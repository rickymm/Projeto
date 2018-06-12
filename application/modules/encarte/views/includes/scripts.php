<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/bootstrap4/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/fastclick/lib/fastclick.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/nprogress/nprogress.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/google-code-prettify/src/prettify.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/jquery.redirect-master/jquery.redirect.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/bootstrap-slider.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/flipbook/js/flipbook.min.js"></script>
<script src="<?php echo base_url("themes/simple") ?>/plugins/validator/validator.js"></script>


<script>

    var lat;
    var long;
    $(document).ready(function () {
        
        $('[data-toggle="tooltip"]').tooltip();

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        }

        $('.categoria-menu li').click(function () {
            var categoria = $(this).attr('id');
            window.location.href = '<?= base_url('encarte/categoria/consultar/null/null') ?>/' + categoria;
        });

        $(".icon-ic-automoveis").mouseover(function () {
            $(".icon-ic-automoveis::before").css("color", "#000");
        });

    });






    function showPosition(position) {
        lat = position.coords.latitude;
        long = position.coords.longitude;
    }


    // initialize the validator function
    validator.message.date = 'not a real date';
    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    $('form')
            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);
    $('.multi.required').on('keyup blur', 'input', function () {
        validator.checkField.apply($(this).siblings().last()[0]);
    });
    $('form').submit(function (e) {
        e.preventDefault();
        var submit = true;
        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
            submit = false;
        }

        if (submit)
            this.submit();
        return false;
    });
    function carregaModal(url) {
        //Função utilizada para chamar dinamicamente um modal
        $(".modal-body").load(url, function () {
            console.log("Load foi executado.");
        });
    }


</script>
<!-- /validator -->