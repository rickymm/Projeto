<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CategoriaModel');
        $this->lang->load("application",$this->session->app_lang);
    }

    public function consultar($filtro = null, $retorno = null, $categoria = null) {
        if (!is_null($categoria)){
            $this->clicarCategoria($categoria);
        }
        
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $estado = $this->input->post('estado');
        } else {
            $estado = null;
        }
        
        $coordenada = null;
        if (isset($this->session->latitude)) {
            $coordenada = $this->session->latitude . "_" . $this->session->longitude;
        }
        
        
        $encartes = Modules::run('encarte/Encarte/ofertasAtivas', $categoria, null, $estado, $coordenada);
        $categorias = Modules::run('encarte/Categoria/todos');
        $redes = Modules::run('encarte/Encarte/ofertasAtivas', null, '100', null, $coordenada, '0');
        $redesFiltro = Modules::run('encarte/Encarte/ofertasAtivas', null, null, null, $coordenada, '0');
        if ((is_null($filtro) || $filtro == 'null') && (is_null($retorno) || $retorno == 'null')) {
            $param = array(
                'view' => 'encarte/categoria/index',
                'titulo' => 'Categoria',
                'subtitulo' => 'CRUD Categoria',
                'custom' => 'true',
                'modulo' => 'true',
                'json' => 'encarte/categoria/consultar/null/json',
                'editar' => 'encarte/categoria/editar',
                'excluir' => 'encarte/categoria/remover',
                'estado' => $estado,
                'encartes' => $encartes,
                'categorias' => $categorias,
                'categoria_filtrada' => $categoria,
                'redes' => $redes,
                'redesFiltro' => $redesFiltro
            );
            $this->load->view('encarte/includes/core', $param);
        }

        if (is_numeric($filtro) && !is_null($retorno) && $retorno == 'json') {
            $consulta = $this->CategoriaModel->consultar($filtro, $retorno);
            $param = array(
                'dataSource' => $consulta
            );
            $this->load->view('core/crud/json', $param);
        } else if (is_numeric($filtro) || is_array($filtro)) {
            $consulta = $this->CategoriaModel->consultar($filtro);
            return $consulta;
        } else if (!is_null($retorno) && $retorno == 'json') {
            $consulta = $this->CategoriaModel->consultar(null, $retorno);
            $param = array(
                'dataSource' => $consulta
            );

            $this->load->view('core/crud/json', $param);
        }
    }

    public function form() {
        $param = array(
            'view' => 'categoria/form',
            'custom' => 'true',
            'modulo' => 'true'
        );
        $this->load->view('includes/core_single', $param);
    }

    public function salvar($modal = null) {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $post = $this->input->post();
            if ($result = $this->CategoriaModel->salvar($post)) {
                $this->setSessionMessage('Operação realizada com sucesso', 'alert alert-success');
            } else {
                $this->setSessionMessage('Falha ao realizar operação favor verificar os dados e tentar novamente', 'alert alert-danger');
            }
        }
        if ($modal == true) {
            return $result;
        } else {
            redirect(base_url('encarte/categoria/consultar'));
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
            $this->CategoriaModel->excluir($id);
        }
    }

    public function todos() {
        return $consulta = $this->CategoriaModel->consultar();
    }

    public function filtrarEncarte($cod_categoria = null, $lat = null, $lon = null, $rede = null) {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $consulta = Modules::run('encarte/Encarte/ofertasAtivas', $this->input->post('cod_categoria'), $this->input->post('distancia'), null, $this->input->post('lat') . '_' . $this->input->post('long'), $this->input->post('cod_rede'));
            $param = array(
                'dataSource' => $consulta
            );

            $this->load->view('core/crud/json', $param);
        } else {
            $consulta = Modules::run('encarte/Encarte/ofertasAtivas', $cod_categoria, null, null, $lat . '_' . $lon, $rede);
            return $consulta;
        }
    }
    
    public function clicarCategoria($categoria){
        //inserir na tabela enc_acesso_categoria usando para o cod_sessao o $_COOKIE['ci_session'] e $categoria
        $cod_sessao = $_COOKIE['ci_session'];
        $this->CategoriaModel->clicarCategoria($cod_sessao, $categoria);
    }

}
