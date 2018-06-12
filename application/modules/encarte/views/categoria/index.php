<div class="jumbotron filtro">
    <div class="container">
        <div class="row encartes">
            <div class="col-md-3">
                <label for="categoria"><?php echo $this->lang->line("encarte_categoria") ?></label>
                <select required class="form-control categoria" name="categoria" id="categoria" placeholder="todas">
                    <option value=""><?php echo $this->lang->line("encarte_todas") ?></option>
                    <?php foreach ($categorias as $categoria) { ?> 
                        <option value="<?php echo $categoria->cod_categoria ?>" <?php echo (!is_null($categoria_filtrada) && $categoria->cod_categoria == $categoria_filtrada) ? 'selected' : ''; ?>><?php echo $this->lang->line("encarte_" . strtolower($categoria->nome_imagem)); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="rede"><?php echo $this->lang->line("encarte_rede") ?></label>
                <select required class="form-control rede" name="rede" id="rede" placeholder="rede">
                    <option value=""><?php echo $this->lang->line("encarte_todas") ?></option>
                    <?php foreach ($redesFiltro as $redeFiltro) { ?> 
                        <option value="<?php echo $redeFiltro->cod_rede ?>" ><?php echo $redeFiltro->rede ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="localizacao"><?php echo $this->lang->line("encarte_localizacao") ?></label>
                <input type="text" class="form-control localizacao" name="localizacao" id="localizacao" value="<?= is_null($estado) ? "" : $estado; ?>" placeholder="<?php echo $this->lang->line("encarte_digite_a_localizacao") ?>">
            </div>
            <div class="col-md-3">
                <label for="distancia"><?php echo $this->lang->line("encarte_distancia") ?></label><br>
                <input id="distancia" class="distancia" type="text" data-slider-ticks="[1, 10, 20, 30, 40]" data-slider-ticks-snap-bounds="30" data-slider-ticks-labels='["$1km", "$10km", "$20km", "$30km", "40km"]'/>
            </div>
        </div>
    </div>
</div>


<div class="jumbotron">
    <div class="container ">
        <div class="row">
            <div id="encartes">
                <?php foreach ($encartes as $encarte) { ?>
                    <div class="col-md-4 encarte-<?= $encarte->cod_categoria ?> encarte-todas distancia-<?php echo str_replace(',', '', $encarte->distancia) ?>">

                        <div class="hovered ">
                            <div class="encarte-img" style="background-image: url('<?php echo base_url("uploads/encarte/imagem_destacada/" . $encarte->imagem_destacada) ?>')"> 
                            </div>
                            <div class="encarte-background-cinza">
                                <h6 class="encarte-titulo-amarelo"><?php echo $encarte->loja ?></h6>
                                <p class="encarte-texto">Vence em: <strong><?php echo $encarte->vencimento ?></strong></p>
                                <p class="encarte-texto texto-distancia" style="display: inline-block;"><img src="img/ic-gps.png" style="float:left"><?php echo str_replace(',', '', $encarte->distancia) ?></p>
                                <p class="encarte-texto" style="display: inline-block; padding-left:0">km</p>
                                <div class="fb-share-button" data-href="http://www.icatubrasil.com.br/dev/app/encarte/home/consultar" data-layout="button" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.icatubrasil.com.br%2Fdev%2Fapp%2Fencarte%2Fhome%2Fconsultar&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartilhar</a></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div> 
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <h1 class="titulo-section"><?php echo $this->lang->line("encarte_ofertas_ativas_regiao") ?></h1>
        </div>
    </div>
    <div class="row lista">
        <div class="col-md-12 col-xs-12">
            <div class="list-group">
                <?php foreach ($redes as $rede) { ?>
                    <a href="#" class="list-group-item list-group-item-action"><?php echo $rede->rede ?></a>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

