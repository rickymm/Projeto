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

        <div id="fb-root"></div>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.0&appId=598785497186685&autoLogAppEvents=1';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>


        <!--            //Header-->
<?php   $this->load->view('includes/header'); ?>
        <!-- page content -->
       
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