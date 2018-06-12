<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rede extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('RedeModel');
        $this->lang->load("application",$this->session->app_lang);
    }

    public function consultar($filtro = null, $retorno = null) {

        if (is_null($filtro) && is_null($retorno)) {

            $redesFiltro = Modules::run('encarte/Loja/consultarRedes');

            $param = array(
                'view' => 'encarte/rede/index',
                'custom' => 'true',
                'modulo' => 'true',
                'json' => 'encarte/categoria/consultar/null/json',
                'editar' => 'encarte/categoria/editar',
                'excluir' => 'encarte/categoria/remover',
                'titulo' => 'Rede',
                'redesFiltro' => $redesFiltro
            );

            $this->load->view('includes/core', $param);
        }

        if (is_numeric($filtro) && !is_null($retorno) && $retorno == 'json') {

            $consulta = $this->RedeModel->consultar($filtro, $retorno);
            $param = array(
                'dataSource' => $consulta
            );
            $this->load->view('core/crud/json', $param);
        } else if (is_numeric($filtro) || is_array($filtro)) {

            $consulta = $this->RedeModel->consultar($filtro);
            return $consulta;
        } else if (!is_null($retorno) && $retorno == 'json') {

            $consulta = $this->RedeModel->consultar(null, $retorno);
            $param = array(
                'dataSource' => $consulta
            );

            $this->load->view('core/crud/json', $param);
        }
    }

    public function consultarRede($filtro = null) {
        $coordenada = null;
        if (isset($this->session->latitude)) {
            $coordenada = $this->session->latitude . "_" . $this->session->longitude;
        }

        if (is_numeric($filtro)) {
            $redeAtual = $this->RedeModel->consultarRede($filtro);
            $filter = array(
                'r.cod_rede' => $filtro,
            );
            $encartes = Modules::run('encarte/Encarte/ofertasAtivas', null, 100, null, $coordenada, $filtro);
            $enderecos = $this->consultarEndereco($filtro,$coordenada);

            $param = array(
                'view' => 'encarte/rede/rede',
                'custom' => 'true',
                'modulo' => 'true',
                'json' => 'encarte/categoria/consultar/null/json',
                'editar' => 'encarte/categoria/editar',
                'excluir' => 'encarte/categoria/remover',
                'titulo' => 'Rede',
                'redeAtual' => $redeAtual,
                'encartes' => $encartes,
                'enderecos' => $enderecos
            );

            $this->load->view('includes/core', $param);
        }
    }

    public function form() {
        $param = array(
            'view' => 'rede/form',
            'custom' => 'true',
            'modulo' => 'true'
        );
        $this->load->view('includes/core_single', $param);
    }

    public function salvar($modal = null) {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $post = $this->input->post();
            if ($result = $this->RedeModel->salvar($post)) {
                $this->setSessionMessage('Operação realizada com sucesso', 'alert alert-success');
            } else {
                $this->setSessionMessage('Falha ao realizar operação favor verificar os dados e tentar novamente', 'alert alert-danger');
            }
        }
        if ($modal == true) {
            return $result;
        } else {
            redirect(base_url('encarte/rede/consultar'));
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
            $this->RedeModel->excluir($id);
        }
    }

    public function todos() {
        return $consulta = $this->RedeModel->consultar();
    }

    public function consultarEndereco($cod_rede = null, $coordenada = null) {

        $consulta = $this->RedeModel->consultarEndereco($cod_rede,$coordenada);
        return $consulta;
        /* $param = array(
          'dataSource' => $consulta
          );
          $this->load->view('core/crud/json', $param);
         */
    }

}
