<!--begin::Page Vendors -->
<script src="<?php echo base_url('themes/cliente/assets') ?>/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->  
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
<script type="text/javascript">
    $(document).ready(function () {
        var select;

        select = $('select').selectize({
            allowEmptyOption: false,
            create: false
        });

        $('.dz-message').text('Arraste e solte seu arquivo *.xls ou clique para selecionar.');

        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
        
        $('.cnpj').on('blur', function(){
            if(!validate_cnpj($(this).val())){
                $('.alerta-cnpj').show();
            }else{
                $('.alerta-cnpj').hide();
                $('#cadastrar').show();
            }
        });

        var crudServiceBaseUrl = "https://demos.telerik.com/kendo-ui/service";

        $(".tb_lojas").kendoGrid({
            toolbar: ["excel"],
            excel: {
                fileName: "Lojas.xlsx",
                filterable: true
            },
            dataSource: {
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
                schema: {
                    data: "data",
                    model: {
                        fields: {
                            cod_loja: {type: "number"},
                            nome: {type: "string"},
                            cnpj: {type: "string"},
                            estado: {type: "string"},
                            cidade: {type: "string"},
                            bairro: {type: "string"},
                            endereco: {type: "string"},
                            telefone: {type: "string"},
                            aniversario: {type: "string"},
                            qtd_checkout: {type: "number"},
                            situacao: {type: "string"},
                            valida_endereco: {type: "number"},
                            valida_cnpj: {type: "number"}
                        }
                    }
                },
                pageSize: 50,
                pageSizes: [50, 100, 200, "all"]
            },
            height: 500,
            selectable: "multiple",
            scrollable: true,
            reorderable: true,
            resizable: false,
            filterable: true,
            columnMenu: true,
            groupable: true,
            sortable: {
                mode: "multiple",
                allowUnsort: true
            },
            pageable: {
                refresh: true,
                pageSizes: true,
                buttonCount: 5
            },
            columns: [{
                    field: "cod_loja",
                    title: "ID",
                    aggregates: ["count"],
                    width: 50
                }, {
                    field: "nome",
                    title: "Loja",
                    aggregates: ["count"]
                }, {
                    field: "cnpj",
                    title: "CNPJ",
                    aggregates: ["count"]
                }, {
                    field: "estado",
                    title: "Estado",
                    aggregates: ["count"]
                }, {
                    field: "cidade",
                    title: "Cidade",
                    aggregates: ["count"]
                }, {
                    field: "bairro",
                    title: "Bairro",
                    aggregates: ["count"]
                }, {
                    field: "endereco",
                    title: "Endereço",
                    aggregates: ["count"]
                }, {
                    field: "telefone",
                    title: "Telefone",
                    aggregates: ["count"]
                }, {
                    field: "aniversario",
                    title: "Aniversário",
                    aggregates: ["count"]
                }, {
                    field: "qtd_checkout",
                    title: "Caixas/Checkouts",
                    aggregates: ["count"]
                }, {
                    field: "situacao",
                    title: "Situação",
                    aggregates: ["count"]
                }, {
                    field: "valida_endereco",
                    title: "Valida Endereço",
                    aggregates: ["count"]
                }, {
                    field: "valida_cnpj",
                    title: "Valida CNPJ",
                    aggregates: ["count"]
                }, {
                    command: [{text: "Excluir", click: excluir}, {text: "Editar", click: editar}], title: "&nbsp;", width: 150
                }
            ]
        });
        var grid = $(".tb_lojas").data("kendoGrid");
        grid.hideColumn(11);
        grid.hideColumn(12);

        function excluir(e) {
            e.preventDefault();
            var loja = this.dataItem($(e.currentTarget).closest("tr"));
            if (confirm("Deseja realmente excluir a loja " + loja.nome + "?")) {
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url("encarte/loja/inativar"); ?>/',
                    data: {
                        cod_loja: loja.cod_loja
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
            var loja = this.dataItem($(e.currentTarget).closest("tr"));
            $('.alerta-endereco').hide();
            $('.alerta-cnpj').hide();
            $('#modal_adicionar').modal('show');
            $('.cod_loja').val(loja.cod_loja);
            $('.nome').val(loja.nome);
            $('.estado').val(loja.estado);
            $('.cidade').val(loja.cidade);
            $('.bairro').val(loja.bairro);
            $('.endereco').val(loja.endereco);
            $('.telefone').val(loja.telefone);
            $('.aniversario').val(loja.aniversario);
            $('.qtd_checkout').val(loja.qtd_checkout);
            $('.cnpj').val(loja.cnpj);
            $('.cnpj').inputmask({"mask": '99.999.999/9999-99', 'autoUnmask': false});
            if(loja.cnpj == ""){
                $('#cadastrar').hide();
            }else{
                $('#cadastrar').show();
            }
            if (loja.valida_endereco == 1) {
                $('.alerta-endereco').show();
                $('#cadastrar').hide();
            }
            if (loja.valida_cnpj == 1) {
                $('.alerta-cnpj').show();
                $('#cadastrar').hide();
            }
        }

        var grid = $(".tb_lojas").data("kendoGrid");

        $(".k-button .k-button-icontext .k-grid-delete").on("click", function (e) {
            alert("Entrou!");
            var id = grid.dataItem($(this).closest("tr"));
            if (confirm("Deseja excluir a loja de ID:" + id + "?")) {
                alert('ok');
            }
        });

        $('.telefone').inputmask({"mask": '(99) 9999-9999', 'autoUnmask': true});
        addDatePicker('.calendario');

        function addDatePicker(sdt_data) {
            $(sdt_data).daterangepicker({
                'locale': {
                    'format': 'DD/MM/YYYY',
                    'daysOfWeek': [
                        'Dom',
                        'Seg',
                        'Ter',
                        'Qua',
                        'Qui',
                        'Sex',
                        'Sáb'
                    ],
                    'monthNames': [
                        'Janeiro',
                        'Fevereiro',
                        'Março',
                        'Abril',
                        'Maio',
                        'Junho',
                        'Julho',
                        'Agosto',
                        'Setembro',
                        'Outubro',
                        'Novembro',
                        'Dezembro'
                    ]
                },
                "drops": "down",
                singleDatePicker: true
            });
            $(sdt_data).inputmask("99/99/9999", {placeholder: "", clearMaskOnLostFocus: true});
        }
        $('.calendario').val('');
    });

    function validate_cnpj(val) {

        if (val.match(/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/) != null) {
            var val1 = val.substring(0, 2);
            var val2 = val.substring(3, 6);
            var val3 = val.substring(7, 10);
            var val4 = val.substring(11, 15);
            var val5 = val.substring(16, 18);

            var i;
            var number;
            var result = true;

            number = (val1 + val2 + val3 + val4 + val5);

            s = number;

            c = s.substr(0, 12);
            var dv = s.substr(12, 2);
            var d1 = 0;

            for (i = 0; i < 12; i++) {
                d1 += c.charAt(11 - i) * (2 + (i % 8));
            }

            if (d1 == 0) {
                result = false;
            }

            d1 = 11 - (d1 % 11);

            if (d1 > 9) {
                d1 = 0;
            }

            if (dv.charAt(0) != d1) {
                result = false;
            }

            d1 *= 2;
            for (i = 0; i < 12; i++) {
                d1 += c.charAt(11 - i) * (2 + ((i + 1) % 8));
            }

            d1 = 11 - (d1 % 11);

            if (d1 > 9) {
                d1 = 0;
            }

            if (dv.charAt(1) != d1) {
                result = false;
            }
            return result;
        }
        return false;
    }

    function initMap() {
        var input = /** @type {!HTMLInputElement} */(
                document.getElementById('localizacao'));

        var options = {
            componentRestrictions: {country: 'br'}
        };
        var autocomplete = new google.maps.places.Autocomplete(input, options);


        var infowindow = new google.maps.InfoWindow();

        autocomplete.addListener('place_changed', function () {
            infowindow.close();
            var place = autocomplete.getPlace();
            lat = place.geometry.location.lat();
            long = place.geometry.location.lng();
            var address = '';
            if (place.address_components) {


                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
            $('.latitude').val(lat);
            $('.longitude').val(long);
        });
    }
    $(window).on('load', function () {
        $('body').removeClass('m-page--loading');
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfKvfWCdje_CFDHVNnCKTQyjHLi5TRZ2w&libraries=places&callback=initMap"
async defer></script>
<!-- end::Page Loader -->