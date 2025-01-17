<?php

add_action('wp_footer', 'miShowToasts');

/**
 * miShowToasts
 *
 * @return void
 */
function miShowToasts()
{
    $output = '';
    $output .= '<div class="toast-container bottom-0 end-0 p-3">';

    // Mensagem de successo de login
    $mi_login_success_message = isset($_SESSION['mi_login_success_message']) && $_SESSION['mi_login_success_message'] ? $_SESSION['mi_login_success_message'] : null;

    if ($mi_login_success_message) {
        $output .= miToastsHtml($mi_login_success_message);
        unset($_SESSION['mi_login_success_message']);
    }

    // Mensagem de successo de registro de novo usuário
    $mi_register_new_user_success_message = isset($_SESSION['mi_register_new_user_success_message']) && $_SESSION['mi_register_new_user_success_message'] ? $_SESSION['mi_register_new_user_success_message'] : null;

    if ($mi_register_new_user_success_message) {
        $output .= miToastsHtml($mi_register_new_user_success_message);
        unset($_SESSION['mi_register_new_user_success_message']);
    }

    $output .= '</div>';
    echo $output;
}

