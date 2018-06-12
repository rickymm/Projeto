<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($this->session->usuario) || sizeof($this->session->usuario) > 1) {
            redirect('encarte/conta/sair');
        }
        $this->load->model('PaginaModel');
    }

    public function index() {
        $this->sobre();
    }

    public function sobre($filtro = null, $retorno = null) {

        if (is_null($filtro) && is_null($retorno)) {
            $param = array(
                'view' => 'pagina/sobre',
                'js' => 'pagina/js-sobre',
                'titulo' => 'Sobre',
                'subtitulo' => 'Sobre',
            );

            $this->load->view('themes/encarte/core', $param);
        }
    }
    
    public function privacidade($filtro = null, $retorno = null) {

        if (is_null($filtro) && is_null($retorno)) {
            $param = array(
                'view' => 'pagina/privacidade',
                'js' => 'pagina/js-sobre',
                'titulo' => 'Privacidade',
                'subtitulo' => 'Privacidade',
            );

            $this->load->view('themes/encarte/core', $param);
        }
    }
    
    public function termosUso($filtro = null, $retorno = null) {

        if (is_null($filtro) && is_null($retorno)) {
            $param = array(
                'view' => 'pagina/termo',
                'js' => 'pagina/js-sobre',
                'titulo' => 'Termo de Uso',
                'subtitulo' => 'Termo de Uso',
            );

            $this->load->view('themes/encarte/core', $param);
        }
    }

}
