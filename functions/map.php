<?php

add_action('pre_get_posts', 'mi_change_pagination_in_map_view');

/**
 * mi_change_pagination_in_map_view
 *
 * @param  mixed $query
 * @return void
 */
function mi_change_pagination_in_map_view($wp_query)
{
    if (!is_main_query() || is_admin()) {
        return;
    }
    if (!is_home() && !is_author() && !is_search() && !is_archive()) {
        return;
    }
    if ($wp_query->get('post_type') === 'nav_menu_item') {
        return;
    }
    $view = isset($_GET['view']) && $_GET['view'] ? $_GET['view'] : null;
    if ($view !== 'map') {
        return;
    }
    $wp_query->set('posts_per_page', -1);
}
