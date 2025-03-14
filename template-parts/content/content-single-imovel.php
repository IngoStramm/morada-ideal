<?php

/**
 * Template part for displaying imovel posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package morada-ideal
 */
?>
<?php
$post_id = get_the_ID();
$imovel_operacao = wp_get_post_terms($post_id, 'operacao');
$imovel_valor = get_post_meta($post_id, 'imovel_valor', true);
$imovel_lat = get_post_meta($post_id, 'imovel_lat', true);
$imovel_lng = get_post_meta($post_id, 'imovel_lng', true);
$imovel_area_bruta = get_post_meta($post_id, 'imovel_area_bruta', true);
$imovel_area_util = get_post_meta($post_id, 'imovel_area_util', true);
$imovel_ano = get_post_meta($post_id, 'imovel_ano', true);
$imovel_garagens = get_post_meta($post_id, 'imovel_garagens', true);
$valor_por_metro = mi_calcula_valor_por_metro($imovel_valor, $imovel_area_bruta);
$imovel_galeria = get_post_meta($post_id, 'imovel_galeria', true);
$imovel_galeria_id = get_post_meta($post_id, '_imovel_galeria_id', true);
$imovel_caracteristicas_especificas = get_post_meta($post_id, 'imovel_caracteristicas_especificas', true);
$imovel_certificado_energetico = get_post_meta($post_id, 'imovel_certificado_energetico', true);
$imovel_rua = get_post_meta($post_id, 'imovel_rua', true);
$imovel_numero = get_post_meta($post_id, 'imovel_numero', true);
$imovel_codigo_postal = get_post_meta($post_id, 'imovel_codigo_postal', true);
$imovel_cidade = get_post_meta($post_id, 'imovel_cidade', true);
$operacao_term = get_the_terms($post_id, 'operacao');
$tipo_terms = wp_get_post_terms($post_id, 'tipo');
$regiao_terms = get_the_terms($post_id, 'regiao');
$caracteristica_geral_terms = get_the_terms($post_id, 'caracteristica-geral');
$imovel_tipologia = get_the_terms($post_id, 'tipologia');
$outras_denominacoes_terms = get_the_terms($post_id, 'outras-denominacoes');
$imovel_casas_banho = wp_get_post_terms($post_id, 'casas-de-banho');
$imovel_estado = get_post_meta($post_id, 'imovel_estado', true);
$filtro_terms = get_the_terms($post_id, 'filtro');
$andar_terms = get_the_terms($post_id, 'andar');
$user_permition = mi_check_edit_imovel_user_permition($post_id);
$check_imovel_date = mi_check_imovel_date($post_id);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('imovel-single'); ?>>

    <div class="container">

        <div class="row">
            <?php if ($user_permition && $check_imovel_date) { ?>
                <div class="col-md-12">
                    <?php $edit_imovel_url = mi_get_page_url('editimovel') . '?imovel_id=' . $post_id; ?>
                    <a href="<?php echo $edit_imovel_url; ?>" class="btn btn-warning"><?php _e('Editar', 'mi'); ?></a>
                </div>
            <?php } else { ?>
                <div class="col-md-12">
                    <?php echo mi_alert(__('Não é mais possível editar o imóvel, já se passaram mais de 7 dias desde a sua criação.', 'mi')) ?>
                </div>
            <?php } ?>
            <div class="col-md-12 imovel-single-header">
                <h1 class="imovel-single-title"><?php the_title(); ?></h1>
                <?php if ($imovel_valor) { ?>
                    <div class="imovel-single-preco"><strong><?php echo mi_format_money($imovel_valor); ?>€</strong> <?php echo $imovel_operacao[0]->name === 'Arrendar' ? '/mês' : ''; ?></div>
                <?php } ?>
            </div>

            <div class="col-md-12 mb-3">
                <hr class="imovel-single-horizontal-border" />
            </div>

            <div class="col-12 d-flex flex-column flex-md-row align-items-md-center justify-content-md-start gap-3 gap-md-5 mb-5">
                <ul class="imovel-detalhes">
                    <li><strong><?php _e('Características', 'mi'); ?></strong></li>
                    <li>
                        <?php if ($imovel_tipologia && isset($imovel_tipologia[0])) { ?>
                            <span><?php echo mi_get_icon('bed'); ?><?php _e('Quartos', 'mi'); ?><strong><?php echo $imovel_tipologia[0]->name; ?></strong></span>
                        <?php } ?>

                        <?php if ($imovel_casas_banho && isset($imovel_casas_banho[0])) { ?>
                            <span><?php echo mi_get_icon('bath'); ?><?php _e('Casa de banho', 'mi'); ?><strong><?php echo $imovel_casas_banho[0]->name; ?></strong></span>
                        <?php } ?>

                        <?php if ($imovel_area_bruta) { ?>
                            <span><?php echo mi_get_icon('triangle'); ?><?php _e('Área', 'mi') ?><strong><?php echo $imovel_area_bruta; ?>m²</strong></span>
                        <?php } ?>
                    </li>
                </ul>

                <?php if ($imovel_estado || $imovel_cidade) { ?>
                    <ul class="imovel-detalhes">
                        <li><strong><?php _e('Localização', 'mi'); ?></strong></li>
                        <li>
                            <span>
                                <?php
                                echo mi_get_icon('map-pin-alt');
                                if ($imovel_estado) {
                                    echo $imovel_estado;
                                }
                                if ($imovel_estado) {
                                    echo ', ';
                                }
                                if ($imovel_cidade) {
                                    echo $imovel_cidade;
                                } ?>
                            </span>
                        </li>
                    </ul>
                <?php } ?>
            </div>

            <div class="col-lg-7 col-xl-8">

                <figure class="imovel-single-featured-image">
                    <?php
                    // Lazy-loading attributes should be skipped for thumbnails since they are immediately in the viewport.
                    the_post_thumbnail('post-thumbnail', array('loading' => false, 'class' => 'img-fluid'));
                    ?>
                    <?php if (wp_get_attachment_caption(get_post_thumbnail_id())) : ?>
                        <figcaption class="wp-caption-text"><?php echo wp_kses_post(wp_get_attachment_caption(get_post_thumbnail_id())); ?></figcaption>
                    <?php endif; ?>

                    <?php if ($imovel_galeria) { ?>
                        <a href="#" class="btn btn-primary has-icon imovel-show_modal-gallery" data-bs-toggle="modal" data-bs-target="#modal-gallery-<?php echo $post_id; ?>">
                            <?php echo mi_get_icon('picture'); ?>
                            <?php _e('Ver todas as fotos', 'mi'); ?>
                        </a>
                    <?php } ?>

                </figure><!-- .post-thumbnail -->


                <h4><?php _e('Descrição do imóvel', 'mi'); ?></h4>
                <div class="toogle-preview mb-3">
                    <div class="toogle-preview-content">
                        <?php the_content(); ?>
                    </div>
                    <a href="#" class="toogle-preview-btn" data-text="<?php _e('Ver Menos', 'mi'); ?>"><?php _e('Ver Mais', 'mi'); ?></a>
                </div>

                <hr class="imovel-single-horizontal-border my-5" />

                <h4 class="mb-4"><?php _e('Overview', 'mi'); ?></h4>
                <ul class="imovel-single-overview">

                    <li><?php echo mi_get_icon('overview-id'); ?>
                        <ul>
                            <li><?php _e('ID', 'mi') ?></li>
                            <li><strong><?php echo $post_id; ?></strong></li>
                        </ul>
                    </li>

                    <?php if ($tipo_terms && count($tipo_terms) > 0) {
                        echo mi_overview_list_item_term($tipo_terms, 'overview-tipo', __('Tipo', 'mi'));
                    } ?>

                    <?php if ($imovel_garagens) {
                        echo mi_overview_list_item_text($imovel_garagens, 'overview-garagens', __('Garagens', 'mi'));
                    } ?>

                    <?php if ($imovel_tipologia && count($imovel_tipologia) > 0) {
                        echo mi_overview_list_item_term($imovel_tipologia, 'overview-tipologia', __('Tipologia', 'mi'));
                    } ?>

                    <?php if ($imovel_casas_banho && count($imovel_casas_banho) > 0) {
                        echo mi_overview_list_item_term($imovel_casas_banho, 'overview-casas-de-banho', __('Casas de banho', 'mi'));
                    } ?>

                    <?php if ($imovel_area_bruta) {
                        echo mi_overview_list_item_text($imovel_area_bruta . ' m²', 'overview-area-util', __('Área bruta', 'mi'));
                    } ?>

                    <?php if ($imovel_ano) {
                        echo mi_overview_list_item_text($imovel_ano, 'overview-construcao', __('Construção', 'mi'));
                    } ?>

                    <?php if ($imovel_area_util) {
                        echo mi_overview_list_item_text($imovel_area_util . ' m²', 'overview-area-bruta', __('Área útil', 'mi'));
                    } ?>

                </ul>

                <h4 class="mb-4"><?php _e('Comodidades e características', 'mi'); ?></h4>

                <ul class="imovel-comodidades-caracteristicas">

                    <?php if ($imovel_caracteristicas_especificas && count($imovel_caracteristicas_especificas) > 0) { ?>
                        <?php foreach ($imovel_caracteristicas_especificas as $item) { ?>
                            <li><?php echo $item; ?></li>
                        <?php } ?>
                    <?php } ?>

                    <?php if ($caracteristica_geral_terms && count($caracteristica_geral_terms) > 0) { ?>
                        <?php foreach ($caracteristica_geral_terms as $term) { ?>
                            <li><?php echo $term->name; ?></li>
                        <?php } ?>
                    <?php } ?>

                    <?php if ($outras_denominacoes_terms && count($outras_denominacoes_terms) > 0) { ?>
                        <?php foreach ($outras_denominacoes_terms as $term) { ?>
                            <li><?php echo $term->name; ?></li>
                        <?php } ?>
                    <?php } ?>

                    <?php if ($filtro_terms && count($filtro_terms) > 0) { ?>
                        <?php foreach ($filtro_terms as $term) { ?>
                            <li><?php echo $term->name; ?></li>
                        <?php } ?>
                    <?php } ?>

                    <?php if ($andar_terms && count($andar_terms) > 0) { ?>
                        <?php foreach ($andar_terms as $term) { ?>
                            <li><?php echo $term->name; ?></li>
                        <?php } ?>
                    <?php } ?>

                </ul>

                <?php if ($imovel_certificado_energetico) { ?>
                    <div class="imovel-certificado-energetico">
                        <h4><?php _e('Certificado Energético', 'mi') ?></h4>
                        <p><?php echo $imovel_certificado_energetico; ?></p>
                    </div>
                <?php } ?>

                <?php if ($imovel_lat && $imovel_lng) { ?>

                    <hr class="imovel-single-horizontal-border my-5" />

                    <h4 class="mb-4"><?php _e('Localização', 'mi') ?></h4>
                    <div id="map" class="imovel-map"></div>

                <?php } ?>


            </div>
            <div class="col-lg-5 col-xl-4">
                <?php get_sidebar('single-archive') ?>
            </div>
        </div>
    </div>
</article>