<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Version: 5.0.6.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="pt-br" >
	<?php $this->load->view('themes/igimo/head'); ?>
    <!-- end::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
		<?php $this->load->view('themes/igimo/header')?>		
		<!-- begin::Body -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
				<?php $this->load->view('themes/igimo/left_aside');?>
				<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<?php $this->load->view('themes/igimo/subheader');?>
					<div class="m-content">
					<?php $this->load->view($view);?>
					</div>
				</div>
			</div>
			<!-- end:: Body -->
			<?php $this->load->view('themes/igimo/footer'); ?>
		</div>
		<!-- end:: Page -->
		<?php $this->load->view('themes/igimo/quick_sidebar');?>	    
	    <!-- begin::Scroll Top -->
		<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500" data-scroll-speed="300">
			<i class="la la-arrow-up"></i>
		</div>
		<!-- end::Scroll Top -->
    	<?php 
			$this->load->view('themes/igimo/scripts');
			
			if(isset($js)){
				$this->load->view($js);
			}
		?> 
        
	</body>
	<!-- end::Body -->
</html>
