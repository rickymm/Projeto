<style>
    /* ************************ MAIN ************************ */

    main{
        background-color: #c0d9e4;
    }

    .img-duvida{
        max-width: 89%;
    }

    .jumbotron{
        margin-bottom: 0;
        background-color: #c0d9e4;
        padding-top: 0;
    }

    .capa{
        /*padding: 6em 0px;*/
        margin:7% auto 0 auto;
        width: 100%;
    }

    label{
        text-align: left;
        margin-top: 2%;
    }

    .btn-primary{
        margin-top: 2%;
    }
    
    .enviar{
        cursor: pointer;
    }

    @media (max-width: 811px){
        .imagem{
            display: none;
        }
    }




</style>

<script type="text/javascript" src="<?php echo base_url("themes/simple") ?>/plugins/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        var select;
        select = $('select').selectize({
            allowEmptyOption: false,
            create: false
        });
    });
    
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

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfKvfWCdje_CFDHVNnCKTQyjHLi5TRZ2w&libraries=places&callback=initMap"
async defer></script>