<?php

add_action('admin_post_mi_imovel_form', 'mi_imovel_form_handle');
add_action('admin_post_nopriv_mi_imovel_form', 'mi_imovel_form_handle');

function mi_imovel_form_handle()
{

    nocache_headers();
    $edit_novo_imovel_link = mi_get_page_url('editimovel');
    $post_id = isset($_REQUEST['post_id']) && $_REQUEST['post_id'] ? $_REQUEST['post_id'] : null;
    if ($post_id) {
        $edit_novo_imovel_link .= '?imovel_id=' . $post_id;
    }
    unset($_SESSION['mi_imovel_error_message']);

    if (!isset($_POST['mi_form_imovel_nonce']) || !wp_verify_nonce($_POST['mi_form_imovel_nonce'], 'mi_form_imovel_nonce')) {

        $_SESSION['mi_imovel_error_message'] = __('Não foi possível validar a requisição.', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }

    if (!isset($_POST['action']) || $_POST['action'] !== 'mi_imovel_form') {

        $_SESSION['mi_imovel_error_message'] = __('Formulário inválido.', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }

    if (!isset($_POST['user_id']) || !$_POST['user_id']) {

        $_SESSION['mi_imovel_error_message'] = __('ID do usuário inválido.', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }

    $user_id = $_POST['user_id'];
    $check_user_exists = get_user_by('id', $user_id);
    if (!$check_user_exists) {

        $_SESSION['mi_imovel_error_message'] = __('Usuário inválido.', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }

    if (!isset($_POST['imovel_title']) || !$_POST['imovel_title']) {

        $_SESSION['mi_imovel_error_message'] = __('Título inválido.', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $title = wp_strip_all_tags($_POST['imovel_title']);

    if (!isset($_POST['imovel_price']) || !$_POST['imovel_price']) {

        $_SESSION['mi_imovel_error_message'] = __('Preço inválido.', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $price = wp_strip_all_tags($_POST['imovel_price']);

    if (!isset($_POST['imovel-content']) || !$_POST['imovel-content']) {

        $_SESSION['mi_imovel_error_message'] = __('Descrição inválida.', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $content = $_POST['imovel-content'];

    if (!isset($_POST['operacao-term']) || !$_POST['operacao-term']) {

        $_SESSION['mi_imovel_error_message'] = __('Operação inválida.', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $operacao_term_id = isset($_POST['operacao-term']) && $_POST['operacao-term'] ? $_POST['operacao-term'] : null;

    if (!isset($_POST['tipo-terms']) || !$_POST['tipo-terms']) {

        $_SESSION['mi_imovel_error_message'] = __('Tipo(s) inválido(s).', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $tipos_term_id = isset($_POST['tipo-terms']) && $_POST['tipo-terms'] ? $_POST['tipo-terms'] : null;

    if (!isset($_POST['regiao-terms']) || !$_POST['regiao-terms']) {

        $_SESSION['mi_imovel_error_message'] = __('Região(ões) inválida(s).', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $regioes_term_id = isset($_POST['regiao-terms']) && $_POST['regiao-terms'] ? $_POST['regiao-terms'] : null;

    if (!isset($_POST['caracteristicas-gerais-terms']) || !$_POST['caracteristicas-gerais-terms']) {

        $_SESSION['mi_imovel_error_message'] = __('Característica(s) Geral(is) inválida(s).', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $caracteristicas_gerais_term_id = isset($_POST['caracteristicas-gerais-terms']) && $_POST['caracteristicas-gerais-terms'] ? $_POST['caracteristicas-gerais-terms'] : null;

    if (!isset($_POST['imovel_area_bruta']) || !$_POST['imovel_area_bruta']) {

        $_SESSION['mi_imovel_error_message'] = __('Metragem inválida.', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $imovel_area_bruta = isset($_POST['imovel_area_bruta']) && $_POST['imovel_area_bruta'] ? $_POST['imovel_area_bruta'] : null;

    if (!isset($_POST['tipologia-terms']) || !$_POST['tipologia-terms']) {

        $_SESSION['mi_imovel_error_message'] = __('Tipologia(s) inválida(is).', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $tipologias_term_id = isset($_POST['tipologia-terms']) && $_POST['tipologia-terms'] ? $_POST['tipologia-terms'] : null;

    if (!isset($_POST['outras-denominacoes-terms']) || !$_POST['outras-denominacoes-terms']) {

        $_SESSION['mi_imovel_error_message'] = __('Outra(s) Denominação(ões) inválida(s).', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $outras_denominacoes_term_id = isset($_POST['outras-denominacoes-terms']) && $_POST['outras-denominacoes-terms'] ? $_POST['outras-denominacoes-terms'] : null;

    if (!isset($_POST['casas-de-banho-term']) || !$_POST['casas-de-banho-term']) {

        $_SESSION['mi_imovel_error_message'] = __('Casa(s) de Banho inválida(s).', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $casas_de_banho_term_id = isset($_POST['casas-de-banho-term']) && $_POST['casas-de-banho-term'] ? $_POST['casas-de-banho-term'] : null;

    if (!isset($_POST['estado-terms']) || !$_POST['estado-terms']) {

        $_SESSION['mi_imovel_error_message'] = __('Filtro(s) inválido(s).', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $estado_terms_id = isset($_POST['estado-terms']) && $_POST['estado-terms'] ? $_POST['estado-terms'] : null;

    if (!isset($_POST['filtro-terms']) || !$_POST['filtro-terms']) {

        $_SESSION['mi_imovel_error_message'] = __('Filtro(s) inválido(s).', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $filtro_terms_id = isset($_POST['filtro-terms']) && $_POST['filtro-terms'] ? $_POST['filtro-terms'] : null;

    if (!isset($_POST['andar-term']) || !$_POST['andar-term']) {

        $_SESSION['mi_imovel_error_message'] = __('Andar inválido.', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $andar_term_id = isset($_POST['andar-term']) && $_POST['andar-term'] ? $_POST['andar-term'] : null;

    if (!isset($_POST['imovel_caracteristicas-especificas']) || !$_POST['imovel_caracteristicas-especificas']) {
        mi_debug($_POST);
        $_SESSION['mi_imovel_error_message'] = __('Característica(s) específica(s) inválida(s).', 'mi');
        // wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $imovel_caracteristicas_especificas = isset($_POST['imovel_caracteristicas-especificas']) && $_POST['imovel_caracteristicas-especificas'] ? $_POST['imovel_caracteristicas-especificas'] : null;

    if (!isset($_POST['imovel_certificado_energetico']) || !$_POST['imovel_certificado_energetico']) {

        $_SESSION['mi_imovel_error_message'] = __('Certificado energético inválido.', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $imovel_certificado_energetico = isset($_POST['imovel_certificado_energetico']) && $_POST['imovel_certificado_energetico'] ? $_POST['imovel_certificado_energetico'] : null;

    if (!isset($_POST['imovel_rua']) || !$_POST['imovel_rua']) {

        $_SESSION['mi_imovel_error_message'] = __('Rua inválida.', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $imovel_rua = isset($_POST['imovel_rua']) && $_POST['imovel_rua'] ? $_POST['imovel_rua'] : null;

    if (!isset($_POST['imovel_numero']) || !$_POST['imovel_numero']) {

        $_SESSION['mi_imovel_error_message'] = __('Número inválido.', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $imovel_numero = isset($_POST['imovel_numero']) && $_POST['imovel_numero'] ? $_POST['imovel_numero'] : null;

    if (!isset($_POST['imovel_codigo_postal']) || !$_POST['imovel_codigo_postal']) {

        $_SESSION['mi_imovel_error_message'] = __('Código postal inválido.', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $imovel_codigo_postal = isset($_POST['imovel_codigo_postal']) && $_POST['imovel_codigo_postal'] ? $_POST['imovel_codigo_postal'] : null;

    if (!isset($_POST['imovel_cidade']) || !$_POST['imovel_cidade']) {

        $_SESSION['mi_imovel_error_message'] = __('Cidade inválida.', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $imovel_cidade = isset($_POST['imovel_cidade']) && $_POST['imovel_cidade'] ? $_POST['imovel_cidade'] : null;

    if (!isset($_POST['imovel_estado']) || !$_POST['imovel_estado']) {

        $_SESSION['mi_imovel_error_message'] = __('Estado inválido.', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $imovel_estado = isset($_POST['imovel_estado']) && $_POST['imovel_estado'] ? $_POST['imovel_estado'] : null;

    if (!isset($_POST['lat']) || !$_POST['lat']) {

        $_SESSION['mi_imovel_error_message'] = __('Estado inválido.', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $imovel_lat = isset($_POST['lat']) && $_POST['lat'] ? $_POST['lat'] : null;

    if (!isset($_POST['lng']) || !$_POST['lng']) {

        $_SESSION['mi_imovel_error_message'] = __('Estado inválido.', 'mi');
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    $imovel_lng = isset($_POST['lng']) && $_POST['lng'] ? $_POST['lng'] : null;

    $imovel_image = $_FILES['imovel_image'];
    // if ($imovel_image['tmp_name']) {
    //     mi_debug($imovel_image['name']);
    // }

    $imovel_galeria = $_FILES['imovel_galeria'];
    // if ($imovel_galeria['tmp_name']) {
    //     mi_debug($imovel_galeria['name']);
    // }

    // mi_debug($_FILES);
    // mi_debug($_POST);

    // Cadastra/atualiza imóvel;
    $args = array(
        'post_title'        => $title,
        'post_content'      => $content,
        'post_status'       => 'publish',
        'post_author'       => $user_id,
        'post_type'         => 'imovel',
        // 'tax_input' não funciona se o usuário não tiver permissão de 'assign_terms'
        // 'tax_input'         => array(
        //     'categoria-de-imovel'     => $terms_id,
        // ),
        'meta_input' => array(
            'imovel_valor' =>   $price,
            'imovel_area_bruta' => $imovel_area_bruta,
            'imovel_caracteristicas_especificas' => $imovel_caracteristicas_especificas,
            'imovel_certificado_energetico' => $imovel_certificado_energetico,
            'imovel_rua' => $imovel_rua,
            'imovel_numero' => $imovel_numero,
            'imovel_codigo_postal' => $imovel_codigo_postal,
            'imovel_cidade' => $imovel_cidade,
            'imovel_estado' => $imovel_estado,
            'imovel_lat' => $imovel_lat,
            'imovel_lng' => $imovel_lng,
        ),
    );

    if ($post_id) {
        $args['ID'] = $_POST['post_id'];
    }

    $novo_imovel_id = wp_insert_post($args, true);

    if (is_wp_error($novo_imovel_id)) {
        $_SESSION['mi_imovel_error_message'] = $novo_imovel_id->get_error_message();
        wp_safe_redirect($edit_novo_imovel_link);
        exit;
    }
    if (!$post_id) {
        $edit_novo_imovel_link = mi_get_page_url('editimovel') . '?imovel_id=' . $novo_imovel_id;
    }

    // atualiza termos
    $terms_id_arr = array(
        'operacao'              => $operacao_term_id,
        'tipo'                  => $tipos_term_id,
        'regiao'                => $regioes_term_id,
        'caracteristica-geral'  => $caracteristicas_gerais_term_id,
        'tipologia'             => $tipologias_term_id,
        'outras-denominacoes'   => $outras_denominacoes_term_id,
        'casas-de-banho'        => $casas_de_banho_term_id,
        'estado'                => $estado_terms_id,
        'filtro'                => $filtro_terms_id,
        'andar'                 => $andar_term_id
    );
    // Operação
    foreach ($terms_id_arr as $tax_slug => $terms_id) {
        $insert_terms = mi_atualiza_termos($terms_id, $novo_imovel_id, $tax_slug);

        if (is_wp_error($insert_terms)) {
            $_SESSION['mi_imovel_error_message'] = $insert_terms->get_error_message();
            mi_debug($insert_terms->get_error_message());
            wp_safe_redirect($edit_novo_imovel_link);
            exit;
        }
    }

    // Se for um novo anúncio ou se houve mudança na imagem
    if (!$post_id || $imovel_image['tmp_name']) {
        // $imovel_image
        // $imovel_galeria

        // post thumbnail
        if ($imovel_image['tmp_name']) {

            $filename = $imovel_image['name'];
            $file_size = $imovel_image['size'];

            if ($file_size > 2097152) {
                $_SESSION['mi_imovel_error_message'] = __('O arquivo é muito pesado, o tamanho máximo permitido é de 2MB..', 'mi');
                wp_safe_redirect($edit_novo_imovel_link);
                exit;
            }

            $upload_file = wp_upload_bits($filename, null, @file_get_contents($imovel_image['tmp_name']));
            if (!$upload_file['error']) {
                // Check the type of file. We'll use this as the 'post_mime_type'.
                $filetype = wp_check_filetype($filename, null);

                // Get the path to the upload directory.
                $wp_upload_dir = wp_upload_dir();

                // Prepare an array of post data for the attachment.
                $attachment = array(
                    'post_mime_type' => $filetype['type'],
                    'post_title'     => preg_replace('/\.[^.]+$/', '', $filename),
                    'post_content'   => '',
                    'post_status'    => 'inherit',
                    'post_parent'    => $novo_imovel_id
                );

                // Insert the attachment.
                $attach_id = wp_insert_attachment($attachment, $upload_file['file'], $novo_imovel_id);

                if (!is_wp_error($attach_id)) {
                    // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
                    require_once(ABSPATH . 'wp-admin/includes/image.php');

                    // Generate the metadata for the attachment, and update the database record.
                    $attach_data = wp_generate_attachment_metadata($attach_id, $upload_file['file']);
                    wp_update_attachment_metadata($attach_id, $attach_data);

                    set_post_thumbnail($novo_imovel_id, $attach_id);
                } else {
                    $_SESSION['mi_imovel_error_message'] = $attach_id->get_error_message();
                    wp_safe_redirect($edit_novo_imovel_link);
                    exit;
                }
            } else {
                $_SESSION['mi_imovel_error_message'] = __('Ocorreu um erro ao tentar fazer o upload do arquivo.', 'mi');
                wp_safe_redirect($edit_novo_imovel_link);
                exit;
            }
        } else {
            $default_image = mi_get_option('mi_anuncio_default_image_id');
            if ($default_image) {
                set_post_thumbnail($novo_imovel_id, $default_image);
            }
        }
    }

    // post gallery
    if ($imovel_galeria['tmp_name'][0]) {

        $count = 0;
        $imovel_galeria_urls = array();
        foreach ($imovel_galeria['tmp_name'] as $tmp_name) {
            $file = $imovel_galeria;
            $filename = $file['name'][$count];
            $file_size = $file['size'][$count];
            $file_tmp_name = $file['tmp_name'][$count];

            if ($file_size > 2097152) {
                $_SESSION['mi_imovel_error_message'] = sprintf(__('O arquivo %s é muito pesado, o tamanho máximo permitido é de 2MB..', 'mi'), $filename);
                wp_safe_redirect($edit_novo_imovel_link);
                exit;
            }

            $upload_file = wp_upload_bits($filename, null, @file_get_contents($file_tmp_name));
            // exit;
            if (!$upload_file['error']) {
                // Check the type of file. We'll use this as the 'post_mime_type'.
                $filetype = wp_check_filetype($filename, null);

                // Get the path to the upload directory.
                $wp_upload_dir = wp_upload_dir();

                // Prepare an array of post data for the attachment.
                $attachment = array(
                    'post_mime_type' => $filetype['type'],
                    'post_title'     => preg_replace('/\.[^.]+$/', '', $filename),
                    'post_content'   => '',
                    'post_status'    => 'inherit',
                    'post_parent'    => $novo_imovel_id
                );

                // Insert the attachment.
                $attach_id = wp_insert_attachment($attachment, $upload_file['file'], $novo_imovel_id);

                if (!is_wp_error($attach_id)) {
                    // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
                    require_once(ABSPATH . 'wp-admin/includes/image.php');

                    // Generate the metadata for the attachment, and update the database record.
                    $attach_data = wp_generate_attachment_metadata($attach_id, $upload_file['file']);
                    wp_update_attachment_metadata($attach_id, $attach_data);

                    $imovel_galeria_urls[$attach_id] = wp_get_attachment_url($attach_id);
                } else {
                    $_SESSION['mi_imovel_error_message'] = $attach_id->get_error_message();
                    wp_safe_redirect($edit_novo_imovel_link);
                    exit;
                }
            } else {
                $_SESSION['mi_imovel_error_message'] = sprintf(__('Ocorreu um erro ao tentar fazer o upload do arquivo %s.', 'mi'), $filename);
                wp_safe_redirect($edit_novo_imovel_link);
                exit;
            }
            $count++;
        }

        $updated_gallery = update_post_meta($novo_imovel_id, 'imovel_galeria', $imovel_galeria_urls);
        if (!$updated_gallery) {
            $_SESSION['mi_imovel_error_message'] = __('Ocorreu um erro ao tentar atualizar a galeria de imagens.', 'mi');
            wp_safe_redirect($edit_novo_imovel_link);
            exit;
        }
    }


    // atualizar imagens OK
    // testar se todos os campos estão salvando
    // verificar formulário para novo imóvel

    if ($post_id) {
        $_SESSION['mi_imovel_success_message'] = __('Imóvel atualizado com sucesso!', 'mi');
        echo '<h3>' . __('Imóvel atualizado com sucesso! Por favor, aguarde enquanto está sendo redicionando...', 'mi') . '</p>';
    } else {
        $_SESSION['mi_imovel_success_message'] = __('Novo imóvel criado com sucesso!', 'mi');
        echo '<h3>' . __('Novo imóvel criado com sucesso! Por favor, aguarde enquanto está sendo redicionando...', 'mi') . '</p>';
    }

    wp_safe_redirect($edit_novo_imovel_link);
    exit;
}
