<!DOCTYPE html>
<html lang="pt-br" >
    <?php $this->load->view('themes/encarte/head'); ?>
    <!-- end::Body -->
    <body style="background-image: url(<?php echo base_url('themes/cliente/assets') ?>/app/media/img/bg/bg-5.jpg)"  class="m-page--fluid m-page--loading-enabled m-page--loading m-header--fixed m-header--fixed-mobile m-footer--push m-aside--offcanvas-default"  >
        <!-- begin::Page loader -->
        <div class="m-page-loader m-page-loader--base">
            <div class="m-blockui">
                <span>
                    Carregando...
                </span>
                <span>
                    <div class="m-loader m-loader--brand"></div>
                </span>
            </div>
        </div>
        <!-- end::Page Loader -->        
        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <?php $this->load->view('themes/encarte/header'); ?>	
            <!-- begin::Body -->
            <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
                <div class="m-grid__item m-grid__item--fluid m-wrapper">
                    <?php $this->load->view('themes/encarte/subheader'); ?>	
                    <div class="m-content">
                        <!--Begin::Section-->
                        <div class="row">
                            <div class="col-xl-12">
                                <!--begin:: Cadastro de encarte-->
                                <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded">
                                    <div class="m-portlet__body">
                                        <?php
                                        $this->load->view($view);
                                        ?>	
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end::Body -->
            <?php $this->load->view('themes/encarte/footer'); ?>
        </div>
        <!-- end:: Page -->
        <!-- begin::Scroll Top -->
        <div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
            <i class="la la-arrow-up"></i>
        </div>
        <!-- end::Scroll Top -->			
        <?php
        $this->load->view('themes/encarte/scripts');

        if (isset($js)) {
            $this->load->view($js);
        }
        ?>
    </body>
    <!-- end::Body -->
</html>
