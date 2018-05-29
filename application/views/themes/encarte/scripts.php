<!--begin::Base Scripts -->
<script src="<?php echo base_url('themes/cliente/assets') ?>/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="<?php echo base_url('themes/cliente/assets') ?>/demo/demo8/base/scripts.bundle.js" type="text/javascript"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- Selectize -->
<link href="<?php echo base_url("themes/simple") ?>/plugins/selectize.js/dist/css/selectize.bootstrap3.css" rel="stylesheet">
<script src="<?php echo base_url("themes/simple") ?>/plugins/selectize.js/dist/js/standalone/selectize.min.js"></script>
<script src="<?php echo base_url('themes/igimo/assets') ?>/demo/default/custom/components/base/toastr.js" type="text/javascript"></script>
<!--end::Base Scripts --> 
<?php $url = strtolower($this->uri->segment(2));
if($url == 'relatorios'){?>
<script src="<?php echo base_url("themes/simple/dist/js/amcharts/") ?>amcharts.js"></script>
<script src="<?php echo base_url("themes/simple/dist/js/amcharts/") ?>serial.js"></script>
<script src="<?php echo base_url("themes/simple/dist/js/amcharts/") ?>pie.js"></script>
<script src="<?php echo base_url("themes/simple/dist/js/amcharts/plugins/export/") ?>export.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url("themes/simple/dist/css/") ?>/export.css" type="text/css" media="all" />
<script src="<?php echo base_url("themes/simple/dist/js/amcharts/themes/") ?>light.js"></script>
<script src="<?php echo base_url("themes/simple/dist/js/amcharts/") ?>none.js"></script>

<script src="<?php echo base_url("themes/simple/dist/js/amcharts/plugins/dataloader/") ?>dataloader.min.js"></script>
<script src="<?php echo base_url("themes/simple/dist/js/amcharts/") ?>chart.min.js" type="text/javascript"></script>
<?php
}
if (isset($this->session->mensagem) && sizeof($this->session->mensagem) > 0) {
    ?>
    <script>
        $(document).ready(function () {
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
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
                case 'warning':
                    toastr.warning(mensagem[0], mensagem[1]);
                    break;
                default:
                    toastr.info(mensagem[0], mensagem[1]);
                    break;
            }
        });
    </script>
<?php
    $this->session->unset_userdata('mensagem');
}
?>