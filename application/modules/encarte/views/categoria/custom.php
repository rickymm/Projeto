<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.css" rel="stylesheet">
<style>
    /* ************************ MAIN ************************ */

    .jumbotron{
        margin-bottom: 3%;
        background-color: white;
        margin-top: 2%;
        padding-top: 0;
    }

    .slider-horizontal{
        margin-left: 19px !important;
    }



    @media (max-width: 640px){
        .hovered{
            margin: 10px 0px 10px 0px;
        }
    }

    @media (min-width: 641px){
        .hovered{
            float:left;
            margin: 10px 20px 10px 0px;
        }
    }

    .hovered{
        -webkit-filter: grayscale(0) blur(0);
        filter: grayscale(0) blur(0);
        -webkit-transition: .3s ease-in-out;
        transition: .1s ease-in-out;
        display: block;
    }
    .hovered:hover{
        -webkit-animation: flash 1.5s;
        animation: flash 1.5s;
    }

    @-webkit-keyframes flash {
        0% {
            opacity: .4;
        }
        100% {
            opacity: 1;
        }
    }
    @keyframes flash {
        0% {
            opacity: .4;
        }
        100% {
            opacity: 1;
        }
    }


    .capa{
        margin:1% auto 0 auto;
        width: 100%;
    }

    .capa > h1{
        width: 70%;
        margin: 0 auto;
    }


    .titulo-amarelo{
        padding: 0;
        color: #0074cd;
        text-transform: uppercase;
        font-family: 'Amaranth', sans-serif;
        font-weight: bolder;
        text-align: center;
        width: 100%;
    }

    .titulo-section{
        font-size: xx-large;
        text-align: left;
        font-family: 'Amaranth', sans-serif;
        color:#0074cd;
    }

    .img-encarte{
        background-color: white;
        height: 490px;
        width: 290px;
    }

    .encarte-img{
        height: 490px !important;
        width: 331px !important;
        background-repeat: no-repeat;
        background-size: cover !important;
        background-position: center;
        box-shadow: 0 0 5px 0 hsla(243,9%,60%,.75);
    }

    .encarte-background-cinza{
        background-color:#f2f2f2;
        height: 100px !important;
        width: 331px;
        border-radius: 0 0 6px 6px;
    }

    .encarte-titulo-amarelo{
        margin:0 !important;
        font-weight: bolder;
        padding: 10px 0 0 10px;
        text-align: left;
        color:#0074cd;
    }

    .encarte-texto{
        margin:0 !important; 
        font-size: 15px !important;
        padding: 5px 0 0 10px;
        text-align: left;
    }

    .encarte-texto img{
        margin-top:-5px !important;
        margin-right: 5px;
        float:left;
    }

    .list-group-item{
        background-color: #0074cd;
        border:none;
        color: white;
    }

    .list-group a{
        color: white;
        text-align:left;
    }

    .list-group {
        margin-bottom: 0; 
    }

    .lista{
        background-color: #0074cd;
        padding: 2% 0;
    }

    .link{
        font-size: medium;
        text-align: right;
        font-family: 'Amaranth', sans-serif;
        color:#0074cd;
        float:right;
    }

    .ajuste-link{
        margin-top: 35px;
    }

    .list-group-item:first-child, .list-group-item:last-child {
        border-radius: 0; 
    }

    .filtro{
        background-color: #f2f2f2 !important;
        padding: 1% 0 1% 0 !important;
        width: 100%;
        margin: 0 auto;
    }

    .pesquisar{
        display:flex;
    }

    .filtro label{
        text-align: left !important;
    }

    .list-group{
        display: flex;
        flex-wrap: wrap;
    }

    @media (max-width: 640px){
        .filtro label{
            margin-top: 5%;
        }
        .titulo-section{
            text-align: center;
            font-size: x-large;
        }
        .filtro{
            position: relative;
        }
    }

    /* ************************ ANUNCIOS ************************ */

    .anuncio{
        width:720px;
        height: 90px;
        background-image: url("http://www.cursohamburguergourmet.com/files/sites/392/2015/11/AN%C3%9ANCIO-GOOGLE-728x90.gif");
        background-size: cover;
        margin: 5% auto 0 auto;
    }


    @media only screen and (max-width: 500px) {
        .anuncio {
            width:468px !important;
            height: 60px !important;
        }
    }



</style>

<script type="text/javascript">

    var categoria = 'todas';
    var distancia = '0';
    $(document).ready(function () {

        $("#distancia").slider({
            ticks: [1, 10, 20, 30, 40],
            ticks_labels: ['1km', '10km', '20km', '30km', '40km'],
            ticks_snap_bounds: 30
        });

        $('.localizacao').on('blur', function () {
            filtrarEncarte();
        });

        $('.categoria').on('change', function () {
            filtrarEncarte();
        });

        $('#distancia').on('change', function () {
            filtrarEncarte();
        });

        $('.rede').on('change', function () {
            filtrarEncarte();
        });

    });

    function filtrarEncarte() {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url("encarte/categoria/filtrarEncarte"); ?>',
            data: {
                cod_categoria: $('.categoria').val(),
                lat: lat,
                long: long,
                distancia: $('.tooltip-inner').text(),
                cod_rede: $('.rede').val()
            },
            success: function (response) {
                $('#encartes').html('');
                var html = "";
                for (var i = 0; i < response.data.length; i++) {
                    var obj = response.data[i];
                    var imagem = "background-image: url('uploads/encarte/imagem_destacada/" + obj.imagem_destacada + "')";
                    html += '<div class="col-md-4">'
                            + '<div class="hovered ">'
                            + '<div class="encarte-img" style="' + imagem + '">'
                            + '</div>'
                            + '<div class="encarte-background-amarelo">'
                            + '<h6 class="encarte-titulo-amarelo">' + obj.loja + '</h6>'
                            + '<p class="encarte-texto">Vence em: <strong>' + obj.vencimento + '</strong></p>'
                            + '<p class="encarte-texto texto-distancia" style="display: inline-block;">' + obj.distancia + '</p>'
                            + '<p class="encarte-texto" style="display: inline-block; padding-left:0">km</p>'
                            + '</div>'
                            + '</div>'
                            + '</div>';
                }
                $('#encartes').append(html);
            },
            error: function (request, status, error) {

            }
        });
    }

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