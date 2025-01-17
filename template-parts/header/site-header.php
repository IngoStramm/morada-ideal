<?php
$wrapper_classes  = 'site-header sticky-top';
$wrapper_classes .= has_custom_logo() ? ' has-logo' : '';
$wrapper_classes .= (true === get_theme_mod('display_title_and_tagline', true)) ? ' has-title-and-tagline' : '';
$wrapper_classes .= has_nav_menu('primary') ? ' has-menu' : '';
// $account_page_id = mi_get_page_id('account');
// $login_page_id = mi_get_page_id('login');
?>
<header id="site-header" class="<?php echo esc_attr($wrapper_classes); ?>">
    <nav class="navbar navbar-expand-md" id="first-header-navbar">
        <div class="container">

            <?php get_template_part('template-parts/header/site-header', 'branding'); ?>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarMenuPrincipal" aria-controls="navbarMenuPrincipal" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarMenuPrincipal" aria-labelledby="navbarMenuPrincipalLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="navbarMenuPrincipalLabel"><?php get_template_part('template-parts/header/site-header', 'branding'); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <?php get_template_part('template-parts/header/site-header', 'nav'); ?>
                </div>
            </div>

            <?php /* ?>
            <ul class="nav my-2 justify-content-between justify-content-md-center my-md-0 text-small align-items-center gap-1">

                    <li>
                        <a class="nav-link d-block text-center px-2" href="<?php echo wp_logout_url(); ?>">
                            <i class="bi bi-box-arrow-left d-block fs-3"></i>
                        </a>
                    </li>
                </ul>
            <?php */ ?>

        </div>
    </nav>
</header>

<?php
// finalizar topo genérico
// Rodapé genérico
// modelo de página padrão
// modelo de post padrão
// modelo de arquivo padrão
// pesquisa padrão
?>