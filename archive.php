<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * 
 * @package morada-ideal
 */

get_header(); ?>
<div class="container">
    <div class="row">
        <?php
        if (have_posts()) {
            // Load posts loop.
            while (have_posts()) {
                the_post();
                get_template_part('template-parts/content/content');
            }
        } else {
            // If no content, include the "No posts found" template.
            get_template_part('template-parts/content/content-none');
        }
        mi_paging_nav();
        get_footer(); ?>
    </div>
</div>