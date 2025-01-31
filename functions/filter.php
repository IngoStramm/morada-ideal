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
    if (
        (!isset($_GET['tipo-terms']) || !$_GET['tipo-terms']) &&
        (!isset($_GET['tipologia-term']) || !$_GET['tipologia-term'])
    ) {
        return;
    }


    $tipo_terms = isset($_GET['tipo-terms']) && $_GET['tipo-terms'] ? $_GET['tipo-terms'] : null;
    $tipologia_term = isset($_GET['tipologia-term']) && $_GET['tipologia-term'] ? $_GET['tipologia-term'] : null;

    if ((is_home() || is_author() || is_search() || is_archive()) && is_main_query() && !is_admin() && $wp_query->get('post_type') !== 'nav_menu_item') {
        if ($tipo_terms || $tipologia_term) {
            $tax_query = array(
                'relation' => 'AND'
            );
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
        /*
        if ($min_price && $max_price) {
            $meta_query = array(
                'relation' => 'AND',
                array(
                    'key' => 'mi_anuncio_preco',
                    'value' => floatval($min_price),
                    'compare' => '>=',
                    'type' => 'numeric'
                ),
                array(
                    'key' => 'mi_anuncio_preco',
                    'value' => floatval($max_price),
                    'compare' => '<=',
                    'type' => 'numeric'
                )
            );
            $wp_query->set('meta_query', $meta_query);
        }
        */
    }
}
