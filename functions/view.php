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
    $output = '';
    $output .= '
    <div class="mb-3 autocomplete-wrapper">
        <label class="form-label">' . __('Pesquisar endereço', 'mi') . '</label>
        <div class="input-group">
            <div class="form-floating">
                <input type="search" class="form-control form-control-sm search autocomplete" id="autocomplete" name="s" tabindex="17">
                <label for="autocomplete" class="form-label">' . __('Endereço do imóvel', 'mi') . '</label>
            </div>
            <span class="input-group-text">' . mi_get_icon('search') . '</span>
        </div>
        <div id="autocomplete-message" class="autocomplete-message">' . __('Digite um endereço válido para fazer a pesquisa.', 'mi') . '</div>
        <input type="hidden" value="' . $imovel_lat . '" name="lat" />
        <input type="hidden" value="' . $imovel_lng . '" name="lng" />
    </div>
    ';
    return $output;
}
