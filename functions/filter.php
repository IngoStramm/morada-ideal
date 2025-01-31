<?php

add_action('pre_get_posts', 'mi_filter_query');

/**
 * mi_filter_query
 *
 * @param  mixed $query
 * @return void
 */
function mi_filter_query($wp_query)
{
    $filter_params = mi_filters_params();
    $check = false;
    foreach ($filter_params as $params) {
        if (isset($_GET[$params]) && $_GET[$params]) {
            $check = true;
        }
    }

    if (!$check) {
        return;
    }

    $tipo_terms = isset($_GET['tipo-terms']) && $_GET['tipo-terms'] ? $_GET['tipo-terms'] : null;
    $tipologia_term = isset($_GET['tipologia-term']) && $_GET['tipologia-term'] ? $_GET['tipologia-term'] : null;
    $operacao_term = isset($_GET['operacao-term']) && $_GET['operacao-term'] ? $_GET['operacao-term'] : null;

    $preco_max = isset($_GET['preco-max']) && $_GET['preco-max'] ? $_GET['preco-max'] : null;
    $preco_min = isset($_GET['preco-min']) && $_GET['preco-min'] ? $_GET['preco-min'] : null;

    $metragem_imovel_max = isset($_GET['metragem-imovel-max']) && $_GET['metragem-imovel-max'] ? $_GET['metragem-imovel-max'] : null;
    $metragem_imovel_min = isset($_GET['metragem-imovel-min']) && $_GET['metragem-imovel-min'] ? $_GET['metragem-imovel-min'] : null;

    if ((is_home() || is_author() || is_search() || is_archive()) && is_main_query() && !is_admin() && $wp_query->get('post_type') !== 'nav_menu_item') {

        if ($tipo_terms || $tipologia_term || $operacao_term) {
            $tax_query = array(
                'relation' => 'AND'
            );
            if ($operacao_term) {
                $tax_query[] = array(
                    'taxonomy'      => 'operacao',
                    'field'         => 'term_id',
                    'terms'         => $operacao_term,
                );
            }
            if ($tipo_terms) {
                $tax_query[] = array(
                    'taxonomy'      => 'tipo',
                    'field'         => 'term_id',
                    'terms'         => $tipo_terms,
                );
            }
            if ($tipologia_term) {
                $tax_query[] = array(
                    'taxonomy'      => 'tipologia',
                    'field'         => 'term_id',
                    'terms'         => $tipologia_term,
                );
            }
            $wp_query->set('tax_query', $tax_query);
        }
        $meta_query = array(
            'relation' => 'AND'
        );
        if ($preco_min) {
            $meta_query[] = array(
                'key' => 'imovel_valor',
                'value' => floatval($preco_min),
                'compare' => '>=',
                'type' => 'numeric'
            );
        }
        if ($preco_max) {
            $meta_query[] = array(
                'key' => 'imovel_valor',
                'value' => floatval($preco_max),
                'compare' => '<=',
                'type' => 'numeric'
            );
        }
        if ($metragem_imovel_min) {
            $meta_query[] = array(
                'key' => 'imovel_metragem',
                'value' => floatval($metragem_imovel_min),
                'compare' => '>=',
                'type' => 'numeric'
            );
        }
        if ($metragem_imovel_max) {
            $meta_query[] = array(
                'key' => 'imovel_metragem',
                'value' => floatval($metragem_imovel_max),
                'compare' => '<=',
                'type' => 'numeric'
            );
        }
        $wp_query->set('meta_query', $meta_query);
    }
}
