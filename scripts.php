<?php

add_action('wp_enqueue_scripts', 'mi_frontend_scripts');

function mi_frontend_scripts()
{

    $min = (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', '10.0.0.3'))) ? '' : '.min';
    $version = mi_version();
    $imoveis = mi_get_imoveis();

    if (empty($min)) :
        wp_enqueue_script('morada-ideal-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true);
    endif;

    wp_register_script('imask-script', MI_URL . '/assets/js/imask.min.js', array('jquery'), $version, array('strategy' => 'defer', 'in_footer' => true));

    wp_register_script('bootstrap-script', MI_URL . '/assets/js/bootstrap.bundle.min.js', array('jquery'), $version, true);

    wp_register_script('list-js', MI_URL . '/assets/js/list' . $min . '.js', array('jquery'), $version, array('strategy' => 'defer', 'in_footer' => true));

    wp_register_script('slick-script', MI_URL . '/assets/js/slick/slick.min.js', array('jquery'), $version, true);

    wp_register_script('morada-ideal-script', MI_URL . '/assets/js/morada-ideal' . $min . '.js', array('jquery', 'bootstrap-script', 'imask-script', 'list-js', 'slick-script'), $version, true);

    wp_enqueue_script('morada-ideal-script');

    wp_localize_script('morada-ideal-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'plugin_url' => MI_URL,
        'imoveis' => $imoveis,
        'lat' => isset($_GET['lat']) ? $_GET['lat'] : null,
        'lng' => isset($_GET['lng']) ? $_GET['lng'] : null,
    ));

    $gmaps_key = mi_get_option('gmaps_key');

    if ($gmaps_key) {
        wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=' . $gmaps_key . '&libraries=places&callback=initGoogleApi&', array(), null,  array(
            'in_footer' => true,
            'strategy' => 'defer'
        ));
    }

    wp_enqueue_style('bootstrap-style', MI_URL . '/assets/css/bootstrap.min.css', array(), $version, 'all');
    wp_enqueue_style('bootstrap-icon-style', MI_URL . '/assets/fonts/bootstrap-icons/bootstrap-icons.min.css', array(), $version, 'all');
    wp_enqueue_style('slick-style', MI_URL . '/assets/js/slick/slick.css', array(), $version, 'all');
    wp_enqueue_style('slick-theme-style', MI_URL . '/assets/js/slick/slick-theme.css', array(), $version, 'all');

    // wp_enqueue_style('googleapis', 'https://fonts.googleapis.com', array(), null, 'all');
    // wp_enqueue_style('gstatic', 'https://fonts.gstatic.com', array(), null, 'all');
    // wp_enqueue_style('inter-font', 'https://fonts.googleapis.com/css2?family=Assistant:wght@200..800&display=swap', array(), null, 'all');
    // wp_enqueue_style('adventpro-font', 'https://fonts.googleapis.com/css2?family=Advent+Pro:ital,wght@0,100..900;1,100..900&display=swap', array(), null, 'all');

    wp_enqueue_style('morada-ideal-style', MI_URL . '/assets/css/morada-ideal.css', array('bootstrap-style'), $version, 'all');
}

add_action('admin_enqueue_scripts', 'mi_admin_scripts');

function mi_admin_scripts()
{
    if (!is_user_logged_in())
        return;

    $version = mi_version();

    $min = (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', '10.0.0.3'))) ? '' : '.min';

    wp_register_script('imask-script', MI_URL . '/assets/js/imask.min.js', array('jquery'), $version, array('strategy' => 'defer', 'in_footer' => true));

    wp_register_script('morada-ideal-admin-script', MI_URL . '/assets/js/morada-ideal-admin' . $min . '.js', array('jquery', 'imask-script'), $version, array('strategy' => 'defer', 'in_footer' => true));

    wp_enqueue_script('morada-ideal-admin-script');

    wp_localize_script('morada-ideal-admin-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
