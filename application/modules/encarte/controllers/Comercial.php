<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Comercial extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ComercialModel');
        $this->lang->load("application",$this->session->app_lang);
    }

    public function consultar($filtro=null, $retorno=null) {

        if (is_null($filtro) && is_null($retorno)) {
            $param=array(
                'view' => 'comercial/index',
                'titulo' => 'comercial',
                'subtitulo' => 'comercial',
                'custom' => 'true',
                'modulo' => 'true',
                'json' => 'encarte/comercial/consultar/null/json',
                'editar' => 'encarte/comercial/editar',
                'excluir' => 'encarte/comercial/remover'
            );

            $this->load->view('includes/core', $param);
        }

        if (is_numeric($filtro) && !is_null($retorno) && $retorno == 'json') {

            $consulta=$this->ComercialModel->consultar($filtro, $retorno);
            $param=array(
                'dataSource' => $consulta
            );
            $this->load->view('core/crud/json', $param);

        } else if (is_numeric($filtro) || is_array($filtro)) {

            $consulta=$this->ComercialModel->consultar($filtro);
            return $consulta;

        } else if (!is_null($retorno) && $retorno == 'json') {

            $consulta=$this->ComercialModel->consultar(null, $retorno);
            $param=array(
                'dataSource' => $consulta
            );

            $this->load->view('core/crud/json', $param);
        }
    }
    
    public function form() {
        $param = array(
            'view' => 'comercial/form',
            'custom' => 'true',
            'modulo' => 'true'
        );
        $this->load->view('includes/core_single', $param);
    }
    
    public function salvar($modal = null) {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $post = $this->input->post();
            if ($result = $this->ComercialModel->salvar($post)) {
                $this->setSessionMessage('Operação realizada com sucesso', 'alert alert-success');
            } else {
                $this->setSessionMessage('Falha ao realizar operação favor verificar os dados e tentar novamente', 'alert alert-danger');
            }
        }
    if($modal == true){
        return $result;
    }else{
        redirect(base_url('encarte/comercial/consultar'));
    }
    }

    public function editar($id) {

        $result=$this->consultar($id);
        $param=array(
            'dataSource' => $result
        );
        $this->load->view('core/crud/json', $param);
    }

    public function remover($id) {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->ComercialModel->excluir($id);
        }

    }

    public function todos() {
        return $consulta=$this->ComercialModel->consultar();
    }
    
}
