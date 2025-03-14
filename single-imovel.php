<?php

/**
 * The template for displaying all imovel single posts.
 *
 * @package morada-ideal
 */

get_header();
if (have_posts()) {
    // Load posts loop.
    while (have_posts()) {
        the_post();
        get_template_part('template-parts/content/content', 'single-imovel');
    }
}
get_footer();
