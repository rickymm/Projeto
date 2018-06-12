<!-- Bootstrap -->
<link href="<?php echo base_url("themes/simple") ?>/plugins/bootstrap4/dist/css/bootstrap.min.css" rel="stylesheet"/>
<!-- Font Awesome -->
<link href="<?php echo base_url("themes/simple") ?>/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
<!-- NProgress -->
<link href="<?php echo base_url("themes/simple") ?>/plugins/nprogress/nprogress.css" rel="stylesheet"/>
<!--begin:: Flipbook-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url("themes/simple") ?>/plugins/flipbook/css/flipbook.style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url("themes/simple") ?>/plugins/flipbook/css/font-awesome.css">
<!--end:: Flipbook-->
<style>

    /* Fonts*/
    @font-face {
        font-family: 'Amaranth';
        font-style: normal;
        font-weight: 400;
        src: local('Amaranth Regular'), local('Amaranth-Regular'), url(<?php echo base_url("themes/simple") ?>/dist/css/fonts/amaranth.woff2) format('woff2');
        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }

    html{
        min-height: 100%;
        height: 100%;
        margin: 0;
    }

    .principal-icones{
        display: flex;
        flex-direction: row;
        float:right;
    }

    .principal-icones-div{
        padding-right: 0px !important;
    }

    .principal-icones li{
        padding: 16px;
        margin-top: -13px;
        border: 1px solid #195d9e;
        float: right;
    }
    
    .principal-icones li:first-child{
        border-left: 2px solid #195d9e;
    }
    
    
    /* ************************ HEADER ************************ */
    .navbar-fixed-top{
        margin-bottom: 0px;   
    }
    #menu-principal{
        margin-bottom: 0px;
        background: #1a75ce; /* Old browsers */
        display: flex;
        flex-direction: row;
        padding: 1% 0 0;
    }
    
    .principal-icones li:hover{
        background-color: #195d9e;
    }

    .dropdown-item:hover{
        background-color: #195d9e;
        color: #F6B428 !important;
    }


    #menu-principal .navbar-header{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width:-webkit-fill-available;
    }

    .borda{
        border: none !important;
    }

    .fill{
        border-left: 1px solid #215382;
        width: calc(100vw/10);
    }

    .fill:first-child{
        border-left: none;
    }

    .navbar-form .form-group{
        display: flex;
        flex-direction: column;
        width:100%;
    }

    .nav-pesquisa{
        display: flex !important;
        flex-direction: row !important;
    }

    #ic-menu-principal{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .glyphicon-menu-down{
        left: 4px;
        top: 2px;

    }

    .glyphicon-menu-hamburger{
        margin-right: 4px;
    }

    .navbar-nav>li>.dropdown-menu{
        background-color: white;
    }

    .dropdown-menu a{
        color:#195d9e !important;
        margin-right: 10px;
    }

    .dropdown-menu>li>a:hover{
        background-color:#ffd93e;
        color: white!important;
    }

    .dropdown-menu>li>a>img{
        margin-right:4px;
        width: 24px;
        padding-bottom: 6px;
    }

    a:hover{
        color: #595959;
        text-decoration: none;
    }

    #ipt-pesquisar{
        background-color: white;
        color: #0074CD;
        border: 1px solid #0074CD;
        width: inherit;
        border-radius: 14px;
        margin-right: 0;
        z-index: 0;
    }

    #btn-pesquisar{
        z-index: 9999;
        background-color: transparent;
        /*border: 1px solid #0169b9;*/
        border-radius: 15px;
        color: #195d9e;
    }

    .navbar-form img{
        margin-right: 4px;
    }

    .nav-tags{
        margin-bottom: 0px;
        border:0px;
        border-radius: 0px;
    }

    .nav-tags a{
        color: white;
        text-align: center;
        font-size:0.9em;
    }

    .nav-tags a:hover{
        color: #f7b428;
    }

    .fa-bars{
        font-size: 1.3em;
        margin-top: 10px;
    }

    .flex{
        display: flex; 
        flex-direction: row; 
        flex-wrap: nowrap; 
        justify-content: space-around;
    }

    .bottomsub{
        background-color: #EFEFEF;
        border-top: solid 2px #f7b428;
    }

    .nav-link{
        padding:0;
    }


    .open>.dropdown-toggle{
        background-color:#035ca0 !important;
    }

    .navbar-brand {
        padding: 6px 15px;
    }

    .principal-icones-div #ic-loja, .principal-icones-div #ic-mapa, .principal-icones-div #ic-localizacao{
        margin-right: 2%;  
        width: 35px;
    }

    .icones-mobile #ic-loja, .icones-mobile #ic-mapa, .icones-mobile #ic-localizacao{
        margin-right: 2%;  
        width: 27px;
    }

    .link-idioma{
        margin:0; 
    }

    .idioma{
        width:5%;   
    }

    .idioma:first-of-type{
        margin-left:5% !important;
    }

    .btn-menu{
        background-color:white;   
    }

    .submenu{
        background:#195d9e;
    }

    .ic-categoria{
        height: 25px;
    }

    .ic-categoria-automoveis{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-automoveis.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-automoveis:hover{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-automoveis-hover.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-construir{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-construir.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-construir:hover{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-construir-hover.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-criancas{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-criancas.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-criancas:hover{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-criancas-hover.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-eletronicos{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-eletronicos.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-eletronicos:hover{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-eletronicos-hover.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-encarte{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-encarte.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-encarte:hover{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-encarte-hover.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-moda{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-moda.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-moda:hover{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-moda-hover.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-outros{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-outros.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-outros:hover{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-outros-hover.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-restaurantes{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-restaurantes.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-restaurantes:hover{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-restaurantes-hover.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-saude{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-saude.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-saude:hover{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-saude-hover.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-supermercados{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-supermercados.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-supermercados:hover{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-supermercados-hover.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-viagem{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-viagem.svg') no-repeat center;
        height: 26px;
    }
    .ic-categoria-viagem:hover{
        background-size: 26px;
        background: url('http://localhost/WPW/uploads/encarte/icones/ic-viagem-hover.svg') no-repeat center;
        height: 26px;
    }

    #menu-mobile{
        background-color: rgb(26, 117, 206);
        display: flex;
        flex-direction: row;
    }

    .principal-busca-div-mobile{
        background-color: #195d9e;
    }

    .collapse-mobile{
        background-color: rgb(26, 117, 206);
        padding-left: 0px;
    }

    .collapse-mobile ul{
        padding-left: 0px;
    }
    .icones-mobile{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        margin-top: 6px;
    }

    .marca-mobile{
        padding-left: 0;
        margin-left: -27px;
        margin-right: 27px;
    }

    .icones-mobile-div{
        margin-left: 9px;
        padding: 0 10px
    }

    .mobile-busca-div{
        background-color: #195d9e;
        padding: 2% 2%;
    }
    /* ************************ HEADER ************************ */


    @media (min-width: 769px) /*desktop*/
    {
        .principal-busca-div-mobile{display:none;}
        .collapse-mobile{display:none;}
        .marca-mobile{display:none;}
        #menu-mobile{display:none;}
        .icones-mobile-div{display:none;}
        .mobile-busca-div {display:none;}
    }

    @media (max-width: 768px) /*mobile*/
    {
        #menu-principal{display:none;}
        .submenu{display:none;}
        .bottomsub{display:none;}
    }

    /* ************************ FOOTER ************************ */
    .footer1 {
        background: #fff;
        padding-top: 26px;
        padding-right: 0;
        padding-left: 0;
    }

    .card-block ul {
        list-style-type: none;
    }

    .card-block a {
        color: #0275d8 !important;
    }


    .titulo-footer {
        color: #0074cd;
        font-size: 20px;
        font-weight: 300;
        line-height: 1;
        position: relative;
        margin-top: 0;
        margin-right: 0;
        margin-left: 0;
        padding-left: 10px;
    }

    .titulo-footer::before {
        background-color: #0074cd;
        content: "";
        height: 22px;
        left: 0px;
        position: absolute;
        top: -2px;
        width: 2px;
    }


    .t-mobile{
        font-size:0.8em !important;
    }

    .t-mobile::before {
        height: 16px;
    }

    .card {
        border-radius: 0; 
        border-bottom: 0;
    }

    .widget_nav_menu a{
        color: #595959;
    }

    .widget_nav_menu ul {
        list-style: outside none none;
        padding-left: 0;
    }

    .widget_archive ul li {
        background-color: rgba(0, 0, 0, 0.3);
        content: "";
        height: 3px;
        left: 0;
        position: absolute;
        top: 7px;
        width: 3px;
    }

    .widget_nav_menu ul li {
        font-size: 13px;
        font-weight: 700;
        line-height: 20px;
        position: relative;
        width:95%;
    }


    #social:hover {
        -webkit-transform:scale(1.1); 
        -moz-transform:scale(1.1); 
        -o-transform:scale(1.1); 
    }
    #social {
        -webkit-transform:scale(0.8);
        /* Browser Variations: */
        -moz-transform:scale(0.8);
        -o-transform:scale(0.8); 
        -webkit-transition-duration: 0.5s; 
        -moz-transition-duration: 0.5s;
        -o-transition-duration: 0.5s;
    }           
    /* 
        Only Needed in Multi-Coloured Variation 
    */
    .social-fb:hover {
        color: #3B5998;
    }
    .social-tw:hover {
        color: #4099FF;
    }
    .social-gp:hover {
        color: #d34836;
    }
    .social-em:hover {
        color: #f39c12;
    }
    .nomargin { margin:0px; padding:0px;}

    .footer-bottom {
        background-color: #195d9e;
        min-height: 30px;
        width: 100%;
        bottom:0px;
        position: relative;
        padding: 10px 0;
    }

    .footer-bottom a{
        color:#fff;
    }

    .copyright {
        color: #fff;
        line-height: 30px;
        min-height: 30px;
        padding: 7px 0;
    }

    .list-unstyled{
        margin-bottom:44px;
    }

    .alerta{
        display: flex;
        background-color: #ffd93e;
        height: 131px;
        margin-top: -17px;
        flex-direction:column;
        justify-content: center;
    }

    .footerp{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding-top: 13px;
        color:#595959;
    }

    .footerp > img{
        margin-top: -33px;
        margin-bottom: 5px;
    }

    .footer-bottom {
        left: 0;
        bottom: 0;
        width: 100%;
    }

    .footer1 {
        left: 0;
        width: 100%;
    }
    .container {
        padding-right: 15px;
        padding-left: 15px;
    }

    .link-idioma-footer img{
        width:18px;
        float:right;
        margin-left: 5px;
        cursor:pointer;
    }

    @media (min-width: 681px) 
    {

        .alerta{
            margin-top: 3px;
        }
        .nav-mobile-upper{
            display: none;
        }

        .nav-footer{
            display:none;
        }
    }

    @media (min-width: 769px) /*desktop*/
    {
        .mobile{
            display:none;
        }
    }

    @media (max-width: 768px) /*mobile*/
    {
        .desktop{
            display:none;
        }
    }


    /* ************************ FOOTER ************************ */

</style>