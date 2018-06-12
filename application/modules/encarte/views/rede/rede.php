<div class="jumbotron">
    <div class="container ">
        <div class="row">
            <h1 class="titulo-azul"><span><?php echo $redeAtual[0]->nome_fantasia; ?></span></h1>
            <input type="text" id="cod_rede" value="<?php echo $redeAtual[0]->cod_rede; ?>" hidden>
            <div class="col-md-4 col-xs-12 ajuste">
                <h2 style="text-align:center"><?php echo $this->lang->line("encarte_lojas_e_redes_parceiras") ?></h2>
                <div id="map"></div>
                <div class="container">
                    <div class="row">
                        <?php foreach ($enderecos as $endereco) { ?>
                            <a onclick="initMap(<?php echo $endereco->latitude . ',' . $endereco->longitude . ',' . $endereco->loja ?>)" class="btn btn-loja"> <?php echo $endereco->endereco ?><br>
                                <img src="img/ic-gps.svg"><?php echo $endereco->distancia ?>km
                            </a>
                        <?php } ?>
                    </div> 
                </div>
            </div>
            <div class="col-md-8 col-xs-8 ajuste">
                <div id="encartes">
                    <?php foreach ($encartes as $encarte) { ?>
                        <div class="col-md-6 col-xs-12 ajuste encarte-<?= $encarte->cod_categoria ?> encarte-todas distancia-<?php echo str_replace(',', '', $encarte->distancia) ?>">
                            <div class="hovered "> 
                                <div class="encarte-img" style="background-image: url('<?php echo base_url("uploads/encarte/imagem_destacada/" . $encarte->imagem_destacada) ?>')">  
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="anuncio" >
        </div>
    </div>
</div>
