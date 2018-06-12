<form action="<?php echo base_url('encarte/inscricao/formContato'); ?>" method="POST">
    <div class="jumbotron">
        <div class="container" style="margin-bottom: 2%; padding-top: 5%;">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6 imagem">
                    <img class="img-duvida" src="img/contato.svg">   
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                    <h2 class="titulo-section margem"><?php echo $this->lang->line("encarte_encontrou_erro") ?></h2>

                    <label for="rede"><?php echo $this->lang->line("encarte_rede") ?></label>
                    <select name="rede" class="form-control rede" required>
                        <option value="">-- Rede --</option>
                        <?php
                        foreach ($redes as $rede) {
                            echo '<option value="' . $rede->cod_rede . '">' . $rede->rede . '</option>';
                        }
                        ?>
                    </select>
                    <label for="text"><?php echo $this->lang->line("encarte_localizacao") ?></label>
                    <input type="text" class="form-control localizacao" name="localizacao" id="localizacao" required>

                    <label for="url"><?php echo $this->lang->line("encarte_url_encarte") ?></label>  
                    <input type="text" class="form-control url" name="url" id="url" required>

                    <label for="detalhes"><?php echo $this->lang->line("encarte_detalhes_erro") ?></label>
                    <textarea class="form-control detalhes" name="detalhes" id="detalhes" required></textarea>

                    <label for="email"><?php echo $this->lang->line("encarte_email") ?></label>
                    <input type="email" class="form-control email" name="email" id="email"  data-toggle="tooltip" data-placement="top" title="Deseja receber o retorno do seu contato? Informe seu e-mail.">

                    <button type="submit" class="btn btn-primary enviar"><?php echo $this->lang->line("encarte_enviar") ?></button>
                </div>
            </div>
        </div>
    </div>
</form>