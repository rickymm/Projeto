	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
			<?php echo APP_NAME; ?> <?php echo isset($titulo) ? '| ' . $titulo : ''; ?>
		</title>
		<meta name="description" content="Latest updates and statistic charts">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
          WebFont.load({
            google: {"families":["Cairo:200,300,400,600,700,900","Roboto:300,400,500,600,700","Asap+Condensed:500"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--end::Web font -->
        <!--begin::Base Styles -->  
        <!--begin::Page Vendors -->
		<link href="<?php echo base_url('themes/cliente/assets')?>/vendors/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors -->
		<link href="<?php echo base_url('themes/cliente/assets')?>/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('themes/cliente/assets')?>/demo/demo8/base/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="<?php echo base_url('themes/')?>/favicon.png" />
		<style>
		<?php
			if(isset($css)){
				$this->load->view($css);
			}
		?>
		</style>
	</head>
	<!-- end::Head -->