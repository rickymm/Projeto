<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RelatoriosModel extends Crud {

    public function __construct() {
        parent::__construct();
        $this->output->enable_profiler(false);
    }

    public function consultarCliquePorLoja($fields) {

        $select = "a.cod_loja, r.nome_fantasia, l.nome, COUNT(a.cod_loja) as cliques";

        $joins = Array(
            'enc_loja l' => 'l.cod_rede = r.cod_rede',
            'enc_acesso_loja a' => 'a.cod_loja = l.cod_loja'
        );

        $filter = Array(
            'select' => $select,
            'table' => "enc_rede r",
            'fields' => $fields,
            'joins' => $joins,
            'operator' => '=',
            'order_by' => 'cliques',
            'group_by' => 'a.cod_loja',
            'order_type' => 'DESC',
        );

        $dados = $this->selectWithJoin($filter);
        return $dados;
    }

    public function consultarCliquePorRegiao($fields) {

        $select = "re.nome, r.cod_rede, count(l.estado) as cliques";

        $joins = Array(
            'enc_loja l' => 'r.cod_rede = l.cod_rede',
            'enc_acesso_loja a' => 'l.cod_loja = a.cod_loja',
            'estado e' => 'l.estado = e.vch_uf',
            'enc_regiao re' => 'e.cod_regiao = re.cod_regiao'
        );

        $filter = Array(
            'select' => $select,
            'table' => "enc_rede r",
            'fields' => $fields,
            'joins' => $joins,
            'operator' => '=',
            'order_by' => 'cliques',
            'group_by' => 'estado, r.cod_rede',
            'order_type' => 'DESC',
        );

        $dados = $this->selectWithJoin($filter);
        return $dados;
    }
    
    public function consultarCliquePorEstado($fields) {

        $select = "l.estado as nome, r.cod_rede, count(l.estado) as cliques";

        $joins = Array(
            'enc_loja l' => 'r.cod_rede = l.cod_rede',
            'enc_acesso_loja a' => 'l.cod_loja = a.cod_loja',
            'estado e' => 'l.estado = e.vch_uf',
        );

        $filter = Array(
            'select' => $select,
            'table' => "enc_rede r",
            'fields' => $fields,
            'joins' => $joins,
            'operator' => '=',
            'order_by' => 'cliques',
            'group_by' => 'estado, r.cod_rede',
            'order_type' => 'DESC',
        );

        $dados = $this->selectWithJoin($filter);
        return $dados;
    }
    
    public function consultarCliquePorCidade($fields) {

        $select = "l.cidade as nome, r.cod_rede, count(l.estado) as cliques";

        $joins = Array(
            'enc_loja l' => 'r.cod_rede = l.cod_rede',
            'enc_acesso_loja a' => 'l.cod_loja = a.cod_loja',
        );

        $filter = Array(
            'select' => $select,
            'table' => "enc_rede r",
            'fields' => $fields,
            'joins' => $joins,
            'operator' => '=',
            'order_by' => 'cliques',
            'group_by' => 'l.cidade, r.cod_rede',
            'order_type' => 'DESC',
        );

        $dados = $this->selectWithJoin($filter);
        return $dados;
    }

}
