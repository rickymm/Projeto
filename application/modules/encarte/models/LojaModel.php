<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LojaModel extends Crud {

    private $table = 'enc_loja';
    private $primary_key = 'cod_loja';

    public function __construct() {
        parent::__construct();
        $this->output->enable_profiler(false);
    }

    public function consultar($filter = null) {

        if (is_array($filter)) {
            $select = "cod_loja, "
                    . "nome, "
                    . "cod_rede, "
                    . "estado, "
                    . "cidade, "
                    . "bairro, "
                    . "endereco, "
                    . "telefone, "
                    . "latitude, "
                    . "longitude, "
                    . "aniversario, "
                    . "qtd_checkout, "
                    . "CASE "
                    . "WHEN cod_situacao = 1 THEN 'Ativa' "
                    . "WHEN cod_situacao = 0 THEN 'Inativa' "
                    . "WHEN cod_situacao = 2 THEN 'Pendente' END AS situacao, "
                    . "cod_regiao, "
                    . "cnpj, "
                    . "valida_endereco, "
                    . "valida_cnpj";
            $filtros = array();
            foreach ($filter as $key => $value) {
                $filtros[$key] = $value;
            }
            $dados = Array(
                'select' => $select,
                'table' => $this->table,
                'fields' => $filtros,
                'operator' => 'and',
                'order_by' => 'cod_loja',
                'order_type' => 'asc'
            );
        }
        if (is_numeric($filter)) {
            $dados = Array(
                'table' => $this->table,
                'fields' => array($this->primary_key => $filter),
                'operator' => '=',
                'order_by' => 'cod_loja',
                'order_type' => 'asc'
            );
        }
        if (empty($filter)) {
            $dados = Array(
                'table' => $this->table,
                'order_by' => 'cod_loja',
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
            $this->primary_key => $fields['cod_loja']
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

    public function inativar($cod_loja) {
        $fields = Array(
            'cod_situacao' => '0'
        );
        $criterios = Array(
            $this->primary_key => $cod_loja
        );

        $filter = Array(
            'table' => $this->table,
            'fields' => $fields,
            'criteria' => $criterios
        );

        $dados = $this->update($filter);
        return $dados;
    }

    public function consultarRedes() {

        $join = Array(
            'enc_loja l' => 'r.cod_rede = l.cod_rede',
        );

        $filter = Array(
            'select' => "DISTINCT r.nome_fantasia, r.cod_rede, r.icone, r.marca",
            'table' => 'enc_rede r',
            'joins' => $join,
            'order_by' => 'r.nome_fantasia',
            'order_type' => 'asc'
        );

        $dados = $this->selectWithJoin($filter);
        return $dados;
    }

    public function consultarEncarteLoja($filtro = null) {

        $join = Array(
            'enc_loja l' => 'r.cod_rede = l.cod_rede',
            'enc_loja_encarte lenc' => 'lenc.cod_loja = l.cod_loja',
            'enc_encarte enc' => 'enc.cod_encarte = lenc.cod_encarte',
        );

        $filter = Array(
            'select' => "DISTINCT enc.cod_encarte",
            'table' => 'enc_rede r',
            'fields' => $filtro,
            'operator' => '=',
            'joins' => $join,
            'order_by' => 'r.nome_fantasia',
            'order_type' => 'asc'
        );

        $dados = $this->selectWithJoin($filter);
        return $dados;
    }

    public function consultarRedesLimit() {

        $join = Array(
            'enc_loja l' => 'r.cod_rede = l.cod_rede',
        );

        $filter = Array(
            'select' => "DISTINCT upper(r.nome_fantasia) as rede, r.cod_rede",
            'table' => 'enc_rede r',
            'joins' => $join,
            'order_by' => 'r.nome_fantasia',
            'order_type' => 'asc',
            'limit' => '10'
        );

        $dados = $this->selectWithJoin($filter);
        return $dados;
    }

    public function consultarRegiao($filtro) {
        $join = Array(
            'estado e' => 'e.vch_uf = l.estado OR e.vch_nome = l.estado',
            'enc_regiao r' => 'r.cod_regiao = e.cod_regiao'
        );

        $filter = Array(
            'select' => "DISTINCT r.cod_regiao, r.nome as regiao",
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

    public function consultarLojas($filtro = null) {
        $table = 'enc_loja l';

        $select = "l.cod_loja, r.nome_fantasia as loja, l.cidade, l.estado, l.latitude, l.longitude";

        $join = Array(
            'enc_rede r' => 'l.cod_rede = r.cod_rede',
        );

        if (is_null($filtro)) {
            $filter = Array(
                'select' => $select,
                'table' => $table,
                'joins' => $join,
                'order_by' => 'loja',
                'order_type' => 'asc'
            );
        } else if (is_array($filtro)) {
            if (isset($filtro['enc.cod_categoria'])) {
                $joins = array(
                    'enc_rede r' => 'r.cod_rede = l.cod_rede',
                    'enc_loja_encarte lenc' => 'lenc.cod_loja = l.cod_loja',
                    'enc_encarte enc' => 'enc.cod_encarte = lenc.cod_encarte',
                );
            } else {
                $joins = array(
                    'enc_rede r' => 'r.cod_rede = l.cod_rede',
                );
            }
            $left = array(
                'enc_loja_encarte lenc' => 'lenc.cod_loja = l.cod_loja',
                'enc_encarte enc' => 'enc.cod_encarte = lenc.cod_encarte',
            );
            $select = ' l.cod_loja, l.endereco, r.cod_rede, r.nome_fantasia AS rede, l.latitude as latitude, l.longitude as longitude, r.icone as icone, count(lenc.cod_loja_encarte) cont, 0 distancia';
            $filter = Array(
                'select' => $select,
                'table' => $table,
                'fields' => $filtro,
                'operator' => '=',
                'joins' => $joins,
                'left_joins' => $left,
                'group_by' => 'l.cod_loja, l.endereco, r.cod_rede, r.nome_fantasia, l.latitude, l.longitude, r.icone',
            );
        } else {
            $filter = Array(
                'select' => $select,
                'table' => $table,
                'fields' => array('l.estado' => $filtro),
                'operator' => '=',
                'joins' => $join,
                'order_by' => 'l.nome',
                'order_type' => 'asc'
            );
        }


        $dados = $this->selectWithJoin($filter);
        return $dados;
    }

    public function clicarLoja($cod_sessao, $loja) {

        $fields = Array(
            'cod_sessao' => $cod_sessao,
            'cod_loja' => $loja
        );

        $filter = Array(
            'table' => 'enc_acesso_loja',
            'fields' => $fields
        );
        $this->insert($filter);
    }

    public function consultarLojasAtivasPorRede($rede) {
        $query = "SELECT 
            count(*) as quantidade
        FROM (
            SELECT DISTINCT * FROM
                enc_loja 
            WHERE
		cod_situacao = 1
		and cod_rede = " . $rede . "
	) sq";

        return $this->customSQL($query);
    }

}
