<?php

/**
 * mi_get_icon
 *
 * @param  string $name
 * @return string
 */
function mi_get_icon($name)
{
    $icon = empty($name) || is_null($name) ? null : file_get_contents(MI_DIR . '/assets/icons/' . $name . '.svg');
    return !$icon ? null : $icon;
}

/**
 * miToastsHtml
 *
 * @param  string $message
 * @return string
 */
function miToastsHtml($message = null)
{
    $output = null;
    if ($message) {
        $output = "
    <div class='toast align-items-center' role='alert' aria-live='assertive' aria-atomic='true'>
        <div class='d-flex'>
            <div class='toast-body'>$message</div>
            <button type='button' class='btn-close me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
        </div>
    </div>
    ";
    }
    return  $output;
}

/**
 * mi_alert
 *
 * @param  string $text
 * @param  string $type
 * @return string
 */
function mi_alert($text, $type = 'warning')
{
    $output = '';
    $output .= '<div class="alert alert-' . $type . ' d-flex align-items-top align-content-center" role="alert">';
    $output .= '<i class="bi bi-exclamation-triangle-fill me-2"></i>';
    $output .= "<div>$text</div>";
    $output .= '</div>';
    return $output;
}

/**
 * mi_dismissible_alert
 *
 * @param  string $message
 * @param  string $type
 * @return string
 */
function mi_dismissible_alert($message, $type = 'success')
{
    $output = '';
    if ($message) {
        $output .= '
        <div class="alert alert-' . $type . ' alert-dismissible d-flex align-items-center gap-2 fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <div>' . $message . '</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }
    return $output;
}

/**
 * mi_alert_not_logged_in
 *
 * @param  string $text
 * @return string
 */
function mi_alert_not_logged_in($text)
{
    $login_page_id = mi_get_page_id('login');
    $output = null;
    if ($login_page_id) {
        $login_page_url = mi_get_page_url('login');
        $output .= '<div class="alert alert-warning">';
        $output .= $text;
        $output .= '<br><a class="" href="';
        $output .= $login_page_url . '">' . __('Entrar', 'mi') . '</a></div>';
    }
    return $output;
}

/**
 * mi_account_nav
 *
 * @param  string $curr_account_page_id ('account', 'editanuncio', 'catanuncioconfig', 'myleads', 'myanuncios', 'contactedanuncios', 'followingtermsanuncios')
 * @return void
 */
function mi_account_nav($slug)
{
    $account_page_id = mi_get_page_id('account');
    $account_edit_imovel_page_id = mi_get_page_id('editimovel');
    $page_contacted_imoveis_id = mi_get_page_id('contactedimoveis');
    $curr_account_page_id = mi_get_page_id($slug);
    if ($account_edit_imovel_page_id) {
        get_template_part('template-parts/content/account/content-account-nav', null, array(
            'account' => $account_page_id,
            'edit-imovel' => $account_edit_imovel_page_id,
            'curr-page' => $curr_account_page_id,
            'contacted-imoveis' => $page_contacted_imoveis_id,
        ));
    }
}

/**
 * mi_list_sort_table_terms
 *
 * @param  string $table_id
 * @param  array $terms
 * @param  array $post_terms_id
 * @param  boolean $checkbox
 * @return string
 */
function mi_list_sort_table_terms($slug, $terms, $post_terms_id, $checkbox = true)
{
    $output = '';
    $output .= '
    <div id="table-' . $slug . '-imoveis">

        <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="search" class="form-control form-control-sm search" id="table-search-input" placeholder="' . __('Pesquisar', 'mi') . '">
                    <label for="table-search-input">' . __('Pesquisar', 'mi') . '</label>
                </div>
            </div>
        </div>

        <div class="table-responsive sort-table">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">' . __('Nome', 'mi') . '</th>
                    </tr>
                </thead>

                <tbody class="list checkbox-terms-list">';
    foreach ($terms as $term) {
        if (!$term->parent) {
            $parent_checked = in_array($term->term_id, $post_terms_id) ? 'checked' : '';
            $type_input = $checkbox ? 'checkbox' : 'radio';
            $name_input = $checkbox ? $slug . '-terms[]' : $slug . '-term';
            $output .= '
                    <tr>
                        <td scope="row" class="text-center" width="70px">
                            <input class="form-check-input" type="' . $type_input . '" value="' . $term->term_id . '" name="' . $name_input . '" id="term-' . $term->term_id . '" data-name="' . $term->name . '" ' . $parent_checked . '>
                        </td>
                        <td>
                            <div class="form-check">
                                <label class="form-check-label nome" for="term-' . $term->term_id . '">' . $term->name . '</label>
                            </div>
                        </td>
                    </tr>';
            foreach ($terms as $term2) {
                if ($term2->parent === $term->term_id) {
                    $child_checked = in_array($term2->term_id, $post_terms_id) ? 'checked' : '';
                    $output .= '
                    <tr>
                        <td scope="row" class="text-center">
                            <input class="form-check-input" type="' . $type_input . '" value="' .  $term2->term_id . '" name="' . $name_input . '" id="term-' . $term2->term_id . '" data-parent="term-' . $term2->parent . '" data-name="' . $term2->name . '" ' . $child_checked . '>
                        </td>
                        <td class="child-term">
                            <div class="form-check">

                                <label class="form-check-label" for="term-' . $term2->term_id . '">
                                    <span class="nome">' . $term2->name . '</span> — <span class="parent-term-name">' . $term->name . '</span>
                                </label>
                            </div>
                        </td>
                    </tr>';
                }
            }
        }
    }
    $output .= '                    
                </tbody>
            </table>
            <ul class="pagination"></ul>
        </div>
    </div>
    ';
    return $output;
}


/**
 * mi_autocomplete_search_input
 *
 * @param  string $imovel_lat
 * @param  string $imovel_lng
 * @return string
 */
function mi_autocomplete_search_input($imovel_lat = '', $imovel_lng = '')
{
    $search = isset($_GET['search']) && $_GET['search'] ? $_GET['search'] : null;
    if (!$imovel_lat) {
        $imovel_lat = isset($_GET['lat']) && $_GET['lat'] ? $_GET['lat'] : null;
    }
    if (!$imovel_lng) {
        $imovel_lng = isset($_GET['lng']) && $_GET['lng'] ? $_GET['lng'] : null;
    }
    $imovel_estado = isset($_GET['imovel_estado']) && $_GET['imovel_estado'] ? $_GET['imovel_estado'] : null;
    $imovel_cidade = isset($_GET['imovel_cidade']) && $_GET['imovel_cidade'] ? $_GET['imovel_cidade'] : null;
    $imovel_codigo_postal = isset($_GET['imovel_codigo_postal']) && $_GET['imovel_codigo_postal'] ? $_GET['imovel_codigo_postal'] : null;
    $imovel_rua = isset($_GET['imovel_rua']) && $_GET['imovel_rua'] ? $_GET['imovel_rua'] : null;
    $output = '';
    $output .= '
    <div class="autocomplete-wrapper">
        <div class="input-group search-address-group">
            <input type="search" class="form-control form-control-sm search autocomplete" id="autocomplete" name="search" value="' . $search . '" placeholder="' . __('Localização', 'mi') . '">
            <span class="input-group-text">' . mi_get_icon('target') . '</span>
        </div>
        <div id="autocomplete-message" class="autocomplete-message">' . __('Digite um endereço válido para fazer a pesquisa.', 'mi') . '</div>
        <input type="hidden" value="' . $imovel_lat . '" name="lat" />
        <input type="hidden" value="' . $imovel_lng . '" name="lng" />
        <input type="hidden" value="' . $imovel_estado . '" name="imovel_estado" />
        <input type="hidden" value="' . $imovel_cidade . '" name="imovel_cidade" />
        <input type="hidden" value="' . $imovel_codigo_postal . '" name="imovel_codigo_postal" />
        <input type="hidden" value="' . $imovel_rua . '" name="imovel_rua" />
    </div>
    ';
    return $output;
}

/**
 * mi_range_slider_double_value
 * 
 * Referência: @https://medium.com/@predragdavidovic10/native-dual-range-slider-html-css-javascript-91e778134816
 *
 * @param  array $values
 * @param  string $name1
 * @param  string $name2
 * @param  int $selected_min_value
 * @param  int $selected_max_value
 * @return string
 */
function mi_range_slider_double_value($data_id, $values, $name1, $name2, $selected_min_value = 0, $selected_max_value = 0, $label)
{
    $values_positions = [];
    $values_positions[] = '0';
    foreach ($values as $k => $v) {
        $values_positions[] = $k;
    }
    $max = count($values);
    if ($selected_max_value === 0) {
        $selected_max_value = array_key_last($values);
    }
    $selected_min_key = 0;
    if ($selected_min_value !== 0) {
        $selected_min_key = array_search($selected_min_value, $values_positions);
    }
    $selected_max_key = 0;
    if ($selected_max_value !== 0) {
        $selected_max_key = array_search($selected_max_value, $values_positions);
    }
    $selected_min_value_text = $selected_min_value === 0 ? 0 : $values[$selected_min_value];
    $selected_max_value_text = $selected_max_value === 0 ? $values[array_key_last($values)] : $values[$selected_max_value];
    $output = '';
    $output .= '
    <div class="range-container" data-array-id="' . $data_id . '">
        <label>' . $label . ' <span class="text-min-value">' . $selected_min_value_text . '</span> - <span class="text-max-value">' . $selected_max_value_text . '</span>
        </label>

        <div class="sliders-control">
            <input id="fromSlider" class="fromSlider" type="range" value="' . $selected_min_key . '" min="0" max="' . $max . '"/>
            <input id="toSlider" class="toSlider" type="range" value="' . $selected_max_key . '" min="0" max="' . $max . '"/>
        </div>

        <input class="fromInput" name="' . $name1 . '" type="hidden" id="fromInput" value="' . $selected_min_value . '" />
        <input class="toInput" name="' . $name2 . '" type="hidden" id="toInput" value="' . $selected_max_value . '" />
        
    </div>
    ';
    return $output;
}

/**
 * mi_total_imoveis_sort_message
 *
 * @return string
 */
function mi_total_imoveis_sort_message()
{
    global $wp_query;
    if (!is_main_query() || is_admin() || $wp_query->get('post_type') === 'nav_menu_item') {
        return;
    }
    $post_count = $wp_query->post_count;
    $search_term = isset($wp_query->query_vars['search']) && $wp_query->query_vars['search'] ? $wp_query->query_vars['search'] : null;
    $output = '';
    $output .= $search_term ? sprintf(__('%s imóveis encontrados em %s', 'mi'), $post_count, $search_term) : sprintf(__('%s imóveis encontrados', 'mi'), $post_count);
    return $output;
}

/**
 * mi_overview_list_item_text
 *
 * @param  string $item
 * @param  string $icon
 * @param  string $text
 * @return string
 */
function mi_overview_list_item_text($item, $icon, $text)
{
    $output = '';
    $output .= '
        <li>' . mi_get_icon($icon) . '
            <ul>
                <li>' . $text . '</li>';
    $output .= '<li><strong>' . $item . '</strong></li>';
    $output .= '
            </ul>
        </li>';
    return $output;
}

/**
 * mi_overview_list_item_term
 *
 * @param  array $terms
 * @param  string $icon
 * @param  string $text
 * @return string
 */
function mi_overview_list_item_term($terms, $icon, $text)
{
    $output = '';
    if ($terms) {
        $output .= '
        <li>' . mi_get_icon($icon) . '
            <ul>
                <li>' . $text . '</li>';
        foreach ($terms as $term) {
            if (!$term->parent) {
                $output .= '<li><strong>' . $term->name . '</strong></li>';
            }
        }
        $output .= '
            </ul>
        </li>';
    }
    return $output;
}
