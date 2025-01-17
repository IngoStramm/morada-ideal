<?php

/**
 * The template for displaying all imovel single posts.
 *
 * @package morada-ideal
 */

get_header(); ?>
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <?php
            if (have_posts()) {
                // Load posts loop.
                while (have_posts()) {
                    the_post();
                    get_template_part('template-parts/content/content', 'single-imovel');
                }
            }
            get_footer(); ?>
        </div>
        <div class="col-md-3">
            <?php get_sidebar('single-archive') ?>
        </div>
    </div>
</div>