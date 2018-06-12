<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notificacao extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('NotificacaoModel');
        $this->lang->load("application",$this->session->app_lang);
    }

    public function consultar($filtro=null, $retorno=null) {

        if (is_null($filtro) && is_null($retorno)) {
            
            $redes = Modules::run('encarte/Loja/consultarRedes');
            
            
            $param=array(
                'view' => 'notificacao/index',
                'titulo' => 'Notificacao',
                'subtitulo' => 'CRUD Notificacao',
                'custom' => 'true',
                'modulo' => 'true',
                'redes' => $redes,
                'json' => 'encarte/notificacao/consultar/null/json',
                'editar' => 'encarte/notificacao/editar',
                'excluir' => 'encarte/notificacao/remover'
            );

            $this->load->view('includes/core', $param);
        }

        if (is_numeric($filtro) && !is_null($retorno) && $retorno == 'json') {

            $consulta=$this->NotificacaoModel->consultar($filtro, $retorno);
            $param=array(
                'dataSource' => $consulta
            );
            $this->load->view('core/crud/json', $param);

        } else if (is_numeric($filtro) || is_array($filtro)) {

            $consulta=$this->NotificacaoModel->consultar($filtro);
            return $consulta;

        } else if (!is_null($retorno) && $retorno == 'json') {

            $consulta=$this->NotificacaoModel->consultar(null, $retorno);
            $param=array(
                'dataSource' => $consulta
            );

            $this->load->view('core/crud/json', $param);
        }
    }
    
    public function form() {
        $param = array(
            'view' => 'notificacao/form',
            'custom' => 'true',
            'modulo' => 'true'
        );
        $this->load->view('includes/core_single', $param);
    }
    
    public function salvar($modal = null) {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $post = $this->input->post();
            if ($result = $this->NotificacaoModel->salvar($post)) {
                $this->setSessionMessage('Operação realizada com sucesso', 'alert alert-success');
            } else {
                $this->setSessionMessage('Falha ao realizar operação favor verificar os dados e tentar novamente', 'alert alert-danger');
            }
        }
    if($modal == true){
        return $result;
    }else{
        redirect(base_url('encarte/notificacao/consultar'));
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
            $this->NotificacaoModel->excluir($id);
        }

    }

    public function todos() {
        return $consulta=$this->NotificacaoModel->consultar();
    }
    
}
