<?php

add_action('wp_ajax_nopriv_mi_contact_form', 'mi_contact_form');
add_action('wp_ajax_mi_contact_form', 'mi_contact_form');

function mi_contact_form()
{
    if (!isset($_POST['mi_contact_form_nonce']) || !wp_verify_nonce($_POST['mi_contact_form_nonce'], 'mi_contact_form_nonce')) {
        wp_send_json_error(array('msg' => __('Não foi possível validar a requisição.', 'mi')), 200);
    }

    $fields = array('nome', 'email', 'mensagem');
    $data = [];
    foreach ($fields as $name) {
        $data[$name] = mi_get_field_value($name);
    }

    $send_to_emails = mi_get_option('mi_contact_form_emails');
    $to = $send_to_emails;
    $subject = sprintf(__('Nova mensagem de contato | %s', 'mi'), get_bloginfo('name'));
    $body = '';
    $body .= '<p>' . sprintf(__('Nome: "%s"', 'mi'), $data['nome']) . '</p>';
    $body .= '<p>' . sprintf(__('Email: "%s"', 'mi'), $data['email']) . '</p>';
    $body .= '<p>' . sprintf(__('Mensagem: "%s"', 'mi'), $data['mensagem']) . '</p>';
    $send_email_notification = mi_mail($to, $subject, $body);

    if (!$send_email_notification) {
        wp_send_json_error(array('msg' => __('Ocorreu um erro ao tentar enviar a sua mensagem.', 'mi')), 200);
    }

    $response = array(
        'msg'                   => __('Mensagem enviada com sucesso!', 'mi'),
    );

    wp_send_json_success($response);
}
