<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class EncarteModel extends Crud {

    public $table = 'enc_encarte';
    public $primary_key = 'cod_encarte';

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

    public function ofertasAtivasPorCategoria($categoria) {

        $join = Array(
            'enc_loja_encarte le' => 'e.cod_encarte = le.cod_encarte',
            'enc_loja l' => 'l.cod_loja = le.cod_loja',
            'enc_categoria_encarte c' => 'c.cod_encarte = e.cod_encarte',
            'enc_rede r' => 'l.cod_rede = r.cod_rede'
        );

        $filter = Array(
            'select' => "l.cod_loja, l.nome, e.nome nome_encarte, e.imagem_destacada, e.pdf, r.cod_rede, DATE_FORMAT(le.data_fim, '%d/%m/%Y') vencimento, l.cidade, le.data_fim, l.longitude, l.latitude, format(111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(-12.6975)) * COS(RADIANS(l.longitude - -38.3242)) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(-12.6975)))),0) AS distancia, 111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(" . "-12.6975" . ")) * COS(RADIANS(l.longitude - " . "-38.3242" . ")) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(" . "-12.6975" . ")))) orderdist",
            'table' => $this->table . ' e',
            'fields' => array('0' => 'le.data_fim > now()', 'c.cod_categoria' => $categoria),
            'joins' => $join,
            'operator' => 'and',
            'order_by' => 'orderdist, l.nome, e.data_cadastro',
            'order_type' => 'asc',
            'limit' => '10'
        );

        $dados = $this->selectWithJoin($filter);
        return $dados;
    }

    public function ofertasAtivasPorRede($rede) {
        $query = "SELECT 
            count(*) as quantidade
        FROM (
            SELECT e.* FROM
		enc_encarte e
            INNER JOIN enc_loja_encarte le ON le.cod_encarte = e.cod_encarte
            INNER JOIN enc_loja l ON l.cod_loja = le.cod_loja
            INNER JOIN enc_rede r ON r.cod_rede = l.cod_rede
            WHERE
                e.data_fim > now()
                AND r.cod_rede =". $rede
                ." GROUP BY 
		e.cod_encarte
	) sq";
        return $this->customSQL($query);
    }
    
    public function tabelaOfertasAtivasPorRede($rede) {
        $query = "SELECT DISTINCT
            e.cod_encarte, e.pdf, e.observacao, date_format(e.data_inicio, '%d/%m/%Y') as data_inicio, date_format(e.data_fim, '%d/%m/%Y') as data_fim
        FROM
            enc_encarte e
	INNER JOIN enc_loja_encarte le ON le.cod_encarte = e.cod_encarte
	INNER JOIN enc_loja l ON l.cod_loja = le.cod_loja
	INNER JOIN enc_rede r ON r.cod_rede = l.cod_rede 
        WHERE
            e.data_fim > now( ) 
            AND r.cod_rede = " . $rede;
        
        return $this->customSQL($query);
    }
    
    public function ofertasProxFimPorRede($rede) {
        $query = "SELECT 
            count(*) as quantidade
        FROM (
            SELECT e.* FROM
		enc_encarte e
            INNER JOIN enc_loja_encarte le ON le.cod_encarte = e.cod_encarte
            INNER JOIN enc_loja l ON l.cod_loja = le.cod_loja
            INNER JOIN enc_rede r ON r.cod_rede = l.cod_rede
            WHERE
                DATE_FORMAT(e.data_fim, '%Y-%m-%d') = CURDATE() + INTERVAL 2 DAY
                AND r.cod_rede =". $rede
                ." GROUP BY 
		e.cod_encarte
	) sq";
        return $this->customSQL($query);
    }

    public function ofertasAtivas($categoria = null, $distancia = null, $estado = null, $coordenator = null, $rede = null) {

        $join = Array(
            'enc_loja_encarte le' => 'e.cod_encarte = le.cod_encarte',
            'enc_loja l' => 'l.cod_loja = le.cod_loja',
            'enc_categoria_encarte ce' => 'ce.cod_encarte = e.cod_encarte',
            'enc_categoria c' => 'c.cod_categoria = ce.cod_categoria',
            'enc_rede r' => 'l.cod_rede = r.cod_rede'
        );
        $filtro = array('0' => 'le.data_fim > now()');
        if (!is_null($categoria) && $categoria > 0) {
            $filtro['0'] .= ' and c.cod_categoria =' . $categoria;
        }
        if (!is_null($estado)) {
            $filtro['0'] .= ' and l.estado like "%' . $estado . '%"';
        }

        if ($rede > 0 || $rede == "") {
            $filtro['0'] .= ' and r.cod_rede = ' . $rede;
        }
        if (!is_null($distancia)) {
            if (is_null($coordenator)) {
                $filtro['0'] .= ' AND 111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(-12.6975)) * COS(RADIANS(l.longitude - -38.3242)) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(-12.6975)))) <= ' . $distancia;
            } else {
                $location = explode("_", $coordenator);
                if ($location[0] != "") {
                    $filtro['0'] .= ' AND 111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(' . $location[0] . ')) * COS(RADIANS(l.longitude - ' . $location[1] . ')) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(' . $location[0] . ')))) <= ' . $distancia;
                } else {
                    $filtro['0'] .= ' AND 111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(-12.6975)) * COS(RADIANS(l.longitude - -38.3242)) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(-12.6975)))) <= ' . $distancia;
                }
            }
        }

        if (is_null($rede)) {
            if (is_null($coordenator)) {
                $select = "DISTINCT r.nome_fantasia as rede, l.cod_loja, r.cod_rede, l.nome as loja, e.imagem_destacada, DATE_FORMAT(le.data_fim, '%d/%m/%Y') vencimento, c.cod_categoria, l.cidade, le.data_fim, l.longitude, l.latitude, format(111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(-12.6975)) * COS(RADIANS(l.longitude - -38.3242)) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(-12.6975)))),0) AS distancia, 111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(-12.6975)) * COS(RADIANS(l.longitude - -38.3242)) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(-12.6975)))) orderdist";
            } else {
                $location = explode("_", $coordenator);
                if ($location[0] != "") {
                    $select = "DISTINCT r.nome_fantasia as rede, l.cod_loja, r.cod_rede, r.nome_fantasia as loja, e.imagem_destacada, DATE_FORMAT(le.data_fim, '%d/%m/%Y') vencimento, c.cod_categoria, c.nome,le.data_fim, l.longitude, l.latitude, format(111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(" . $location[0] . ")) * COS(RADIANS(l.longitude - " . $location[1] . ")) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(" . $location[0] . ")))),0) AS distancia, 111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(" . $location[0] . ")) * COS(RADIANS(l.longitude - " . $location[1] . ")) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(" . $location[0] . ")))) orderdist";
                } else {
                    $select = "DISTINCT r.nome_fantasia as rede, l.cod_loja, r.cod_rede, l.nome as loja, e.imagem_destacada, DATE_FORMAT(le.data_fim, '%d/%m/%Y') vencimento, c.cod_categoria, l.cidade, le.data_fim, l.longitude, l.latitude, format(111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(-12.6975)) * COS(RADIANS(l.longitude - -38.3242)) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(-12.6975)))),0) AS distancia, 111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(-12.6975)) * COS(RADIANS(l.longitude - -38.3242)) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(-12.6975)))) orderdist";
                }
            }
            $order = "orderdist, loja, e.data_cadastro";
        } else {
            if ($rede > 0 || $rede == "") {
                if (is_null($coordenator)) {
                    $select = "DISTINCT r.nome_fantasia as rede, l.cod_loja, r.cod_rede, l.nome as loja, e.imagem_destacada, DATE_FORMAT(le.data_fim, '%d/%m/%Y') vencimento, c.cod_categoria, c.nome,le.data_fim, l.longitude, l.latitude, format(111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(-12.6975)) * COS(RADIANS(l.longitude - -38.3242)) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(-12.6975)))),0) AS distancia, 111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(-12.6975)) * COS(RADIANS(l.longitude - -38.3242)) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(-12.6975)))) orderdist";
                } else {
                    $location = explode("_", $coordenator);
                    if ($location[0] != "") {
                        $select = "DISTINCT r.nome_fantasia as rede, l.cod_loja, r.cod_rede, l.nome as loja, e.imagem_destacada, DATE_FORMAT(le.data_fim, '%d/%m/%Y') vencimento, c.cod_categoria, l.cidade,le.data_fim, l.longitude, l.latitude, format(111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(" . $location[0] . ")) * COS(RADIANS(l.longitude - " . $location[1] . ")) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(" . $location[0] . ")))),0) AS distancia, 111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(" . $location[0] . ")) * COS(RADIANS(l.longitude - " . $location[1] . ")) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(" . $location[0] . ")))) orderdist";
                    } else {
                        $select = "DISTINCT r.nome_fantasia as rede, l.cod_loja, r.cod_rede, l.nome as loja, e.imagem_destacada, DATE_FORMAT(le.data_fim, '%d/%m/%Y') vencimento, c.cod_categoria, l.cidade,le.data_fim, l.longitude, l.latitude, format(111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(-12.6975)) * COS(RADIANS(l.longitude - -38.3242)) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(-12.6975)))),0) AS distancia, 111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(-12.6975)) * COS(RADIANS(l.longitude - -38.3242)) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(-12.6975)))) orderdist";
                    }
                }
                $order = "orderdist, loja, e.data_cadastro";
            } else {
                $select = "DISTINCT r.nome_fantasia as rede, r.cod_rede";
                $order = "r.nome_fantasia , r.cod_rede";
            }
        }

        $filter = Array(
            'select' => $select,
            'table' => $this->table . ' e',
            'fields' => $filtro,
            'joins' => $join,
            'operator' => 'and',
            'order_by' => $order,
            'order_type' => 'asc',
        );

        $dados = $this->selectWithJoin($filter);
        return $dados;
    }

    public function ofertasAtivasRecentes() {

        $join = Array(
            'enc_loja_encarte le' => 'e.cod_encarte = le.cod_encarte',
            'enc_loja l' => 'l.cod_loja = le.cod_loja AND l.cod_situacao = 1',
            'enc_rede r' => 'l.cod_rede = r.cod_rede'
        );

        $filter = Array(
            'select' => "distinct l.cod_loja, l.nome, e.nome nome_encarte, e.imagem_destacada, e.pdf, r.cod_rede, DATE_FORMAT(le.data_fim, '%d/%m/%Y') vencimento, l.cidade,le.data_fim, l.longitude, l.latitude, format(111.111 * DEGREES(ACOS(COS(RADIANS(l.latitude)) * COS(RADIANS(-12.6975)) * COS(RADIANS(l.longitude - -38.3242)) + SIN(RADIANS(l.latitude)) * SIN(RADIANS(-12.6975)))),0) AS distancia",
            'table' => $this->table . ' e',
            'fields' => array('0' => 'e.data_inicio <= now() and e.data_fim >= now()'),
            'joins' => $join,
            'operator' => 'and',
            'order_by' => 'distancia',
            'order_type' => 'ASC',
            'limit' => '48'
        );

        $dados = $this->selectWithJoin($filter);
        return $dados;
    }

    public function ofertasAtivasPorLoja($filtros) {
        $join = array(
            'enc_loja_encarte le' => 'le.cod_encarte = e.cod_encarte',
            'enc_loja l' => 'l.cod_loja = le.cod_loja',
            'enc_rede r' => 'r.cod_rede = l.cod_rede'
        );
        $filter = Array(
            'select' => "DISTINCT e.imagem_destacada, e.nome nome_encarte, e.pdf, r.cod_rede, DATE_FORMAT(le.data_fim, '%d/%m/%Y') vencimento",
            'table' => $this->table . ' e',
            'fields' => $filtros,
            'joins' => $join,
            'operator' => 'and'
        );

        $dados = $this->selectWithJoin($filter);
        return $dados;
    }

    public function clicarEncarte($cod_sessao, $encarte) {

        $fields = Array(
            'cod_sessao' => $cod_sessao,
            'cod_encarte' => $encarte
        );

        $filter = Array(
            'table' => 'enc_acesso_encarte',
            'fields' => $fields
        );
        $this->insert($filter);
    }

}
