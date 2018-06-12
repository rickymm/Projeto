<h3 class="m-subheader__title">
    Importar Lojas <a href="<?php echo base_url('uploads/modelo_importacao_loja.xls') ?>" style="float: right;" class="btn btn-primary">Baixar Modelo</a>
</h3>
<br>
<form method="POST" class="dropzone" action="<?php echo base_url('encarte/upload/importar'); ?>">
    <!-- COMPONENT START -->
    <div class="form-row">
        <div class="form-group col-md-8 col-xs-12">
            <div class="fallback">
                <input name="file" type="file" />
            </div>
        </div>
    </div>
</form>
<br>
<h3 class="m-subheader__title">
    Visualizar Lojas
</h3>
<div>
    <table id="tb_lojas" class="table table-striped table-bordered dataTable no-footer dtr-inline tb_lojas" role="grid" aria-describedby="datatable-buttons_info" width="100%">
        <thead>
            <tr role="row">
                <th class="sorting">ID</th>
                <th class="sorting">Nome</th>
                <th class="sorting">CNPJ</th>
                <th class="sorting">Estado</th>
                <th class="sorting">Cidade</th>
                <th class="sorting">Bairro</th>
                <th class="sorting">Endereço</th>
                <th class="sorting">Telefone</th>
                <th class="sorting">Aniversário</th>
                <th class="sorting">Caixa/Checkout</th>
                <th class="sorting">Situação</th>
                <th class="sorting">Valida Endereço</th>
                <th class="sorting">Valida CNPJ</th>
                <th class="sorting">Ações</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<div id="modal_adicionar" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">EDITAR LOJA</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo base_url('encarte/upload/salvarLoja'); ?>" enctype="multipart/form-data">
                    <input type="text" name="cod_loja" class="form-control cod_loja" hidden>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-xs-12">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control nome" required>
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            <label>Estado</label>
                            <input type="text" name="estado" class="form-control estado" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-xs-12">
                            <label>Cidade</label>
                            <input type="text" name="cidade" class="form-control cidade" required>
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            <label>Bairro</label>
                            <input type="text" name="bairro" class="form-control bairro" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-xs-12">
                            <label>Endereço</label>
                            <input type="text" name="endereco" class="form-control endereco" required>
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            <label>Telefone</label>
                            <input type="text" name="telefone" class="form-control telefone" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4 col-xs-12">
                            <label>Aniversário</label>
                            <input type="text" name="aniversario" class="form-control calendario aniversario" required>
                        </div>
                        <div class="form-group col-md-4 col-xs-12">
                            <label>Caixa/Checkout</label>
                            <input type="text" name="qtd_checkout" class="form-control qtd_checkout" required>
                        </div>
                        <div class="form-group col-md-4 col-xs-12">
                            <label>CNPJ</label>
                            <input type="text" name="cnpj" class="form-control cnpj" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4 col-xs-12">
                            <span class="alerta-endereco" style="color: red;">
                                Cidade, Bairro ou Endereço inválido.
                            </span>
                            <br>
                            <span class="alerta-cnpj" style="color: red;">
                                CNPJ inválido.
                            </span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="m-login__form-action">
                            <button type="submit" id="cadastrar" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                                Salvar
                            </button>
                            <button type="button" id="voltar" class="btn btn-outline-focus  m-btn m-btn--pill m-btn--custom" data-dismiss="modal">
                                Fechar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .modal-backdrop{
        display: none !important;
    }
</style>