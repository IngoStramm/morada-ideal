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
$imovel_operacao = get_post_meta($post_id, 'imovel_operacao', true);
$imovel_valor = get_post_meta($post_id, 'imovel_valor', true);
$imovel_metragem = get_post_meta($post_id, 'imovel_metragem', true);
$valor_por_metro = mi_calcula_valor_por_metro($imovel_valor, $imovel_metragem);
$imovel_galeria = get_post_meta($post_id, 'imovel_galeria', true);
$imovel_galeria_id = get_post_meta($post_id, '_imovel_galeria_id', true);
$imovel_caracteristicas_especificas = get_post_meta($post_id, 'imovel_caracteristicas_especificas', true);
$imovel_certificado_energetico = get_post_meta($post_id, 'imovel_certificado_energetico', true);
?>

<div class="row">
    <div class="col-4">
        <a href="<?php echo get_permalink(); ?>">
            <?php the_post_thumbnail('medium-large', array('loading' => false, 'class' => 'img-fluid mx-auto d-block')); ?>
        </a>
    </div>
    <div class="col-md-8">
        <h5><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h5>
        <div class="imovel-preco"><?php echo $imovel_valor; ?> €/mês</div>
        <div class="imovel-detalhes">
            <?php echo $imovel_metragem; ?> m² <?php _e('área bruta', 'mi') ?>
            &nbsp;
            &nbsp;
            <?php echo $valor_por_metro; ?> €/m²
        </div>
        <?php the_excerpt(); ?>
    </div>
</div>