<?php

/**
 * Template part for displaying My Imóveis Page content in page.php
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
                    <p><?php _e('Nesta página você pode visualizar os seus imóveis.', 'mi') ?></p>

                    <div class="clearfix mb-5"></div>

                    <?php // echo mi_account_nav('account'); 
                    ?>

                    <?php do_action('update_user_messages'); ?>

                    <h3 class="mt-2 mb-3"><?php _e('Seus imóveis', 'mi'); ?></h3>

                    <div id="my-imoveis">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="search" class="form-control form-control-sm search" id="table-search-input" placeholder="<?php _e('Pesquisar', 'mi'); ?>">
                                    <label for="table-search-input"><?php _e('Pesquisar', 'mi'); ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive sort-table">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="sort" data-sort="nome" scope="col"><?php _e('Nome', 'mi'); ?> <i class="bi bi-arrow-down-up"></i></th>
                                        <th class="sort" data-sort="data" scope="col"><?php _e('Data', 'mi'); ?> <i class="bi bi-arrow-down-up"></i></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php
                                    $imoveis = mi_get_user_imoveis($user_id);
                                    foreach ($imoveis as $imovel) {
                                        // wt_debug($lead);
                                        $imovel_id = $imovel->ID;
                                        $imovel_title = $imovel->post_title;
                                        $imovel_date = $imovel->post_date;
                                        $imovel_modified = $imovel->post_modified;
                                        $imovel_url = get_post_permalink($imovel_id);
                                    ?>
                                        <tr>
                                            <td class="nome">
                                                <a href="<?php echo $imovel_url; ?>">
                                                    <?php echo $imovel_title; ?>
                                                </a>
                                            </td>
                                            <td class="data">
                                                <?php echo get_the_date('', $imovel_id); ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <?php wp_reset_postdata(); ?>
                                </tbody>
                                </thead>
                            </table>
                            <ul class="pagination"></ul>
                        </div>
                    </div>

                <?php } else { ?>
                    <div class="row col-md-6">
                        <?php echo mi_alert_not_logged_in(__('É preciso estar logado para visualizar os seus imóveis.', 'mi')); ?>
                    </div>
                <?php } ?>


            </div>
        </div>
    </div>

</article><!-- #post-<?php the_ID(); ?> -->