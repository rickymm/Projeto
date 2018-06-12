<style>

    body{
        padding-top:0 ;
        display: flex;
        flex-direction: column;
        height: 100vh;
        background-color: #0074cd;
    }

    .jumbotron{
        background-color: white;
        padding-top: 1% !important;
    }

    #titulo{
        text-align: center;
        margin-bottom: 5%;
        font-size: xx-large;
    }

    .btn-warning{
        margin-right: 2%
    }

    .reset{
        margin: 0 1%;
    }

    .ulnavegacao{
        display: flex;
        justify-content: space-around;
        flex-direction: row;
        padding: 0 !important;
    }

    .ulnavegacao h5, .ulnavegacao li{
        text-align: center;
        padding: 0 !important;
        color: white;
        font-size: larger;
    }

    ul{
        list-style-type:none
    }
    



</style>
<script type="text/javascript">
    $(document).ready(function () {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $('.categoria').selectize({
            allowEmptyOption: false,
            create: false
        });

        $('.regiao').selectize({
            allowEmptyOption: false,
            create: false,
            plugins: ['remove_button'],
            delimiter: ',',
            persist: false
        });

        $('.dias').selectize({
            allowEmptyOption: false,
            create: false,
            plugins: ['remove_button'],
            delimiter: ',',
            persist: false
        });

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


    function initMap() {
        var input = (document.getElementById('localizacao'));

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
            filtrarEncarte();
            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfKvfWCdje_CFDHVNnCKTQyjHLi5TRZ2w&libraries=places&callback=initMap"
async defer></script>