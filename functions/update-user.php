<?php

add_action('admin_post_mi_update_user_form', 'mi_update_user_form_handle');
add_action('admin_post_nopriv_mi_update_user_form', 'mi_update_user_form_handle');

/**
 * mi_update_user_handle
 *
 * @return void
 */
function mi_update_user_form_handle()
{
    nocache_headers();
    $account_page_id = mi_get_option('mi_account_page');
    $account_page_url = $account_page_id ? get_page_link($account_page_id) : get_home_url();
    unset($_SESSION['mi_update_user_error_message']);

    if (!isset($_POST['mi_form_update_user_nonce']) || !wp_verify_nonce($_POST['mi_form_update_user_nonce'], 'mi_form_update_user_nonce')) {

        $_SESSION['mi_update_user_error_message'] = __('Não foi possível validar a requisição.', 'mi');
        wp_safe_redirect($account_page_url);
        exit;
    }

    if (!isset($_POST['action']) || $_POST['action'] !== 'mi_update_user_form') {

        $_SESSION['mi_update_user_error_message'] = __('Formulário inválido.', 'mi');
        wp_safe_redirect($account_page_url);
        exit;
    }

    if (!isset($_POST['user_id']) || !$_POST['user_id']) {

        $_SESSION['mi_update_user_error_message'] = __('ID do usuário inválido.', 'mi');
        wp_safe_redirect($account_page_url);
        exit;
    }
    $user_id = $_POST['user_id'];

    $check_user_exists = get_user_by('id', $user_id);
    if (!$check_user_exists) {

        $_SESSION['mi_update_user_error_message'] = __('Usuário inválido.', 'mi');
        wp_safe_redirect($account_page_url);
        exit;
    }

    $user_name = (isset($_POST['user_name']) && $_POST['user_name']) ? sanitize_text_field($_POST['user_name']) : null;

    $user_surname = (isset($_POST['user_surname']) && $_POST['user_surname']) ? sanitize_text_field($_POST['user_surname']) : null;

    $user_email = (isset($_POST['user_email']) && $_POST['user_email']) ? sanitize_email($_POST['user_email']) : null;

    $user_password = (isset($_POST['user_pass']) && $_POST['user_pass']) ? $_POST['user_pass'] : null;

    $userdata = array();
    $userdata['ID'] = $user_id;

    if ($user_name) {
        $userdata['user_nicename'] = $user_name;
        $userdata['display_name'] = $user_name;
        $userdata['nickname'] = $user_name;
        $userdata['first_name'] = $user_name;
    }

    if ($user_surname) {
        $userdata['last_name'] = $user_surname;
    }

    if ($user_email) {
        $userdata['user_email'] = $user_email;
    }

    if ($user_password) {
        $userdata['user_pass'] = $user_password;
    }

    $update_user_result = wp_update_user($userdata);

    if (is_wp_error($update_user_result)) {
        $error_string = $update_user_result->get_error_message() ? $update_user_result->get_error_message() : __('Ocorreu um erro ao tentar atualizar os dados do usuário. Revise os dados inseridos e tente novamente.', 'mi');
        $_SESSION['mi_update_user_error_message'] = $error_string;
        wp_safe_redirect($account_page_url);
        exit;
    }

    $user = get_user_by('id', $update_user_result);

    $_SESSION['mi_update_user_success_message'] = wp_sprintf(__('Dados do usuário %s atualizados com sucesso!', 'mi'), $user->display_name);

    echo '<h3>' . __('Dados do usuário atualizados com sucesso! Por favor, aguarde enquanto está sendo redicionando...', 'mi') . '</p>';

    wp_safe_redirect($account_page_url);
    exit;
}

add_action('update_user_messages', 'mi_update_user_error_message');

/**
 * mi_update_user_error_message
 *
 * @return void
 */
function mi_update_user_error_message()
{
    // Mensagens de erro de atualização do usuário
    if (isset($_SESSION['mi_update_user_error_message']) && $_SESSION['mi_update_user_error_message']) {
        echo mi_dismissible_alert('danger', $_SESSION['mi_update_user_error_message']);
        unset($_SESSION['mi_update_user_error_message']);
    }
}

add_action('update_user_messages', 'mi_update_user_success_message');

/**
 * mi_update_user_success_message
 *
 * @return void
 */
function mi_update_user_success_message()
{
    // Mensagens de successo de atualização do usuário
    if (isset($_SESSION['mi_update_user_success_message']) && $_SESSION['mi_update_user_success_message']) {
        echo mi_dismissible_alert('success', $_SESSION['mi_update_user_success_message']);
        unset($_SESSION['mi_update_user_success_message']);
    }
}
