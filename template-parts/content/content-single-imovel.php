<?php

/**
 * Template part for displaying imovel posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package morada-ideal
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
                $post_id = get_the_ID();
                $imovel_valor = get_post_meta($post_id, 'imovel_valor', true);
                $imovel_metragem = get_post_meta($post_id, 'imovel_metragem', true);
                $valor_por_metro = mi_calcula_valor_por_metro($imovel_valor, $imovel_metragem);
                $imovel_galeria = get_post_meta($post_id, 'imovel_galeria', true);
                $imovel_galeria_id = get_post_meta($post_id, '_imovel_galeria_id', true);
                $imovel_caracteristicas_especificas = get_post_meta($post_id, 'imovel_caracteristicas_especificas', true);
                $imovel_certificado_energetico = get_post_meta($post_id, 'imovel_certificado_energetico', true);
                $imovel_rua = get_post_meta($post_id, 'imovel_rua', true);
                $imovel_numero = get_post_meta($post_id, 'imovel_numero', true);
                $imovel_codigo_postal = get_post_meta($post_id, 'imovel_codigo_postal', true);
                $imovel_cidade = get_post_meta($post_id, 'imovel_cidade', true);
                $operacao_term = get_the_terms($post_id, 'operacao');
                $tipo_terms = get_the_terms($post_id, 'tipo');
                $regiao_terms = get_the_terms($post_id, 'regiao');
                $caracteristica_geral_terms = get_the_terms($post_id, 'caracteristica-geral');
                $tipologia_terms = get_the_terms($post_id, 'tipologia');
                $outras_denominacoes_terms = get_the_terms($post_id, 'outras-denominacoes');
                $casas_de_banho_terms = get_the_terms($post_id, 'casas-de-banho');
                $estado_terms = get_the_terms($post_id, 'estado');
                $filtro_terms = get_the_terms($post_id, 'filtro');
                $andar_terms = get_the_terms($post_id, 'andar');
                ?>
                <figure class="post-thumbnail">
                    <?php
                    // Lazy-loading attributes should be skipped for thumbnails since they are immediately in the viewport.
                    the_post_thumbnail('post-thumbnail', array('loading' => false, 'class' => 'img-fluid rounded'));
                    ?>
                    <?php if (wp_get_attachment_caption(get_post_thumbnail_id())) : ?>
                        <figcaption class="wp-caption-text"><?php echo wp_kses_post(wp_get_attachment_caption(get_post_thumbnail_id())); ?></figcaption>
                    <?php endif; ?>
                </figure><!-- .post-thumbnail -->
                <div class="imovel-endereco"><?php echo $imovel_rua; ?>, <?php echo $imovel_numero; ?> - <?php echo $imovel_cidade; ?></div>
                <div class="imovel-preco"><?php echo $imovel_valor; ?> €/mês</div>
                <div class="imovel-detalhes">
                    <?php echo $imovel_metragem; ?> m² <?php _e('área bruta', 'mi') ?>
                    &nbsp;
                    &nbsp;
                    <?php echo $valor_por_metro; ?> €/m²
                </div>
                <?php if ($imovel_caracteristicas_especificas && count($imovel_caracteristicas_especificas) > 0) { ?>
                    <div class="imovel-caracteristicas-especificas">
                        <h4><?php _e('Caracteristicas Especificas', 'mi') ?></h4>
                        <ul>
                            <?php foreach ($imovel_caracteristicas_especificas as $item) { ?>
                                <li><?php echo $item; ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php if ($operacao_term && count($operacao_term) > 0) { ?>
                    <div class="imovel-operacao">
                        <h4><?php _e('Operação', 'mi') ?></h4>
                        <ul>
                            <?php foreach ($operacao_term as $term) { ?>
                                <li><?php echo $term->name; ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php if ($tipo_terms && count($tipo_terms) > 0) { ?>
                    <div class="imovel-tipo">
                        <h4><?php _e('Tipo', 'mi') ?></h4>
                        <ul>
                            <?php foreach ($tipo_terms as $term) { ?>
                                <li><?php echo $term->name; ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php if ($caracteristica_geral_terms && count($caracteristica_geral_terms) > 0) { ?>
                    <div class="imovel-caracteristicas-gerais">
                        <h4><?php _e('Características Gerais', 'mi') ?></h4>
                        <ul>
                            <?php foreach ($caracteristica_geral_terms as $term) { ?>
                                <li><?php echo $term->name; ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php if ($tipologia_terms && count($tipologia_terms) > 0) { ?>
                    <div class="imovel-tipologia">
                        <h4><?php _e('Tipologia', 'mi') ?></h4>
                        <ul>
                            <?php foreach ($tipologia_terms as $term) { ?>
                                <li><?php echo $term->name; ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php if ($outras_denominacoes_terms && count($outras_denominacoes_terms) > 0) { ?>
                    <div class="imovel-outras-denominacoes">
                        <h4><?php _e('Outras Denominações', 'mi') ?></h4>
                        <ul>
                            <?php foreach ($outras_denominacoes_terms as $term) { ?>
                                <li><?php echo $term->name; ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php if ($casas_de_banho_terms && count($casas_de_banho_terms) > 0) { ?>
                    <div class="imovel-casas-de-banho">
                        <h4><?php _e('Casas de Banho', 'mi') ?></h4>
                        <ul>
                            <?php foreach ($casas_de_banho_terms as $term) { ?>
                                <li><?php echo $term->name; ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php if ($estado_terms && count($estado_terms) > 0) { ?>
                    <div class="imovel-estado">
                        <h4><?php _e('Estado', 'mi') ?></h4>
                        <ul>
                            <?php foreach ($estado_terms as $term) { ?>
                                <li><?php echo $term->name; ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php if ($filtro_terms && count($filtro_terms) > 0) { ?>
                    <div class="imovel-filtro">
                        <h4><?php _e('Filtro', 'mi') ?></h4>
                        <ul>
                            <?php foreach ($filtro_terms as $term) { ?>
                                <li><?php echo $term->name; ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php if ($andar_terms && count($andar_terms) > 0) { ?>
                    <div class="imovel-andar">
                        <h4><?php _e('Andar', 'mi') ?></h4>
                        <ul>
                            <?php foreach ($andar_terms as $term) { ?>
                                <li><?php echo $term->name; ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php if ($regiao_terms && count($regiao_terms) > 0) { ?>
                    <div class="regiao-regiao">
                        <h4><?php _e('Região', 'mi') ?></h4>
                        <ul>
                            <?php foreach ($regiao_terms as $term1) { ?>
                                <?php if ($term1->parent === 0) { ?>
                                    <li><?php echo $term1->name; ?></li>
                                    <ul>
                                        <?php foreach ($regiao_terms as $term2) { ?>
                                            <?php if ($term2->parent === $term1->term_id) { ?>
                                                <li><?php echo $term2->name; ?></li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <?php if ($imovel_certificado_energetico) { ?>
                    <div class="imovel-certificado-energetico">
                        <h4><?php _e('Certificado Energético', 'mi') ?></h4>
                        <p><?php echo $imovel_certificado_energetico; ?></p>
                    </div>
                <?php } ?>
                <?php the_content(); ?>
                <?php if ($imovel_galeria && count($imovel_galeria) > 0) { ?>
                    <h4><?php _e('Fotos', 'mi'); ?></h4>
                    <div class="d-flex flex-column justify-content-start align-items-start gap-3">
                        <?php foreach ($imovel_galeria as $img) { ?>
                            <img src="<?php echo $img ?>" class="img-fluid" />
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</article>