/**
 * Mapa de Funções Existentes
 * - carrega_form(url) : Função para carregar formulário dinamicamente em um modal 
 * 
 * */

/**
 * Carrega formulário dinamicamente em um modal
 * @param {String} base (url do servidor, geralmente base_url()) 
 * @param {String} url 
 * @return {null}
 */

function carrega_form(url) {
    $.ajax({
        url: url,
        success: function (data) {
            $('.modal-body').html('');
            $('.modal-body').html(data);
        }
    });
    var form = $('#form').parsley();
//    $('form input[type=hidden]').val('');
//    document.getElementsByTagName("form").reset();
//    var form = $('form').parsley();
//    for (i = 0; i < form.length; i++) {
//        form[i].reset();
//    }

}