<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class oportunidadeModel extends Crud {

    private $table = 'processo_interno';
    private $primary_key = 'cod_processo_interno';

    public function __construct() {
        parent::__construct();
    }

    public function consultar($id = null) {

        if (is_null($id) || !is_numeric($id)) {
            $dados = Array(
                'table' => $this->table,
                'order_by' => 'sdt_data_inicio',
                'order_type' => 'desc'
            );
            $dados = $this->select($dados);
        }

        if (is_numeric($id)) {
            $fields = Array(
                $this->primary_key => $id
            );
            $dados = Array(
                'table' => $this->table,
                'fields' => $fields,
                'operator' => '=',
                'order_by' => 'sdt_data_inicio',
                'order_type' => 'desc'
            );
            $dados = $this->select($dados);
        }
        return $dados;
    }

    public function salvar($dados) {
        if (!empty($dados[$this->primary_key])) {
            return $this->atualizar($dados);
        } else {
            return $this->inserir($dados);
        }
    }

    private function atualizar($var) {
        foreach ($var as $campos => $valores) {
            $fields[$campos] = $valores;
        }

        $criterios = Array(
            $this->primary_key => $fields['cod_processo_interno']
        );

        $filter = Array(
            'table' => $this->table,
            'fields' => $fields,
            'criteria' => $criterios
        );

        $dados = $this->update($filter);
        return $dados;
    }

    private function inserir($var) {
        if (empty($var[$this->primary_key])) {
            unset($var[$this->primary_key]);
        }

        foreach ($var as $campos => $valores) {
            $fields[$campos] = $valores;
        }
        $filter = Array(
            'table' => $this->table,
            'fields' => $fields
        );
        $dados = $this->insert($filter);
        return $dados;
    }

    public function excluir($id) {
        $fields = Array(
            $this->primary_key => $id
        );
        $filter = Array(
            'table' => $this->table,
            'fields' => $fields
        );
        $dados = $this->delete($filter);
        return $dados;
    }

}
