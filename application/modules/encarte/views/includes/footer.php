<!--footer-->
<footer class="footer1 desktop">
    <div class="container">
        <div class="row"><!-- row -->
            <div class="col-lg-3 col-md-3"><!-- widgets column left -->
                <ul class="list-unstyled clear-margins"><!-- widgets -->
                    <li class="widget-container widget_nav_menu"><!-- widgets list -->
                        <h4 class="titulo-footer">Melhor Promoção</h4>
                        <ul>
                            <li><a  href="<?php echo base_url('encarte/quemsomos/consultar'); ?>"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line("encarte_quem_somos") ?></a></li>
                            <li><a  target=“_blank”  href="http://www.icatubahia.com.br/portais/vagas/home"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line("encarte_trabalhe_conosco") ?></a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- widgets column left end -->
            <div class="col-lg-3 col-md-3"><!-- widgets column left -->
                <ul class="list-unstyled clear-margins"><!-- widgets -->
                    <li class="widget-container widget_nav_menu"><!-- widgets list -->
                        <h1 class="titulo-footer"><?php echo $this->lang->line("encarte_anuncie") ?></h1>
                        <ul>
                            <li><a  href="<?php echo base_url('encarte/comercial/consultar'); ?>"><i class="fa fa-angle-double-right"></i>  <?php echo $this->lang->line("encarte_o_que_fazemos") ?></a></li>
                            <li><a  href="<?php echo base_url('encarte/comercial/consultar'); ?>"><i class="fa fa-angle-double-right"></i>  <?php echo $this->lang->line("encarte_informacoes_comerciais") ?></a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- widgets column left end -->
            <div class="col-lg-3 col-md-3"><!-- widgets column left -->
                <ul class="list-unstyled clear-margins"><!-- widgets -->
                    <li class="widget-container widget_nav_menu"><!-- widgets list -->
                        <h1 class="titulo-footer"><?php echo $this->lang->line("encarte_contatos") ?></h1>
                        <ul>
                            <li><a href="<?php echo base_url('encarte/notificacao/consultar'); ?>"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line("encarte_erro_no_encarte") ?></a></li>
                            <li><a><i class="fa fa-angle-double-right"></i> sac@melhoresofertas.com.br</a></li>
                            <li><a><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line("encarte_numero_telefone") ?></a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- widgets column left end -->
            <div class="col-lg-3 col-md-3 alerta"><!-- widgets column center -->
                <ul class="list-unstyled clear-margins"><!-- widgets -->
                    <li class="widget-container widget_recent_news"><!-- widgets list -->
                        <div class="footerp"> 
                            <img src="img\ic-alerta.png">
                            <a href="<?php echo base_url('encarte/inscricao/consultar'); ?>"><b><?php echo $this->lang->line("encarte_administre_inscricao") ?></b></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a target="_blank" href="http://www.icatubahia.com.br">
                        <b><?php echo $this->lang->line("encarte_desenvolvido_por") ?></b>
                        <img  style="width: 50px !important;" src="uploads\brands\igimo_yellow.png">
                    </a>
                    <a class="link-idioma-footer" onclick="javascript:window.location.href = '<?php echo base_url(); ?>Idioma/trocarIdioma/portuguese-brazilian'"><img  alt="portugues" src="img\portugues.svg"></a> 
                    <a class="link-idioma-footer" onclick="javascript:window.location.href = '<?php echo base_url(); ?>Idioma/trocarIdioma/spanish'"><img  alt="espanhol" src="img\espanhol.svg"></a> 
                    <a class="link-idioma-footer" onclick="javascript:window.location.href = '<?php echo base_url(); ?>Idioma/trocarIdioma/english'"><img alt="ingles" src="img\ingles.svg"></a> 
                </div>
            </div>
        </div>
    </div>
</footer>

<!--footer mobile-->
<footer class="footer1 mobile">
    <div id="accordion" role="tablist" aria-multiselectable="true">
        <div class="card">
            <div class="card-header" role="tab" id="headingOne">
                <h5 class="mb-0">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h4 class="titulo-footer t-mobile">Melhor Promoção</h4>
                    </a>
                </h5>
                <span class="glyphicon glyphicon-chevron-left"></span>
            </div>

            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                <div class="card-block">
                    <ul>
                        <li><a  href="<?php echo base_url('encarte/quemsomos/consultar'); ?>"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line("encarte_quem_somos") ?></a></li>
                        <li><a  target=“_blank”  href="http://www.icatubahia.com.br/portais/vagas/home"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line("encarte_trabalhe_conosco") ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" role="tab" id="headingTwo">
                <h5 class="mb-0">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <h1 class="titulo-footer t-mobile"><?php echo $this->lang->line("encarte_anuncie") ?></h1>
                    </a>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="card-block">
                    <ul>
                        <li><a  href="<?php echo base_url('encarte/comercial/consultar'); ?>"><i class="fa fa-angle-double-right"></i>  <?php echo $this->lang->line("encarte_o_que_fazemos") ?></a></li>
                        <li><a  href="<?php echo base_url('encarte/comercial/consultar'); ?>"><i class="fa fa-angle-double-right"></i>  <?php echo $this->lang->line("encarte_informacoes_comerciais") ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" role="tab" id="headingThree">
                <h5 class="mb-0">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <h1 class="titulo-footer t-mobile"><?php echo $this->lang->line("encarte_contatos") ?></h1>
                    </a>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="card-block">
                    <ul>
                        <li><a href="<?php echo base_url('encarte/notificacao/consultar'); ?>"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line("encarte_erro_no_encarte") ?></a></li>
                        <li><a><i class="fa fa-angle-double-right"></i> sac@melhoresofertas.com.br</a></li>
                        <li><a><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line("encarte_numero_telefone") ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a target="_blank" href="http://www.icatubahia.com.br">
                        <b><?php echo $this->lang->line("encarte_desenvolvido_por") ?></b>
                        <img  style="width: 50px !important;" src="uploads\brands\igimo_yellow.png">
                    </a>
                    <a class="link-idioma-footer" onclick="javascript:window.location.href = '<?php echo base_url(); ?>Idioma/trocarIdioma/portuguese-brazilian'"><img  alt="portugues" src="img\portugues.svg"></a> 
                    <a class="link-idioma-footer" onclick="javascript:window.location.href = '<?php echo base_url(); ?>Idioma/trocarIdioma/spanish'"><img  alt="espanhol" src="img\espanhol.svg"></a> 
                    <a class="link-idioma-footer" onclick="javascript:window.location.href = '<?php echo base_url(); ?>Idioma/trocarIdioma/english'"><img alt="ingles" src="img\ingles.svg"></a> 
                </div>
            </div>
        </div>
    </div>
</footer>