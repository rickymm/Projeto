<!--begin::Page Vendors -->
<script src="<?php echo base_url('themes/cliente/assets') ?>/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->  
<!--begin::Page Snippets -->
<script src="<?php echo base_url('themes/cliente/assets') ?>/app/js/dashboard.js" type="text/javascript"></script>
<script src="<?php echo base_url('themes/simple/plugins') ?>/intl-tel-input/build/js/intlTelInput.js"></script>
<script src="<?php echo base_url('themes/simple/plugins') ?>/intl-tel-input/build/js/utils.js"></script>
<script src="<?php echo base_url('themes/simple/plugins') ?>/croppie/croppie.js"></script>
<!--end::Page Snippets -->   
<script type="text/javascript">
    $(document).ready(function () {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
<?php if (isset($this->session->usuario) && $this->session->usuario->cod_situacao == '2') { ?>
            setTimeout(function () {
                $('.alert-danger').hide();
            }, 6000);
<?php } ?>
        $('.telefone').inputmask({"mask": '9999999999', 'autoUnmask': true});
        $(".telefone").intlTelInput({
            initialCountry: "br"
        });

        $('.country-list li').click(function () {
            console.log($(".telefone").intlTelInput('getSelectedCountryData').dialCode);
        });


    });


    function bs_input_file() {
        $(".input-file").before(
                function () {
                    if (!$(this).prev().hasClass('input-ghost')) {
                        var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
                        element.attr("name", $(this).attr("name"));
                        element.change(function () {
                            element.next(element).find('input').val((element.val()).split('\\').pop());
                        });
                        $(this).find("button.btn-choose").click(function () {
                            element.click();
                        });
                        $(this).find("button.btn-reset").click(function () {
                            location.reload();
                        });
                        $(this).find('input').css("cursor", "pointer");
                        $(this).find('input').mousedown(function () {
                            $(this).parents('.input-file').prev().click();
                            return false;
                        });
                        $('.enviar').attr('disabled', false);
                        return element;
                    }
                }
        );
    }

    $(function () {
        bs_input_file();
    });

    $(window).on('load', function () {
        $('body').removeClass('m-page--loading');
    });
</script>
<!-- end::Page Loader -->