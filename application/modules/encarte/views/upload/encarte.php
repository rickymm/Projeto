<form method="POST" action="<?php echo base_url('encarte/upload/enviarEncarte'); ?>" enctype="multipart/form-data">
    <!-- COMPONENT START -->
    <div class="form-row">
        <div class="form-group col-md-6 col-xs-12">
            <label>PDF<span class="obrigatorio">*</span></label>
            <div class="input-group input-file" name="arquivo">
                <input type="text" class="form-control" placeholder='Selecione um PDF...' required/>			
                <span class="input-group-btn">
                    <button class="btn btn-default btn-choose" type="button">Selecionar</button>
                </span>
            </div>
        </div>
        <div class="form-group col-md-3 col-xs-12">
            <label>Início da veiculação<span class="obrigatorio">*</span></label>
            <input type="text" name="data_inicio" class="form-control calendario" required>
        </div>
        <div class="form-group col-md-3 col-xs-12">
            <label>Fim da veiculação<span class="obrigatorio">*</span></label>
            <input type="text" name="data_vencimento" class="form-control calendario" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6 col-xs-12">
            <label>Categoria<span class="obrigatorio">*</span></label>
            <select name="categoria[]" class="form-control categoria" multiple required>
                <option value="">-- Categorias --</option>
                <?php
                foreach ($categorias as $categoria) {
                    echo '<option value="' . $categoria->cod_categoria . '">' . $categoria->nome . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-6 col-xs-12">
            <label>Tags:</label>
            <select name="tags[]" class="form-control tags" id="tags" multiple>
                <option value="">-- Escolha uma (ou mais) opção ou digite uma nova --</option>
                <?php
                    foreach ($tags as $tag) {
                        echo '<option value="' . $tag->tag . '">' . $tag->tag . '</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Observações:</label>
            <textarea name="observacao" class="form-control" placeholder='Observações...'></textarea>
        </div>
    </div>
    <?php if (!is_null($lojas)) { ?>
    <div class="form-row">
        <div class="form-group col-md-12">
            <div class="demo-section k-content">
                <br>
                <input id="filterText" type="text" class="form-control" placeholder="Pesquisar" />
                <br>
                <div class="selectAll">
                    <input type="checkbox" id="chbAll" class="k-checkbox" onchange="chbAllOnChange()" />
                    <label class="k-checkbox-label" for="chbAll">Selecionar Tudo</label>
                </div>
                <div id="treeview"></div>
                <input type="text" class="lojas" id="lojas" name="lojas" hidden>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="form-row">
        <div class="m-login__form-action">
            <button type="submit" id="cadastrar" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                Cadastrar
            </button>
            <button type="reset" id="voltar" class="btn btn-outline-focus  m-btn m-btn--pill m-btn--custom">
                Voltar
            </button>
        </div>
    </div>
</form>