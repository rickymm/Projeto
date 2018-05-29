<?php

class Conta_model extends CI_Model {

    public function __construct() {
        $this->db->from('usuario');
    }

    public function validaLogin($dados = null) {
        if (!is_null($dados)) {
            if (isset($dados['usuario'])) {
                $this->db->where('vch_login', $dados['usuario']);
            }
            $this->db->where('md5_senha', md5($dados['senha']));
			$this->db->where('cod_situacao', 1);
            $usuario = $this->db->get();
            return $usuario->result();
        } else {
            return null;
        }
    }

    public function loginExiste($dados) {
        $this->db->where('vch_login', $dados['usuario']);
        //$this->db->or_where('usu_email', $dados['email']);
        $resultado = $this->db->get();
        if ($resultado->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function registraUsuario($dados) {
        $usuario = array(
            "vch_login" => $dados['usuario'],
            "md5_senha" => $dados['senha']
        );
        if ($this->db->insert($usuario)) {
            return true;
        } else {
            return $error = $this->db->error();
        }
    }

}
