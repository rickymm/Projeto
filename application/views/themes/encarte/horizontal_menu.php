<?php $modulo = strtolower($this->uri->segment(2)); ?>
<!-- begin::Horizontal Menu -->
<div class="m-stack__item m-stack__item--fluid m-header-menu-wrapper">
    <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light " id="m_aside_header_menu_mobile_close_btn">
        <i class="la la-close"></i>
    </button>
    <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light "  >
        <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
            <li class="m-menu__item  <?php echo $modulo == 'upload' ? 'm-menu__item--active  m-menu__item--active-tab' : ''; ?> m-menu__item--submenu m-menu__item--tabs"  data-menu-submenu-toggle="tab" aria-haspopup="true">
                <a  href="index.html" class="m-menu__link m-menu__toggle">
                    <span class="m-menu__link-text">
                        Cadastro
                    </span>
                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                    <ul class="m-menu__subnav">
                        <?php $url = strtolower($this->uri->segment(3)); ?>
                        <li class="m-menu__item <?php echo $url == 'rede' || $url == '' ? 'm-menu__item--active' : ''; ?>"  data-redirect="true" aria-haspopup="true">
                            <a href="<?php echo base_url('encarte/upload/rede') ?>" class="m-menu__link ">
                                <i class="m-menu__link-icon fa fa-sitemap"></i>
                                <span class="m-menu__link-text">
                                    Rede
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item <?php echo $url == 'loja' ? 'm-menu__item--active' : ''; ?>"  data-redirect="true" aria-haspopup="true">
                            <a href="<?php echo base_url('encarte/upload/loja') ?>" class="m-menu__link ">
                                <i class="m-menu__link-icon fa fa-building"></i>
                                <span class="m-menu__link-text">
                                    Loja
                                </span>
                            </a>
                        </li>
                        <li class="m-menu__item <?php echo $url == 'encarte' ? 'm-menu__item--active' : ''; ?>"  data-redirect="true" aria-haspopup="true">
                            <a href="<?php echo base_url('encarte/upload/encarte') ?>" class="m-menu__link ">
                                <i class="m-menu__link-icon fa fa-leanpub"></i>
                                <span class="m-menu__link-text">
                                    Encarte
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> 
            <li class="m-menu__item  <?php echo $modulo == 'relatorios' ? 'm-menu__item--active  m-menu__item--active-tab' : ''; ?> m-menu__item--submenu m-menu__item--tabs"  data-menu-submenu-toggle="tab" aria-haspopup="true">
                <a class="m-menu__link m-menu__toggle">
                    <span class="m-menu__link-text">
                        Relatórios
                    </span>
                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                    <ul class="m-menu__subnav">
                        <?php $url = strtolower($this->uri->segment(3)); ?>
                        <li class="m-menu__item <?php echo $url == 'clique' || $url == '' ? 'm-menu__item--active' : ''; ?>"  data-redirect="true" aria-haspopup="true">
                            <a href="<?php echo base_url('encarte/relatorios/clique') ?>" class="m-menu__link ">
                                <i class="m-menu__link-icon fa fa-hand-pointer-o"></i>
                                <span class="m-menu__link-text">
                                    Cliques
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> 
            <li class="m-menu__item  <?php echo $modulo == 'anuncios' ? 'm-menu__item--active  m-menu__item--active-tab' : ''; ?> m-menu__item--submenu m-menu__item--tabs"  data-menu-submenu-toggle="tab" aria-haspopup="true">
                <a class="m-menu__link m-menu__toggle">
                    <span class="m-menu__link-text">
                        Campanhas
                    </span>
                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                    <ul class="m-menu__subnav">
                        <?php $url = strtolower($this->uri->segment(3)); ?>
                        <li class="m-menu__item <?php echo $url == 'criar' || $url == '' ? 'm-menu__item--active' : ''; ?>"  data-redirect="true" aria-haspopup="true">
                            <a href="<?php echo base_url('encarte/anuncios/criar') ?>" class="m-menu__link ">
                                <i class="m-menu__link-icon fa fa-plus-circle"></i>
                                <span class="m-menu__link-text">
                                    Nova campanha
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> 
            <?php if($modulo == 'usuario'){ ?> 
            <li class="m-menu__item m-menu__item--active  m-menu__item--active-tab m-menu__item--submenu m-menu__item--tabs"  data-menu-submenu-toggle="tab" aria-haspopup="true">
                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                    <ul class="m-menu__subnav">
                        <?php $url = strtolower($this->uri->segment(3)); ?>
                        <li class="m-menu__item m-menu__item--active"  data-redirect="true" aria-haspopup="true">
                        </li>
                    </ul>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>
<!-- end::Horizontal Menu -->