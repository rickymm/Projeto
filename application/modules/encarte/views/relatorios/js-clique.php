<!--begin::Page Vendors -->
<script src="<?php echo base_url('themes/cliente/assets') ?>/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
<script src="https://www.amcharts.com/lib/3/themes/none.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        carregarRelatorio();
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

    function carregarRelatorio() {
        var filtros = "";
        var data_ini = $('.data_ini').val();
        var data_fim = $('.data_fim').val();
        var opcao = $('.opcao').val();
        if (data_ini != "" && data_fim != "") {
            filtros += moment(data_ini, 'DD/MM/YYYY').format('YYYY-MM-DD') + "/" + moment(data_fim, 'DD/MM/YYYY').format('YYYY-MM-DD') + "/" + opcao;
        } else {
            filtros += 'null/null/' + opcao;
        }
        var chart = AmCharts.makeChart("chartdiv", {
            "type": "serial",
            "theme": "none",
            "colors": [
                "#0074CD"
            ],
            "startDuration": 2,
            "dataLoader": {
                "url": "<?php echo base_url('encarte/relatorios/relatorios'); ?>/" + filtros,
                "format": "json",
            },
            "valueAxes": [{
                    "title": "Quantidade de cliques"
                }],
            "graphs": [{
                    "balloonText": "[[category]]: <b>[[value]]</b>",
                    "fillColorsField": "#ddd",
                    "fillAlphas": 1,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "cliques"
                }],
            "rotate": true,
            "categoryField": "nome",
            "categoryAxis": {
                "gridPosition": "start",
                "fillAlpha": 0.05,
                "position": "left"
            },
            "export": {
                "enabled": true
            }
        });
    }
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $(window).on('load', function () {
        $('body').removeClass('m-page--loading');
    });
    
    
</script>