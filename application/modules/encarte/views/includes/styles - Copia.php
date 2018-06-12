<!-- Bootstrap -->
<link href="<?php echo base_url("themes/simple") ?>/plugins/bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
<!-- Font Awesome -->
<link href="<?php echo base_url("themes/simple") ?>/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
<!-- NProgress -->
<link href="<?php echo base_url("themes/simple") ?>/plugins/nprogress/nprogress.css" rel="stylesheet"/>
<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css"/>
<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>
<!--*******begin: SLICK******-->
<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css"/>
<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>
<!--*******end: SLICK******-->
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

    body {
        display: flex;
        flex-direction: column;
        height: 100vh;
    }
    
    .row{
        margin:0 !important;
        
    }
    
    
    .right-content-md-center>navbar-nav>li{
        float:left;
    }

    /* ************************ HEADER ************************ */
 
    .navbar-toggle .icon-bar {
        background-color: white;
    }
    
    .navbar-toggle {
        display:block;
    }
    
    .icons{
        height:25px;
    }
    

    /* ************************ HEADER ************************ */

    @media (max-width: 768px) 
    {
        .header-marca{
            flex-direction: row; 
            display: flex; 
            justify-content: space-around; 
            flex-wrap: nowrap !important;
        }
    }


    /* ************************ FOOTER ************************ */
    .footer1 {
        background: #fff;
        padding-top: 40px;
        padding-right: 0;
        padding-left: 0;
    }

    .link-idioma-footer{
        width: 20px;
        float: left;
        margin: 0.5% 1%;

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
        background-color: #0074cd;
        min-height: 30px;
        width: 100%;
        bottom:0px;
        position: relative;
    }
    .copyright {
        color: #fff;
        line-height: 30px;
        min-height: 30px;
        padding: 7px 0;
    }
    .design {
        color: #fff;
        line-height: 30px;
        min-height: 30px;
        padding: 7px 0;
        float: right;
        margin-right: 3%;
    }
    .design a {
        color: #fff;
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
        bottom: 30px;
        width: 100%;
    }
    .container {
        padding-right: 15px;
        padding-left: 15px;
    }

    @media (min-width: 681px) 
    {
        .container .design 
        {
            float: right;
        }

        .footer1 > .container .row
        {
            display: flex;
        }
        .alerta{
            margin-top: 3px;
        }
        .nav-web{
            display:none;
        }
        .nav-mobile-upper{
            display: none;
        }
        .nav-mobile-bottom{
            display: block;
            margin-top: 10px;
        }
        /*        .nav-mobile-bottom > a{
                    margin-right:20px;
                }*/
        .navbar-nav > li > a {
            color:#fff !important;
        }
        .nav-footer{
            display:none;
        }
        .link-idioma-footer {
            margin: 1% 2% 0 2%
        }
        .idioma:first-of-type {
            margin-left: 0 !important;
        }
    }

    @media (max-width: 1023px) 
    {
        .container .row 
        {
            text-align: -webkit-center;
            flex-direction: column;
        }

        .titulo-footer::before
        {
            width: 0px;
        }

        .capa{
            margin-top: 98px !important;
        }

        .design 
        {
            display: flex;
            justify-content: center;
        }

        .navbar-toggle{
            float:left;
        }
        .nav-mobile{
            display:none;
        }
        .nav-tags{
            overflow: hidden;
            height: 40px;
        }
        .nav-tags > li {
            float:left;
        }
        .navbar-toggle collapsed{
            width: 45px;
            float: left;
        }

        .navbar-nav > li > a > img{
            max-width: 40px;
        }

        .navbar-brand{
            float: left;
        }
        #menu-principal .navbar-header {
            display: unset;
        }
        .nav-mobile-upper{
            display: block;
            float:right;
        }
        .nav-mobile-upper > a{
            float:left;
            margin-right:10px;
            font-size: 0;
            line-height: 0; 
        }
        .nav-mobile-bottom{
            display: none;
        }
        #navbar{
            background: #0074cd;
        }
        .navbar-nav > li > a {
            text-align:left;
            text-indent: 10px;
            color:#fff !important;
        }
        .navbar-nav > li > a > img {
            padding-right: 10px;
        }
        .jumbotron>.capa{
            margin-top: 160px;
        }
        .navbar-fixed-bottom, .navbar-fixed-top {
            position: absolute;
        }
        .navbar-default .navbar-toggle:focus, .navbar-default .navbar-toggle:hover{
            background-color: #fff !important;
        }
        .nav-footer{
            display:block;
        }
        /*        .footer1{
                    display: none;
                }*/

        @media (max-width: 360px) 
        {
            .link-idioma-footer {
                margin:2% 2%;
            }
        }

        @media (max-width: 414px) 
        {
            .link-idioma-footer {
                margin:2% 2%;
            }
        }

    }

    /* ************************ FOOTER ************************ */

</style>