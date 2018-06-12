<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top" id="menu-principal">
    <!-- COLLAPSE-->
    <div class="col-md-1 col-sm-1 col-1">
        <ul> 
            <li class="nav-item dropdown" style="list-style: none;">
                <a class="nav-link" id="dropdown-desktop" style="color:#fff;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-bars"></i></a>
                <div class="dropdown-menu show" aria-labelledby="dropdown-desktop">
                    <?php
                    $categorias = Modules::run('encarte/Categoria/todos');
                    foreach ($categorias as $categoria) {
                        echo '<a class="dropdown-item" href="#">' . $categoria->nome . '</a>';
                    }
                    ?>
                </div>
            </li>
        </ul>
    </div>
    <!-- END -->
    <!-- MARCA -->
    <div class="col-md-2 col-sm-4 col-4">
        <a class="navbar-brand" href="<?php echo base_url('encarte/home/consultar'); ?>"><img id="logo" alt="logo" src="uploads/encarte/img/marca.png" width="131,20" height="40,6" class="d-inline-block align-top"></a>
    </div>
    <!-- END -->

    <!-- BUSCA -->
    <div class="col-md-6 principal-busca-div">
        <form class="navbar-form borda">
            <div class="form-group nav-pesquisa">
                <input id="ipt-pesquisar" type="text" class="form-control" placeholder="<?php echo $this->lang->line("encarte_encontre_sua_oferta") ?>">
                <div class="input-group-append" style="z-index: 999;margin-left: -51px;">
                    <button id="btn-pesquisar" type="submit" class="btn btn-default"><span class="fa fa-search"></span></button>
                </div>
            </div>
        </form>
    </div>
    <!-- END -->

    <!-- ICONES -->
    <div class="col-md-3 col-sm-7 principal-icones-div col-7">
        <ul class="nav navbar-nav principal-icones">
            <li>
                <a href="<?php echo base_url('encarte/rede/consultar'); ?>"><img id="ic-loja" alt="logo" src="uploads/encarte/img/ic-loja.svg" data-placement="bottom" title="<?php echo $this->lang->line("encarte_lojas") ?>" /></a> 
            </li>
            <li>
                <a href="<?php echo base_url('encarte/loja/consultar'); ?>"><img id="ic-mapa" alt="logo" src="uploads/encarte/img/ic-mapa.svg" data-placement="bottom" title="<?php echo $this->lang->line("encarte_mapa") ?>" /></a> 
            </li>
            <li>
                <a href="<?php echo base_url('encarte/categoria/consultar'); ?>"><img id="ic-localizacao" alt="logo" src="uploads/encarte/img/ic-encarte.svg" data-placement="bottom" title="<?php echo $this->lang->line("encarte_encartes") ?>" /></a> 
            </li>
        </ul>
    </div>
</nav>
<!-- END -->

<div class="submenu">
    <div class="col-md-12">
        <ul class="nav navbar nav-tags flex">
            <?php
            $categorias = Modules::run('encarte/Categoria/todos');
            foreach ($categorias as $categoria) {
                $link = base_url("uploads/encarte/icones/ic-" . $categoria->nome_imagem . ".svg");
                echo "<li class='nav-item fill'><a class='nav-link' href='#'><div class='ic-categoria-" . $categoria->nome_imagem . "' ></div><div>" . $categoria->nome . "</div></a></li>";
            }
            ?>
        </ul>
    </div>
</div>

<div class="bottomsub">
    <div style="height: 50px;">
    </div>
</div>


<!-- MOBILE -->
<nav class="navbar navbar-default navbar-fixed-top" id="menu-mobile">
    <!-- COLLAPSE-->
    <div class="col-md-2 col-sm-2 col-2 collapse-mobile">
        <ul> 
            <li class="nav-item dropdown" style="list-style: none;">
                <a class="nav-link" id="dropdown-mobile" style="color:#fff;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><i class="fa fa-bars"></i></a>
                <div class="dropdown-menu show" aria-labelledby="dropdown-mobile">
                    <?php
                    foreach ($categorias as $categoria) {
                        echo '<a class="dropdown-item" href="#">' . $categoria->nome . '</a>';
                    }
                    ?>
                </div>
            </li>
        </ul>
    </div>
    <!-- END -->

    <!-- MARCA -->
    <div class="col-md-5 col-sm-5 col-5 marca-mobile">
        <a class="navbar-brand" href="<?php echo base_url('encarte/home/consultar'); ?>"><img id="logo" alt="logo" src="uploads/encarte/img/marca.png" width="131,20" height="40,6" class="d-inline-block align-top"></a>
    </div>
    <!-- END -->

    <!-- MARCA -->
    <div class="col-md-5 col-sm-5 col-5 icones-mobile-div">
        <ul class="nav navbar-nav icones-mobile">
            <li>
                <a href="<?php echo base_url('encarte/rede/consultar'); ?>"><img id="ic-loja" alt="logo" src="uploads/encarte/img/ic-loja.svg" data-placement="bottom" title="<?php echo $this->lang->line("encarte_lojas") ?>" /></a> 
            </li>
            <li>
                <a href="<?php echo base_url('encarte/loja/consultar'); ?>"><img id="ic-mapa" alt="logo" src="uploads/encarte/img/ic-mapa.svg" data-placement="bottom" title="<?php echo $this->lang->line("encarte_mapa") ?>" /></a> 
            </li>
            <li>
                <a href="<?php echo base_url('encarte/categoria/consultar'); ?>"><img id="ic-localizacao" alt="logo" src="uploads/encarte/img/ic-encarte.svg" data-placement="bottom" title="<?php echo $this->lang->line("encarte_encartes") ?>" /></a> 
            </li>
        </ul>
    </div>
    <!-- END -->
</nav>
<!-- BUSCA -->
<div class="col-md-12 mobile-busca-div">
    <form class="navbar-form borda">
        <div class="form-group nav-pesquisa" style="margin-bottom:0">
            <input id="ipt-pesquisar" type="text" class="form-control" placeholder="<?php echo $this->lang->line("encarte_encontre_sua_oferta") ?>">
            <div class="input-group-append" style="z-index: 999;margin-left: -51px;">
                <button id="btn-pesquisar" type="submit" class="btn btn-default"><span class="fa fa-search"></span></button>
            </div>
        </div>
    </form>
</div>
<!-- END -->