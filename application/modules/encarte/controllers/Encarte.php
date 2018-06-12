<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Encarte extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('EncarteModel');
        $this->lang->load("application", $this->session->app_lang);
    }

    public function consultar($filtro = null, $retorno = null) {

        if (is_null($filtro) && is_null($retorno)) {
            $param = array(
                'view' => 'encarte/index',
                'titulo' => 'Encarte',
                'subtitulo' => 'CRUD Encarte',
                'custom' => 'true',
                'modulo' => 'true',
                'json' => 'encarte/encarte/consultar/null/json',
                'editar' => 'encarte/encarte/editar',
                'excluir' => 'encarte/encarte/remover'
            );

            $this->load->view('includes/core', $param);
        }

        if (is_numeric($filtro) && !is_null($retorno) && $retorno == 'json') {

            $consulta = $this->EncarteModel->consultar($filtro, $retorno);
            $param = array(
                'dataSource' => $consulta
            );
            $this->load->view('core/crud/json', $param);
        } else if (is_numeric($filtro) || is_array($filtro)) {

            $consulta = $this->EncarteModel->consultar($filtro);
            return $consulta;
        } else if (!is_null($retorno) && $retorno == 'json') {

            $consulta = $this->EncarteModel->consultar(null, $retorno);
            $param = array(
                'dataSource' => $consulta
            );

            $this->load->view('core/crud/json', $param);
        }
    }

    public function form() {
        $param = array(
            'view' => 'encarte/form',
            'custom' => 'true',
            'modulo' => 'true'
        );
        $this->load->view('includes/core_single', $param);
    }

    public function salvar($modal = null) {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $post = $this->input->post();
            if ($result = $this->EncarteModel->salvar($post)) {
                $this->setSessionMessage('Operação realizada com sucesso', 'alert alert-success');
            } else {
                $this->setSessionMessage('Falha ao realizar operação favor verificar os dados e tentar novamente', 'alert alert-danger');
            }
        }
        if ($modal == true) {
            return $result;
        } else {
            redirect(base_url('encarte/encarte/consultar'));
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
            $this->EncarteModel->excluir($id);
        }
    }

    public function todos() {
        return $consulta = $this->EncarteModel->consultar();
    }

    public function tabelaOfertasAtivasPorRede($rede) {

        $result = $this->tabelaOfertasAtivasPorRede($rede);
        $param = array(
            'dataSource' => $result
        );
        $this->load->view('core/crud/json', $param);
    }

    public function ofertasAtivasPorCategoria($categoria) {
        return $consulta = $this->EncarteModel->ofertasAtivasPorCategoria($categoria);
    }

    public function ofertasAtivasPorRede($rede) {
        return $resultado = $this->EncarteModel->ofertasAtivasPorRede($rede);
    }

    public function ofertasProxFimPorRede($rede) {
        return $resultado = $this->EncarteModel->ofertasProxFimPorRede($rede);
    }

    public function ofertasAtivasRecentes() {
        $dados = $consulta = $this->EncarteModel->ofertasAtivasRecentes();
        return $dados;
    }

    public function ofertasAtivas($categoria = null, $distancia = null, $estado = null, $localizacao = null, $rede = null) {
        $dados = $consulta = $this->EncarteModel->ofertasAtivas($categoria, $distancia, $estado, $localizacao, $rede);
        return $dados;
    }

    public function ofertasAtivasPorLoja() {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $post = $this->input->post();
            if (!is_null($post['cod_loja'])) {
                $loja = $post['cod_loja'];
                if ($loja != "") {
                    Modules::run('encarte/Loja/clicarLoja', $loja);
                }
            }
            $filtro = array(
                '0' => 'le.data_fim >= now() AND e.data_fim >= now()'
            );
            if ($post['cod_loja'] == '') {
                $filtro['r.cod_rede'] = $post['cod_rede'];
            } else {
                $filtro['le.cod_loja'] = $post['cod_loja'];
            }
            $filtro['l.cod_situacao'] = 1;
            $resultado = $this->EncarteModel->ofertasAtivasPorLoja($filtro);
            $param = array(
                'dataSource' => $resultado
            );
            $this->load->view('core/crud/json', $param);
        } else {
            return null;
        }
    }

    public function clicarEncarte($encarte) {
        $cod_sessao = $_COOKIE['ci_session'];
        $this->EncarteModel->clicarEncarte($cod_sessao, $encarte);
    }

}
