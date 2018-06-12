<?php

class Upload extends MX_Controller {

    public function __construct() {
        parent::__construct();
        //para tratar a sessão do waypoint...
        if (sizeof($this->session->usuario) > 1) {
            redirect('encarte/conta/sair');
        }

        $this->load->model('UploadModel');
    }

    public function index() {
        if (!isset($this->session->usuario)) {
            redirect('encarte/conta');
        } else {
            $this->rede();
        }
    }

    private function checarSituacao() {
        if (isset($this->session->usuario) && $this->session->usuario->cod_situacao == '2') {
            redirect('encarte/upload/rede');
        }
    }

    public function rede() {
        $param = array(
            'view' => 'encarte/upload/rede',
            'js' => 'encarte/upload/js-rede',
            'css' => 'encarte/upload/css-rede',
            'titulo' => 'Rede',
            'breadcumb' => array()
        );

        if ($this->session->usuario->cod_situacao == '1') {
            $param['rede'] = $this->UploadModel->consultarRede($this->session->usuario->cod_rede);
        }
        $this->load->view('themes/encarte/core', $param);
    }

    public function encarte() {
        $this->checarSituacao();
        $param = array(
            'view' => 'encarte/upload/encarte',
            'js' => 'encarte/upload/js-encarte',
            'titulo' => 'Encarte',
            'lojas' => $this->arvoreLojas(),
            'categorias' => $this->categorias(),
            'tags' => $this->tags(),
            'breadcumb' => array()
        );
        $this->load->view('themes/encarte/core', $param);
    }

    public function arvoreLojas() {
        $cod_rede = $this->session->usuario->cod_rede;
        $regioes = Modules::run("encarte/loja/consultarRegiao", array('l.cod_rede' => $cod_rede));
        $arvore = array();
        if (sizeof($regioes) > 0) {
            for ($contador = 0; $contador < sizeof($regioes); $contador++) {
                $estados = $this->UploadModel->consultarEstados(array('l.cod_rede' => $cod_rede, 'r.cod_regiao' => $regioes[$contador]->cod_regiao));
                $arvore[$contador] = (object) [
                            'id' => $regioes[$contador]->cod_regiao,
                            'text' => $regioes[$contador]->regiao,
                            'expanded' => true,
                            'items' => array()
                ];
                for ($contador2 = 0; $contador2 < sizeof($estados); $contador2++) {
                    $cidades = $this->UploadModel->consultarCidades(array('l.cod_rede' => $cod_rede, 'e.cod_estado' => $estados[$contador2]->cod_estado));
                    $arvore[$contador]->items[$contador2] = (object) [
                                'id' => $estados[$contador2]->cod_estado,
                                'text' => $estados[$contador2]->estado,
                                'expanded' => false,
                                'items' => array()
                    ];
                    for ($contador3 = 0; $contador3 < sizeof($cidades); $contador3++) {
                        $lojas = $this->UploadModel->consultarLojas(array('l.cod_rede' => $cod_rede, 'l.cidade' => "'" . $cidades[$contador3]->cidade . "'"));
                        $arvore[$contador]->items[$contador2]->items[$contador3] = (object) [
                                    'id' => $cidades[$contador3]->cidade,
                                    'text' => $cidades[$contador3]->cidade,
                                    'expanded' => false,
                                    'items' => array()
                        ];
                        for ($contador4 = 0; $contador4 < sizeof($lojas); $contador4++) {
                            $arvore[$contador]->items[$contador2]->items[$contador3]->items[$contador4] = (object) [
                                        'id' => $lojas[$contador4]->cod_loja,
                                        'text' => $lojas[$contador4]->nome
                            ];
                        }
                    }
                }
            }
            return json_encode($arvore);
        } else {
            $this->setSessionMessage('Para cadastrar encarte, é necessário ter alguma loja cadastrada.', 'warning');
            redirect(base_url('encarte/upload/loja'));
        }
    }

    public function loja() {
        $this->checarSituacao();
        $param = array(
            'view' => 'encarte/upload/loja',
            'js' => 'encarte/upload/js-loja',
            'css' => 'encarte/upload/css-loja',
            'json' => 'encarte/loja/consultar/null/json',
            'titulo' => 'Loja',
            'breadcumb' => array()
        );

        $this->load->view('themes/encarte/core', $param);
    }

    private function categorias() {
        return Modules::run('encarte/categoria/todos');
    }

    private function tags() {
        return $this->UploadModel->consultarTags($this->session->usuario->cod_rede);
    }

    public function enviarEncarte() {
        if ($_FILES['arquivo']['name'] != "") {
            if (!isset($this->session->usuario)) {
                redirect('encarte/conta/sair');
            }
            $rede = $this->session->usuario->cod_rede;
            //Diretório
            $uploaddir = 'uploads/encarte/pdf/';
            //Rede_diaMesAno_arquivo.pdf
            $vch_arquivo = $rede . '_' . date('dmy') . '_' . $_FILES['arquivo']['name'];

            $ext = substr($vch_arquivo, strpos($vch_arquivo, ".") + 1);
            if ($ext == 'pdf') {
                //vch_arquivo tem que mudar para cod_rede(session) + dia + encarte_nome
                $uploadfile = $uploaddir . $vch_arquivo;
                if (!file_exists($uploadfile)) {
                    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile)) {
                        $imagem_destacada = $this->gerarThumbnail($vch_arquivo);
                    }
                } else {
                    $this->setSessionMessage('O encarte selecionado já existe.', 'warning');
                    redirect(base_url('encarte/upload/encarte'));
                }

                //inserir no banco de dados as informações
                $dados = $this->input->post();
                if(empty($dados['lojas'])){
                    $this->setSessionMessage('Nenhuma loja foi selecionada.', 'warning');
                    redirect(base_url('encarte/upload/encarte'));
                }
                $enviar = array();
                $enviar['nome'] = $vch_arquivo;
                $enviar['observacao'] = $dados['observacao'];
                $enviar['pdf'] = $vch_arquivo;
                $enviar['data_cadastro'] = date('Y-m-d');
                $enviar['data_fim'] = $this->dateToFormat($dados['data_vencimento'], 'Y-m-d');
                $enviar['data_inicio'] = $this->dateToFormat($dados['data_inicio'], 'Y-m-d');
                $enviar['imagem_destacada'] = $imagem_destacada;

                $cod_encarte = $this->UploadModel->salvar($enviar);

                foreach ($dados['categoria'] as $categoria) {
                    $catEnc = array(
                        'cod_categoria' => $categoria,
                        'cod_encarte' => $cod_encarte,
                        'data' => date('Y-m-d')
                    );
                    $this->UploadModel->categoriaEncarte($catEnc);
                }

                foreach ($dados['tags'] as $tag) {
                    $tagEnc = array(
                        'tag' => $tag,
                        'cod_encarte' => $cod_encarte,
                        'data' => date('Y-m-d')
                    );
                    $this->UploadModel->tagEncarte($tagEnc);
                }
                $lojas = explode(',', $dados['lojas']);
                foreach ($lojas as $loja) {
                    if (is_numeric($loja)) {
                        $lojaEnc = array(
                            'cod_loja' => $loja,
                            'cod_encarte' => $cod_encarte,
                            'data_inicio' => $enviar['data_inicio'],
                            'data_fim' => $enviar['data_fim']
                        );
                        $this->UploadModel->lojaEncarte($lojaEnc);
                    }
                }
                $this->setSessionMessage('O PDF foi enviado com sucesso!', 'success');
                redirect(base_url('encarte/upload/encarte'));
            } else {
                $this->setSessionMessage('O arquivo selecionado não é um PDF. Favor inserir um PDF.', 'warning');
                redirect(base_url('encarte/upload/encarte'));
            }
        } else {
            $this->setSessionMessage('Nenhum arquivo foi selecionado.', 'warning');
            redirect('encarte/upload/encarte');
        }
    }

    public function gerarThumbnail($arquivo) {
        $nome = str_replace('.pdf', '', $arquivo);
        $image = $_SERVER['DOCUMENT_ROOT'] . '/WPW/uploads/encarte/pdf/' . $nome . '.pdf[0]';
        $im = new Imagick($image); // 0-first page, 1-second page
        $im->setImageColorspace(255); // prevent image colors from inverting
        $im->setimageformat("png");
        $im->setImageCompression(Imagick::COMPRESSION_LZW);
        $im->setImageCompressionQuality(92);
        $im->thumbnailimage(267, 386.66); // width and height
        $im->writeimage($_SERVER['DOCUMENT_ROOT'] . '/WPW/uploads/encarte/imagem_destacada/' . $nome . '.png');
        $im->clear();
        $im->destroy();
        return $nome . '.png';
    }

    public function salvarRede() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $dados = $this->input->post();
            $dados['cod_situacao'] = '1';
            $dados['icone'] = $_FILES['icone']['name'];
            $dados['marca'] = $_FILES['marca']['name'];
            if ($rede = $this->UploadModel->salvarRede($dados)) {
                if (!file_exists('uploads/encarte/pdf/' . $rede) && !file_exists('uploads/encarte/imagem_destacada/' . $rede)) {
                    mkdir('uploads/encarte/pdf/' . $rede, 0777, true);
                    mkdir('uploads/encarte/imagem_destacada/' . $rede, 0777, true);
                    $this->salvarMarcaIconeRede($rede);
                } else if (!file_exists('uploads/logos_imagens/icones/' . $rede . '_*.png') && !file_exists('uploads/logos_imagens/marcas/' . $rede . '_*.png')) {
                    $this->salvarMarcaIconeRede($rede);
                }
                $usuario = $this->session->usuario->cod_usuario;
                $atualizar = array(
                    'cod_usuario' => $usuario,
                    'cod_situacao' => '1',
                    'cod_rede' => $rede
                );
                if ($this->UploadModel->updateUsuario($atualizar)) {
                    $sessao = $this->session->usuario;
                    $sessao->cod_situacao = '1';
                    $sessao->cod_rede = $rede;
                    $this->session->set_userdata('usuario', $sessao);
                    $this->setSessionMessage('Seu cadastro foi finalizado, agora você pode cadastrar Lojas e Encartes!', 'success');
                    redirect(base_url('encarte/upload/rede'));
                } else {
                    $this->setSessionMessage('Informações sobre a sua Rede foram alteradas com sucesso!', 'success');
                    redirect(base_url('encarte/upload/loja'));
                }
            } else {
                $this->setSessionMessage('Ocorreu um erro ao salvar a rede. Por favor ente novamente.', 'error');
                redirect(base_url('encarte/upload/rede'));
            }
        }
    }

    public function salvarLoja() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $dados = $this->input->post();
            $dados['cod_situacao'] = 1;
            if ($this->validar_cnpj($dados['cnpj'])) {
                $dados['valida_cnpj'] = 0;
            } else {
                $dados['valida_cnpj'] = 1;
                $dados['cod_situacao'] = 2;
            }
            $endereco = $dados['endereco'] . '+' . $dados['bairro'] . '+' . $dados['cidade'] . '+' . $dados['estado'] . '+Brasil';
            $resultado = $this->consultarLocalizacao(str_replace(' ', '+', $endereco));
            if (isset($resultado->results[0])) {
                $dados['latitude'] = $resultado->results[0]->geometry->location->lat;
                $dados['longitude'] = $resultado->results[0]->geometry->location->lng;
                $dados['valida_endereco'] = 0;
            } else {
                $dados['latitude'] = '';
                $dados['longitude'] = '';
                $dados['valida_endereco'] = 1;
                $dados['cod_situacao'] = 2;
            }
            $cod_loja = $this->UploadModel->updateLoja($dados);
        }
        if (!is_null($cod_loja)) {
            $this->setSessionMessage('Loja atualizada com sucesso', 'success');
        } else {
            $this->setSessionMessage('Erro ao atualizar loja', 'danger');
        }
        redirect(base_url('encarte/upload/loja'));
    }

    public function importar() {
        $this->load->library('excel_reader');
        try {
            $ext = substr($_FILES['file']['name'], -4);
            if ($ext == '.xls') {//validação para formato apenas .xls
                $this->excel_reader->read($_FILES['file']['tmp_name']);
                $worksheet = $this->excel_reader->sheets[0];
                $cells = $worksheet['cells'];
                $count = count($cells); //contabiliza a quantidade de linhas

                if ($count) {
                    for ($linha = 2; $linha < $count + 1; $linha++) {
                        $coluna = 1;
                        $dados['cod_situacao'] = 1;
                        $dados['nome'] = $cells[$linha][$coluna++];
                        $dados['cnpj'] = $cells[$linha][$coluna++];
                        if ($this->validar_cnpj($dados['cnpj'])) {
                            $dados['valida_cnpj'] = 0;
                        } else {
                            $dados['valida_cnpj'] = 1;
                            $dados['cod_situacao'] = 2;
                        }
                        $dados['estado'] = $cells[$linha][$coluna++];
                        $dados['cidade'] = $cells[$linha][$coluna++];
                        $dados['bairro'] = $cells[$linha][$coluna++];
                        $dados['endereco'] = $cells[$linha][$coluna++];
                        $dados['telefone'] = $cells[$linha][$coluna++];
                        $dados['aniversario'] = $cells[$linha][$coluna++];
                        $dados['qtd_checkout'] = $cells[$linha][$coluna++];
                        $dados['cod_rede'] = $this->session->usuario->cod_rede;

                        $endereco = $dados['endereco'] . '+' . $dados['bairro'] . '+' . $dados['cidade'] . '+' . $dados['estado'] . '+Brasil';
                        $resultado = $this->consultarLocalizacao(str_replace(' ', '+', $endereco));
                        if (isset($resultado->results[0])) {
                            $dados['latitude'] = $resultado->results[0]->geometry->location->lat;
                            $dados['longitude'] = $resultado->results[0]->geometry->location->lng;
                            $dados['valida_endereco'] = 0;
                        } else {
                            $dados['latitude'] = '';
                            $dados['longitude'] = '';
                            $dados['valida_endereco'] = 1;
                            $dados['cod_situacao'] = 2;
                        }
                        $cod_loja = $this->UploadModel->inserirLoja($dados);
                    }
                }
                if (!is_null($cod_loja)) {
                    $this->setSessionMessage('Loja(s) importada(s) com sucesso', 'success');
                } else {
                    $this->setSessionMessage('Erro ao importar planilha', 'danger');
                }
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        redirect(base_url('encarte/upload/loja'));
    }

    public function consultarLocalizacao($address) {
        $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $address . '&sensor=false');

        return json_decode($geocode);
    }

    public function validar_cnpj($cnpj) {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
    }

    private function salvarMarcaIconeRede($rede) {
        if ($_FILES['icone']['name'] != "" && $_FILES['marca']['name'] != "") {
            if (!isset($this->session->usuario)) {
                redirect('encarte/conta/sair');
            }
            //Diretório + arquivo
            $dir_marca = 'uploads/logos_imagens/marcas/';
            $vch_marca = $rede . '_' . $_FILES['marca']['name'];

            $dir_icone = 'uploads/logos_imagens/icones/';
            $vch_icone = $rede . '_' . $_FILES['icone']['name'];

            $ext_icone = substr($vch_icone, strpos($vch_icone, ".") + 1);
            $ext_marca = substr($vch_marca, strpos($vch_marca, ".") + 1);
            if ($ext_icone == 'png' && $ext_icone == 'png') {
                //vch_arquivo tem que mudar para cod_rede(session) + dia + encarte_nome
                $upload_marca = $dir_marca . $vch_marca;
                $upload_icone = $dir_icone . $vch_icone;
                if (!file_exists($upload_marca) && !file_exists($upload_icone)) {
                    move_uploaded_file($_FILES['marca']['tmp_name'], $upload_marca);
                    move_uploaded_file($_FILES['icone']['tmp_name'], $upload_icone);
                } else {
                    $this->setSessionMessage('O encarte selecionado já existe.', 'warning');
                    redirect(base_url('encarte/upload/encarte'));
                }
            }
        }
    }

}
