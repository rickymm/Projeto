<style>
    /* ************************ MAIN ************************ */

    .jumbotron{
        margin-bottom: 3%;
        background-color: white;
        margin-top: 2%;
        padding-top: 0;
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

    @media (max-width: 991px){
        .pesquisar{
            display: block !important;
        }
        .btn-pesquisar{
            margin-top: 2%;
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
        /*padding: 6em 0px;*/
        margin:1% auto 0 auto;
        width: 100%;
    }

    .capa > h1{
        width: 70%;
        margin: 0 auto;
    }

    .titulo-amarelo{
        /*        background: #ffd93e;*/
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

    .encarte-background-amarelo{
        background-color:#ffd93e;
        height:100px;
        width: 331px;
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

    .list-group{
        display: flex;
        flex-wrap: wrap;
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

    .lista-rede{
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        height: 160px;
    }

    @media (max-width: 640px){
        .filtro label{
            margin-top: 5%;
        }
        .titulo-section{
            text-align: center;
            font-size: x-large;
        }
        .lista-rede{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }
    }


    /* ************************ MAPA ************************ */

    .mapa-container{
        height: 500px;
    }

    #mapa{
        height: 100%;
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

    var localizacao;
    var locations = [];
    var icons = '';
    var categoria = '';
    var rede = '';

    var contentString = '';
    var remote;

    $(document).ready(function () {        
        carregarPontos();

        $('.rede, .categoria').on('change', function () {
            rede = $('.rede').val();
            categoria = $('.categoria').val();

            carregarPontos(categoria, rede);
        });



    });


    function initMap() {
        var location = {
                    lat: -12.880990342218649,
                    lng: -38.476117450000004
                };
        
        // Create a map object and specify the DOM element for display.
        var map = new google.maps.Map(document.getElementById('mapa'), {
            zoom: 12,
            center: location
        });


        if (navigator.geolocation) {
            
            navigator.geolocation.getCurrentPosition(function (position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                map.setCenter(pos);
            }, function (error) {
                //alert(error.message);
            }, {enableHighAccuracy: true, timeout: 5000000});
        } else {
            // Browser doesn't support Geolocation
            alert('Sem localização!');
        }
        
        var markers = [];

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i]['lat'], locations[i]['lng']),
                icon: locations[i]['icons'],
                animation: google.maps.Animation.DROP,
                map: map,
                cod_rede: locations[i]['cod_rede']
            });

            google.maps.event.addListener(marker, 'click', (function (marker, i) {

                return function () {
                    window.location = '<?php echo base_url("encarte/rede/consultarRede/"); ?>'+marker.cod_rede;
                };
            })(marker, i));
            
            
            google.maps.event.addListener(marker, 'mouseover', (function (marker, i) {

                return function () {
                    infowindow = new google.maps.InfoWindow({
                        content: locations[i]['contentString']
                    });
                    infowindow.open(map, marker);
                }
            })(marker, i));

            google.maps.event.addListener(marker, 'mouseout', (function (marker, i) {

                return function () {
                    infowindow.close();
                }
            })(marker, i));

            markers.push(marker);
        }
        if (markers.length > 0) {
            var markerCluster = new MarkerClusterer(map, markers,
                    {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
        }


    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
    }

    function carregarPontos(cod_categoria = null, cod_rede = null) {
        locations = [];
        icons = '';
        image = '';
        if (cod_rede === '') {
            cod_rede = null;
        }
        ;
        if (cod_categoria === '') {
            cod_categoria = null;
        }
        ;
        
        $.ajax({
            type: "POST",
            url: '<?php echo base_url("encarte/loja/consultarRedesComOfertasAtivas/"); ?>' + cod_rede + '/' + cod_categoria,
            success: function (response) {
                var dados = response.data;

                $.each(dados, function (i, val) {
                    if (val.cod_rede == null) {
                        image = {
                            url: 'img/ic-marca.png',
                            size: new google.maps.Size(64, 64),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(0, 64)
                        };
                        icons = image
                    } else {
                        image = {
                            url: '<?php echo base_url("uploads/logos_imagens/icones/"); ?>' + val.cod_rede + '.png',
                            size: new google.maps.Size(64, 64),
                            origin: new google.maps.Point(0, 0),
                            anchor: new google.maps.Point(0, 64)
                        };
                        icons = image
                    }
                    
                    contentString = '<div id="content">' +
                            '<div id="siteNotice">' +
                            '</div>' +
                            '<h5 id="firstHeading" class="firstHeading">' + val.rede + '</h5>' +
                            '<div id="bodyContent">' +
                            '<p>' + val.endereco +
                            '<h6>Encartes ativos: '+val.cont+'</h6>' +
                            '</p>' +
                            '</div>' +
                            '</div>';

                    locations.push({
                        cod_rede: parseFloat(val.cod_rede),
                        lat: parseFloat(val.latitude),
                        lng: parseFloat(val.longitude),
                        icons: icons,
                        contentString: contentString
                    });

                });


                initMap();
            },
            error: function (request, status, error) {
                console.log(error);
            }
        });
    }
</script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
</script>


