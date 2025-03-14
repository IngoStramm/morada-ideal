<?php

add_action('cmb2_admin_init', 'mi_register_main_options_metabox');

function mi_register_main_options_metabox()
{

    $cmb_options = new_cmb2_box(array(
        'id'           => 'mi_theme_options_page',
        'title'        => esc_html__('Configurações Morada Ideal', 'mi'),
        'object_types' => array('options-page'),

        'option_key'      => 'mi_theme_options',
        'icon_url'        => 'dashicons-admin-generic',
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('E-mails que receberão as mensagens do formulário de contato.', 'mi'),
        'id'      => 'mi_contact_form_emails',
        'type'    => 'text_email',
        'repeatable'    => true,
        'required'      => true
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('E-mails que receberão as inscrições de newsletter.', 'mi'),
        'id'      => 'mi_newsletter_form_emails',
        'type'    => 'text_email',
        'repeatable'    => true,
        'required'      => true
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Página de login', 'mi'),
        'id'      => 'mi_login_page',
        'type'    => 'select',
        'options' => function () {
            $pages = mi_get_pages();
            $array = [];
            $array[''] = __('Selecione uma página', 'mi');
            foreach ($pages as $id => $title) {
                $array[$id] = $title;
            }
            return $array;
        },
        'required'      => true
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Página de cadastro de novo usuário', 'mi'),
        'id'      => 'mi_new_user_page',
        'type'    => 'select',
        'options' => function () {
            $pages = mi_get_pages();
            $array = [];
            $array[''] = __('Selecione uma página', 'mi');
            foreach ($pages as $id => $title) {
                $array[$id] = $title;
            }
            return $array;
        },
        'required'      => true
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Página de senha perdida', 'mi'),
        'id'      => 'mi_lostpassword_page',
        'type'    => 'select',
        'options' => function () {
            $pages = mi_get_pages();
            $array = [];
            $array[''] = __('Selecione uma página', 'mi');
            foreach ($pages as $id => $title) {
                $array[$id] = $title;
            }
            return $array;
        },
        'required'      => true
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Página de redefinição de senha', 'mi'),
        'id'      => 'mi_resetpassword_page',
        'type'    => 'select',
        'options' => function () {
            $pages = mi_get_pages();
            $array = [];
            $array[''] = __('Selecione uma página', 'mi');
            foreach ($pages as $id => $title) {
                $array[$id] = $title;
            }
            return $array;
        },
        'required'      => true
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Página da conta do usuário', 'mi'),
        'id'      => 'mi_account_page',
        'type'    => 'select',
        'options' => function () {
            $pages = mi_get_pages();
            $array = [];
            $array[''] = __('Selecione uma página', 'mi');
            foreach ($pages as $id => $title) {
                $array[$id] = $title;
            }
            return $array;
        },
        'required'      => true
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Página de cadastro/edição do imóvel', 'mi'),
        'id'      => 'mi_edit_imovel_page',
        'type'    => 'select',
        'options' => function () {
            $pages = mi_get_pages();
            $array = [];
            $array[''] = __('Selecione uma página', 'mi');
            foreach ($pages as $id => $title) {
                $array[$id] = $title;
            }
            return $array;
        },
        'required'      => true
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Página Meus Imóveis', 'mi'),
        'id'      => 'mi_my_imovel_page',
        'type'    => 'select',
        'options' => function () {
            $pages = mi_get_pages();
            $array = [];
            $array[''] = __('Selecione uma página', 'mi');
            foreach ($pages as $id => $title) {
                $array[$id] = $title;
            }
            return $array;
        },
        'required'      => true
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Página Termos de Serviços', 'mi'),
        'id'      => 'mi_service_terms',
        'type'    => 'select',
        'options' => function () {
            $pages = mi_get_pages();
            $array = [];
            $array[''] = __('Selecione uma página', 'mi');
            foreach ($pages as $id => $title) {
                $array[$id] = $title;
            }
            return $array;
        },
        'required'      => true
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Página Política de Cookies', 'mi'),
        'id'      => 'mi_cookies_policy',
        'type'    => 'select',
        'options' => function () {
            $pages = mi_get_pages();
            $array = [];
            $array[''] = __('Selecione uma página', 'mi');
            foreach ($pages as $id => $title) {
                $array[$id] = $title;
            }
            return $array;
        },
        'required'      => true
    ));

    $cmb_options->add_field(array(
        'name' => esc_html__('Imagem padrão', 'mi'),
        'desc' => esc_html__('A imagem padrão será exibido quando o comprador não definir uma imagem para o anúncio.', 'mi'),
        'id'   => 'mi_anuncio_default_image',
        'type' => 'file',
        'attributes' => array(
            'accept' => '.jpg,.jpeg,.png'
        )
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Google Maps Key', 'mi'),
        'description'    => 'Acesse o <strong>Google Console</strong> para ativar a API e criar a Key: <a href="https://console.cloud.google.com/" target="_blank">clique aqui</a>.',
        'id'      => 'gmaps_key',
        'type'    => 'text',
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Geocode Key', 'mi'),
        'description'    => 'Acesse o <strong>Google Console</strong> para ativar a API e criar a Key: <a href="https://console.cloud.google.com/" target="_blank">clique aqui</a>.',
        'id'      => 'geocode_key',
        'type'    => 'text',
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Maps Static API Key', 'mi'),
        'description'    => 'Acesse o <strong>Google Console</strong> para ativar a API e criar a Key: <a href="https://console.cloud.google.com/" target="_blank">clique aqui</a>.',
        'id'      => 'mapstatic_key',
        'type'    => 'text',
    ));
}

add_action('cmb2_admin_init', 'mi_register_site_info_options_metabox');

function mi_register_site_info_options_metabox()
{

    $cmb_options = new_cmb2_box(array(
        'id'           => 'mi_site_info_options_page',
        'title'        => esc_html__('Informações da Empresa', 'mi'),
        'object_types' => array('options-page'),
        'option_key'      => 'mi_site_info_options',
        'icon_url'        => 'dashicons-admin-generic',
        'menu_title'              => esc_html__('Informações da Empresa', 'mi'),
        'parent_slug'             => 'mi_theme_options',
    ));

    $cmb_options->add_field(array(
        'name' => esc_html__('Logo do rodapé', 'mi'),
        'id'   => 'mi_footer_logo',
        'type' => 'file',
        'attributes' => array(
            'accept' => '.jpg,.jpeg,.png,.svg'
        )
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Texto curto sobre a empresa', 'mi'),
        'description'    => 'Texto exibido no rodapé, na coluna com o endereço e dados de contato da empresa.',
        'id'      => 'mi_company_text',
        'type'    => 'text',
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Endereço da empresa', 'mi'),
        'id'      => 'mi_company_address',
        'type'    => 'text',
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Telefone da empresa', 'mi'),
        'id'      => 'mi_company_phone',
        'type'    => 'text',
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('E-mail da empresa', 'mi'),
        'id'      => 'mi_company_email',
        'type'    => 'text_email',
    ));
}

add_action('cmb2_admin_init', 'mi_register_site_social_media_options_metabox');

function mi_register_site_social_media_options_metabox()
{

    $cmb_options = new_cmb2_box(array(
        'id'           => 'mi_site_social_media_options_page',
        'title'        => esc_html__('Redes Sociais', 'mi'),
        'object_types' => array('options-page'),
        'option_key'      => 'mi_site_social_media_options',
        'icon_url'        => 'dashicons-admin-generic',
        'menu_title'              => esc_html__('Redes Sociais da Empresa', 'mi'),
        'parent_slug'             => 'mi_theme_options',
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Url do Facebook da Empresa', 'mi'),
        'description'    => 'Url para o perfil da empresa no Facebook.',
        'id'      => 'mi_facebook_url',
        'type'    => 'text_url',
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Url do Linkedin da Empresa', 'mi'),
        'description'    => 'Url para o perfil da empresa no Linkedin.',
        'id'      => 'mi_linkedin_url',
        'type'    => 'text_url',
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Url do X (antigo Twitter) da Empresa', 'mi'),
        'description'    => 'Url para o perfil da empresa no X (antigo Twitter).',
        'id'      => 'mi_x_url',
        'type'    => 'text_url',
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Url do Pinterest da Empresa', 'mi'),
        'description'    => 'Url para o perfil da empresa no Pinterest.',
        'id'      => 'mi_pinterest_url',
        'type'    => 'text_url',
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Url do Instagram da Empresa', 'mi'),
        'description'    => 'Url para o perfil da empresa no Instagram.',
        'id'      => 'mi_instagram_url',
        'type'    => 'text_url',
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('Url do Youtube da Empresa', 'mi'),
        'description'    => 'Url para o perfil da empresa no Youtube.',
        'id'      => 'mi_youtube_url',
        'type'    => 'text_url',
    ));
}
