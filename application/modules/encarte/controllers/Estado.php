<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Estado extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('estadoModel');
    }

    public function consultar($id = null, $retorno = null) {

        if (is_null($id) && is_null($retorno)) {
            $param = array(
                'view' => 'estado/index',
                'titulo' => 'Estado',
                'subtitulo' => 'Consulta de Estados da Federação',
                'custom' => 'true',
                'modulo' => 'true',
                'json' => 'operacao/estado/consultar/null/json',
                'editar' => 'operacao/estado/editar',
                'excluir' => 'operacao/estado/remover'
            );
            $this->load->view('includes/core', $param);
        }

        if (is_numeric($id) && !is_null($retorno) && $retorno == "json") {

            $consulta = $this->estadoModel->consultar($id, $retorno);
            $param = array(
                'dataSource' => $consulta
            );
            $this->load->view("crud/json", $param);
        } else if (!is_null($id) && is_numeric($id)) {

            $consulta = $this->estadoModel->consultar($id);
            return $consulta;
        } else if (!is_null($retorno) && $retorno == "json") {

            $consulta = $this->estadoModel->consultar(null, $retorno);
            $param = array(
                'dataSource' => $consulta
            );
            $this->load->view("crud/json", $param);
        }
    }

    public function consultarPorNome($nome = null, $retorno = null) {

        if (is_null($nome) && is_null($retorno)) {
            $param = array(
                'view' => 'estado/index',
                'titulo' => 'Estado',
                'subtitulo' => 'Consulta de Estados da Federação',
                'custom' => 'true',
                'modulo' => 'true',
                'json' => 'operacao/estado/consultarPorNome/null/json',
                'editar' => 'operacao/estado/editar',
                'excluir' => 'operacao/estado/remover'
            );
            $this->load->view('includes/core', $param);
        }

        if ($nome != "" && !is_null($retorno) && $retorno == "json") {

            $consulta = $this->estadoModel->consultarPorNome($nome, $retorno);
            $param = array(
                'dataSource' => $consulta
            );
            $this->load->view("crud/json", $param);
        } else if (!is_null($nome) && $nome != "") {

            $consulta = $this->estadoModel->consultarPorNome($nome);
            return $consulta;
        } else if (!is_null($retorno) && $retorno == "json") {

            $consulta = $this->estadoModel->consultarPorNome(null, $retorno);
            $param = array(
                'dataSource' => $consulta
            );
            $this->load->view("crud/json", $param);
        }
    }

    public function consultarPorNomeEstado($nome = null) {
        if (!is_null($nome) && $nome != "") {

            $consulta = $this->estadoModel->consultarPorNome($nome);
            return $consulta;
        } else {
            return null;
        }
    }

    public function consultarPorLoja($cod_loja = null) {

        $consulta = $this->estadoModel->consultarPorLoja($cod_loja);
        return $consulta;
    }

    public function salvar() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            if ($this->estadoModel->salvar($this->input->post())) {
                $this->setSessionMessage('Operação realizada com sucesso', 'alert alert-success');
            } else {
                $this->setSessionMessage('Falha ao realizar operação favor verificar os dados e tentar novamente', 'alert alert-danger');
            }
        }
        redirect(base_url('operacao/estado/consultar'));
    }

    public function editar($id) {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $codigo = $id;
            $retorno = $this->consultar($codigo);
            $param = array(
                'dataSource' => $retorno
            );
            $this->load->view("crud/json", $param);
        }
    }

    public function remover($id) {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->estadoModel->excluir($id);
        }
    }

    public function estados() {
        return $consulta = $this->estadoModel->consultar();
    }

    public function todos() {
        return $this->estados();
    }

    /**
     * Função responsável por filtrar estado(s) por cliente no modal de filtro de relatório
     * @param int $cod_fornecedor
     * @author Tarssito Pereira
     * @version 1.0
     */
    public function carregaEstadoRelatorioFaturamento($cod_fornecedor = null) {
        return $this->estadoModel->filtrarEstadoRelatorioFaturamento($cod_fornecedor);
    }

    public function pesquisarEstadosFornecedorUsuario($filtro) {
        return $this->estadoModel->filtrarEstadoFornecedorUsuario($filtro);
    }

}
