<style>
    /* ************************ MAIN ************************ */
    
    .enviar{
        cursor: pointer;
    }
    
    .alert{
        margin-bottom: 0px !important;
    }

    .titulo-section{
        font-size: xx-large;
        text-align: left;
        font-family: 'Amaranth', sans-serif;
        color:#0074cd !important;
    }

    small{
        font-size: 76%;
        font-weight: 100;
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
        letter-spacing: -3px;
    }

    .titulo-azul span{
        background-color: #0074cd;
        padding: 0.1em 0.3em;
        -webkit-box-shadow: 0px 7px 28px -8px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 7px 28px -8px rgba(0,0,0,0.75);
        box-shadow: 0px 7px 28px -8px rgba(0,0,0,0.75);
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
    }

    .list-group-item:first-child, .list-group-item:last-child {
        border-radius: 0; 
    }

    .check{
        position: relative;
        cursor: pointer;
        color: #666;
        font-size: large;
        display: block;
    }

    #paragrafo{
        margin-top: 30px;
    }

    .check-categorias{
        margin-top: -409px; 
    }

    input[type="checkbox"] + .label-text:before{
        content: "\f096";
        font-family: "FontAwesome";
        speak: none;
        font-style: normal;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        line-height: 1;
        -webkit-font-smoothing:antialiased;
        width: 1em;
        display: inline-block;
        margin-right: 5px;
    }

    input[type="checkbox"]:checked + .label-text:before{
        content: "\f14a";
        color: #2980b9;
        animation: effect 250ms ease-in;
    }

    input[type="checkbox"]:disabled + .label-text{
        color: #aaa;
    }

    input[type="checkbox"]:disabled + .label-text:before{
        content: "\f0c8";
        color: #ccc;
    }
    input[type="checkbox"]{
        position: absolute;
        right: 9000px;
    }

    @media only screen and (max-width: 1024px) {
        .imagem{
            display:none;
        }
        .check-categorias {
            margin-top: 0px; 
        }
        .titulo-azul span{
            font-size: xx-large;
            letter-spacing: -2px;
        }
    }


</style>

<script type="text/javascript">

    function initMap() {
        var input = /** @type {!HTMLInputElement} */(
                document.getElementById('cidade'));

        var options = {
            types: ['(cities)'],
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

        });
    }

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfKvfWCdje_CFDHVNnCKTQyjHLi5TRZ2w&libraries=places&callback=initMap"
async defer></script>