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
    get_template_part('template-parts/content/account/content-imovel-form');

endwhile; // End of the loop.

get_footer();
