<?php

class Anuncios extends MX_Controller {

    public function __construct() {
        parent::__construct();
        //para tratar a sessão do waypoint...
        if (sizeof($this->session->usuario) > 1) {
            redirect('encarte/conta/sair');
        }

        $this->load->model('AnunciosModel');
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

    public function dashboard() {
        $this->checarSituacao();

        $param = array(
            'view' => 'encarte/anuncios/dashboard',
            'js' => 'encarte/anuncios/js-anuncios',
            'css' => 'encarte/anuncios/css-anuncios',
            'titulo' => 'Dashboard',
            'breadcumb' => array()
        );

        $this->load->view('themes/encarte/core', $param);
    }
    
    public function criar() {
        $this->checarSituacao();

        $param = array(
            'view' => 'encarte/anuncios/criar',
            'js' => 'encarte/anuncios/js-anuncios',
            'css' => 'encarte/anuncios/css-anuncios',
            'titulo' => 'Nova campanha',
            'breadcumb' => array()
        );

        $this->load->view('themes/encarte/core', $param);
    }

}
