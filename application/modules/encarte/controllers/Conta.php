<?php

class Conta extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ContaModel');
    }

    public function index() {
        $this->load->view('encarte/login/login');
    }

    public function entrar() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('email', 'EMAIL', 'required');
            $this->form_validation->set_rules('senha', 'SENHA', 'required|min_length[3]');

            if ($this->form_validation->run() === TRUE) {
                $dados = $this->input->post();
                $login = array(
                    'email' => $dados['email'],
                    'senha' => md5($dados['senha'])
                );
                $usuario = $this->ContaModel->existeLogin($login);
                if (!empty($usuario)) {
                    $this->session->set_userdata('usuario', $usuario[0]);
                    redirect('encarte/dashboard/home');
                } else {
                    $this->setSessionMessage('Usuário ou senha inválidos.', 'error');
                    $this->index();
                }
            } else {
                $this->setSessionMessage('Falha na validação do formulário</br>' . validation_errors(), 'danger');
                $this->index();
            }
        } else {
            $this->index();
        }
    }

    public function sair($dados = null) {
        $this->session->sess_destroy();
        if (is_null($dados)) {
            $this->index();
        } else {
            $this->load->view('seguranca/conta/login-4', $dados);
        }
    }

    public function cadastrar() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->form_validation->set_rules('email', 'EMAIL', 'required');
            $this->form_validation->set_rules('senha', 'SENHA', 'required|min_length[3]');
            if ($this->form_validation->run() === TRUE) {
                $dados = $this->input->post();
                $consulta = array(
                    'email' => $dados['email']
                );
                $retorno = $this->ContaModel->existeLogin($consulta);
                if (empty($retorno)) {
                    $enviar = array(
                        'vch_nome' => $dados['nomecompleto'],
                        'email' => $dados['email'],
                        'senha' => md5($dados['senha']),
                        'cod_situacao' => '2'
                    );

                    $retorno = $this->ContaModel->salvar($enviar);
                    if ($retorno > 0) {
                        $this->setSessionMessage('Conta cadastrada com sucesso!', 'success');
                        $this->index();
                    } else {
                        $this->setSessionMessage('Ocorrreu um erro. Tente novamente', 'danger');
                        $this->index();
                    }
                } else {
                    $this->setSessionMessage('Email informado já existe. Tente novamente.', 'danger');
                    $this->index();
                }
            }
        } else {
            $this->setSessionMessage('Cadastro incompleto.<br>Favor preencher todos os campos', 'danger');
            redirect('encarte/conta');
        }
    }

    public function recuperarSenha() {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $post = $this->input->post();

            $result = $this->ContaModel->existeLogin(array('email' => $post['email']));
            if (!empty($result)) {
                $novaSenha = str_pad(rand(0, 99999999), 8, "0", STR_PAD_LEFT);
                $param = array(
                    'id' => $result[0]->id,
                    'senha' => md5($novaSenha),
                );

                $this->ContaModel->salvar($param);
                $assunto = "Melhor Promoção - Recuperação de Senha";
                $mensagem = "Sua nova senha é: \n<br>";
                $mensagem .= $novaSenha;
                $mensagem .= "\n\n<br><br>";
                $mensagem .= "===========================================================\n\n<br><br>";
                $mensagem .= "Esta mensagem foi enviada automaticamente pelo sistema do Melhor Promoção. Favor não responder à este e-mail.";

                $para = $result[0]->email;

                if ($this->sendMail($para, $assunto, $mensagem)) {
                    $this->setSessionMessage('A sua nova senha foi enviada para o email: ' . $result[0]->email . '.', 'success');
                } else {
                    $this->setSessionMessage('Problema ao enviar o email: ' . $result[0]->email . '.', 'danger');
                }

                $this->index();
            } else {
                $this->setSessionMessage('Email informado não foi encontrado.', 'danger');
                $this->index();
            }
        }
    }

    public function sendMail($para, $assunto, $mensagem, $cc = null, $reply = null) {

        $smtp_from = Modules::run('seguranca/parametro/consultaComFiltro', array('vch_chave' => '"smtp_from"'));

        $headers = "From: " . strip_tags($smtp_from[0]->valor) . "\r\n";
        if (isset($reply)) {
            $headers .= "Reply-To: " . strip_tags($reply) . "\r\n";
        }
        if (isset($cc)) {
            $headers .= "CC: susan@example.com\r\n";
        }
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        try {
            mail($para, $assunto, $mensagem, $headers);
            return true;
        } catch (Exception $ex) {
            echo $ex;
            return false;
        }
    }

}
