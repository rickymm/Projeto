<?php

class Home extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->lang->load("application", $this->session->app_lang);
    }

    public function index() {
        $this->consultar();
    }

    public function consultar() {

        $supermercados = Modules::run('encarte/Encarte/ofertasAtivasPorCategoria', 1);
        $eletronicos = Modules::run('encarte/Encarte/ofertasAtivasPorCategoria', 2);
        $moda = Modules::run('encarte/Encarte/ofertasAtivasPorCategoria', 3);
        $saude = Modules::run('encarte/Encarte/ofertasAtivasPorCategoria', 4);
        $construir = Modules::run('encarte/Encarte/ofertasAtivasPorCategoria', 5);
        $viagem = Modules::run('encarte/Encarte/ofertasAtivasPorCategoria', 6);
        $automoveis = Modules::run('encarte/Encarte/ofertasAtivasPorCategoria', 7);
        $restaurantes = Modules::run('encarte/Encarte/ofertasAtivasPorCategoria', 8);
        $criancas = Modules::run('encarte/Encarte/ofertasAtivasPorCategoria', 9);
        $outros = Modules::run('encarte/Encarte/ofertasAtivasPorCategoria', 9);
        $recentes = Modules::run('encarte/Encarte/ofertasAtivasRecentes');
        $redes = Modules::run('encarte/Loja/consultarRedesLimit');

        $param = array(
            'view' => 'encarte/home/index',
            'titulo' => 'Início',
            'custom' => 'true',
            'modulo' => 'true',
            'supermercados' => $supermercados,
            'eletronicos' => $eletronicos,
            'moda' => $moda,
            'saude' => $saude,
            'construir' => $construir,
            'viagem' => $viagem,
            'automoveis' => $automoveis,
            'restaurantes' => $restaurantes,
            'criancas' => $criancas,
            'outros' => $outros,
            'recentes' => $recentes,
            'redes' => $redes,
        );

        $this->load->view('encarte/includes/core', $param);
    }

    public function visualizar() {
        $arquivo = 'MestradoIFBA.pdf';
        redirect('flipview/php/simple_document.php?subfolder=&doc=' . $arquivo);
    }

    public function salvarSessionLocation($lat = null, $long = null) {
        $this->session->set_userdata('latitude', $lat);
        $this->session->set_userdata('longitude', $long);
    }

}
