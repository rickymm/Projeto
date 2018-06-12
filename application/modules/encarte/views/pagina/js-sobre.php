<script type="text/javascript">

    $(document).ready(function () {
        $('#alterar-senha').validate({
            rules: {
                senha: {
                    required: true,
                    minlength: 6
                },
                confirmacao_senha: {
                    required: true,
                    minlength: 6,
                    equalTo: "#senha"
                }
            },
            messages: {
                senha: {
                    required: "O campo confirmação de senha é obrigatório.",
                    minlength: "Tamanho mínimo 6 caracteres"
                },
                confirmacao_senha: {
                    required: "O campo confirmação de senha é obrigatório.",
                    equalTo: "O campo confirmação de senha deve ser idêntico ao campo senha.",
                    minlength: "Tamanho mínimo 6 caracteres"
                }
            }
        });
    });


    $(window).on('load', function () {
        $('body').removeClass('m-page--loading');
    });
</script>