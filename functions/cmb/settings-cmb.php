<?php

add_action('cmb2_admin_init', 'mi_register_theme_options_metabox');
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function mi_register_theme_options_metabox()
{

    /**
     * Registers options page menu item and form.
     */
    $cmb_options = new_cmb2_box(array(
        'id'           => 'mi_theme_options_page',
        'title'        => esc_html__('Configurações Morada Ideal', 'mi'),
        'object_types' => array('options-page'),

        /*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */

        'option_key'      => 'mi_theme_options', // The option key and admin menu page slug.
        'icon_url'        => 'dashicons-admin-generic', // Menu icon. Only applicable if 'parent_slug' is left empty.
        // 'menu_title'              => esc_html__( 'Options', 'mi' ), // Falls back to 'title' (above).
        // 'parent_slug'             => 'themes.php', // Make options page a submenu item of the themes menu.
        // 'capability'              => 'manage_options', // Cap required to view options-page.
        // 'position'                => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
        // 'admin_menu_hook'         => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
        // 'priority'                => 10, // Define the page-registration admin menu hook priority.
        // 'display_cb'              => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
        // 'save_button'             => esc_html__( 'Save Theme Options', 'mi' ), // The text for the options-page save button. Defaults to 'Save'.
        // 'disable_settings_errors' => true, // On settings pages (not options-general.php sub-pages), allows disabling.
        // 'message_cb'              => 'mi_options_page_message_callback',
        // 'tab_group'               => '', // Tab-group identifier, enables options page tab navigation.
        // 'tab_title'               => null, // Falls back to 'title' (above).
        // 'autoload'                => false, // Defaults to true, the options-page option will be autloaded.
    ));

    $cmb_options->add_field(array(
        'name'    => esc_html__('E-mails que receberão as mensagens do formulário de contato.', 'mi'),
        'id'      => 'mi_contact_form_emails',
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
