<style>
    /* ************************ MAIN ************************ */

    .jumbotron{
        margin-bottom: 0;
        background-color: white;
        padding-top: 2%;
    }

    .capa{
        /*padding: 6em 0px;*/
        margin:7% auto 0 auto;
        width: 100%;
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

    small{
        font-size: 76%;
        font-weight: 100;
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

    label, texto{
        margin-top: 3%;
    }

    .enviar{
        float: right;
        margin-top: 2%;
        cursor: pointer;
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

<script type="text/javascript" src="<?php echo base_url("themes/simple") ?>/plugins/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.telefone').inputmask({"mask": '(99) 9999-9999', 'autoUnmask': true});
    });

</script>