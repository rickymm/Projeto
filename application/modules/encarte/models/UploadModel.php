<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UploadModel extends Crud {

    private $table = 'enc_encarte';
    private $primary_key = 'cod_encarte';

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
                'order_by' => 'cod_encarte',
                'order_type' => 'asc'
            );
        }
        if (is_numeric($filter)) {
            $dados = Array(
                'table' => $this->table,
                'fields' => array($this->primary_key => $filter),
                'operator' => '=',
                'order_by' => 'cod_encarte',
                'order_type' => 'asc'
            );
        }
        if (empty($filter)) {
            $dados = Array(
                'table' => $this->table,
                'order_by' => 'cod_encarte',
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
            $this->primary_key => $fields['cod_encarte']
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

    public function salvarRede($var) {
        if (!empty($var['cod_rede'])) {
            return $this->updateRede($var);
        } else {
            return $this->inserirRede($var);
        }
    }

    private function inserirRede($var) {
        if (empty($var['cod_rede'])) {
            unset($var['cod_rede']);
        }

        foreach ($var as $campos => $valores) {
            $fields[$campos] = $valores;
        }

        $filter = Array(
            'table' => 'enc_rede',
            'fields' => $fields
        );

        $dados = $this->insert($filter);
        return $dados;
    }

    private function updateRede($var) {
        foreach ($var as $campos => $valores) {
            $fields[$campos] = $valores;
        }

        $criterios = Array(
            'cod_rede' => $fields['cod_rede']
        );

        $filter = Array(
            'table' => 'enc_rede',
            'fields' => $fields,
            'criteria' => $criterios
        );

        $dados = $this->update($filter);
        return $dados;
    }

    public function updateUsuario($var) {
        foreach ($var as $campos => $valores) {
            $fields[$campos] = $valores;
        }

        $criterios = Array(
            'cod_usuario' => $fields['cod_usuario']
        );

        $filter = Array(
            'table' => 'enc_usuario',
            'fields' => $fields,
            'criteria' => $criterios
        );

        $dados = $this->update($filter);
        return $dados;
    }

    public function updateLoja($var) {
        foreach ($var as $campos => $valores) {
            $fields[$campos] = $valores;
        }

        $criterios = Array(
            'cod_loja' => $fields['cod_loja']
        );

        $filter = Array(
            'table' => 'enc_loja',
            'fields' => $fields,
            'criteria' => $criterios
        );

        $dados = $this->update($filter);
        return $dados;
    }

    public function consultarTags($cod_rede) {
        $joins = array(
            'enc_loja_encarte enc' => 'enc.cod_loja = loj.cod_loja',
            'enc_tag_encarte tag' => 'tag.cod_encarte = enc.cod_encarte'
        );
        $dados = Array(
            'select' => 'DISTINCT tag',
            'table' => 'enc_loja loj',
            'joins' => $joins,
            'fields' => array('loj.cod_rede' => $cod_rede),
            'operator' => '=',
            'order_by' => 'tag',
            'order_type' => 'asc'
        );
        return $this->selectWithJoin($dados);
    }
    
    public function consultarRede($cod_rede) {
        $dados = Array(
            'table' => 'enc_rede',
            'fields' => array('cod_rede' => $cod_rede),
            'operator' => '=',
            'order_by' => 'cod_rede',
            'order_type' => 'asc'
        );
        return $this->select($dados);
    }

    public function consultarLoja($campos) {
        $dados = Array(
            'table' => 'enc_loja',
            'fields' => $campos,
            'operator' => '=',
            'order_by' => 'cod_loja',
            'order_type' => 'asc'
        );
        return $this->select($dados);
    }

    public function inserirLoja($var) {
        if (empty($var['cod_loja'])) {
            unset($var['cod_loja']);
        }

        foreach ($var as $campos => $valores) {
            $fields[$campos] = $valores;
        }

        $filter = Array(
            'table' => 'enc_loja',
            'fields' => $fields
        );

        $dados = $this->insert($filter);
        return $dados;
    }

    public function consultarEstados($filtro) {
        $join = Array(
            'estado e' => 'e.vch_uf = l.estado OR e.vch_nome = l.estado',
            'enc_regiao r' => 'r.cod_regiao = e.cod_regiao'
        );
        $filtro['l.cod_situacao'] = '1';
        $filter = Array(
            'select' => "DISTINCT e.cod_estado, e.vch_nome as estado",
            'table' => 'enc_loja l',
            'fields' => $filtro,
            'joins' => $join,
            'operator' => '=',
            'order_by' => 'r.nome',
            'order_type' => 'asc'
        );

        $dados = $this->selectWithJoin($filter);
        return $dados;
    }

    public function consultarCidades($filtro) {
        $join = Array(
            'estado e' => 'e.vch_uf = l.estado OR e.vch_nome = l.estado',
            'enc_regiao r' => 'r.cod_regiao = e.cod_regiao'
        );
        $filtro['l.cod_situacao'] = '1';
        $filter = Array(
            'select' => "DISTINCT l.cidade",
            'table' => 'enc_loja l',
            'fields' => $filtro,
            'joins' => $join,
            'operator' => '=',
            'order_by' => 'r.nome',
            'order_type' => 'asc'
        );

        $dados = $this->selectWithJoin($filter);
        return $dados;
    }

    public function consultarLojas($filtro) {
        $join = Array(
            'estado e' => 'e.vch_uf = l.estado OR e.vch_nome = l.estado',
            'enc_regiao r' => 'r.cod_regiao = e.cod_regiao'
        );
        $filtro['l.cod_situacao'] = '1';
        $filter = Array(
            'select' => "DISTINCT l.cod_loja, l.nome",
            'table' => 'enc_loja l',
            'fields' => $filtro,
            'joins' => $join,
            'operator' => '=',
            'order_by' => 'r.nome',
            'order_type' => 'asc'
        );

        $dados = $this->selectWithJoin($filter);
        return $dados;
    }

    public function categoriaEncarte($var) {
        foreach ($var as $campos => $valores) {
            $fields[$campos] = $valores;
        }

        $filter = Array(
            'table' => 'enc_categoria_encarte',
            'fields' => $fields
        );

        $dados = $this->insert($filter);
        return $dados;
    }

    public function tagEncarte($var) {
        foreach ($var as $campos => $valores) {
            $fields[$campos] = $valores;
        }

        $filter = Array(
            'table' => 'enc_tag_encarte',
            'fields' => $fields
        );

        $dados = $this->insert($filter);
        return $dados;
    }

    public function lojaEncarte($var) {
        foreach ($var as $campos => $valores) {
            $fields[$campos] = $valores;
        }

        $filter = Array(
            'table' => 'enc_loja_encarte',
            'fields' => $fields
        );

        $dados = $this->insert($filter);
        return $dados;
    }

}
