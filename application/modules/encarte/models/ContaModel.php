<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ContaModel extends Crud {

    private $table='enc_usuario';
    private $primary_key='cod_usuario';

    public function __construct() {
        parent::__construct();
        $this->output->enable_profiler(false);
    }

    public function consultar($filter=null) {
    
        if (is_array($filter)) {
            $filtros = array();
            foreach ($filter as $key => $value) {
                $filtros[$key] = $value;
            }
            $dados = Array(
                'table' => $this->table,
                'fields' => $filtros,
                'operator' => 'and',
                'order_by' => 'cod_categoria',
                'order_type' => 'asc'
            );
        }
        if (is_numeric($filter)) {
            $dados = Array(
                'table' => $this->table,
                'fields' => array($this->primary_key => $filter),
                'operator' => '=',
                'order_by' => 'cod_categoria',
                'order_type' => 'asc'
            );
        }
        if (empty($filter)) {
            $dados = Array(
                'table' => $this->table,
                'order_by' => 'nome',
                'order_type' => 'asc'
            );
        }

        return $this->select($dados);

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
            $fields[$campos]=$valores;
        }

        $criterios=Array(
            $this->primary_key => $fields['cod_categoria']
        );

        $filter=Array(
            'table' => $this->table,
            'fields' => $fields,
            'criteria' => $criterios
        );

        $dados=$this->update($filter);
        return $dados;
    }

    private function inserir($var) {
        if(empty($var[$this->primary_key])){
            unset($var[$this->primary_key]);
        }

        foreach ($var as $campos => $valores) {
            $fields[$campos]=$valores;
        }
        $filter=Array(
            'table' => $this->table,
            'fields' => $fields
        );
        $dados=$this->insert($filter);
        return $dados;
    }

    public function excluir($id) {
        $fields=Array(
            $this->primary_key => $id
        );
        $filter=Array(
            'table' => $this->table,
            'fields' => $fields
        );
        $dados=$this->delete($filter);
        return $dados;
    }
    
    public function existeLogin($dados = null){
        if(!is_null($dados)){
            $dados[0] = "(cod_situacao = 1 OR cod_situacao = 2)";
            $dados = Array(
                'table' => $this->table,
                'fields' => $dados,
                'operator' => 'and'
            );
            $result = $this->select($dados);
            return $result;
        }else{
            return null;
        }
    }
}