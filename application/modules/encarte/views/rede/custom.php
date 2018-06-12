<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.css" rel="stylesheet">
<style>
    /* ************************ MAIN ************************ */


    .jumbotron{
        margin-bottom: 3%;
        background-color: white;
        margin-top: 2%;
        padding-top: 0;
    }

    .jumbotron p {
        margin-top: 15px;
        margin-bottom: 15px;
        font-size: 12px;
    }

    .capa{
        /*padding: 6em 0px;*/
        margin:2% auto 0 auto;
        width: 100%;
    }

    .capa > h1{
        width: 70%;
        margin: 0 auto;
    }

    @font-face {
        font-family: "UniNeueBold";
        src: url(img/UniNeueBold-Italic.otf);
    }

    .titulo-azul{
        color:#ffd93e !important;
        text-transform: uppercase;
        font-family: UniNeueBold, sans-serif;
        font-weight: bolder;
        font-size: -webkit-xxx-large;
        letter-spacing: -4px;
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

    .encarte-texto{
        margin:0 !important; 
        font-size: 15px !important;
        padding: 5px 0 0 10px;
        text-align: left;
    }

    .ajuste{
        margin-left: 0;
        padding: 0;

    }

    .btn-loja{
        width: 100%;
        margin: 0.3%;
        color: #333;
        background-color: white;
        text-align:left;
    }

    .btn-loja img{
        width: 5%;
        padding: 0% 1% 0 0;
    }

    .btn-loja:hover{
        background-color: #035ca0;
        color:white;
    }

    .list-group{
        display:flex;
        flex-direction:row;
        flex-wrap: wrap;
    }

    .list-group-item{
        background-color: #f2f2f2;
        border: 1px solid #d2d0d0;
    } 

    .list-group-item:hover{
        background-color: #0074cd !important;
        border: 1px solid #d2d0d0;
    } 

    a.list-group-item{
        color:#555;
    }

    a.list-group-item:hover{
        color:white;
    }

    .rede{
        margin-top: 4%;
    }


    .marcas{
        width: 16%;
        margin-right: 3%;
    }

    .list-group .col-md-4{
        margin-bottom: 1%;
    }


    @media (max-width: 640px){
        .titulo-section{
            text-align: center;
            font-size: x-large;
        }

        .encarte-img {
            height: 298px !important;
            width: 199px !important;
            background-repeat: no-repeat;
            background-size: cover !important;
            background-position: center;
            box-shadow: 0 0 5px 0 hsla(243,9%,60%,.75);
        }

        .titulo-section {
            text-align: center;
            font-size: medium;
        }

        .titulo-azul {
            font-size: xx-large;
            letter-spacing: -2px;
        }

        .ajuste{
            padding-right: 0;
        }
        .rede{
            margin-top:0;
            margin-bottom:2%;
        }

    }

    #map {
        height: 442px;
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

    function initMap(lat = null, long = null, loja = null) {
        var location = {
            lat: -12.880990342218649,
            lng: -38.476117450000004
        };
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: location
        });
        var marker = new google.maps.Marker({
            position: location,
            map: map
        });
        filtrarEncarte(loja);
        subir();

    }

    function subir() {
        $("html, body").delay(50).animate({
            scrollTop: $('body').offset().top
        }, 500);
    }



    function filtrarEncarte(loja) {
        $.ajax({
            type: "POST",
            url: '<?php echo base_url("encarte/encarte/ofertasAtivasPorLoja"); ?>',
            data: {
                cod_loja: loja,
                cod_rede: $('#cod_rede').val()
            },
            success: function (response) {
                $('#encartes').html('');
                var html = "";
                for (var i = 0; i < response.data.length; i++) {
                    var obj = response.data[i];
                    //'<?php echo base_url("uploads/logos_imagens/icones/"); ?>' + val.cod_rede + '.png',
                    var imagem = "background-image: url('<?php echo base_url("uploads/encarte/imagem_destacada/") ?>" + obj.imagem_destacada + "')";
                    html += '<div class="col-md-6">'
                            + '<div class="hovered" onclick="swipeBook(\'' + obj.pdf + '\', ' + obj.cod_rede + ', \'' + obj.nome_encarte + '\')">'
                            + '<div class="encarte-img" style="' + imagem + '">'
                            + '</div>'
                            + '<div class="encarte-background-amarelo">'
                            + '<p class="encarte-texto">Vence em: <strong>' + obj.vencimento + '</strong></p>'
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

    function swipeBook(pdf, rede, descricao) {

        $('.hovered').swipeBook({
            pdfUrl: "<?= base_url('uploads/encarte/pdf/') ?>" + pdf,
            lightBox: true,
            skin: "dark",
            zoomMin: 0.9,
            zoomStep: 3,
            btnToc: {
                enabled: false
            },
            btnAutoplay : {
                enabled: false
            },
            btnPrint: {
                enabled: false
            },
            btnDownloadPages: {
                enabled: false
            },
            btnDownloadPdf: {
                enabled: false
            },
            btnSearch: {
                enabled: true,
                title: "Pesquisar",
                icon: "fas fa-search"
            },
            btnShare: {
                enabled: true,
                title: "Compartilhe com seus amigos",
                icon: "fa-link"
            },
            btnExpand: {
                enabled: true,
                title: "Tela cheia",
                icon: "fa-expand",
                iconalt: "fa-compress"
            },
            btnZoomOut: {
                enabled: true,
                title: "Diminuir zoom",
                icon: "fa-minus"
            },
            btnZoomIn: {
                enabled: true,
                title: "Aumentar zoom",
                icon: "fa-plus"
            },
            pageTextureSize: 1500,
            facebook: {
                enabled: true,
                load_sdk: true,
                url: "<?php echo base_url('uploads/rede/consultarrede/') ?>" + rede,
                app_id: null,
                title: descricao,
                caption: null,
                description: null,
                image: "https://vignette.wikia.nocookie.net/leagueoflegends/images/d/df/Morgana_OriginalCentered.jpg/revision/latest/scale-to-width-down/1215?cb=20180414203434"
            },
            twitter: {
                enabled: true,
                url: "<?php echo base_url('uploads/rede/consultarrede/') ?>" + rede,
                description: descricao
            },
            pinterest: {
                enabled: true,
                url: "<?php echo base_url('uploads/rede/consultarrede/') ?>" + rede,
                image: "https://vignette.wikia.nocookie.net/leagueoflegends/images/d/df/Morgana_OriginalCentered.jpg/revision/latest/scale-to-width-down/1215?cb=20180414203434",
                description: descricao
            }

        });


    }

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfKvfWCdje_CFDHVNnCKTQyjHLi5TRZ2w&libraries=places&callback=initMap"
async defer></script>