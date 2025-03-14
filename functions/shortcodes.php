<?php

add_shortcode('mi_editor', 'mi_editor');

function mi_editor($atts)
{
    $a = shortcode_atts(array(
        'name' => 'mi_editor',
        'tabindex' => -1,
        'post_id' => ''
    ), $atts);
    $editor_id = 'mi_editor';
    $content = $a['post_id'] ? get_the_content(null, null, $a['post_id']) : null;
    $args = array(
        'media_buttons'     => false, // This setting removes the media button.
        'textarea_name'     => $a['name'], // Set custom name.
        'textarea_rows'     => get_option('default_post_edit_rows', 10), //Determine the number of rows.
        'quicktags'         => false, // Remove view as HTML button.
        'tabindex'          => $a['tabindex'],
        'required'          => true,
        'teeny'             => false,
        'tinymce'           => array(
            'toolbar1'      => 'bold,italic,underline,separator,alignleft,aligncenter,alignright,separator,undo,redo',
            'toolbar2'      => '',
            'toolbar3'      => '',
        ),
    );
    return wp_editor($content, $editor_id, $args);
}

add_shortcode('contact_form', 'mi_contact_form_shortcode');

function mi_contact_form_shortcode($atts)
{
    $a = shortcode_atts(array(
        'name' => 'mi_editor',
        'tabindex' => -1,
        'post_id' => ''
    ), $atts);
    $nome = '';
    $email = '';
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        $nome = $user->first_name && $user->last_name ?
            $user->first_name . ' ' . $user->last_name :
            $user->display_name;
        $email = $user->user_email;
    }
    $mi_add_contact_form_nonce = wp_create_nonce('mi_contact_form_nonce');
    $form = '';
    $form .=
        '<form class="mi-contact-form needs-validation" role="search" action="' . esc_url(admin_url('admin-post.php')) . '" method="post" id="mi-contact-form" novalidate>

            <div class="row">

                <div class="mb-3">
                    <label for="nome" class="form-label">' . __('Nome', 'mi') . '</label>
                    <input type="text" class="form-control" name="nome" id="nome" value ="' . $nome . '" autocomplete="off" aria-autocomplete="list" aria-label="' . __('Nome', 'mi') . '" tabindex="1" required>
                    <div class="invalid-feedback">' . __('Campo obrigatório', 'mi') . '</div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">' . __('E-mail', 'mi') . '</label>
                    <input type="text" class="form-control" name="email" id="email" value="' . $email . '" autocomplete="off" aria-autocomplete="list" aria-label="' . __('E-mail', 'mi') . '" tabindex="2" required>
                    <div class="invalid-feedback">' . __('Campo obrigatório', 'mi') . '</div>
                </div>

                <div class="mb-3">
                    <label for="mensagem" class="form-label">' . __('Mensagem', 'mi') . '</label>
                    <textarea class="form-control" name="mensagem" id="mensagem" rows="5" aria-autocomplete="list" aria-label="' . __('Mensagem', 'mi') . '" tabindex="3" required></textarea>
                    <div class="invalid-feedback">' . __('Campo obrigatório', 'mi') . '</div>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" tabindex="4">' . __('Enviar', 'mi') . '</button>
                </div>

            </div>

            <input type="hidden" name="mi_contact_form_nonce" value="' . $mi_add_contact_form_nonce . '" />
            <input type="hidden" value="mi_contact_form" name="action">

        </form>
        <div id="contact-form-alert-placeholder"></div>';

    return $form;
}

add_shortcode('newsletter_form', 'mi_newsletter_form_shortcode');

function mi_newsletter_form_shortcode($atts)
{
    $a = shortcode_atts(array(
        'name' => 'mi_editor',
        'tabindex' => -1,
        'post_id' => ''
    ), $atts);
    $email = '';
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        $email = $user->user_email;
    }
    $mi_add_newsletter_form_nonce = wp_create_nonce('mi_newsletter_form_nonce');
    $form = '';
    $form .=
        '<form class="mi-newsletter-form needs-validation" role="search" action="' . esc_url(admin_url('admin-post.php')) . '" method="post" id="mi-newsletter-form" novalidate>

            <div class="newsletter-input-group">
                <input type="text" class="form-control newsletter-input" name="email" id="email" value="' . $email . '" placeholder="' . __('Seu endereço de email', 'mi') . '" autocomplete="off" aria-autocomplete="list" aria-label="' . __('E-mail', 'mi') . '" required>
                <button type="submit" class="newsletter-btn">' . mi_get_icon('arrow') . '</button>
                <div class="invalid-feedback">' . __('Campo obrigatório', 'mi') . '</div>
            </div>

            <input type="hidden" name="mi_newsletter_form_nonce" value="' . $mi_add_newsletter_form_nonce . '" />
            <input type="hidden" value="mi_newsletter_form" name="action">

        </form>
        <div id="newsletter-form-alert-placeholder"></div>';

    return $form;
}

add_shortcode('anunciante_contact_form', 'mi_anunciante_contact_form_shortcode');

function mi_anunciante_contact_form_shortcode($atts)
{
    $a = shortcode_atts(array(
        'post_id' => '',
        'author_id' => ''
    ), $atts);
    $nome = '';
    $email = '';
    $phone = '';
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        $nome = $user->first_name && $user->last_name ?
            $user->first_name . ' ' . $user->last_name :
            $user->display_name;
        $email = $user->user_email;
        $phone = get_user_meta($user->ID, 'mi_user_phone', true);
    }
    $mi_add_anunciante_contact_form_nonce = wp_create_nonce('mi_anunciante_contact_form_nonce');
    $form = '';
    $form .=
        '<form class="mi-anunciante-contact-form needs-validation" role="search" action="' . esc_url(admin_url('admin-post.php')) . '" method="post" id="mi-anunciante-contact-form" novalidate>

            <div class="row">

                <div class="mb-3">
                    <label for="nome" class="form-label">' . __('Nome', 'mi') . '</label>
                    <input type="text" class="form-control" name="nome" id="nome" value ="' . $nome . '" autocomplete="off" aria-autocomplete="list" aria-label="' . __('Nome', 'mi') . '" tabindex="1" required>
                    <div class="invalid-feedback">' . __('Campo obrigatório', 'mi') . '</div>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">' . __('Telefone', 'mi') . '</label>
                    <input type="tel" class="form-control" name="phone" id="phone" value="' . $phone . '" autocomplete="off" aria-autocomplete="list" aria-label="' . __('Telefone', 'mi') . '" tabindex="2" required>
                    <div class="invalid-feedback">' . __('Campo obrigatório', 'mi') . '</div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">' . __('E-mail', 'mi') . '</label>
                    <input type="text" class="form-control" name="email" id="email" value="' . $email . '" autocomplete="off" aria-autocomplete="list" aria-label="' . __('E-mail', 'mi') . '" tabindex="2" required>
                    <div class="invalid-feedback">' . __('Campo obrigatório', 'mi') . '</div>
                </div>

                <div class="mb-3">
                    <label for="mensagem" class="form-label">' . __('Mensagem', 'mi') . '</label>
                    <textarea class="form-control" name="mensagem" id="mensagem" rows="5" aria-autocomplete="list" aria-label="' . __('Mensagem', 'mi') . '" tabindex="3" required></textarea>
                    <div class="invalid-feedback">' . __('Campo obrigatório', 'mi') . '</div>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-warning has-icon" tabindex="4">' . __('Enviar', 'mi') . mi_get_icon('arrow-right') . '</button>
                </div>

            </div>

            <input type="hidden" name="mi_anunciante_contact_form_nonce" value="' . $mi_add_anunciante_contact_form_nonce . '" />
            <input type="hidden" value="mi_anunciante_contact_form" name="action">
            <input type="hidden" value="' . $a['author_id'] . '" name="author_id">
            <input type="hidden" value="' . $a['post_id'] . '" name="post_id">

        </form>
        <div id="anunciante-contact-form-alert-placeholder"></div>';

    return $form;
}
