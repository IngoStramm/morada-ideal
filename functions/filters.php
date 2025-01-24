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
    // if (!isset($_GET['mi_form_filter_imovel_nonce']) || !wp_verify_nonce($_GET['mi_form_filter_imovel_nonce'], 'mi_form_filter_imovel_nonce')) {
    //     return;
    // }

    if (!isset($_GET['action']) || $_GET['action'] !== 'mi_filter_imovel_form') {
        return;
    }

    if (!isset($_GET['orderby']) || !$_GET['orderby']) {
        return;
    }

    $orderby = $_GET['orderby'];
    $order_array = array(
        'date_asc' => array(
            'orderby'   => 'date',
            'order'     => 'ASC'
        ),
        'date_desc' => array(
            'orderby'   => 'date',
            'order'     => 'DESC'
        ),
        'title_asc' => array(
            'orderby'   => 'title',
            'order'     => 'ASC'
        ),
        'title_desc' => array(
            'orderby'   => 'title',
            'order'     => 'DESC'
        ),
    );

    $start_date = isset($_GET['start-date']) && $_GET['start-date'] ? $_GET['start-date'] : null;
    $end_date = isset($_GET['end-date']) && $_GET['end-date'] ? $_GET['end-date'] : null;
    $min_price = isset($_GET['min-price']) && $_GET['min-price'] ? $_GET['min-price'] : null;
    $max_price = isset($_GET['max-price']) && $_GET['max-price'] ? $_GET['max-price'] : null;

    if ((is_home() || is_author() || is_search() || is_archive()) && is_main_query() && !is_admin() && $wp_query->get('post_type') !== 'nav_menu_item') {
        $wp_query->set('orderby', $order_array[$orderby]['orderby']);
        $wp_query->set('order', $order_array[$orderby]['order']);

        $date_query_array = array();

        if ($start_date) {
            $start_date = strtotime($start_date . '-1 day');
            $date_query_array['after'] = array(
                'day' => date('d', $start_date),
                'month' => date('m', $start_date),
                'year' => date('Y', $start_date),
            );
        }

        if ($end_date) {
            $end_date = strtotime($end_date . '+1 day');
            $date_query_array['before'] = array(
                'day' => date('d', $end_date),
                'month' => date('m', $end_date),
                'year' => date('Y', $end_date),
            );
        }

        // mi_debug($date_query_array);

        if (count($date_query_array) > 0) {
            $wp_query->set('date_query', $date_query_array);
        }

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
    }
}