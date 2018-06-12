<style>
    /* ************************ MAIN ************************ */

    .carousel-control-next-icon {
        background-image: url(<?php echo base_url("img/next.svg"); ?>);
    }

    .carousel-control-prev-icon {
        background-image: url(<?php echo base_url("img/next.svg"); ?>);
        transform: rotate(-180deg);
    }

    .carousel-indicators li{
        background-color:#ff790061;
    }

    .carousel-indicators .active{
        background-color:#F6B428;
    }
    
    .carousel-item img{
        height: calc(100vw/4)!important;
        width: 100vw;
    }
    
    .distribuir{
        display:flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    .hovered{
        padding: 0.5vw;
    }

    .ic-sessao{
        width: 6%;
        margin-right: 2%;
    }

    @font-face {
        font-family: "UniNeueBold";
        src: url(img/UniNeueBold-Italic.otf);
    }

    #como-funciona h1{
        color: #0074cd;
        text-align: center;
        font-size: xx-large;
        font-family: 'Amaranth', sans-serif;
        margin-bottom: 5%;
    }

    #lojas-parceiras h1{
        color: #0074cd;
        text-align: center;
        font-size: xx-large;
        font-family: 'Amaranth', sans-serif;
        margin-bottom: 5%;
    }

    #mapa h1{
        color: #0074cd;
        text-align: left;
        font-size: xx-large;
        font-family: 'Amaranth', sans-serif;
        margin-bottom: 5%;
        margin-top: 2%;
    }

    .img-encarte{
        background-color: white;
        height: 386.66px !important;
        width: 267px !important
    }

    .encarte-img{
        height: 386.66px !important;
        width: 267px !important;
        background-repeat: no-repeat;
        background-size: cover !important;
        background-position: center;
    }

    .lojas-img{
        height: 85px !important;
        width: 109px !important;
        margin-bottom: 5px;
        background-repeat: no-repeat;
        background-size: contain;
        background-position: center;
    }

    .encarte-background-cinza{
        background-color:#f2f2f2;
        height: 100px !important;
        width: 267px !important;
        border-radius: 0 0 6px 6px;
    }

    .encarte-titulo{
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
        width:11%;
    }

    #como-funciona > .container{
        width: 80%;
        margin-top:30px;
        padding: 0 5%;
        margin-top: 70px;
    }

    #lojas-parceiras > .container{
        margin-top: 70px;
        text-align: center;
    }

    #como-funciona{
        text-align:center;
    }

    #como-funciona img{
        max-width: 50%;
    }

    #como-funciona p{
        text-align: center;
        padding:0 5%;
        margin-top: 4%;
    }

    .div-btn{
        margin-top: 3%;
        text-align: center;
        margin-bottom: 5%;
    }

    .div-btn .btn-primary{
        background-color: #0074cd;
        margin-bottom: 5%;
    }

    .div-btn .btn-primary:hover{
        opacity:0.9;
    }

    .carousel {
        position: relative;
        padding-bottom: 50px;
    }


    /**************** MAPA **************/

    #svg-map path { fill:#0094d9 }
    #svg-map text { fill:#fff; font:12px Arial-BoldMT, sans-serif; cursor:pointer }
    #svg-map a{ text-decoration:none }
    #svg-map a:hover { cursor:pointer; text-decoration:none }
    #svg-map a:hover path{ fill:#003399 !important }
    #svg-map .circle { fill:#66ccff }
    #svg-map a:hover .circle { fill:#003399 !important; cursor:pointer }

    .mapa-svg{
        text-align: -webkit-center;
    }

    /**************** MAPA **************/



    /* Blur + Gray Scale */
    .hovered{
        -webkit-filter: grayscale(0) blur(0);
        filter: grayscale(0) blur(0);
        -webkit-transition: .3s ease-in-out;
        transition: .2s ease-in-out;
        display: block;
        cursor: pointer;

    }
    .hovered:hover{
        border-radius: 5px 5px 5px 5px;
        box-shadow: -1px 4px 20px 0px hsla(243,9%,60%,.75);
        cursor: pointer;
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

    /* ************************ MAIN ************************ */

</style>
<script type="text/javascript">

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        }
    }

    function showPosition(position) {

        /*sessionStorage.setItem("lat", position.coords.latitude);
         sessionStorage.setItem("long", position.coords.longitude);
         */
        $.ajax({
            type: "POST",
            url: '<?php echo base_url("encarte/Home/salvarSessionLocation/"); ?>' + position.coords.latitude + '/' + position.coords.longitude,
            success: function (response) {

            },
            error: function (request, status, error) {
                console.log(error);
            }
        });
    }

    $(document).ready(function () {
        $('.recentes').click(function () {
            window.location.href = '<?= base_url('encarte/categoria/consultar/null/null') ?>/' + '0';
        });

        $('.supermercados').click(function () {
            window.location.href = '<?= base_url('encarte/categoria/consultar/null/null') ?>/' + '1';
        });

        $('.eletronicos').click(function () {
            window.location.href = '<?= base_url('encarte/categoria/consultar/null/null') ?>/' + '2';
        });

        $('.moda').click(function () {
            window.location.href = '<?= base_url('encarte/categoria/consultar/null/null') ?>/' + '3';
        });

        $('.saude').click(function () {
            window.location.href = '<?= base_url('encarte/categoria/consultar/null/null') ?>/' + '4';
        });

        $('.construir').click(function () {
            window.location.href = '<?= base_url('encarte/categoria/consultar/null/null') ?>/' + '5';
        });

        $('.viagem').click(function () {
            window.location.href = '<?= base_url('encarte/categoria/consultar/null/null') ?>/' + '6';
        });

        $('.automoveis').click(function () {
            window.location.href = '<?= base_url('encarte/categoria/consultar/null/null') ?>/' + '7';
        });

        $('.restaurantes').click(function () {
            window.location.href = '<?= base_url('encarte/categoria/consultar/null/null') ?>/' + '8';
        });

        $('.criancas').click(function () {
            window.location.href = '<?= base_url('encarte/categoria/consultar/null/null') ?>/' + '9';
        });

        $('.outros').click(function () {
            window.location.href = '<?= base_url('encarte/categoria/consultar/null/null') ?>/' + '10';
        });

        getLocation();

        $('.mapa-svg a').on('click', function () {
            $('.estado-selecionado').val($(this).attr('class'));
            if ($('.estado-selecionado').val() != '') {
                $('.form-mapa').submit();
            }
        });
    })


    function swipeBook(pdf, rede, descricao) {
        $('.flipbook-overlay').remove();
        $('.cssload-container').remove();
        $(this).swipeBook({
            pdfUrl: "<?php echo base_url('uploads/encarte/pdf/') ?>" + pdf,
            lightBox: true,
            skin: "light",
            zoomMin: 1.8,
            zoomStep: 3,
            btnSize: 18,
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

