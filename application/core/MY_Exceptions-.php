<?php

class MY_Exceptions extends CI_Exceptions {

    function _construct() {
        parent::CI_Exceptions();
    }

    function show_error($heading, $message, $template = 'error_general', $status_code = 500) {

        $CI = & get_instance();

        switch ($heading) {
            case "Erro de Banco de Dados":
                $this->registra_exception(4096, $heading, null, null, $status_code);
                break;
            case "An Error Was Encountered":
                $this->registra_exception(2048, $heading, null, null, $status_code);
                break;
        }

        if ($status_code == 500) {
            $this->_report_error($message);
        }
        if ($CI->config->config['return_url'] == true) {
            if (!is_null($_SESSION['referred_from'][0])) {
                $url = $_SESSION['referred_from'][0];
            } else {
                $url = base_url();
            }
            $_SESSION['mensagem'] = array(
                'mensagem' => "Ocorreu um erro na sua requisição. Tente novamente mais tarde. Caso o problema persista contate o suporte técnico.",
                'class' => "danger"
            );
            header("location: " . $url);
        } else {
            return parent::show_error($heading, $message, $template = 'error_general', $status_code = 500);
        }
    }

    function log_exception($severity, $message, $filepath, $line) {
        parent::log_exception($severity, $message, $filepath, $line);

        $this->registra_exception($severity, $message, $filepath, $line);

        if ($severity != E_WARNING && $severity != E_NOTICE && $severity != E_STRICT) {
            $this->_report_error($message);
        }
    }

    function _get_debug_backtrace($br = "<BR>") {
        $trace = array_slice(debug_backtrace(), 3);
        $msg = '<code>';
        foreach ($trace as $index => $info) {

            if (isset($info['file'])) {
                $msg .= $info['file'] . ':' . $info['line'] . " -> " . $info['function'] . '(' . $info['args'] . ')' . $br;
            }
        }
        $msg .= '</code>';
        return $msg;
    }

    function _report_error($subject) {

        $CI = & get_instance();
        $CI->load->library('email');

        //substr(substr(strstr($filepath, 'modules'), 8), 0, strpos(substr(strstr($filepath, 'modules'), 8), '\\'))

        /*
          $body = '';
          $body .= 'Request: <br/><br/><code>';
          foreach ($_REQUEST as $k => $v) {
          $body .= $k . ' => ' . $v . '<br/>';
          }
          $body .= '</code>';
          $body .= '<br/><br/>Server: <br/><br/><code>';
          foreach ($_SERVER as $k => $v) {
          $body .= $k . ' => ' . $v . '<br/>';
          }
          $body .= '</code>';
          $body .= '<br/><br/>Stacktrace: <br/><br/>';
          $body .= $this->_get_debug_backtrace();
          $CI->email->from('errors@myapp.com', '[MyApp production] MyApp Notifier');
          $CI->email->to('support@myapp.com');
          $CI->email->subject($subject);
          $CI->email->message($body);
          $CI->email->send();

         */
    }

    function _error_handler($severity, $message, $filepath, $line) {
        $is_error = (((E_ERROR | E_COMPILE_ERROR | E_CORE_ERROR | E_USER_ERROR) & $severity) === $severity);

        // When an error occurred, set the status header to '500 Internal Server Error'
        // to indicate to the client something went wrong.
        // This can't be done within the $_error->show_php_error method because
        // it is only called when the display_errors flag is set (which isn't usually
        // the case in a production environment) or when errors are ignored because
        // they are above the error_reporting threshold.

        if ($is_error) {
            set_status_header(500);
        }

        // Should we ignore the error? We'll get the current error_reporting
        // level and add its bits with the severity bits to find out.
        if (($severity & error_reporting()) !== $severity) {
            return;
        }

        $_error = & load_class('Exceptions', 'core');
        $_error->log_exception($severity, $message, $filepath, $line);

        // Should we display the error?
        if (str_ireplace(array('off', 'none', 'no', 'false', 'null'), '', ini_get('display_errors'))) {
            $_error->show_php_error($severity, $message, $filepath, $line);
        }

        // If the error is fatal, the execution of the script should be stopped because
        // errors can't be recovered from. Halting the script conforms with PHP's
        // default error handling. See http://www.php.net/manual/en/errorfunc.constants.php
        if ($is_error) {
            exit(1); // EXIT_ERROR
        }
    }

    function registra_exception($severity, $message, $filepath, $line, $is_error = null) {

        $backtrace = null;
        if (is_array($message)) {
            foreach ($message as $key => $value) {
                $backtrace .= $key . ": " . $value . "\n";
            }
        } else {
            $trace = array_slice(debug_backtrace(), 3);
            foreach ($trace as $value) {
                if (!isset($value['function'])) {
                    $backtrace .= $value['file'] . " | " . "Linha: " . $value['line'] . " | " . isset($value['class']) ? $value['class'] : '' . "::" . $value['function'] . "<br>";
                } else {
                    $backtrace .= isset($value['class']) ? $value['class'] : '' . "::" . "Linha: " . $value['function'] . "<br>";
                }
            }
        }
        /* Registra Exceção em Banco */
        $mx = new MY_Controller();
        $CI = & get_instance();

        $fields = Array(
            'cod_severidade' => $severity,
            'vch_mensagem' => $message,
            'vch_backtrace' => $backtrace,
            'vch_caminho' => $filepath,
            'cod_linha' => $line,
            'cod_usuario' => $_SESSION['usuario'][0]->cod_usuario,
            'log_login' => $_SESSION['log_login'],
            'sdt_data' => date("Y-m-d H:i:s"),
            'cod_sessao' => $_COOKIE['ci_session'],
            'vch_ambiente' => ENVIRONMENT,
            'vch_modulo' => $CI->router->module,
            'cod_error' => $is_error
        );

        $filter = Array(
            'table' => 'seg_exception',
            'fields' => $fields
        );
        $retorno = $mx->insert($filter);
        /* Fim Registro Exceção em Banco */
    }

}
