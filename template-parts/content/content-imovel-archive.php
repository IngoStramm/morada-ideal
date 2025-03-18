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
$imovel_area_bruta = get_post_meta($post_id, 'imovel_area_bruta', true);
$imovel_area_util = get_post_meta($post_id, 'imovel_area_util', true);
$valor_por_metro = mi_calcula_valor_por_metro($imovel_valor, $imovel_area_bruta);
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
            <?php if ($imovel_estado || $imovel_cidade) { ?>
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
            <?php } ?>

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
        <div class="imovel-resumo">
            <?php the_excerpt(); ?>
        </div>
        <div class="imovel-bottom-bar">
            <img src="<?php echo $user_avatar; ?>" class="author-avatar">
            <div class="imovel-preco"><?php echo mi_format_money($imovel_valor); ?> €<?php echo $imovel_operacao[0]->name === 'Arrendar' ? '/mês' : ''; ?></div>
        </div>
    </div>
</div>