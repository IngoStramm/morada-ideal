<?php

/**
 * Template Name: Página Meus Imóveis
 * 
 * The template for My Imóveis
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Morada ideal
 */

get_header();

do_action('account_announces');

/* Start the Loop */
while (have_posts()) :
    the_post();
    get_template_part('template-parts/content/account/content-my-imoveis');

endwhile; // End of the loop.

get_footer();
