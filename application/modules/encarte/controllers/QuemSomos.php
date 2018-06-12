<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class QuemSomos extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('QuemSomosModel');
        $this->lang->load("application",$this->session->app_lang);
    }

    public function consultar($filtro=null, $retorno=null) {

        if (is_null($filtro) && is_null($retorno)) {
            $param=array(
                'view' => 'quemsomos/index',
                'titulo' => 'Quem Somos',
                'subtitulo' => 'Quem Somos',
                'custom' => 'true',
                'modulo' => 'true',
                'json' => 'encarte/quemsomos/consultar/null/json',
                'editar' => 'encarte/quemsomos/editar',
                'excluir' => 'encarte/quemsomos/remover'
            );

            $this->load->view('includes/core', $param);
        }

        if (is_numeric($filtro) && !is_null($retorno) && $retorno == 'json') {

            $consulta=$this->QuemSomosModel->consultar($filtro, $retorno);
            $param=array(
                'dataSource' => $consulta
            );
            $this->load->view('core/crud/json', $param);

        } else if (is_numeric($filtro) || is_array($filtro)) {

            $consulta=$this->QuemSomosModel->consultar($filtro);
            return $consulta;

        } else if (!is_null($retorno) && $retorno == 'json') {

            $consulta=$this->QuemSomosModel->consultar(null, $retorno);
            $param=array(
                'dataSource' => $consulta
            );

            $this->load->view('core/crud/json', $param);
        }
    }
    
    public function form() {
        $param = array(
            'view' => 'quemsomos/form',
            'custom' => 'true',
            'modulo' => 'true'
        );
        $this->load->view('includes/core_single', $param);
    }
    
    public function salvar($modal = null) {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $post = $this->input->post();
            if ($result = $this->QuemSomosModel->salvar($post)) {
                $this->setSessionMessage('Operação realizada com sucesso', 'alert alert-success');
            } else {
                $this->setSessionMessage('Falha ao realizar operação favor verificar os dados e tentar novamente', 'alert alert-danger');
            }
        }
    if($modal == true){
        return $result;
    }else{
        redirect(base_url('encarte/quemsomos/consultar'));
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
            $this->QuemSomosModel->excluir($id);
        }

    }

    public function todos() {
        return $consulta=$this->QuemSomosModel->consultar();
    }
    
}
