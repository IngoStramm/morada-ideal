<div class="footer-middle container">
    <div class="row gy-4">
        <div class="col-12 col-lg-4 col-md-6">
            <?php
            $company_text = mi_get_option('mi_company_text', false, 'mi_site_info_options');
            if ($company_text) { ?>
                <p class="company-text"><?php echo $company_text; ?></p>
            <?php } ?>
            <?php
            $company_address = mi_get_option('mi_company_address', false, 'mi_site_info_options');
            $company_phone = mi_get_option('mi_company_phone', false, 'mi_site_info_options');
            $company_email = mi_get_option('mi_company_email', false, 'mi_site_info_options');
            if ($company_address || $company_phone || $company_email) { ?>
                <ul class="company-address">

                    <?php if ($company_address) { ?>
                        <li><?php echo mi_get_icon('map-pin'); ?> <span><?php echo $company_address; ?></span></li>
                    <?php } ?>

                    <?php if ($company_phone) { ?>
                        <li><?php echo mi_get_icon('phone'); ?> <span><?php echo $company_phone; ?></span></li>
                    <?php } ?>

                    <?php if ($company_email) { ?>
                        <li><?php echo mi_get_icon('envelope'); ?> <span><?php echo $company_email; ?></span></li>
                    <?php } ?>

                </ul>
            <?php } ?>
        </div>
        <div class="col-12 col-lg-2 col-md-6">
            <h5 class="footer-title"><?php _e('Categorias', 'mi'); ?></h5>
            <?php if (has_nav_menu('footer_cat')) : ?>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location'    => 'footer_cat',
                        'walker'            => new Mi_Walker_Nav_Menu(),
                        'menu_class'        => 'navbar-nav ms-auto footer-menu-cat footer-menu',
                        'fallback_cb'       => false,
                        'container'         => false
                    )
                );
                ?>
            <?php endif; ?>
        </div>
        <div class="col-12 col-lg-2 col-md-6">
            <h5 class="footer-title"><?php _e('Nossa Empresa', 'mi'); ?></h5>
            <?php if (has_nav_menu('footer_company')) : ?>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location'    => 'footer_company',
                        'walker'            => new Mi_Walker_Nav_Menu(),
                        'menu_class'        => 'navbar-nav ms-auto footer-menu-company footer-menu',
                        'fallback_cb'       => false,
                        'container'         => false
                    )
                );
                ?>
            <?php endif; ?>
        </div>
        <div class="col-12 col-lg-4 col-md-6">
            <h5 class="footer-title"><?php _e('Boletim Informativo', 'mi'); ?></h5>
            <p><?php _e('Sua dose semanal/mensal de conhecimento e inspiração', 'mi'); ?></p>
            <?php echo do_shortcode('[newsletter_form]'); ?>
        </div>
    </div>
</div>