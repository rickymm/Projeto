<!-- Fixed navbar -->
<header class="m-grid__item m-header">
    <div class="m-header__top">
        <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-stack m-stack--ver m-stack--desktop"></div>
            <div class="row header-marca" style="background-color: #ff0000; min-height: 100px;">
                <div>
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bars"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <?php foreach ($categorias as $cs) { ?>
                                    <li id="<?php echo $cs->cod_categoria ?>"><a><img alt="<?php echo strtolower($cs->nome_imagem); ?>" src="img\ic-<?php echo strtolower($cs->nome_imagem); ?>.svg"><?php echo $this->lang->line("encarte_" . strtolower($cs->nome_imagem)); ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                    <!--/.nav-collapse -->
                </div>
                <div>
                    <a class="navbar-brand" href="<?php echo base_url('encarte/home/consultar'); ?>"><img id="logo" alt="logo" src="img\marca.png" width="131,20" height="40,6" class="d-inline-block align-top"></a>
                </div>
                <div><a class="nav-link" href="<?php echo base_url('encarte/rede/consultar'); ?>"><img id="ic-loja" class="icons" alt="logo" src="img\ic-loja.svg"><?php $this->lang->line("encarte_lojas") ?></a> </div>
                <div><a class="nav-link" href="<?php echo base_url('encarte/loja/consultar'); ?>"><img id="ic-loja" class="icons" alt="logo" src="img\ic-mapa.svg"><?php $this->lang->line("encarte_mapa") ?></a> </div>
                <div><a class="nav-link" href="<?php echo base_url('encarte/categoria/consultar'); ?>"><img id="ic-localizacao" class="icons" alt="logo" src="img\ic-encarte.svg"><?php $this->lang->line("encarte_encartes") ?></a>    </div>    
            </div>
        </div>
        <div class="col-md-5 col-xs-12">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Encontre sua oferta" aria-label="Encontre sua oferta" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <ul class="">
                <li><a href="<?php echo base_url('encarte/rede/consultar'); ?>"><img id="ic-loja" class="icons" alt="logo" src="img\ic-loja.svg"><?php echo $this->lang->line("encarte_lojas") ?></a></li>
                <li><a href="<?php echo base_url('encarte/loja/consultar'); ?>"><img id="ic-loja" class="icons" alt="logo" src="img\ic-mapa.svg"><?php echo $this->lang->line("encarte_mapa") ?></a> </li>
                <li><a href="<?php echo base_url('encarte/categoria/consultar'); ?>"><img id="ic-localizacao" class="icons" alt="logo" src="img\ic-encarte.svg"><?php echo $this->lang->line("encarte_encartes") ?></a>    </li>    
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">Categorias</div>
    </div>
</div>
</div>
</header>


<!--
<nav class="navbar navbar-default navbar-fixed-top" id="menu-principal">
    <div class="container" style="width: 100%;"> 
        <div class="row" style="padding-bottom: 10px;">
            <div class="col-md-3">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed btn-menu" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url('encarte/home/consultar'); ?>"><img id="logo" alt="logo" src="img\marca.png" width="131,20" height="40,6" class="d-inline-block align-top"></a>
                    <ul class="nav navbar-nav navbar-right nav-mobile-upper">
                        <a href="<?php echo base_url('encarte/rede/consultar'); ?>"><img id="ic-loja" alt="logo" src="img\ic-loja.svg"><?php echo $this->lang->line("encarte_lojas") ?></a> 
                        <a href="<?php echo base_url('encarte/loja/consultar'); ?>"><img id="ic-loja" alt="logo" src="img\ic-mapa.svg"><?php echo $this->lang->line("encarte_mapa") ?></a> 
                        <a href="<?php echo base_url('encarte/categoria/consultar'); ?>"><img id="ic-localizacao" alt="logo" src="img\ic-encarte.svg"><?php echo $this->lang->line("encarte_encartes") ?></a> 
                        <li>        
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-5">
                <form class="navbar-form borda">
                    <div class="form-group nav-pesquisa">
                        <input id="ipt-pesquisar" type="text" class="form-control" placeholder="<?php echo $this->lang->line("encarte_encontre_sua_oferta") ?>">
                        <div class="input-group-append">
                            <button id="btn-pesquisar" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <ul class="nav navbar-nav navbar-right nav-mobile-bottom">
                    <a href="<?php echo base_url('encarte/rede/consultar'); ?>"><img id="ic-loja" alt="logo" src="img\ic-loja.svg"><?php echo $this->lang->line("encarte_lojas") ?></a> 
                    <a href="<?php echo base_url('encarte/loja/consultar'); ?>"><img id="ic-loja" alt="logo" src="img\ic-mapa.svg"><?php echo $this->lang->line("encarte_mapa") ?></a> 
                    <a href="<?php echo base_url('encarte/categoria/consultar'); ?>"><img id="ic-localizacao" alt="logo" src="img\ic-encarte.svg"><?php echo $this->lang->line("encarte_encartes") ?></a> 
                </ul>
            </div>
        </div>
<?php $categorias = Modules::run('encarte/Categoria/todos'); ?>
        <div class="row" style="background: #0074cd;">
            <div id="navbar" class="navbar-collapse collapse col-md-4 col-sm-12">
                <ul class="nav navbar-nav navbar-left nav-mobile">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-menu-hamburger"></span><?php echo $this->lang->line("encarte_todas_as_categorias") ?><span class="glyphicon glyphicon-menu-down"></span></a>
                        <ul class="dropdown-menu categoria-menu">
<?php foreach ($categorias as $cs) { ?>
                                                                                                            <li id="<?php echo $cs->cod_categoria ?>"><a><img alt="<?php echo strtolower($cs->nome_imagem); ?>" src="img\ic-<?php echo strtolower($cs->nome_imagem); ?>.svg"><?php echo $this->lang->line("encarte_" . strtolower($cs->nome_imagem)); ?></a></li>
<?php } ?>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav nav-web categoria-menu">
<?php foreach ($categorias as $cs) { ?>
                                                                                                <li id="<?php echo $cs->cod_categoria ?>"><a><img alt="<?php echo strtolower($cs->nome_imagem); ?>" src="img\ic-<?php echo strtolower($cs->nome_imagem); ?>.svg"><?php echo $this->lang->line("encarte_" . strtolower($cs->nome_imagem)); ?></a></li>
<?php } ?>
                </ul>

            </div>/.nav-collapse 
            <div class="col-md-8 col-sm-12">
                <ul class="nav navbar-nav nav-tags">
                    <li><a href="#">#bota-fora</a></li>
                    <li><a href="#">#eletrônicos</a></li>
                    <li><a href="#">#moda</a></li>
                    <li><a href="#">#beleza</a></li>
                    <li><a href="#">#decorar e construir</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>-->
