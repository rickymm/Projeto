<div class="jumbotron filtro">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <label for="rede"><?php echo $this->lang->line("encarte_rede") ?></label>
                <select required class="form-control rede" name="rede" id="rede">
                    <option value=""><?php echo $this->lang->line("encarte_todas") ?></option>
                    <?php foreach ($redesFiltro as $redeFiltro) { ?> 
                        <option value="<?php echo $redeFiltro->cod_rede ?>" ><?php echo $redeFiltro->nome_fantasia ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="container mapa-container" style="height: 600px; width: 100%; margin: auto 0 !important; padding:0 !important">
    <div id="mapa" ></div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <h1 class="titulo-section">ofertas ativas na sua região</h1>
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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfKvfWCdje_CFDHVNnCKTQyjHLi5TRZ2w&libraries=places&callback=initMap"
async defer></script>