<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RedeModel extends Crud {

    private $table = 'enc_rede';
    private $primary_key = 'cod_rede';

    public function __construct() {
        parent::__construct();
        $this->output->enable_profiler(false);
    }

    public function consultar($filter = null) {

        if (is_array($filter)) {
            $filtros = array();
            foreach ($filter as $key => $value) {
                $filtros[$key] = $value;
            }
            $dados = Array(
                'table' => $this->table,
                'fields' => $filtros,
                'operator' => 'and',
                'order_by' => 'cod_rede',
                'order_type' => 'asc'
            );
        }
        if (is_numeric($filter)) {
            $dados = Array(
                'table' => $this->table,
                'fields' => array($this->primary_key => $filter),
                'operator' => '=',
                'order_by' => 'cod_rede',
                'order_type' => 'asc'
            );
        }
        if (empty($filter)) {
            $dados = Array(
                'table' => $this->table,
                'order_by' => 'cod_rede',
                'order_type' => 'asc'
            );
        }

        return $this->select($dados);
    }

    public function consultarRede($filter = null) {

        if (is_array($filter)) {
            $filtros = array();
            foreach ($filter as $key => $value) {
                $filtros[$key] = $value;
            }
            $dados = Array(
                'table' => "enc_rede r",
                'fields' => $filtros,
                'operator' => 'and',
                'order_by' => 'cod_rede',
                'order_type' => 'asc'
            );
        }
        if (is_numeric($filter)) {
            $dados = Array(
                'table' => "enc_rede r",
                'fields' => array($this->primary_key => $filter),
                'operator' => '=',
                'order_by' => 'cod_rede',
                'order_type' => 'asc'
            );
        }
        if (empty($filter)) {
            $dados = Array(
                'table' => "enc_rede r",
                'order_by' => 'cod_rede',
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
            $fields[$campos] = $valores;
        }

        $criterios = Array(
            $this->primary_key => $fields['cod_rede']
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

    public function consultarEndereco($rede = null, $coordenada = null) {

        $join = Array(
            'enc_rede r' => 'l.cod_rede = r.cod_rede'
        );

        $fields = Array(
            'r.cod_rede' => $rede,
            '0' => ' latitude is not null ',
            'l.cod_situacao' => 1
        );

        if (is_null($coordenada)) {

            $select = "l.cod_loja as loja, l.latitude, l.longitude, l.endereco as endereco, , format(111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(-12.6975)) * COS(RADIANS(l.longitude - -38.3242)) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(-12.6975)))),0) AS distancia, 111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(-12.6975)) * COS(RADIANS(l.longitude - -38.3242)) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(-12.6975)))) orderdist";
        } else {
            $location = explode("_", $coordenada);
            if ($location[0] != "") {
                $select = "l.cod_loja as loja, l.latitude, l.longitude, l.endereco as endereco, format(111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(" . $location[0] . ")) * COS(RADIANS(l.longitude - " . $location[1] . ")) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(" . $location[0] . ")))),0) AS distancia, 111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(" . $location[0] . ")) * COS(RADIANS(l.longitude - " . $location[1] . ")) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(" . $location[0] . ")))) orderdist";
            } else {
                $select = "l.cod_loja as loja, l.latitude, l.longitude, l.endereco as endereco, format(111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(-12.6975)) * COS(RADIANS(l.longitude - -38.3242)) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(-12.6975)))),0) AS distancia, 111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(-12.6975)) * COS(RADIANS(l.longitude - -38.3242)) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(-12.6975)))) orderdist";
            }
        }

        $filter = Array(
            'select' => $select,
            'table' => "enc_loja l",
            'fields' => $fields,
            'joins' => $join,
            'operator' => '=',
            'order_by' => 'orderdist, l.cod_loja',
            'order_type' => 'ASC',
        );

        $dados = $this->selectWithJoin($filter);
        return $dados;
    }

}
