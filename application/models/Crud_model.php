<?php

class Crud_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
    }

    var $tabelas = array(
        'processo_interno', 'rota', 'rede', 'loja', 'comite',
        'comite_rota_rede', 'membro', 'membro_comite', 'membro_rota_rede','fatura_fornecedor_loja',
        'nivel_usuario', 'nivel_usuario_menu', 'processo_juridico','fatura_loja_aprovacao',
        'rede', 'centro_de_resultado', 'rota', 'rota_rede', 'rota_rede_loja',
        'roteiro', 'roteiro_loja', 'telefone', 'usuario', 'usuario_menu', 'zona', 'zona_roteiro',
        'fatura_loja', 'fornecedor_loja', 'fornecedor', 'item', 'suspensao_loja', 'fatura_fornecedor',
        'baixa_fatura', 'historico_fatura_loja', 'frequencia_loja_faturamento',
        'empresa', 'industria', 'associacao_roteiro_funcionario',
        'custo_transporte_funcionario'
    );

    public function getAll($dados = null) {
        // Se forem definidos os campos do select ele aplica o filtro
        if (isset($dados['select']) && !empty($dados['select'])) {
            $this->db->select($dados['select'], false);
        }
        //Obtém todos os registros pegando por parâmetro apenas a tabela
        $results = $this->db->get($dados['table']);
        //Retorna o resultset com todos os registros
        return $results->result();
    }

    public function getWithFilter($dados = null) {
        // Se forem definidos os campos do select ele aplica o filtro
        if (isset($dados['select']) && !empty($dados['select'])) {
            $this->db->select($dados['select'], false);
        }
        if (isset($dados['order_by'])) {
            $this->db->order_by($dados['order_by'], $dados['order_type']);
        }
        //limit if exists 
        if (isset($dados['limit'])) {
            $this->db->limit($dados['limit']);
        }
        //group by
        if (isset($dados['group_by'])) {
            $this->db->group_by($dados['group_by']);
        }
        if (isset($dados['fields']) && !is_null($dados['fields'])) {
            if (is_array($dados['operator'])) {
                $i = 0;
                $operador = $dados['operator'];
                foreach ($dados['fields'] as $field => $value) {
                    if ($field === 0) {
                        $this->db->where($value);
                    } else {
                        switch ($operador[$i]) {
                            case 'and':
                                $this->db->where($field, $value);
                                break;
                            case 'or':
                                $this->db->or_where($field, $value);
                                break;
                            case 'in':
                                $this->db->where_in($field, explode(',', $value));
                                break;
                            default:
                                $this->db->where($field . $operador[$i] . $value);
                                break;
                        }
                    }
                    $i++;
                }
            } else {
                foreach ($dados['fields'] as $field => $value) {
                    if ($field === 0) {
                        $this->db->where($value);
                    } else {
                        switch ($dados['operator']) {
                            case 'and':
                                $this->db->where($field, $value);
                                break;
                            case 'or':
                                $this->db->or_where($field, $value);
                                break;
                            case 'in':
                                $this->db->where_in($field, $value);
                                break;
                            default:
                                $this->db->where($field . $dados['operator'] . $value);
                                break;
                        }
                    }
                }
            }

            $results = $this->db->get($dados['table']);

            return $results->result();
        } else {
            $results = $this->db->get($dados['table']);
            return $results->result();
        }
    }

    public function getWithJoin($dados) {

        //Significa q left join foi colocado antes e precisa ser executado
        $keyJoin = array_search("joins", array_keys($dados));
        $keyLeftJoin = array_search("left_joins", array_keys($dados));

        if (isset($dados['select']) && !empty($dados['select'])) {
            $this->db->select($dados['select'], false);
        }

        if (isset($dados['joins']) || isset($dados['left_joins']) || isset($dados['left_outer_joins'])) {
            if ($keyJoin > $keyLeftJoin) {

                //left join
                if (isset($dados['left_joins'])) {
                    foreach ($dados['left_joins'] as $table => $criteria) {
                        $this->db->join($table, $criteria, 'left');
                    }
                }
                //inner join
                if (isset($dados['joins'])) {
                    foreach ($dados['joins'] as $table => $criteria) {
                        $this->db->join($table, $criteria, 'inner');
                    }
                }
            } else {
                //inner join
                if (isset($dados['joins'])) {
                    foreach ($dados['joins'] as $table => $criteria) {
                        $this->db->join($table, $criteria, 'inner');
                    }
                }

                //left join
                if (isset($dados['left_joins'])) {
                    foreach ($dados['left_joins'] as $table => $criteria) {
                        $this->db->join($table, $criteria, 'left');
                    }
                }

                //left join
                if (isset($dados['left_outer_joins'])) {
                    foreach ($dados['left_outer_joins'] as $table => $criteria) {
                        $this->db->join($table, $criteria, 'left outer');
                    }
                }
            }
        }

        //group by
        if (isset($dados['group_by'])) {
            $this->db->group_by($dados['group_by']);
        }

        //order by
        if (isset($dados['order_by'])) {
            $this->db->order_by($dados['order_by'], $dados['order_type']);
        }

        //limit rows
        if (isset($dados['limit'])) {
            $this->db->limit($dados['limit']);
        }

        if (isset($dados['fields']) && !is_null($dados['fields'])) {
            if (is_array($dados['operator'])) {
                $i = 0;
                $operador = $dados['operator'];
                foreach ($dados['fields'] as $field => $value) {
                    if ($field === 0) {
                        $this->db->where($value);
                    } else {
                        switch ($operador[$i]) {
                            case 'and':
                                $this->db->where($field, $value);
                                break;
                            case 'or':
                                $this->db->or_where($field, $value);
                                break;
                            case 'in':
                                $this->db->where_in($field, explode(',', $value));
                                break;
                            default:
                                $this->db->where($field . $operador[$i] . $value);
                                break;
                        }
                    }
                    $i++;
                }
            } else {
                foreach ($dados['fields'] as $field => $value) {
                    if ($field === 0) {
                        $this->db->where($value);
                    } else {
                        switch ($dados['operator']) {
                            case 'and':
                                $this->db->where($field, $value);
                                break;
                            case 'or':
                                $this->db->or_where($field, $value);
                                break;
                            case 'in':
                                $this->db->where_in($field, $value);
                                break;
                            default:
                                $this->db->where($field . $dados['operator'] . $value);
                                break;
                        }
                    }
                }
            }

            $results = $this->db->get($dados['table']);

            return $results->result();
        } else {
            $results = $this->db->get($dados['table']);
            return $results->result();
        }
    }

    public function insert($dados) {

        //Cria um array vazio
        $record = array();
        // Cria um laço para obter todos os campos que serão inseridos
        foreach ($dados['fields'] as $field => $value) {
            $record[$field] = $value;
        }
        //Executa o insert e retorna a chave primária criada, se não retorna o erro de banco
        if ($this->db->insert($dados['table'], $record)) {
            $id = $this->db->insert_id();

            $table_filter = $dados['table'];//substr($dados['table'], 0, strpos($dados['table'], " "));
            if (in_array($table_filter, $this->tabelas)) {
                $user = isset($this->session->usuario[0]->cod_usuario) ? $this->session->usuario[0]->cod_usuario : $usuario[0]->cod_usuario;
                foreach ($record as $key => $value) {
                    $insert = "INSERT INTO seg_audit_tabela (id_tabela, vch_campo, vch_antigo, vch_novo, cod_usuario, sdt_data, vch_tabela, acao)"
                            . "VALUES (" . $id . ", '" . $key . "', '0', \"" . $value . "\", '" . $user . "', '" . date('Y-m-d H:i:s') . "', '" . $table_filter . "', 'insert')";
                    $this->custom_insert($insert);
                }
            }
            return $id;
        } else {
            return $error = $this->db->error();
        }
    }

    public function update($dados) {
        //Cria um array vazio
        $record = array();
        // Cria um laço para obter todos os campos que serão inseridos
        foreach ($dados['fields'] as $field => $value) {
            $record[$field] = $value;
        }
        // Adiciona os critérios para fazer o update
        if (isset($dados['criteria']) && !is_null($dados['criteria'])) {
            foreach ($dados['criteria'] as $field => $value) {
                $this->db->where($field, $value);
            }
        }

        $table_filter = $dados['table'];//substr($dados['table'], 0, strpos($dados['table'], " "));
        if (in_array($table_filter, $this->tabelas)) {
            //Registra mudança na tabela
            foreach ($dados['criteria'] as $field => $value) {
                $select = "SELECT * FROM " . $dados['table'] . " WHERE " . $field . " = " . $value;
                $primary[0] = $field;
                $primary[1] = $value;
            }
            $old = $this->custom_sql($select);

            foreach ($record as $key => $value) {
                $insert = "INSERT INTO seg_audit_tabela (id_tabela, vch_campo, vch_antigo, vch_novo, cod_usuario, sdt_data, vch_tabela, acao)"
                        . "VALUES (" . $primary[1] . ", '" . $key . "', \"" . $old[0]->$key . "\", \"" . $value . "\", '" . $this->session->usuario[0]->cod_usuario . "', '" . date('Y-m-d H:i:s') . "', '" . $table_filter . "', 'update')";
                $this->custom_insert($insert);
            }
        }
        //Executa o update
        if ($this->db->update($dados['table'], $record)) {
            $row_affected = $this->db->affected_rows();
            return $row_affected;
        } else {
            return $error = $this->db->error();
        }
    }

    public function delete($dados) {
        // Obtém os critérios para fazer o update
        if (isset($dados['fields']) && !is_null($dados['fields'])) {
            foreach ($dados['fields'] as $field => $value) {
                $this->db->where_in($field, $value);
            }
        }

        $table_filter = $dados['table'];//substr($dados['table'], 0, strpos($dados['table'], " "));
        if (in_array($table_filter, $this->tabelas)) {
            /* Consulta os valores que serão apagados */
            $select = "SELECT * FROM " . $dados['table'] . " WHERE " . $field . " = " . $value;
            $primary[0] = $field;
            $primary[1] = $value;

            $record = $this->custom_sql($select);

            /* Insere o que 
             * será apagado */
            foreach ($record[0] as $key => $value) {
                $insert = "INSERT INTO seg_audit_tabela (id_tabela, vch_campo, vch_antigo, vch_novo, cod_usuario, sdt_data, vch_tabela, acao)"
                        . "VALUES (" . $primary[1] . ", '" . $key . "', '" . $value . "', NULL, '" . $this->session->usuario[0]->cod_usuario . "', '" . date('Y-m-d H:i:s') . "', '" . $table_filter . "', 'delete')";
                $this->custom_insert($insert);
            }
        }
        if ($this->db->delete($dados['table'])) {
            return $this->db->affected_rows();
        } else {
            return $this->db->error();
        }
    }

    public function custom_sql($query) {
        //Se a query estiver definida, executa a query e retorna o resultado obtido
        if (isset($query)) {
            $results = $this->db->query($query);
            return $results->result();
        } else {
            return $this->db->error();
        }
    }

    public function custom_insert($query) {
        //Se a query estiver definida, executa a query e retorna o resultado obtido
        if (isset($query)) {
            $results = $this->db->query($query);
            $id = $this->db->insert_id();
            return $id;
        } else {
            return $this->db->error();
        }
    }

    public function custom_update($query) {
        //Se a query estiver definida, executa a query e retorna o resultado obtido
        if (isset($query)) {
            $results = $this->db->query($query);
            $row_affected = $this->db->affected_rows();
            return $row_affected;
        } else {
            return $this->db->error();
        }
    }

    public function custom_delete($query) {
        //Se a query estiver definida, executa a query e retorna o resultado obtido
        if (isset($query)) {
            $results = $this->db->query($query);
            return $result;
        } else {
            return null;
        }
    }

}
