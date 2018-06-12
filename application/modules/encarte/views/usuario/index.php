<div>
    <button style="margin-bottom: 1%;" href="" class="btn btn-primary" onclick="novoUsuario()">Novo usuário</button>
</div>
<div id="datatable-buttons_wrapper_sintetico" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
    <table id="tb_usuarios" class="table table-striped table-bordered dataTable no-footer dtr-inline tb_usuarios" role="grid" aria-describedby="datatable-buttons_info" width="100%">
        <thead>
            <tr role="row">
                <th class="sorting">ID</th>
                <th class="sorting">Nome</th>
                <th class="sorting">Email</th>
                <th class="sorting">Situação</th>
                <th class="sorting">Perfil</th>
                <th class="sorting">Ação</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>


<div id="modal_adicionar" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">EDITAR USUÁRIO</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo base_url('encarte/usuario/salvar'); ?>" enctype="multipart/form-data">
                    <input type="text" name="cod_usuario" class="form-control cod_usuario" hidden>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-xs-12">
                            <label>Nome</label>                     
                            <input type="text" name="vch_nome" class="form-control vch_nome" required>
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            <label>E-mail</label>
                            <input type="text" name="email" class="form-control email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-xs-12">
                            <fieldset class="form-group">
                                <legend>Ativo?</legend>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="cod_situacao" id="ativo" value="1">
                                        Ativo
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="cod_situacao" id="inativo" value="0">
                                        Inativo
                                    </label>
                                </div>
                            </fieldset>
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            <fieldset class="form-group">
                                <legend>Administrador?</legend>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="cod_funcao" id="administrador" value="0">
                                        Sim
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="cod_funcao" id="colaborador" value="1">
                                        Não
                                    </label>
                                </div>
                            </fieldset>
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


<div id="modal_novo" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">NOVO USUÁRIO</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo base_url('encarte/usuario/salvar'); ?>" enctype="multipart/form-data">
                    <input type="text" name="cod_rede" class="form-control cod_rede" value="<?php echo $this->session->usuario->cod_rede ?>" hidden>
                    <div class="form-row">
                        <div class="form-group col-md-4 col-xs-12">
                            <label>Nome</label>                     
                            <input type="text" name="vch_nome" class="form-control vch_nome" required>
                        </div>
                        <div class="form-group col-md-4 col-xs-12">
                            <label>E-mail</label>
                            <input type="text" name="email" class="form-control email" required>
                        </div>
                        <div class="form-group col-md-4 col-xs-12">
                            <label>Senha</label>
                            <input type="password" name="senha" class="form-control senha" minlength="6" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-xs-12">
                            <fieldset class="form-group">
                                <legend>Ativo?</legend>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="cod_situacao" id="ativo" value="1" required>
                                        Ativo
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="cod_situacao" id="inativo" value="0" required>
                                        Inativo
                                    </label>
                                </div>
                            </fieldset>
                        </div>
                        <div class="form-group col-md-6 col-xs-12">
                            <fieldset class="form-group">
                                <legend>Administrador?</legend>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="cod_funcao" id="administrador" value="0" required>
                                        Sim
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="cod_funcao" id="colaborador" value="1" required>
                                        Não
                                    </label>
                                </div>
                            </fieldset>
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