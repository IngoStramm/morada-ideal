<?php if (has_nav_menu('primary')) : ?>
    <?php
    wp_nav_menu(
        array(
            'theme_location'    => 'primary',
            'walker'            => new Mi_Walker_Nav_Menu(),
            'menu_class'        => 'navbar-nav ms-auto',
            'fallback_cb'       => false,
            'container'         => false
        )
    );
    ?>
<?php endif; ?>