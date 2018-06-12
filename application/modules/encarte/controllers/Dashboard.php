<?php

class Dashboard extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->lang->load("application",$this->session->app_lang);
    }

    public function index(){
        $this->home();
    }
    
    public function home() {
        $rede = $this->session->usuario->cod_rede;
        $encartesAtivos = Modules::run('encarte/encarte/ofertasAtivasPorRede', $rede);
        $proxFim = Modules::run('encarte/encarte/ofertasProxFimPorRede', $rede);
        $lojasAtivas = Modules::run('encarte/loja/consultarLojasAtivasPorRede', $rede);
        $param = array(
            'view' => 'encarte/dashboard/index',
            'titulo' => 'Início',
            'js' => 'encarte/dashboard/js',
            'css' => 'encarte/dashboard/css',
            'json' => 'encarte/loja/consultar/null/json',
            'modulo' => 'true',
            'breadcumb' => array(),
            'encartes' => $encartesAtivos[0]->quantidade,
            'proxFim' => $proxFim[0]->quantidade,
            'json' => 'encarte/encarte/tabelaOfertasAtivasPorRede',
            'lojasAtivas' => $lojasAtivas[0]->quantidade
        );
        
        $this->load->view('themes/encarte/core', $param);
    }
}
