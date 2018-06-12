<?php
extract($_POST);
?>
<!DOCTYPE html>
<html>

    <?php $this->load->view('includes/head'); ?>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">

                <!--            //Cabeçalho-->
                <?php $this->load->view('includes/header'); ?>
                <!--            //Top Naviation-->
                <?php $this->load->view('includes/aside'); ?>

                <!--            //Main Content-->
                <?php //$this->load->view($view); ?>
                <!-- /.content-wrapper -->
                <!--            //Footer-->
                <?php $this->load->view('includes/footer'); ?>

            </div>
        </div>
        <!--            //Scripts-->
        <?php $this->load->view('includes/scripts'); ?>
    </body>
</html>