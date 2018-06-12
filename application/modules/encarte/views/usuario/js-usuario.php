<!--begin::Page Vendors -->
<script src="<?php echo base_url('themes/cliente/assets') ?>/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->  
<!--begin::Page Snippets -->
<script src="<?php echo base_url('themes/cliente/assets') ?>/app/js/dashboard.js" type="text/javascript"></script>
<!--end::Page Snippets -->   
<!-- begin::Kendo UI -->
<link href="<?php echo base_url("themes/simple/plugins/knd.ui.17.r1") ?>/styles/kendo.common.min.css" rel="stylesheet">
<link href="<?php echo base_url("themes/simple/plugins/knd.ui.17.r1") ?>/styles/kendo.rtl.min.css" rel="stylesheet">
<link href="<?php echo base_url("themes/simple/plugins/knd.ui.17.r1") ?>/styles/kendo.default.min.css" rel="stylesheet">
<link href="<?php echo base_url("themes/simple/plugins/knd.ui.17.r1") ?>/styles/kendo.default.mobile.min.css" rel="stylesheet">
<script src="<?php echo base_url("themes/simple/plugins/knd.ui.17.r1") ?>/js/jszip.min.js"></script>
<script src="<?php echo base_url("themes/simple/plugins/knd.ui.17.r1") ?>/js/kendo.all.min.js"></script>
<script src="<?php echo base_url("themes/simple/plugins/knd.ui.17.r1") ?>/js/messages/kendo.messages.pt-BR.min.js"></script>
<script src="<?php echo base_url("themes/simple/plugins/knd.ui.17.r1") ?>/content/shared/js/console.js"></script>
<!-- end::Kendo UI -->
<script type="text/javascript" src="<?php echo base_url("themes/simple") ?>/plugins/parsleyjs/dist/parsley.js"></script>
<script type="text/javascript" src="<?php echo base_url("themes/simple") ?>/plugins/parsleyjs/dist/i18n/pt-br.js"></script>
<script type="text/javascript" src="<?php echo base_url("themes/simple") ?>/plugins/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#info').hide();

        $(".confirmar").blur(function () {
            if ($('.confirmar').val() != $('.nova').val()) {
                $('.confirmar').val('');
                $('#info').val('Senhas não conferem');
                $('#info').show();
                $('.nova').focus();
            } else {
                $('#info').hide();
            }
        });

        var crudServiceBaseUrl = "https://demos.telerik.com/kendo-ui/service",
                dataSource = new kendo.data.DataSource({
                    transport: {
                        read: {
                            url: "<?php echo base_url($json); ?>",
                            dataType: "json",
                            serverPaging: true,
                            serverFiltering: true
                        },
                        parameterMap: function (options, operation) {
                            if (operation !== "read" && options.models) {
                                return {models: kendo.stringify(options.models)};
                            }
                        }
                    },
                    batch: true,
                    pageSize: 20,
                    schema: {
                        data: "data",
                        model: {
                            fields: {
                                cod_usuario: {editable: false, nullable: true},
                                vch_nome: {validation: {required: true}},
                                email: {validation: {required: true}},
                                cod_situacao: {required: true},
                                cod_funcao: {required: true}
                            }
                        }
                    }
                });

        $(".tb_usuarios").kendoGrid({
            dataSource: dataSource,
            navigatable: true,
            pageable: true,
            height: 550,
            columns: [{
                    field: "cod_usuario",
                    title: "ID",
                    aggregates: ["count"],
                    width: 50
                }, {
                    field: "vch_nome",
                    title: "Usuario",
                    aggregates: ["count"]
                }, {
                    field: "email",
                    title: "Email",
                    aggregates: ["count"]
                }, {
                    field: "cod_situacao",
                    title: "Situacao",
                    aggregates: ["count"]
                },
                {
                    field: "cod_funcao",
                    title: "Perfil",
                    aggregates: ["count"]
                },
                {
                    command: [{text: "Editar", click: editar}], title: "&nbsp;", width: 150
                }
            ]
        });
    });

    function novoUsuario() {
        $('.cod_usuario').val('');
        $('.vch_nome').val('');
        $('.email').val('');
        $('.cod_situacao').val('');
        $('.cod_funcao').val('');
        $('#modal_novo').modal('show');
    }

    function customBoolEditor(container, options) {
        var guid = kendo.guid();
        $('<input class="k-checkbox" id="' + guid + '" type="checkbox" name="Discontinued" data-type="boolean" data-bind="checked:Discontinued">').appendTo(container);
        $('<label class="k-checkbox-label" for="' + guid + '">&#8203;</label>').appendTo(container);
    }

    function excluir(e) {
        e.preventDefault();
        var usuario = this.dataItem($(e.currentTarget).closest("tr"));
        if (confirm("Deseja realmente excluir o usuário " + usuario.vch_nome + "?")) {
            $.ajax({
                type: "POST",
                url: '<?php echo base_url("encarte/usuario/excluir"); ?>/',
                data: {
                    cod_usuario: usuario.cod_usuario
                },
                success: function (response) {
                    //setada na sessão pelo controller uma mensagem de sucesso.
                    location.reload();
                },
                error: function (request, status, error) {
                    alert("Entrar em contato com o suporte do sistema, mostrar o seguinte erro: " + error);
                }
            });
        }
    }

    function editar(e) {

        e.preventDefault();
        var usuario = this.dataItem($(e.currentTarget).closest("tr"));
        var opcao_situacao = usuario.cod_situacao;
        var opcao_funcao = usuario.cod_funcao;
        $('#modal_adicionar').modal('show');
        $('.cod_usuario').val(usuario.cod_usuario);
        $('.vch_nome').val(usuario.vch_nome);
        $('.email').val(usuario.email);
        if (opcao_situacao == "Ativo") {
            $('#ativo').attr('checked', true);
        } else {
            $('#inativo').attr('checked', true);
        }
        if (opcao_funcao == "Administrador") {
            $('#administrador').attr('checked', true);
        } else {
            $('#colaborador').attr('checked', true);
        }
    }

    $(window).on('load', function () {
        $('body').removeClass('m-page--loading');
    });
</script>
<!-- end::Page Loader -->