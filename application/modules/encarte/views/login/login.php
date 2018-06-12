<!DOCTYPE html>
<html lang="en" >
    <!-- begin::Head -->
    <head>
        <meta charset="utf-8" />
        <title>
            Melhor Promoção
        </title>
        <meta name="description" content="Latest updates and statistic charts">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--begin::Web font -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script src="<?php echo base_url("themes/simple") ?>/plugins/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo base_url('themes/igimo/assets') ?>/demo/default/custom/components/base/toastr.js" type="text/javascript"></script>
        <script>
            WebFont.load({
                google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
                active: function () {
                    sessionStorage.fonts = true;
                }
            });
            $(document).ready(function () {
                $('.senha').on('keyup', function () {
                    if ($(this).val().length < 6) {
                        $('.erro-senha').text('A senha está muito pequena. No mínimo 6 caracteres.');
                        $('.cadastrar').hide();
                    }else{
                        $('.erro-senha').text('');
                    }
                });
                $('.cadastrar').hide();
                $('.confirma-senha').on('keyup', function () {
                    var senha = $('.senha').val();
                    if ($(this).val() != senha) {
                        $('.erro-senha').text("Senhas não conferem");
                        $('.cadastrar').hide();
                    } else if (senha == '' || senha == undefined || senha == null) {
                        $('.erro-senha').text("A senha não pode ser vazia.");
                        $('.cadastrar').hide();
                    } else {
                        $('.erro-senha').text('');
                        $('.cadastrar').show();
                    }
                });
<?php if (isset($this->session->mensagem) && sizeof($this->session->mensagem) > 0) { ?>
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-left",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    var opcao = '<?php echo $this->session->mensagem['class']; ?>';
                    var mensagem = ["<?php echo $this->session->mensagem['mensagem']; ?>", "Aviso"];

                    switch (opcao) {
                        case 'success':
                            toastr.success(mensagem[0], mensagem[1]);
                            break;
                        case 'error':
                            toastr.error(mensagem[0], mensagem[1]);
                            break;
                        case 'danger':
                        case 'warning':
                        {
                            toastr.warning(mensagem[0], mensagem[1]);
                            break;
                        }
                        default:
                            toastr.info(mensagem[0], mensagem[1]);
                            break;
                    }
    <?php
    $this->session->unset_userdata('mensagem');
}
?>
            });
        </script>
        <!--end::Web font -->
        <!--begin::Base Styles -->
        <link href="<?php echo base_url('themes/2018/src/assets') ?>/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('themes/2018/src/assets') ?>/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
        <!--end::Base Styles -->
        <link rel="shortcut icon" href="<?php echo base_url('img/') ?>ic-marca.png" />
        <style type="text/css">
            .form-control{
                font-family: 'Poppins' !important;
            }
            .btn-focus{
                color: #fff;
                background-color: #0074CD;
                border-color: #035CA0;
            }
            .btn-focus:hover{
                color: #0074CD;
                background-color: #ffff;
                border-color: #0074CD;
            }
            .btn-outline-focus.m-btn--air, .btn-focus.m-btn--air {
                -webkit-box-shadow: 0px 5px 10px 2px rgba(22, 49, 244, 0.19);
                -moz-box-shadow: 0px 5px 10px 2px rgba(22, 49, 244, 0.19);
                box-shadow: 0px 5px 10px 2px rgba(22, 49, 244, 0.19);
            }
            .btn-outline-focus.m-btn--air, .btn-focus.m-btn--air:hover{
                -webkit-box-shadow: 0px 5px 10px 2px rgba(22, 49, 244, 0.19);
                -moz-box-shadow: 0px 5px 10px 2px rgba(22, 49, 244, 0.19);
                box-shadow: 0px 5px 10px 2px rgba(22, 49, 244, 0.19);
            }
            .btn-outline-focus{
                color: #0074CD;
                background-color: #ffff;
                border-color: #0074CD;
            }
            .btn-outline-focus:hover{
                color: #ffff;
                background-color: #0074CD;
                border-color: #035CA0;
            }
            .m-link.m-link--focus {
                color: #0074CD;
            }
            .m-link.m-link--focus:hover {
                color: #035CA0;
            }
            .m-login.m-login--1 .m-login__wrapper .m-login__head .m-login__title {
                text-align: center;
                font-size: 2.5rem;
            }
        </style>
    </head>
    <!-- end::Head -->
    <!-- end::Body -->
    <body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile 		m-login m-login--1 m-login--singin" id="m_login">
                <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
                    <div class="m-stack m-stack--hor m-stack--desktop">
                        <div class="m-stack__item m-stack__item--fluid">
                            <div class="m-login__wrapper">
                                <div class="m-login__logo">
                                    <a href="#">
                                        <img src="<?php echo base_url('img/') ?>marca.svg">
                                    </a>
                                </div>
                                <div class="m-login__signin">
                                    <div class="m-login__head">
                                        <h3 class="m-login__title">
                                            Bem-vindo
                                        </h3>
                                    </div>
                                    <form class="m-login__form m-form" action="<?php echo base_url('encarte/conta/entrar') ?>" method="POST">
                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input" type="email" placeholder="Email" name="email">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Senha" name="senha">
                                        </div>
                                        <div class="row m-login__form-sub">
                                            <div class="col m--align-center">
                                                <a href="javascript:;" id="m_login_forget_password" class="m-link">
                                                    Esqueceu sua senha?
                                                </a>
                                            </div>
                                        </div>
                                        <div class="m-login__form-action">
                                            <button id="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                                Entrar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="m-login__signup">
                                    <div class="m-login__head">
                                        <h3 class="m-login__title">
                                            Cadastrar
                                        </h3>
                                        <div class="m-login__desc">
                                            Digite as informações:
                                        </div>
                                    </div>
                                    <form class="m-login__form m-form" action="<?php echo base_url('encarte/conta/cadastrar') ?>" method="POST">
                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input" type="text" placeholder="Nome Completo" name="nomecompleto" required>
                                        </div>
                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input" type="email" placeholder="Email" name="email" autocomplete="off" required>
                                        </div>
                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input senha" type="password" placeholder="Senha" name="senha" required>
                                        </div>
                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input m-login__form-input--last confirma-senha" type="password" placeholder="Confirme sua senha" name="rsenha" required>
                                            <span class="erro-senha" style="color:red; font-size: small"></span>
                                        </div>
                                        <!--<div class="row form-group m-form__group m-login__form-sub">
                                                <div class="col m--align-left">
                                                    <label class="m-checkbox m-checkbox--focus">
                                                        <input type="checkbox" name="agree">
                                                        I Agree the
                                                            <a href="#" class="m-link m-link--focus">
                                                                terms and conditions
                                                            </a>
                                                        .
                                                        <span></span>
                                                    </label>
                                                    <span class="m-form__help"></span>
                                                </div>
                                            </div>-->
                                        <div class="m-login__form-action">
                                            <button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air cadastrar">
                                                Cadastrar
                                            </button>
                                            <button id="m_login_signup_cancel" class="btn btn-outline-focus  m-btn m-btn--pill m-btn--custom">
                                                Voltar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="m-login__forget-password">
                                    <div class="m-login__head">
                                        <h3 class="m-login__title">
                                            Esqueceu sua senha ?
                                        </h3>
                                        <div class="m-login__desc">
                                            Informe email para recuperar senha:
                                        </div>
                                    </div>
                                    <form class="m-login__form m-form" action="<?php echo base_url('encarte/conta/recuperarSenha') ?>" method="POST">
                                        <div class="form-group m-form__group">
                                            <input class="form-control m-input" type="email" placeholder="Email" name="email" id="m_email" autocomplete="off">
                                        </div>
                                        <div class="m-login__form-action">
                                            <button type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                                Solicitar
                                            </button>
                                            <button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom">
                                                Cancelar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="m-stack__item m-stack__item--center">
                            <div class="m-login__account">
                                <span class="m-login__account-msg">
                                    Não possui uma conta?
                                </span>
                                &nbsp;
                                <a href="javascript:;" id="m_login_signup" class="m-link m-link--focus m-login__account-link">
                                    Cadastrar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content" style="background-size: cover; background-image: url(https://photos.smugmug.com/Dubai/i-Sq3v55g/6/c3185aa1/X3/Dawn%20On%20Cloud%20City-X3.jpg)">
                    <div class="m-grid__item m-grid__item--middle">
                        <h3 class="m-login__welcome">
                            Gerenciador
                        </h3>
                        <p class="m-login__msg">
                            Lorem ipsum dolor sit amet, coectetuer adipiscing.
                            <br>
                            Elit sed diam nonummy et nibh euismod.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Page -->
        <!--begin::Base Scripts -->
        <script src="<?php echo base_url('themes/2018/src/assets') ?>/vendors/base/vendors.bundle.js" type="text/javascript"></script>
        <script src="<?php echo base_url('themes/2018/src/assets') ?>/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
        <!--end::Base Scripts -->
        <!--begin::Page Snippets -->
        <script src="<?php echo base_url('themes/2018/src/assets') ?>/snippets/pages/user/login.js" type="text/javascript"></script>
        <!--end::Page Snippets -->
    </body>
    <!-- end::Body -->
</html>
