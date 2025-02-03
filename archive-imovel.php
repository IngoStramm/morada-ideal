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
        <div class="col-md-12 mb-3">
            <?php get_template_part('template-parts/sort', 'imovel'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-5">
            <?php get_sidebar('sidebar') ?>
        </div>
        <div class="col-lg-9 col-md-7">
            <?php
            if (have_posts()) {
                // Load posts loop.
                while (have_posts()) {
                    the_post();
                    get_template_part('template-parts/content/content', 'imovel-archive');
                }
            } else {
                if (is_search()) {
                    get_template_part('template-parts/content/content', 'search-no-result');
                } else {
                    // If no content, include the "No posts found" template.
                    get_template_part('template-parts/content/content-none');
                }
            }
            mi_paging_nav(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>