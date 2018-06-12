<script src="<?php echo base_url("themes/simple") ?>/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/fastclick/lib/fastclick.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/nprogress/nprogress.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/skycons/skycons.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/dropzone/dist/min/dropzone.min.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/dist/js/util.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/dist/js/custom.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/google-code-prettify/src/prettify.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/validator/validator.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/parsleyjs/dist/parsley.js"></script>
<link href="<?php echo base_url("themes/simple") ?>/plugins/selectize.js/dist/css/selectize.bootstrap3.css" rel="stylesheet">

<script src="<?php echo base_url("themes/simple") ?>/plugins/selectize.js/dist/js/standalone/selectize.min.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/moment-range/dist/moment-range.min.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/jquery.redirect-master/jquery.redirect.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/jquery-maskmoney/jquery.maskMoney.min.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/jquery.redirect-master/jquery.redirect.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/bootstrap-slider.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/filterizr/jquery.filterizr.min.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/flipbook/js/flipbook.min.js"></script>


<script>

    var lat;
    var long;

    $(document).ready(function () {
        
    });

    
    function carregaModal(url) {
        //Função utilizada para chamar dinamicamente um modal
        $(".modal-body").load(url, function () {
            console.log("Load foi executado.");
        });
    }
    
 
</script>
<!-- /validator -->