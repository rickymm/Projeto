<div class="center_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <br />
                        <form id="form" name="form" action="<?php echo base_url('faturamento/relatorio/loadView'); ?>" method="POST" data-parsley-validate>
                            <input type="hidden" id="totalCampos" name="totalCampos"/>
                            <div clas="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>Fonte de Dados</h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#">Settings 1</a>
                                                        </li>
                                                        <li><a href="#">Settings 2</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                </li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">

                                            <div class="col-md-6 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>View</label>
                                                    <select id="desc_view" name="desc_view" required="required" class="form-control desc_view">
                                                        <option value="" selected="true">Escolha uma view</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Configuração dos parâmetros</h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="#">Settings 1</a>
                                                    </li>
                                                    <li><a href="#">Settings 2</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <div class="x_content">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="form-group">
                                                        <label><h4><strong>Campos Disponíveis:</strong></h4></label><br/>
                                                        <!-- Split button -->
                                                        <div id="campos">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label><h4><strong>Campos Utilizados</strong></h4></label><br/>
                                        </div>

                                        <div class="x_content">

                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                <label>Exibição</label>
                                                <select id="exibicao" name="exibicao[]" class="select2_multiple form-control exibicao" multiple="multiple">
                                                </select>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                <label>Agrupamento:</label>
                                                <select id="agrupamento" name="agrupamento[]" class="select2_multiple form-control agrupamento" multiple="multiple">
                                                </select>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                <label>Ordernação:</label>
                                                <select id="ordenacao" name="ordenacao[]" class="select2_multiple form-control ordenacao" multiple="multiple">
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label>Cretérios:</label><br/>
                                        </div>

                                        <div class='where'>
                                            <div class="grupo1">

                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <select id="campoWhere" name="campoWhere1" class="form-control campoWhere">
                                                        <option value="" selected="true">Escolha um campo</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <select id="criterio" name="criterio1" class="form-control criterio">
                                                        <option value="=" selected="true">Igual a</option>
                                                        <option value="<">Menor que</option>
                                                        <option value=">">Maior que</option>
                                                        <option value="!=">Diferente de</option>
                                                        <option value=">=">Maior igual a</option>
                                                        <option value="<=">Menor igual a</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <input id="valorCriterio" name="valorCriterio1" intype="text" placeholder="Insira um valor" class="form-control valorCriterio">
                                                </div>

                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <select id="campoWhereMais" name="campoWhereMais1" class="form-control campoWhereMais">
                                                        <option value="" selected="true"></option>
                                                        <option value="and">E</option>
                                                        <option value="or">OU</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-1 col-sm-12 col-xs-12">

                                                    <input type="button" id="addWhere" name="addWhere" onclick="addDiv();" class="btn btn-primary addWhere" value="+">
                                                </div>

                                                <div class="col-md-1 col-sm-12 col-xs-12">

                                                    <input type="button" id="removeWhere" name="removeWhere" class="btn btn-danger removeWhere" value="-">
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <br/>
                                            <button type="submit" class="btn btn-primary" id="gera" name="gera">Gerar</button>
                                            <!--<input type="submit" class="btn btn-primary" id="gera" name="gera" value="Gerar">-->
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
                <!-- Final do Painel -->

            </div>
        </div>
    </div>
</div>
