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
<script type="text/javascript">
    $(document).ready(function(){
        $(".tb_encartes").kendoGrid({
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
                            cod_encarte: {type: "number"},
                            pdf: {type: "string"},
                            observacao: {type: "string"},
                            data_inicio: {type: "string"},
                            data_fim: {type: "string"}
                        }
                    }
                },
                pageSize: 50,
                pageSizes: [50, 100, 200, "all"]
            },
            height: 500,
            selectable: "multiple",
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
                    field: "cod_encarte",
                    title: "ID",
                    aggregates: ["count"],
                    width: 50
                }, {
                    field: "pdf",
                    title: "PDF",
                    aggregates: ["count"]
                }, {
                    field: "cnpj",
                    title: "CNPJ",
                    aggregates: ["count"]
                }, {
                    field: "observacao",
                    title: "Observação",
                    aggregates: ["count"]
                }, {
                    field: "data_inicio",
                    title: "Data Ínicio",
                    aggregates: ["count"]
                }, {
                    field: "data_fim",
                    title: "Data Fim",
                    aggregates: ["count"]
                }
            ]
        });
    });
    $(window).on('load', function () {
        $('body').removeClass('m-page--loading');
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfKvfWCdje_CFDHVNnCKTQyjHLi5TRZ2w&libraries=places&callback=initMap"
async defer></script>
<!-- end::Page Loader -->