<?php
extract($_POST);

if (!isset($view) && empty($view)) {
    header("location:" . site_url());
}
?>
<!DOCTYPE html>
<html>

    <?php $this->load->view('includes/head'); ?>

    <body>
        <!--            //Header-->
        <?php $this->load->view('includes/header'); ?>
        <!-- page content -->
        <main role="main">
            <!-- Mensagens -->
            <?php
            if (isset($this->session->mensagem) && sizeof($this->session->mensagem) > 0) {
                ?>
                <div class="alert alert-<?php echo $this->session->mensagem['class']; ?>">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> 
                    <?php
                    echo $this->session->mensagem['mensagem'];
                    $this->session->mensagem = array();
                    ?>
                </div>
            <?php } ?>
            <!-- /Mensagens -->
            
            <?php $this->load->view($view); ?>
            
        </main>

        <!-- /.content-wrapper -->
     	<!--            //Footer-->
        <?php $this->load->view('includes/footer'); ?>
        <!--            //Scripts-->
        <?php $this->load->view('includes/scripts'); ?>
        <!-- //Custom Script -->

        <?php
        if (isset($custom)) {
            if (isset($modulo)) {
                $this->load->view(lcfirst($this->uri->segment(1) . "/" . strtolower($this->uri->segment(2)) . "/custom"));
            } else {
                $this->load->view(strtolower($this->uri->segment(1) . "/custom"));
                //$this->load->view($this->uri->segment(1) . "/custom");
            }
        }
        ?>
        <?php
        if (isset($scripts) && $scripts == true) {
            if (isset($campos)) {
                $param = array(
                    'campos' => $campos
                );
                $this->load->view('includes/custom/custom', $param);
            } else {
                $this->load->view('includes/custom/custom');
            }
        }
        ?>
    </body>
</html>