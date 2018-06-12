<?php

class Relatorios extends MX_Controller {

    public function __construct() {
        parent::__construct();
        //para tratar a sessão do waypoint...
        if (sizeof($this->session->usuario) > 1) {
            redirect('encarte/conta/sair');
        }

        $this->load->model('RelatoriosModel');
    }

    public function index() {
        if (!isset($this->session->usuario)) {
            redirect('encarte/conta');
        } else {
            $this->rede();
        }
    }
    
    public function relatorios($data_ini = null, $data_fim = null, $opcao) {
        $cod_rede = $this->session->usuario->cod_rede;
        switch ($opcao){
            case 'loja':
                $this->consultarCliquePorLoja($cod_rede, $data_ini, $data_fim);
            break;
            case 'regiao':
                $this->consultarCliquePorRegiao($cod_rede, $data_ini, $data_fim);
            break;
            case 'estado':
                $this->consultarCliquePorEstado($cod_rede, $data_ini, $data_fim);
            break;
            case 'cidade':
                $this->consultarCliquePorCidade($cod_rede, $data_ini, $data_fim);
            break;
        }
        
    }

    private function checarSituacao() {
        if (isset($this->session->usuario) && $this->session->usuario->cod_situacao == '2') {
            redirect('encarte/upload/rede');
        }
    }

    public function clique() {
        $this->checarSituacao();
        
        $param = array(
            'view' => 'encarte/relatorios/clique',
            'js' => 'encarte/relatorios/js-clique',
            'css' => 'encarte/relatorios/css-clique',
            'titulo' => 'Cliques',
            'breadcumb' => array()
        );

        $this->load->view('themes/encarte/core', $param);
    }

    public function consultarCliquePorLoja($cod_rede, $data_ini = null, $data_fim = null) {
        $filtro = array(
            'r.cod_rede' => $cod_rede,
        );
        if($data_ini != "null" && $data_fim != "null" ){
            $filtro[0] = 'DATE_FORMAT(a.data, "%Y-%m-%d") between "' . $data_ini . '" AND "' . $data_fim . '"';
        }
   
        $consulta = $this->RelatoriosModel->consultarCliquePorLoja($filtro);
        
        $param = array(
            'dataSource' => $consulta
        );
        $this->load->view('core/crud/jsonSemData', $param);
    }
    
    public function consultarCliquePorRegiao($cod_rede, $data_ini = null, $data_fim = null) {
        $filtro = array(
            'r.cod_rede' => $cod_rede,
        );
        if($data_ini != "null" && $data_fim != "null" ){
            $filtro[0] = 'DATE_FORMAT(a.data, "%Y-%m-%d") between "' . $data_ini . '" AND "' . $data_fim . '"';
        }
   
        $consulta = $this->RelatoriosModel->consultarCliquePorRegiao($filtro);
        
        $param = array(
            'dataSource' => $consulta
        );
        $this->load->view('core/crud/jsonSemData', $param);
    }
    
    public function consultarCliquePorEstado($cod_rede, $data_ini = null, $data_fim = null) {
        $filtro = array(
            'r.cod_rede' => $cod_rede,
        );
        if($data_ini != "null" && $data_fim != "null" ){
            $filtro[0] = 'DATE_FORMAT(a.data, "%Y-%m-%d") between "' . $data_ini . '" AND "' . $data_fim . '"';
        }
   
        $consulta = $this->RelatoriosModel->consultarCliquePorEstado($filtro);
        
        $param = array(
            'dataSource' => $consulta
        );
        $this->load->view('core/crud/jsonSemData', $param);
    }
    
    public function consultarCliquePorCidade($cod_rede, $data_ini = null, $data_fim = null) {
        $filtro = array(
            'r.cod_rede' => $cod_rede,
        );
        if($data_ini != "null" && $data_fim != "null" ){
            $filtro[0] = 'DATE_FORMAT(a.data, "%Y-%m-%d") between "' . $data_ini . '" AND "' . $data_fim . '"';
        }
   
        $consulta = $this->RelatoriosModel->consultarCliquePorCidade($filtro);
        
        $param = array(
            'dataSource' => $consulta
        );
        $this->load->view('core/crud/jsonSemData', $param);
    }

}
