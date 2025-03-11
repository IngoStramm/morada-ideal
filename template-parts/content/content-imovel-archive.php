<?php

/**
 * Template part for displaying imovel
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package morada-ideal
 */
?>

<?php
$post_id = get_the_ID();
$author_id = get_the_author_meta('ID');
$user_avatar = get_user_meta($author_id, 'mi_user_avatar', true);
$user_phone = get_user_meta($author_id, 'mi_user_phone', true);
$imovel_operacao = wp_get_post_terms($post_id, 'operacao');
$imovel_tipologia = wp_get_post_terms($post_id, 'tipologia');
$imovel_casas_banho = wp_get_post_terms($post_id, 'casas-de-banho');
$imovel_estado = get_post_meta($post_id, 'imovel_estado', true);
$imovel_cidade = get_post_meta($post_id, 'imovel_cidade', true);
$imovel_valor = get_post_meta($post_id, 'imovel_valor', true);
$imovel_metragem = get_post_meta($post_id, 'imovel_metragem', true);
$valor_por_metro = mi_calcula_valor_por_metro($imovel_valor, $imovel_metragem);
$imovel_galeria = get_post_meta($post_id, 'imovel_galeria', true);
$imovel_galeria_id = get_post_meta($post_id, '_imovel_galeria_id', true);
$imovel_caracteristicas_especificas = get_post_meta($post_id, 'imovel_caracteristicas_especificas', true);
$imovel_certificado_energetico = get_post_meta($post_id, 'imovel_certificado_energetico', true);
?>

<div class="imovel-list-item">
    <div class="imovel-list-item-img">
        <a href="<?php echo get_permalink(); ?>">
            <?php the_post_thumbnail('medium-large', array('loading' => false, 'class' => 'img-fluid mx-auto d-block')); ?>
        </a>
    </div>
    <div class="imovel-list-item-content">
        <h5 class="imovel-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h5>
        <ul class="imovel-detalhes">
            <li><span><?php echo mi_get_icon('map-pin-alt'); ?><?php echo $imovel_estado; ?>,</span> <?php echo $imovel_cidade; ?></li>
            <li><span><?php echo mi_get_icon('bed'); ?><?php _e('Quartos', 'mi'); ?><strong><?php echo $imovel_tipologia[0]->name; ?></strong></span><span><?php echo mi_get_icon('bath'); ?><?php _e('Casa de banho', 'mi'); ?><strong><?php echo $imovel_casas_banho[0]->name; ?></strong></span><span><?php echo mi_get_icon('triangle'); ?><?php _e('Área', 'mi') ?><strong><?php echo $imovel_metragem; ?>m²</strong></span></li>
            <?php /* ?><li><?php echo $valor_por_metro; ?> €/m²</li><?php */ ?>
        </ul>
        <div class="imovel-resumo">
            <?php the_excerpt(); ?>
        </div>
        <div class="imovel-bottom-bar">
            <img src="<?php echo $user_avatar; ?>" class="author-avatar">
            <div class="imovel-preco"><?php echo mi_format_money($imovel_valor); ?> €<?php echo $imovel_operacao[0]->name === 'Arrendar' ? '/mês' : ''; ?></div>
        </div>
    </div>
</div>