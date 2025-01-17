<?php

/**
 * Template part for displaying User Account Page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Morada Ideal
 */
$user = wp_get_current_user();

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="container">
        <div class="row">
            <div class="col">

                <?php if (is_user_logged_in()) { ?>
                    <?php $user_id = $user->get('ID'); ?>

                    <h3><?php echo sprintf(__('Olá, %s!'), $user->display_name); ?></h3>
                    <p><?php _e('Nesta página você pode alterar os seus dados pessoais.', 'mi') ?></p>

                    <div class="clearfix mb-5"></div>

                    <?php // echo mi_account_nav('account'); ?>

                    <?php do_action('update_user_messages'); ?>

                    <h3 class="mt-2 mb-3"><?php _e('Dados pessoais', 'mi'); ?></h3>

                    <?php get_template_part('template-parts/content/account/content-user-form'); ?>

                <?php } else { ?>
                    <div class="row col-md-6">
                        <?php echo mi_alert_not_logged_in(__('É preciso estar logado para visualizar os dados da sua conta.', 'mi')); ?>
                    </div>
                <?php } ?>


            </div>
        </div>
    </div>

</article><!-- #post-<?php the_ID(); ?> -->