<!-- COMPONENT START -->
<div class="form-row">
    <div class="m-wizard__head m-portlet__padding-x">
        <!--begin: Form Wizard Progress -->         
        <div class="m-wizard__progress">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div>
        </div>
        <!--end: Form Wizard Progress -->  
        <!--begin: Form Wizard Nav -->
        <div class="m-wizard__nav">
            <div class="m-wizard__steps">
                <div class="m-wizard__step m-wizard__step--done" m-wizard-target="m_wizard_form_step_1">
                    <a href="#" class="m-wizard__step-number">
                        <span><i class="fa  flaticon-placeholder"></i></span> 
                    </a>
                    <div class="m-wizard__step-info">
                        <div class="m-wizard__step-title">
                            1. Client Information
                        </div>
                        <div class="m-wizard__step-desc">                            
                            Lorem ipsum doler amet elit<br> 
                            sed eiusmod tempors                                                                                                
                        </div>
                    </div>
                </div>
                <div class="m-wizard__step m-wizard__step--done" m-wizard-target="m_wizard_form_step_2">
                    <a href="#" class="m-wizard__step-number">
                        <span><i class="fa  flaticon-layers"></i></span> 
                    </a>
                    <div class="m-wizard__step-info">
                        <div class="m-wizard__step-title">
                            2. Account Setup
                        </div>
                        <div class="m-wizard__step-desc">
                            Lorem ipsum doler amet elit<br> 
                            sed eiusmod tempors                                                    
                        </div>
                    </div>
                </div>
                <div class="m-wizard__step m-wizard__step--current" m-wizard-target="m_wizard_form_step_3">
                    <a href="#" class="m-wizard__step-number">
                        <span><i class="fa  flaticon-layers"></i></span> 
                    </a>
                    <div class="m-wizard__step-info">
                        <div class="m-wizard__step-title">
                            3. Confirmation
                        </div>
                        <div class="m-wizard__step-desc">
                            Lorem ipsum doler amet elit<br> 
                            sed eiusmod tempors                                                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end: Form Wizard Nav -->
    </div>
    <div class="form-group col-md-12 col-xs-12 efeito">
        <h5>Nome da campanha</h5>
        <input type="text" name="nome_campanha" class="form-control nome_campanha">
    </div>
    <div class="form-group col-md-12 col-xs-12 efeito">
        <h5>Redes</h5>
        <div class="row">
            <div class="col-md-6" style="padding: 24px">
                <img style="margin-right:10px; float:left" height="100" width="100" src="<?php echo base_url(); ?>img/ic-publicacao-destaque.svg">
                <h6>Publicação destaque</h6>
                <p>Anúncios na página inicial do site dentro do espaço "destaques".</p>
                <div class="form-check" style="padding-left: 132px">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Selecionar</label>
                </div>
            </div>
            <div class="col-md-6" style="padding: 24px">
                <img style="margin-right:10px; float:left" height="100" width="100" src="<?php echo base_url(); ?>img/ic-hastags.svg">
                <h6>Hastags</h6>
                <p>Anúncios no submenu do site.</p>
                <div class="form-check" style="padding-left: 132px">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Selecionar</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-md-12 col-xs-12 efeito">
        <h5>Locais</h5>
        <div class="demo-section k-content">
            <br>
            <input id="filterText" type="text" class="form-control" placeholder="Pesquisar" />
            <br>
            <div class="selectAll">
                <input type="checkbox" id="chbAll" class="k-checkbox" onchange="chbAllOnChange()" />
                <label class="k-checkbox-label" for="chbAll">Selecionar Tudo</label>
            </div>
            <div id="treeview"></div>
        </div>
    </div>

    <div class="form-group col-md-12 col-xs-12 efeito">
        <h5>Duração</h5>
        <div class="row">
            <div class="form-group col-md-6 col-xs-12">
                <label>Data início</label>
                <input type="text" name="data_ini" class="form-control calendario data_ini">
            </div>
            <div class="form-group col-md-6 col-xs-12">
                <label>Data fim</label>
                <input  type="text" name="data_fim" class="form-control calendario data_fim">
            </div>
        </div>
    </div>

    <div class="form-group col-md-3 col-xs-12">
        <button style="float:left; margin-top:29px;" class="btn btn-primary">Salvar e continuar</button>
    </div>

</div>

