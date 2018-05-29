<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title ">
                <?php echo isset($titulo) ? $titulo : ''; ?>
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <?php
                /* CONSERTAR!! */
                $primeiro = 0;
                if (isset($breadcumb)) {
                    foreach ($breadcumb as $key => $value) {
                        ?>
                        <li class="m-nav__item m-nav__item--home">
                            <a href="#" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                            <?php
                            if ($primeiro <> 0) {
                                echo '<li class="m-nav__separator"> -> </li>';
                            }
                            echo '<li class="m-nav__item">' . $key . '</li>';
                            $primeiro++;
                        }
                    }
                    ?>	
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- END: Subheader -->