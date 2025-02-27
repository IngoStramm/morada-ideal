<a class="navbar-brand d-block" href="<?php echo get_home_url() ?>">
    <?php if (has_custom_logo()) : ?>
        <?php
        $custom_logo_id = get_theme_mod('custom_logo');
        $image = wp_get_attachment_image_src($custom_logo_id, 'full');
        echo mi_logo();
        ?>
    <?php endif; ?>
</a>