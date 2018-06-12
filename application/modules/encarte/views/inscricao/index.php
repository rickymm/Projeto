<div class="container" style="padding-top: 3%;">
    <div class="row" style="background-image:url(img/bg-quem-somos.png)">
        <div class="col-md-6">
            <h1 class="titulo-azul"><span><?php echo $this->lang->line("encarte_ofertas_por_email") ?></span></h1>
            <p id="paragrafo">
                É simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor.
            </p>
        </div>
        <div class="col-md-6 imagem">
            <img src="img/inscricao.png" style="width:121%; margin-top:-90px; ">   
        </div>
    </div>
</div>

<form id="inscricao-form" action="<?php echo base_url("encarte/inscricao/salvar") ?>" method="POST" enctype="multipart/form-data">
    <div class="container">
        <div class="row check-categorias">
            <div class="col-md-12 cabecalho-categoria">
                <div class="col-md-6">
                    <h2 class="titulo-section"><?php echo $this->lang->line("encarte_escolha_suas_categorias") ?></h2>
                    <div class="row categoria">
                        <div class="col-md-6">
                            <?php $cont = 0; ?>
                            <?php foreach ($categorias as $cs) { ?>
                                <label class="check">
                                    <input type="checkbox" value="<?php echo $cs->cod_categoria ?>" name="categoria[]" > <span class="label-text"><?php echo $this->lang->line("encarte_" . strtolower($cs->nome_imagem)); ?></span>
                                </label>    
                                <?php
                                if ($cont >= (count($categorias) / 2) - 1) {
                                    echo '</div> <div class="col-md-6">';
                                    $cont = 0;
                                }
                                $cont++;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 cabecalho-email">
                <div class="col-md-6 categoria" id="form-email">
                    <label for="email"><?php echo $this->lang->line("encarte_email") ?></label>
                    <input type="email" class="form-control email" name="email" id="email" required >
                </div>
                <div class="col-md-6 categoria" id="form-cidade">
                    <label for="cidade"><?php echo $this->lang->line("encarte_cidade") ?></label>
                    <input type="text" class="form-control cidade" name="cidade" placeholder="<?php echo $this->lang->line("encarte_digite_cidade") ?>" id="cidade" required>
                </div>
            </div>
        </div>
        <div class="form-check">
            <small><?php echo $this->lang->line("encarte_politica_privacidade") ?></small>
        </div>
        <button type="submit" class="btn btn-primary enviar"><?php echo $this->lang->line("encarte_cadastrar") ?></button>
    </div>
</form>