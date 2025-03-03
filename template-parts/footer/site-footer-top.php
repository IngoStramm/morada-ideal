<div class="footer-top">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php
                $footer_logo = mi_get_option('mi_footer_logo', false, 'mi_site_info_options');
                if ($footer_logo) { ?>
                    <a class="navbar-brand d-block" href="<?php echo get_home_url(); ?>">
                        <img class="site-logo img-fluid" src="<?php echo $footer_logo; ?>">
                    </a>
                <?php } ?>
            </div>

            <div class="col-md-6">
                <?php get_template_part('template-parts/footer/site-footer', 'social-media'); ?>
            </div>
        </div>
    </div>
</div>