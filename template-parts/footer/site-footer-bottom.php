<div class="footer-bottom container">
    <div class="row">
        <div class="col-md-6 mb-2 mb-md-0">©<?php echo date('Y'); ?> <?php _e('Todos os direitos reservados.', 'mi'); ?></div>
        <div class="col-md-6 d-flex justify-content-center justify-content-md-end align-items-center">
            <?php
            $page_service_terms_id = mi_get_option('mi_service_terms');
            $page_for_privacy_policy_id = get_option('wp_page_for_privacy_policy');
            $page_cookies_policy_id = mi_get_option('mi_cookies_policy');
            ?>
            <?php if ($page_service_terms_id || $page_for_privacy_policy_id || $page_cookies_policy_id) { ?>
                <ul class="privacy-pages">
                    <?php if ($page_service_terms_id) { ?>
                        <li>
                            <a href="<?php echo get_page_link($page_service_terms_id); ?>"><?php echo get_the_title($page_service_terms_id) ?></a>
                        </li>
                    <?php } ?>

                    <?php if ($page_for_privacy_policy_id) { ?>
                        <li>
                            <a href="<?php echo get_privacy_policy_url(); ?>"><?php echo get_the_title($page_for_privacy_policy_id) ?></a>
                        </li>
                    <?php } ?>

                    <?php if ($page_cookies_policy_id) { ?>
                        <li>
                            <a href="<?php echo get_page_link($page_cookies_policy_id); ?>"><?php echo get_the_title($page_cookies_policy_id) ?></a>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </div>
</div>