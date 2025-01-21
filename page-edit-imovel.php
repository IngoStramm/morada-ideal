<?php

/**
 * Template Name: Página para Criar/Editar Imóveis
 * 
 * The template for Create/Edit Anuncio Post Type User Account Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Morada Ideal
 */

get_header();

do_action('account_announces');

/* Start the Loop */
while (have_posts()) :
    the_post();
    $imovel_id = isset($_REQUEST['imovel_id']) && $_REQUEST['imovel_id'] ? $_REQUEST['imovel_id'] : null;
    $user_permition = mi_check_edit_imovel_user_permition($imovel_id);
    if ($user_permition) {
        get_template_part('template-parts/content/account/content-imovel-form');
    } else {
        get_template_part('template-parts/content/content-access', 'denied');
    }

endwhile; // End of the loop.

get_footer();
