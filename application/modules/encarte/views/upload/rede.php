<?php if (isset($this->session->usuario) && $this->session->usuario->cod_situacao == '2') { ?>
    <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
        <div class="m-alert__icon">
            <i class="flaticon-exclamation-1"></i>
            <span></span>
        </div>
        <div class="m-alert__text">
            <strong>Aviso!</strong> Para cadastrar Loja ou Encarte, é necessário primeiro cadastrar uma rede.
        </div>	
        <div class="m-alert__close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            </button>	
        </div>			  	
    </div>    
<?php } ?>

<form method="POST" action="<?php echo base_url('encarte/upload/salvarRede'); ?>" enctype="multipart/form-data">
    <input type="text" name="cod_rede" value="<?php echo isset($this->session->usuario->cod_rede) ? $this->session->usuario->cod_rede : null; ?>" hidden>
    <!-- COMPONENT START -->
    <div class="form-row">
        <div class="form-group col-md-4 col-xs-12">
            <label>Nome fantasia<span class="obrigatorio">*</span></label>
            <input type="text" name="nome_fantasia" class="form-control" placeholder="Nome Fantasia" value="<?php echo isset($rede) ? $rede[0]->nome_fantasia : null; ?>" required>
        </div>
        <div class="form-group col-md-4 col-xs-12">
            <label>Marca<span class="obrigatorio">*</span></label>
            <div class="input-group input-file" name="marca">
                <input type="text" class="form-control" data-toggle="tooltip" data-placement="top" title="Exibida na página da rede" <?php echo isset($rede) ? 'name="marca" value="' . $rede[0]->marca . '"' : 'placeholder="Selecione um arquivo..." required'; ?>/>			
                <span class="input-group-btn">
                    <button class="btn btn-default btn-choose" type="button">Selecionar</button>
                </span>
            </div>
        </div>
        <div class="form-group col-md-4 col-xs-12">
            <label>Ícone<span class="obrigatorio">*</span></label>
            <div class="input-group input-file" name="icone">
                <input type="text" class="form-control" data-toggle="tooltip" data-placement="top" title="Exibido no mapa de lojas" <?php echo isset($rede) ? 'name="icone" value="' . $rede[0]->icone . '"' : 'placeholder="Selecione um arquivo..." required'; ?>/>
                <span class="input-group-btn">
                    <button class="btn btn-default btn-choose" type="button">Selecionar</button>
                </span>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4 col-xs-12">
            <label>Pessoa de contato<span class="obrigatorio">*</span></label>
            <input type="text" name="nome_contato" class="form-control" placeholder="Nome Contato" value="<?php echo isset($rede) ? $rede[0]->nome_contato : null; ?>" required>
        </div>
        <div class="form-group col-md-4 col-xs-12">
            <label class="tel-label">Telefone</label>
            <input type="tel" name="telefone" class="form-control telefone" placeholder="Telefone" value="<?php echo isset($rede) ? $rede[0]->telefone : null; ?>">
        </div>
        <div class="form-group col-md-4 col-xs-12">
            <label>E-mail<span class="obrigatorio">*</span></label>
            <input type="email" name="email" class="form-control" placeholder="E-mail" value="<?php echo isset($rede) ? $rede[0]->email : null; ?>" required>
        </div>
    </div>


    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Apresentação da rede</label>
            <textarea name="apresentacao" class="form-control" placeholder='Apresentação...' data-toggle="tooltip" data-placement="top" title="Texto exibido na página de apresentação da rede"><?php echo isset($rede) ? $rede[0]->apresentacao : null; ?></textarea>
        </div>
    </div>
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

<div id="demo"></div>

    
    
</form>