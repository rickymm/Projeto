<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/** load the CI class for Modular Extensions * */
require dirname(__FILE__) . '/Base.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Controller.php
 *
 * @copyright	Copyright (c) 2015 Wiredesignz
 * @version 	5.5
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * */
class MX_Controller {

    public $autoload = array();

    public function __construct() {

        $class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
        log_message('debug', $class . " MX_Controller Initialized");
        Modules::$registry[strtolower($class)] = $this;

        /* copy a loader instance and initialize */
        $this->load = clone load_class('Loader');
        $this->load->initialize($this);

        /* autoload module items */
        $this->load->_autoloader($this->autoload);

        /* register in session current url */
        $pagina = array();
        if (isset($_SERVER['HTTP_REFERER'])) {
            $url = $_SERVER['HTTP_REFERER'];
        } else {
            $caminho = base_url();
            $url = current_url();
            $validacao = str_replace($caminho, "", $url);
            /*if (isset($_SESSION['menu']) && ENVIRONMENT <> 'development') {
                if (!($this->in_array_r($validacao, $_SESSION['menu'])) && $validacao != "home/dashboard") {
                    if ($validacao != "conta/entrar") {
                        $this->setSessionMessage('Operação não permitida. Você não tem acesso a esta funcionalidade.', 'alert alert-warning');
                        redirect($_SESSION['referred_from'][1]);
                    }
                }
            }*/
        }
        if (isset($this->session->userdata('referred_from')[1]) && $this->session->userdata('referred_from')[1] != $url) {
            array_push($pagina, $this->session->userdata('referred_from')[1]);
        } else {
            array_push($pagina, $this->session->userdata('referred_from')[0]);
        }
        array_push($pagina, $url);
        $this->session->set_userdata('referred_from', $pagina);
    }

    public function __get($class) {
        return CI::$APP->$class;
    }

    /**
     * Function setSessionMessage - Função utilizada para setar na session a mensagem de alerta ou sucesso
     * @param $msg (string) mensagem de sucesso ou alerta
     * @param $class (string) css da mensagem
     * @author Tarssito Pereira
     * @version 1.0
     */
    public function setSessionMessage($msg, $class) {
        $this->session->set_userdata('mensagem', array(
            'mensagem' => $msg,
            'class' => $class
                )
        );
    }

    /**
     * Função de recusividade para verificar em um array muldimensional se existe um valor ou não
     * @param $needdle valor que quer ser encontrado
     * @param $haystack (array) Array Multidimensional
     * @author Igor Gonzalez
     */
    public function in_array_r($needle, $haystack, $strict = false) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
                return true;
            }
        }

        return false;
    }

    /**
     * Function dateToFormat - Função utilizada para setar na session a mensagem de alerta ou sucesso
     * @param $date (string) data em qualquer formato
     * @param $format (string) Ex. Y-m-d H:i ou d/m/Y H:i
     * @author Tácito Henrique
     * @version 1.3
     */
    public function dateToFormat($date, $format) {
        if (strpos($date, "/")) {
            if (strpos($date, ":")) {
                $data1 = DateTime::createFromFormat('d/m/Y H:i:s', $date);
            } else {
                $data1 = DateTime::createFromFormat('d/m/Y', $date);
            }
        } else {
            if (strpos($date, ":")) {
                $data1 = DateTime::createFromFormat('Y-m-d H:i:s', $date);
            } else {
                $data1 = DateTime::createFromFormat('Y-m-d', $date);
            }
        }
        return date_format($data1, $format);
    }

    public function formatDecimalSql($param) {
        return str_replace(',', '.', str_replace('.', '', $param));
    }

    /**
     * Function sendMail - Envia email
     * @author Tácito Henrique
     * @version 1.0
     * @param String $para
     * @param String $assunto
     * @param String $mensagem
     */
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
        $headers .= "Content-Type: text/html; charset=\"UTF-8\r\n";

        try {
            mail($para, $assunto, $mensagem, $headers);
            return true;
        } catch (Exception $ex) {
            echo $ex;
            return false;
        }
    }

    /**
     * Function criarNotificacao - Função utilizada para criar uma uma notificacao
     * @param $cod_notificacao (inteiro) codigo da notificacao
     * @author Ualid Oliveira
     * @version 1.0
     */
    public function criarNotificacao($nome_notificacao_param, $dados) {
        //Utilizado para associar ao grupo logo após criar a notificacao
        if (!empty($nome_notificacao_param)) {

            if (!is_numeric($nome_notificacao_param)) {

                $param_notificacao_grupo = Modules::run('seguranca/parametro/consultaComFiltro', array('vch_chave' => "'" . $nome_notificacao_param . "'"));
                $cod_notificacao_grupo = $param_notificacao_grupo[0]->valor;
            } else {
                $cod_notificacao_grupo = $nome_notificacao_param;
            }

            if (!empty($cod_notificacao_grupo)) {

                $dados['cod_usuario'] = $this->session->usuario[0]->cod_usuario;
                $dados['sdt_data_criacao'] = date('Y-m-d H:i');
                /* Utilizado para limpar o post, já que será enviado para notificacao
                  Tem como objetivo não ferir a estrutura de segurança */
                $this->limparPost();

                //Utilizado para setar o post e enviar para o salvar de notificacao
                $this->popularPost($dados);

                $cod_notificacao = Modules::run('core/notificacao/salvarSimples');

                if (!$cod_notificacao) {
                    return false;
                }

                $dados = array('cod_notificacao' => $cod_notificacao, 'cod_notificacao_grupo' => $cod_notificacao_grupo);

                //Utilizado para limpar o post para ser enviado para grupo_notificao
                $this->limparPost();
                $this->popularPost($dados);
                $grupo_notificacao = Modules::run('core/grupoNotificacao/salvarSimples');

                if ($grupo_notificacao) {
                    return $cod_notificacao;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    public function limparPost() {
        foreach ($_POST as $key => $value) {
            unset($_POST[$key]);
        }
    }

    public function popularPost($dados) {
        foreach ($dados as $key => $value) {
            $_POST[$key] = $value;
        }
    }

    /**
     * Function dataEmPortugues - Para retornar a data em português, podendo
     * escolhar o seu formato de retorno
     * @param $sdt_data (varchar) data que será convertida
     * @param $retorno (int) tipo de retorno da função. Podendo ser:
     *        null - retorna Dia da semana, dia, mês e ano  
     *        1 - Retorna apenas o Mês e ano;
     *        2 - Retorna apenas o Mês três com letras e ano completo 
     * @author Ualid Oliveira
     * @version 1.0
     */
    public function dataEmPortugues($sdt_data, $retorno = null) {

        setlocale(LC_ALL, 'pt_BR');
        date_default_timezone_set("America/Sao_Paulo");

        if (strpos($sdt_data, '/') !== false) {
            return null;
        }

        $nomeData = null;
        if (is_null($retorno)) {
            $nomeData = strftime('%A, %d de %B de %Y', strtotime($sdt_data));
        } else if ($retorno == 1) {
            $nomeData = ucfirst(strftime('%B de %Y', strtotime($sdt_data)));
        } else if ($retorno == 2) {
            $nomeData = ucfirst(substr(strftime('%B', strtotime($sdt_data)), 0, 3)) . ' de ' . strftime('%Y', strtotime($sdt_data));
        } else if ($retorno == 3) {
            $nomeData = strftime('%d de %B de %Y, %A', strtotime($sdt_data));
        }
        return $nomeData;
    }

    function gerarSqlDeRegistro($row, $tabela) {

        $insertSQL = "INSERT INTO `" . $tabela . "` SET ";
        foreach ($row as $chave => $valor) {
            $insertSQL .= " `" . $chave . "` = '" . $valor . "', ";
        }

        $insertSQL = trim($insertSQL, ", ") . ";";
        return $insertSQL;
    }

    /**
     * Function quantidadeDiasPorPeriodo - Função para retornar quantidades de dias de um periodo. Ex: [ANO][MES][segunda] = 3, [ANO][MES][terca] = 2
     * @param $data_inicio (string) data em qualquer formato
     * @param $data_fim (string) data em qualquer formato
     * @param $total (string) ou qualquer outro formato, retorna o total dos dias sem separar por ano e mes, apenas por dia
     * @author Ricky MM
     * @version 1.0
     */
    public function quantidadeDiasPorPeriodo($data_inicio, $data_fim, $filtro) {
        $diaSemana = array();

        $dia_inicial = (int) date_format(new DateTime($data_inicio), "d");
        $dia_final = (int) date_format(new DateTime($data_fim), "d");

        $mes_inicial = (int) date_format(new DateTime($data_inicio), "m");
        $mes_final = (int) date_format(new DateTime($data_fim), "m");

        $ano_inicial = (int) date_format(new DateTime($data_inicio), "Y");
        $ano_final = (int) date_format(new DateTime($data_fim), "Y");

        $total_anos = $ano_final - $ano_inicial;
        $mes = $mes_inicial;

        if (isset($filtro['total'])) {
            $diaSemana = array(
                'domingo' => null,
                'segunda' => null,
                'terca' => null,
                'quarta' => null,
                'quinta' => null,
                'sexta' => null,
                'sabado' => null
            );
        }

        for ($a = 0; $a <= $total_anos; $a++) {
            $ano = ($ano_inicial + $a);
            if (!isset($filtro['total'])) {
                $diaSemana[$ano] = array();
            }

            if ($total_anos >= 1) {
                if ($ano == $ano_inicial) {
                    $total_meses = 12 - $mes_inicial + 1;
                } else if ($ano == $ano_final) {
                    $total_meses = $mes_final;
                } else {
                    $total_meses = 12;
                }
            } else {
                $total_meses = $mes_final - $mes_inicial + 1;
                if ($total_meses == 0) {
                    $total_meses = 1;
                }
            }

            for ($m = 0; $m < $total_meses; $m++) {

                if ($ano == $ano_inicial) {
                    $mes = ($mes_inicial + $m);
                } else if ($ano == $ano_final) {
                    $mes = (01 + $m);
                } else {
                    $mes = ($m + 1);
                }
                if (!isset($filtro['total'])) {
                    $diaSemana[$ano][$mes] = array();
                }

                $qtd_dias = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

                if ($mes == $mes_inicial) {
                    $dia_contagem = $dia_inicial;
                } else if ($mes == $mes_final) {
                    $qtd_dias = $dia_final;
                    $dia_contagem = 1;
                } else {
                    $dia_contagem = 1;
                }

                if ($total_anos == 0 && $mes_inicial == $mes_final) {
                    $dia_contagem = $dia_inicial;
                    $qtd_dias = $dia_final;
                }

                if (!isset($filtro['total'])) {
                    $diaSemana[$ano][$mes] = array(
                        'domingo' => null,
                        'segunda' => null,
                        'terca' => null,
                        'quarta' => null,
                        'quinta' => null,
                        'sexta' => null,
                        'sabado' => null
                    );
                }

                for ($d = $dia_contagem; $d <= $qtd_dias; $d++) {

                    if ($d <= 9) {
                        if ($mes <= 9) {
                            $data = $ano . "-0" . $mes . "-0" . $d;
                        } else {
                            $data = $ano . "-" . $mes . "-0" . $d;
                        }
                    } else {
                        if ($mes <= 9) {
                            $data = $ano . "-0" . $mes . "-" . $d;
                        } else {
                            $data = $ano . "-" . $mes . "-" . $d;
                        }
                    }

                    if (isset($filtro['cod_estado']) || isset($filtro['cod_municipio'])) {
                        if (isset($filtro['cod_estado'])) {
                            $cod_estado = $filtro['cod_estado'];
                        } else {
                            $cod_estado = '';
                        }
                        if (isset($filtro['cod_municipio'])) {
                            $cod_municipio = $filtro['cod_municipio'];
                        } else {
                            $cod_municipio = '';
                        }
                        $feriado = Modules::run('operacao/feriado/consultarFeriados', $data, $cod_estado, $cod_municipio);
                    }

                    if (is_null($feriado) || $feriado == '') {
                        $dia_semana = date('w', strtotime($data));

                        switch ($dia_semana) {
                            case 0:
                                if (isset($filtro['total'])) {
                                    $diaSemana['domingo'] ++;
                                } else {
                                    $diaSemana[$ano][$mes]['domingo'] ++;
                                }
                                break;
                            case 1:
                                if (isset($filtro['total'])) {
                                    $diaSemana['segunda'] ++;
                                } else {
                                    $diaSemana[$ano][$mes]['segunda'] ++;
                                }
                                break;
                            case 2:
                                if (isset($filtro['total'])) {
                                    $diaSemana['terca'] ++;
                                } else {
                                    $diaSemana[$ano][$mes]['terca'] ++;
                                }
                                break;
                            case 3:
                                if (isset($filtro['total'])) {
                                    $diaSemana['quarta'] ++;
                                } else {
                                    $diaSemana[$ano][$mes]['quarta'] ++;
                                }
                                break;
                            case 4:
                                if (isset($filtro['total'])) {
                                    $diaSemana['quinta'] ++;
                                } else {
                                    $diaSemana[$ano][$mes]['quinta'] ++;
                                }
                                break;
                            case 5:
                                if (isset($filtro['total'])) {
                                    $diaSemana['sexta'] ++;
                                } else {
                                    $diaSemana[$ano][$mes]['sexta'] ++;
                                }
                                break;
                            case 6:
                                if (isset($filtro['total'])) {
                                    $diaSemana['sabado'] ++;
                                } else {
                                    $diaSemana[$ano][$mes]['sabado'] ++;
                                }
                                break;
                        }
                    }
                }
            }
        }
        return $diaSemana;
    }

}
