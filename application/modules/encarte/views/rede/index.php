<div class="container">
    <div class="row">
        <div class="col-md-9 col-xs-12">
            <h1 class="titulo-azul"><span><?php echo $this->lang->line("encarte_redes_parceiras") ?></span></h1>
        </div>
        <div class="col-md-3 col-xs-12">
            <input type="text" class="form-control rede" name="rede" id="rede" value="" placeholder="<?php echo $this->lang->line("encarte_buscar_rede") ?>">
        </div>
    </div>
    <div class="row lista">
        <div class="col-md-12 col-xs-12">
            <div class="list-group">
                <?php foreach ($redesFiltro as $rede) { ?>
                    <div class="col-md-4 col-xs-12">
                        <a href="<?php echo base_url('encarte/rede/consultarrede/') . $rede->cod_rede; ?>" class="list-group-item list-group-item-action"> <?php echo $rede->nome_fantasia ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>