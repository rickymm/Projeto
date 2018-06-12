<form id="alterar-senha" method="POST" action="<?php echo base_url('encarte/usuario/salvar'); ?>" enctype="multipart/form-data">
    <input type="text" name="cod_usuario" class="form-control cod_usuario" value="<?php echo $this->session->usuario->cod_usuario; ?>" hidden>
    <div class="form-row">
        <div class="col-md-12">
            <h5>
                <?php echo $this->session->usuario->vch_nome; ?>
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6 col-xs-12">
            <label>Nova Senha:</label>
            <input type="password" name="senha" id="senha" class="form-control senha" minlength="6"  maxlength="20" placeholder="Nova senha" required>
        </div>
        <div class="form-group col-md-6 col-xs-12">
            <label>Confirmação de Senha:</label>
            <input type="password" name="confirmacao_senha" id="confirmacao_senha" class="form-control confirmacao_senha"  minlength="6"  maxlength="20" placeholder="Confirme a senha" required>
        </div>
    </div>
    <div class="form-row">
        <div class="m-login__form-action">
            <button type="submit" id="alterar" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                Alterar
            </button>
        </div>
    </div>
</form>
