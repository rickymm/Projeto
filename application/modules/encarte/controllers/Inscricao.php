<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inscricao extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->lang->load('application', 'portuguese-brazilian');
        $this->load->model('InscricaoModel');
        $this->lang->load("application",$this->session->app_lang);
    }

    public function consultar($filtro = null, $retorno = null) {

        $redes = Modules::run('encarte/Loja/consultarRedes');

        if (is_null($filtro) && is_null($retorno)) {
            $categorias = Modules::run('encarte/Categoria/todos');
            $param = array(
                'view' => 'inscricao/index',
                'titulo' => 'inscrição',
                'subtitulo' => 'inscrição',
                'custom' => 'true',
                'modulo' => 'true',
                'json' => 'encarte/inscricao/consultar/null/json',
                'editar' => 'encarte/inscricao/editar',
                'excluir' => 'encarte/inscricao/remover',
                'redes' => $redes,
                'categorias' => $categorias
            );

            $this->load->view('includes/core', $param);
        }

        if (is_numeric($filtro) && !is_null($retorno) && $retorno == 'json') {

            $consulta = $this->InscricaoModel->consultar($filtro, $retorno);
            $param = array(
                'dataSource' => $consulta
            );
            $this->load->view('core/crud/json', $param);
        } else if (is_numeric($filtro) || is_array($filtro)) {

            $consulta = $this->InscricaoModel->consultar($filtro);
            return $consulta;
        } else if (!is_null($retorno) && $retorno == 'json') {

            $consulta = $this->InscricaoModel->consultar(null, $retorno);
            $param = array(
                'dataSource' => $consulta
            );

            $this->load->view('core/crud/json', $param);
        }
    }

    public function form() {
        $param = array(
            'view' => 'inscricao/form',
            'custom' => 'true',
            'modulo' => 'true'
        );
        $this->load->view('includes/core_single', $param);
    }

    public function salvar($modal = null) {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $post = $this->input->post();
            $cidade = explode(",", $post['cidade']);
            $post['cidade'] = $cidade[0];
            $post['estado'] = trim($cidade[1]);
            if ($result = $this->InscricaoModel->salvar($post)) {
                if ($result > 0) {
                    $this->InscricaoModel->salvarInscricaoCategoria($result, $post['categoria']);
                }
                $this->setSessionMessage('Operação realizada com sucesso', 'alert alert-success');
            } else {
                $this->setSessionMessage('Falha ao realizar operação favor verificar os dados e tentar novamente', 'alert alert-danger');
            }
        }
        if ($modal == true) {
            return $result;
        } else {
            redirect(base_url('encarte/inscricao/consultar'));
        }
    }

    public function editar($id) {

        $result = $this->consultar($id);
        $param = array(
            'dataSource' => $result
        );
        $this->load->view('core/crud/json', $param);
    }

    public function remover($id) {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->InscricaoModel->excluir($id);
        }
    }

    public function todos() {
        return $consulta = $this->InscricaoModel->consultar();
    }

    public function formContato() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $post = $this->input->post();

            $nome = $post['nome'];
            $email = $post['email'];
            $telefone = $post['telefone'];
            $empresa = $post['empresa'];
            $assunto = $post['assunto'];
            $mensagem = $post['mensagem'];

            $assunto = 'Melhor Promoção: ' . $mensagem;
            $mensagem = "Nome: " . $nome . "<br>";
            $mensagem .= "E-mail: " . $email . "<br>";
            $mensagem .= "Telefone: " . $telefone . "<br>";
            $mensagem .= "Empresa: " . $empresa . "<br>";
            $mensagem .= "<br><br>";
            $mensagem .= "$empresa";
            $mensagem .= "<br>";
            $mensagem .= "$mensagem";

            $para = 'lucasms@msn.com';

            if ($this->sendMail($para, $assunto, $mensagem)) {
                $this->setSessionMessage('E-mail enviado com sucesso.', 'success');
            } else {
                $this->setSessionMessage('E-mail não eviado.', 'danger');
                redirect("encarte/comercial/consultar");
            }
        }
    }

    public function sendMail($para, $assunto, $mensagem, $cc = null, $reply = null) {

        $smtp_from = Modules::run('seguranca/parametro/consultaComFiltro', array('vch_chave' => '"smtp_from"'));

        $headers = "From: " . strip_tags($smtp_from[0]->valor) . "\r\n";
        if (isset($reply)) {
            $headers .= "Reply-To: " . strip_tags($reply) . "\r\n";
        }
        if (isset($cc)) {
            $headers .= "CC: igimo@igimo.com.br\r\n";
        }
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        try {
            mail($para, $assunto, $mensagem, $headers);
            return true;
        } catch (Exception $ex) {
            echo $ex;
            return false;
        }
    }

}
