<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Loja extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('LojaModel');
        $this->lang->load("application", $this->session->app_lang);
    }

    public function consultar($filtro = null, $retorno = null) {

        if (is_null($filtro) && is_null($retorno)) {
            $categorias = Modules::run('encarte/Categoria/todos');
            $lojas = $this->consultarLojas();
            $redesFiltro = Modules::run('encarte/Loja/consultarRedes');
            $redes = Modules::run('encarte/Encarte/ofertasAtivas', null, '100', null, null, '0');

            $param = array(
                'view' => 'loja/index',
                'titulo' => 'loja',
                'subtitulo' => 'loja',
                'custom' => 'true',
                'modulo' => 'true',
                'json' => 'encarte/loja/consultar/null/json',
                'editar' => 'encarte/loja/editar',
                'excluir' => 'encarte/loja/remover',
                'categorias' => $categorias,
                'redesFiltro' => $redesFiltro,
                'redes' => $redes,
                'lojas' => $lojas
            );

            $this->load->view('encarte/includes/core', $param);
        }

        if (is_numeric($filtro) && !is_null($retorno) && $retorno == 'json') {

            $consulta = $this->LojaModel->consultar($filtro, $retorno);
            $param = array(
                'dataSource' => $consulta
            );
            $this->load->view('core/crud/json', $param);
        } else if (is_numeric($filtro) || is_array($filtro)) {

            $consulta = $this->LojaModel->consultar($filtro);
            return $consulta;
        } else if (!is_null($retorno) && $retorno == 'json') {
            if (isset($this->session->usuario) && !is_null($this->session->usuario->cod_rede)) {
                $filtro = array(
                    'cod_rede' => $this->session->usuario->cod_rede,
                    0 => '(cod_situacao = 1 OR cod_situacao = 2)'
                );
            }
            $consulta = $this->LojaModel->consultar($filtro, $retorno);
            $param = array(
                'dataSource' => $consulta
            );

            $this->load->view('core/crud/json', $param);
        }
    }

    public function form() {
        $param = array(
            'view' => 'loja/form',
            'custom' => 'true',
            'modulo' => 'true'
        );
        $this->load->view('includes/core_single', $param);
    }

    public function salvar($modal = null) {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $post = $this->input->post();
            if ($result = $this->LojaModel->salvar($post)) {
                $this->setSessionMessage('Operação realizada com sucesso', 'alert alert-success');
            } else {
                $this->setSessionMessage('Falha ao realizar operação favor verificar os dados e tentar novamente', 'alert alert-danger');
            }
        }
        if ($modal == true) {
            return $result;
        } else {
            redirect(base_url('encarte/loja/consultar'));
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
            $this->LojaModel->excluir($id);
        }
    }

    public function inativar() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $cod_loja = $this->input->post('cod_loja');
            $this->LojaModel->inativar($cod_loja);
            $this->setSessionMessage('A loja foi inativada com sucesso!', 'success');
            return;
        }
    }

    public function todos() {
        return $consulta = $this->LojaModel->consultar();
    }

    public function consultarRedes() {
        return $consulta = $this->LojaModel->consultarRedes();
    }

    public function consultarRedesLimit() {
        return $consulta = $this->LojaModel->consultarRedesLimit();
    }
    
    public function consultarRegiao($filtro) {
        return $consulta = $this->LojaModel->consultarRegiao($filtro);
    }

    public function consultarRedesComOfertasAtivas($cod_rede = null) {
        $filtro = array(
            'r.cod_rede' => $cod_rede,
            'l.cod_situacao' => '1',
            '0' => '(TRIM(l.latitude) IS NOT NULL AND TRIM(l.latitude) <> "") AND (TRIM(l.longitude) IS NOT NULL AND TRIM(l.longitude) <> "")',
        );


        if (is_null($cod_rede) || $cod_rede == "null") {
            unset($filtro['r.cod_rede']);
        }
        unset($filtro['enc.cod_categoria']);
        $consulta = $this->LojaModel->consultarLojas($filtro);
        $param = array(
            'dataSource' => $consulta
        );
        $this->load->view('core/crud/json', $param);
    }

    public function consultarLojas($filtro = null) {
        $consulta = $this->LojaModel->consultarLojas($filtro);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $param = array(
                'dataSource' => $consulta
            );
            $this->load->view('core/crud/json', $param);
        } else {
            return $consulta;
        }
    }

    public function consultarEncarteLoja($cod_loja = null) {
        $filtro = array(
            'l.cod_loja' => '84',
        );

        $consulta = $this->LojaModel->consultarEncarteLoja($filtro);

        $param = array(
            'dataSource' => $consulta
        );
        $this->load->view('core/crud/json', $param);
    }
    
    public function consultarLojasAtivasPorRede($rede){
        return $resultado = $this->LojaModel->consultarLojasAtivasPorRede($rede);
    }

    public function clicarLoja($loja) {
        $cod_sessao = $_COOKIE['ci_session'];
        $this->LojaModel->clicarLoja($cod_sessao, $loja);
    }

}
