<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($this->session->usuario) || sizeof($this->session->usuario) > 1) {
            redirect('encarte/conta/sair');
        }
        $this->load->model('UsuarioModel');
    }

    public function index() {
        $this->consultar();
    }

    public function consultar($filtro = null, $retorno = null) {
        if ($this->session->usuario->cod_funcao == "0") {
            if (is_null($filtro) && is_null($retorno)) {

                $param = array(
                    'view' => 'usuario/index',
                    'js' => 'js-usuario',
                    'titulo' => 'Usuário',
                    'subtitulo' => 'Usuário',
                    'json' => 'encarte/usuario/consultar/null/json',
                    'create' => 'encarte/usuario/salvar'
                );

                $this->load->view('themes/encarte/core', $param);
            } else if ($filtro == "null" && $retorno == "json") {
                $filtro = array('cod_rede' => $this->session->usuario->cod_rede);
                $consulta = $this->UsuarioModel->consultar($filtro);

                $param = array(
                    'dataSource' => $consulta
                );

                $this->load->view('core/crud/json', $param);
            }
        }else{
            redirect(base_url('encarte/upload'));
        }
    }

    public function perfil($filtro = null, $retorno = null) {

        if (is_null($filtro) && is_null($retorno)) {
            $param = array(
                'view' => 'usuario/perfil',
                'js' => 'usuario/js-perfil',
                'titulo' => 'Perfil do usuário',
                'subtitulo' => 'Perfil do usuário',
            );

            $this->load->view('themes/encarte/core', $param);
        }
    }

    public function salvar() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $post = $this->input->post();
            unset($post['confirmacao_senha']);
            if (isset($post['senha'])){
                $post['senha'] = md5($post['senha']);
            }
            
            if ($result = $this->UsuarioModel->salvar($post)) {
                $this->setSessionMessage('Operação realizada com sucesso', 'success');
                redirect(base_url('encarte/usuario/index'));
            } else {
                $this->setSessionMessage('Falha ao realizar operação favor verificar os dados e tentar novamente', 'danger');
            }
        }
    }
    
    public function alterarSenha() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $post = $this->input->post();
            unset($post['confirmacao_senha']);
            if (isset($post['senha'])){
                $post['senha'] = md5($post['senha']);
            }
            
            if ($result = $this->UsuarioModel->salvar($post)) {
                $this->setSessionMessage('Operação realizada com sucesso', 'success');
                redirect(base_url('encarte/upload/rede'));
            } else {
                $this->setSessionMessage('Falha ao realizar operação favor verificar os dados e tentar novamente', 'danger');
            }
        }
    }

}
