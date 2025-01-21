<?php
$post_id = isset($_REQUEST['imovel_id']) && $_REQUEST['imovel_id'] ? $_REQUEST['imovel_id'] : null;

$operacao_terms = get_terms(array(
    'taxonomy'   => 'operacao',
    'hide_empty' => false,
));

$tipo_terms = get_terms(array(
    'taxonomy'   => 'tipo',
    'hide_empty' => false,
));

$regiao_terms = get_terms(array(
    'taxonomy'   => 'regiao',
    'hide_empty' => false,
));

$caracteristica_geral_terms = get_terms(array(
    'taxonomy'   => 'caracteristica-geral',
    'hide_empty' => false,
));

$tipologia_terms = get_terms(array(
    'taxonomy'   => 'tipologia',
    'hide_empty' => false,
));

$outras_denominacoes_terms = get_terms(array(
    'taxonomy'   => 'outras-denominacoes',
    'hide_empty' => false,
));

$casas_de_banho_terms = get_terms(array(
    'taxonomy'   => 'casas-de-banho',
    'hide_empty' => false,
));

$estado_terms = get_terms(array(
    'taxonomy'   => 'estado',
    'hide_empty' => false,
));

$filtro_terms = get_terms(array(
    'taxonomy'   => 'filtro',
    'hide_empty' => false,
));

$andar_terms = get_terms(array(
    'taxonomy'   => 'andar',
    'hide_empty' => false,
));

$user = wp_get_current_user();
$user_id = $user->get('id');
$account_page_id = mi_get_option('mi_account_page');
$redirect_to = $account_page_id ? get_page_link($account_page_id) : get_home_url();
$mi_add_form_new_imovel_nonce = wp_create_nonce('mi_form_imovel_nonce');

$post = get_post($post_id);
$title = $post_id ? get_the_title($post_id) : null;
$price = $post_id ? get_post_meta($post_id, 'imovel_valor', true) : null;
$metragem = $post_id ? get_post_meta($post_id, 'imovel_metragem', true) : null;
$imovel_galeria = $post_id ? get_post_meta($post_id, 'imovel_galeria', true) : array();
$imovel_rua = $post_id ? get_post_meta($post_id, 'imovel_rua', true) : null;
$imovel_numero = $post_id ? get_post_meta($post_id, 'imovel_numero', true) : null;
$imovel_codigo_postal = $post_id ? get_post_meta($post_id, 'imovel_codigo_postal', true) : null;
$imovel_cidade = $post_id ? get_post_meta($post_id, 'imovel_cidade', true) : null;

$operacao_post_terms = $post_id ? get_the_terms($post_id, 'operacao') : array();
$operacao_post_terms_id = array();
if (is_array($operacao_post_terms)) {
    foreach ($operacao_post_terms as $post_term) {
        $operacao_post_terms_id[] = $post_term->term_id;
    }
}

$tipo_post_terms = $post_id ? get_the_terms($post_id, 'tipo') : array();
$tipo_post_terms_id = array();
if (is_array($tipo_post_terms)) {
    foreach ($tipo_post_terms as $post_term) {
        $tipo_post_terms_id[] = $post_term->term_id;
    }
}

$regiao_post_terms = $post_id ? get_the_terms($post_id, 'regiao') : array();
$regiao_post_terms_id = array();
if (is_array($regiao_post_terms)) {
    foreach ($regiao_post_terms as $post_term) {
        $regiao_post_terms_id[] = $post_term->term_id;
    }
}

$caracteristica_geral_post_terms = $post_id ? get_the_terms($post_id, 'caracteristica-geral') : array();
$caracteristica_geral_post_terms_id = array();
if (is_array($caracteristica_geral_post_terms)) {
    foreach ($caracteristica_geral_post_terms as $post_term) {
        $caracteristica_geral_post_terms_id[] = $post_term->term_id;
    }
}

$tipologia_post_terms = $post_id ? get_the_terms($post_id, 'tipologia') : array();
$tipologia_post_terms_id = array();
if (is_array($tipologia_post_terms)) {
    foreach ($tipologia_post_terms as $post_term) {
        $tipologia_post_terms_id[] = $post_term->term_id;
    }
}

$outras_denominacoes_post_terms = $post_id ? get_the_terms($post_id, 'outras-denominacoes') : array();
$outras_denominacoes_post_terms_id = array();
if (is_array($outras_denominacoes_post_terms)) {
    foreach ($outras_denominacoes_post_terms as $post_term) {
        $outras_denominacoes_post_terms_id[] = $post_term->term_id;
    }
}

$casas_de_banho_post_terms = $post_id ? get_the_terms($post_id, 'casas-de-banho') : array();
$casas_de_banho_post_terms_id = array();
if (is_array($casas_de_banho_post_terms)) {
    foreach ($casas_de_banho_post_terms as $post_term) {
        $casas_de_banho_post_terms_id[] = $post_term->term_id;
    }
}

$estado_post_terms = $post_id ? get_the_terms($post_id, 'estado') : array();
$estado_post_terms_id = array();
if (is_array($estado_post_terms)) {
    foreach ($estado_post_terms as $post_term) {
        $estado_post_terms_id[] = $post_term->term_id;
    }
}

$filtro_post_terms = $post_id ? get_the_terms($post_id, 'filtro') : array();
$filtro_post_terms_id = array();
if (is_array($filtro_post_terms)) {
    foreach ($filtro_post_terms as $post_term) {
        $filtro_post_terms_id[] = $post_term->term_id;
    }
}

$andar_post_terms = $post_id ? get_the_terms($post_id, 'andar') : array();
$andar_post_terms_id = array();
if (is_array($andar_post_terms)) {
    foreach ($andar_post_terms as $post_term) {
        $andar_post_terms_id[] = $post_term->term_id;
    }
}

$post_thumbnail = $post_id ? get_the_post_thumbnail($post_id, array('100', '100'), array('loading' => false, 'class' => 'img-fluid rounded my-2')) : null;
$post_thumbnail_url = $post_id ? get_the_post_thumbnail_url($post_id, 'full') : null;

$imovel_caracteristicas_especificas = $post_id ? get_post_meta($post_id, 'imovel_caracteristicas_especificas', true) : array();

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <?php if (($post_id && (intval($post->post_author) !== $user_id || get_post_meta($post_id, 'mi_imovel_status', true) === 'closed'))) { ?>

                <?php get_template_part('template-parts/content/content-access-denied'); ?>

            <?php } else { ?>

                <h3><?php echo sprintf(__('Olá, %s!'), $user->display_name); ?></h3>

                <p class="mb-5"><?php _e('Nesta página, você pode criar um novo anúncio.', 'mi'); ?></p>

                <?php echo mi_account_nav('editimovel'); ?>

                <?php do_action('update_imovel_messages'); ?>

                <h3 class="mt-5 mb-3"><?php _e('Novo anúncio', 'mi'); ?></h3>

                <form name="new-imovel-form" id="new-imovel-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                    <div class="row">
                        <div class="mb-3">
                            <label for="imovel_title" class="form-label"><?php _e('Título', 'mi'); ?><span class="text-danger" data-bs-toggle="tooltip" data-bs-title="<?php _e('Campo obrigatório.', 'mi'); ?>">*</span></label>
                            <input type="text" class="form-control" id="imovel_title" name="imovel_title" tabindex="1" value="<?php echo $title ?>" required>
                            <div class=" form-text"><?php _e('Procure usar um título que seja auto-explicativo. Evite títulos desnecessariamente longos.', 'mi'); ?>
                            </div>
                            <div class="invalid-feedback"><?php _e('Campo obrigatório', 'mi'); ?></div>
                        </div>

                        <div class="mb-3">
                            <label for="imovel_price" class="form-label"><?php _e('Preço', 'mi'); ?><span class="text-danger" data-bs-toggle="tooltip" data-bs-title="<?php _e('Campo obrigatório.', 'mi'); ?>">*</span></label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">€</span>
                                <input type="text" class="form-control" id="imovel_price" name="imovel_price" aria-label="<?php _e('Apenas números', 'mi'); ?>" value="<?php echo $price; ?>" tabindex="2">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="imovel_content" class="form-label"><?php _e('Descrição', 'mi'); ?><span class="text-danger" data-bs-toggle="tooltip" data-bs-title="<?php _e('Campo obrigatório.', 'mi'); ?>">*</span></label>
                            <div class="form-text mb-2"><?php _e('Quanto mais completa for a descrição, mais fácil será o entendimento sobre o anúncio.'); ?></div>
                            <?php echo do_shortcode('[mi_editor name="imovel-content" tabindex="3" post_id="' . $post_id . '"]'); ?>
                        </div>

                        <div class="mb-3">
                            <label for="operacao-terms" class="form-label" tabindex="4"><?php _e('Operação', 'mi'); ?></label>
                            <?php echo mi_list_sort_table_terms('operacao', $operacao_terms, $operacao_post_terms_id, false); ?>
                        </div>

                        <div class="mb-3">
                            <label for="tipo-terms" class="form-label" tabindex="5"><?php _e('Tipo de imóvel', 'mi'); ?></label>
                            <?php echo mi_list_sort_table_terms('tipo', $tipo_terms, $tipo_post_terms_id); ?>
                        </div>

                        <div class="mb-3">
                            <label for="regiao-terms" class="form-label" tabindex="6"><?php _e('Regiões', 'mi'); ?></label>
                            <?php echo mi_list_sort_table_terms('regiao', $regiao_terms, $regiao_post_terms_id); ?>
                        </div>

                        <div class="mb-3">
                            <label for="caracteristicas-gerais-terms" class="form-label" tabindex="7"><?php _e('Características Gerais', 'mi'); ?></label>
                            <?php echo mi_list_sort_table_terms('caracteristicas-gerais', $caracteristica_geral_terms, $caracteristica_geral_post_terms_id); ?>
                        </div>

                        <div class="mb-3">
                            <label for="imovel_metragem" class="form-label"><?php _e('Metragem² área bruta', 'mi'); ?><span class="text-danger" data-bs-toggle="tooltip" data-bs-title="<?php _e('Campo obrigatório.', 'mi'); ?>">*</span></label>
                            <input type="number" min="0" class="form-control" id="imovel_metragem" name="imovel_metragem" tabindex="8" value="<?php echo $metragem; ?>" required>
                            <div class="invalid-feedback"><?php _e('Campo obrigatório', 'mi'); ?></div>
                        </div>

                        <div class="mb-3">
                            <label for="tipologia-terms" class="form-label" tabindex="9"><?php _e('Tipologia', 'mi'); ?></label>
                            <?php echo mi_list_sort_table_terms('tipologia', $tipologia_terms, $tipologia_post_terms_id, true); ?>
                        </div>

                        <div class="mb-3">
                            <label for="outras-denominacoes-terms" class="form-label" tabindex="10"><?php _e('Outras Denominações', 'mi'); ?></label>
                            <?php echo mi_list_sort_table_terms('outras-denominacoes', $outras_denominacoes_terms, $outras_denominacoes_post_terms_id); ?>
                        </div>

                        <div class="mb-3">
                            <label for="casas-de-banho-terms" class="form-label" tabindex="11"><?php _e('Casas de Banho', 'mi'); ?></label>
                            <?php echo mi_list_sort_table_terms('casas-de-banho', $casas_de_banho_terms, $casas_de_banho_post_terms_id, false); ?>
                        </div>

                        <div class="mb-3">
                            <label for="estado-terms" class="form-label" tabindex="12"><?php _e('Estado', 'mi'); ?></label>
                            <?php echo mi_list_sort_table_terms('estado', $estado_terms, $estado_post_terms_id); ?>
                        </div>

                        <div class="mb-3">
                            <label for="filtro-terms" class="form-label" tabindex="13"><?php _e('Mais Filtros', 'mi'); ?></label>
                            <?php echo mi_list_sort_table_terms('filtro', $filtro_terms, $filtro_post_terms_id); ?>
                        </div>

                        <div class="mb-3">
                            <label for="filtro-terms" class="form-label" tabindex="14"><?php _e('Andar', 'mi'); ?></label>
                            <?php echo mi_list_sort_table_terms('andar', $andar_terms, $andar_post_terms_id, false); ?>
                        </div>

                        <div class="mb-3">
                            <h5 for="imovel_caracteristicas-especiais"><?php _e('Características específicas', 'mi') ?></h5>
                            <div class="mi-caracteristicas-especificas-group">
                                <ul class="list-group mi-caracteristicas-especificas-group-list">
                                    <?php $count = 1; ?>
                                    <?php if (count($imovel_caracteristicas_especificas) <= 0) { ?>
                                        <li class="mi-caracteristicas-especificas-group-item list-group-item" id="mi-caracteristicas-especificas-group-item-<?php echo $count; ?>" data-caracteristicas-especificas-group-item-id="<?php echo $count; ?>">
                                            <label for=" imovel_caracteristicas-especificas-<?php echo $count; ?>" class="form-label"><?php _e('Característica', 'mi') ?></label>
                                            <input type="text" class="form-control" id="imovel_caracteristicas-especificas-<?php echo $count; ?>" name="imovel_caracteristicas-especificas[]" tabindex="15">
                                            <div class="invalid-feedback"><?php _e('Campo obrigatório', 'mi'); ?></div>
                                            <?php  ?>
                                            <div class="d-flex">
                                                <a href="#" class="mi-delete-caracteristicas-especificas-group btn btn-danger btn-sm mt-2 ms-auto"><i class="bi bi-x-circle-fill"></i> <?php _e('Remover item', 'mi'); ?></a>
                                            </div>
                                            <?php  ?>
                                        </li>
                                    <?php } else { ?>
                                        <?php foreach ($imovel_caracteristicas_especificas as $item) { ?>
                                            <li class="mi-caracteristicas-especificas-group-item list-group-item" id="mi-caracteristicas-especificas-group-item-<?php echo $count; ?>" data-caracteristicas-especificas-group-item-id="<?php echo $count; ?>">
                                                <label for=" imovel_caracteristicas-especificas-<?php echo $count; ?>" class="form-label"><?php _e('Característica', 'mi') ?></label>
                                                <input type="text" class="form-control" id="imovel_caracteristicas-especificas-<?php echo $count; ?>" name="imovel_caracteristicas-especificas[]" value="<?php echo $item; ?>" tabindex="15">
                                                <div class="invalid-feedback"><?php _e('Campo obrigatório', 'mi'); ?></div>
                                                <?php  ?>
                                                <div class="d-flex">
                                                    <a href="#" class="mi-delete-caracteristicas-especificas-group btn btn-danger btn-sm mt-2 ms-auto"><i class="bi bi-x-circle-fill"></i> <?php _e('Remover item', 'mi'); ?></a>
                                                </div>
                                                <?php  ?>
                                            </li>
                                            <?php $count++; ?>
                                        <?php } ?>
                                    <?php } ?>
                                </ul>
                                <a href="#" class="mi-group-new-item-btn btn btn-success mt-3"><i class="bi bi-plus-circle-fill"></i> <?php _e('Adicionar item', 'mi'); ?></a>
                            </div>
                        </div>
                        <?php
                        $selected_option = 0;
                        if ($post_id) {
                            $imovel_certificado_energetico = get_post_meta($post_id, 'imovel_certificado_energetico', true);
                            $selected_option = $imovel_certificado_energetico ? $imovel_certificado_energetico : $selected_option;
                        }
                        ?>

                        <div class="mb-3">
                            <label for="imovel_certificado_energetico" class="form-label"><?php _e('Certificado Energético', 'mi'); ?></label>
                            <select class="form-select" aria-label="<?php _e('Certificado Energético', 'mi'); ?>" name="imovel_certificado_energetico" id="imovel_certificado_energetico" tabindex="16">
                                <?php
                                $mi_certificado_energetico_options = mi_certificado_energetico_options();
                                $i = 0;
                                foreach ($mi_certificado_energetico_options as $k => $option) {
                                ?>
                                    <option <?php echo $k === $selected_option ? ' selected' : ''; ?> value="<?php echo $k; ?>"><?php echo $option; ?></option>
                                    <?php $i++; ?>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="imovel_rua" class="form-label"><?php _e('Rua', 'mi'); ?><span class="text-danger" data-bs-toggle="tooltip" data-bs-title="<?php _e('Campo obrigatório.', 'mi'); ?>">*</span></label>
                            <input type="text" class="form-control" id="imovel_rua" name="imovel_rua" tabindex="17" value="<?php echo $imovel_rua; ?>" required>
                            <div class="invalid-feedback"><?php _e('Campo obrigatório', 'mi'); ?></div>
                        </div>

                        <div class="mb-3">
                            <label for="imovel_numero" class="form-label"><?php _e('Número', 'mi'); ?><span class="text-danger" data-bs-toggle="tooltip" data-bs-title="<?php _e('Campo obrigatório.', 'mi'); ?>">*</span></label>
                            <input type="text" class="form-control" id="imovel_numero" name="imovel_numero" tabindex="18" value="<?php echo $imovel_numero; ?>" required>
                            <div class="invalid-feedback"><?php _e('Campo obrigatório', 'mi'); ?></div>
                        </div>

                        <div class="mb-3">
                            <label for="imovel_codigo_postal" class="form-label"><?php _e('Código Postal', 'mi'); ?><span class="text-danger" data-bs-toggle="tooltip" data-bs-title="<?php _e('Campo obrigatório.', 'mi'); ?>">*</span></label>
                            <input type="text" class="form-control" id="imovel_codigo_postal" name="imovel_codigo_postal" tabindex="19" value="<?php echo $imovel_codigo_postal; ?>" required>
                            <div class="invalid-feedback"><?php _e('Campo obrigatório', 'mi'); ?></div>
                        </div>

                        <div class="mb-3">
                            <label for="imovel_cidade" class="form-label"><?php _e('Cidade', 'mi'); ?><span class="text-danger" data-bs-toggle="tooltip" data-bs-title="<?php _e('Campo obrigatório.', 'mi'); ?>">*</span></label>
                            <input type="text" class="form-control" id="imovel_cidade" name="imovel_cidade" tabindex="20" value="<?php echo $imovel_cidade; ?>" required>
                            <div class="invalid-feedback"><?php _e('Campo obrigatório', 'mi'); ?></div>
                        </div>

                        <div class="mb-3 mi-file-image-preview">
                            <label for="imovel_image" class="form-label"><?php _e('Imagem', 'mi') ?></label>
                            <input type="file" class="form-control" id="imovel_image" name="imovel_image" accept=".jpg,.jpeg,.png" value="<?php echo $post_thumbnail_url; ?>" tabindex="21">
                            <div class="form-text"><?php _e('Arquivos aceitos: ".jpg" e ".png". Tamanho máximo permitido: 2MB.'); ?></div>
                            <div class="invalid-feedback"><?php _e('Campo obrigatório', 'mi'); ?></div>
                            <div class="d-flex flex-row justify-content-start gap-1 align-items-center images-preview">
                                <?php if ($post_thumbnail_url) { ?>
                                    <img class="image-preview" src="<?php echo $post_thumbnail_url; ?>" />
                                <?php } ?>
                            </div>
                            <div class="clearfix"></div>
                            <button class="btn btn-danger btn-sm mt-3 btn-clear-image" <?php echo $post_thumbnail_url ? '' : 'style="display: none;"'; ?>><?php _e('Remover Imagem', 'mi'); ?></button>
                            <input type="hidden" name="changed-thumbnail" value="false">
                        </div>

                        <div class="mb-3 mi-file-image-preview">
                            <label for="imovel_galeria" class="form-label"><?php _e('Galeria', 'mi') ?></label>
                            <input type="file" class="form-control" id="imovel_galeria" name="imovel_galeria[]" accept=".jpg,.jpeg,.png" value="" tabindex="22" multiple>
                            <div class="form-text"><?php _e('Arquivos aceitos: ".jpg" e ".png". Tamanho máximo permitido: 2MB.'); ?></div>
                            <div class="invalid-feedback"><?php _e('Campo obrigatório', 'mi'); ?></div>
                            <div class="d-flex flex-row flex-wrap justify-content-start gap-1 align-items-center images-preview images-preview-thumbnail">
                                <?php foreach ($imovel_galeria as $attachment_id => $attachment_url) { ?>
                                    <?php $src = wp_get_attachment_image_url($attachment_id); ?>
                                    <img class="image-preview" src="<?php echo $src; ?>" />
                                <?php } ?>
                            </div>
                            <div class="clearfix"></div>
                            <button class="btn btn-danger btn-sm mt-3 btn-clear-image" <?php echo $imovel_galeria ? '' : 'style="display: none;"'; ?>><?php _e('Remover Imagens', 'mi'); ?></button>
                            <input type="hidden" name="changed-thumbnail" value="false">
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <button type="submit" class="btn btn-primary" tabindex="23"><?php _e('Salvar', 'mi'); ?></button>

                            <?php if ($post_id) { ?>
                                <a href="#" class="btn btn-danger close-imovel" data-bs-toggle="modal" data-bs-target="#close-imovel-modal" tabindex="24">
                                    <i class="bi bi-x-circle-fill me-1"></i>
                                    <?php _e('Encerrar anúncio', 'mi'); ?>
                                </a>
                            <?php } ?>

                        </div>
                    </div>

                    <input type="hidden" name="mi_form_imovel_nonce" value="<?php echo $mi_add_form_new_imovel_nonce ?>" />
                    <input type="hidden" value="mi_imovel_form" name="action">
                    <input type="hidden" value="<?php echo $user_id; ?>" name="user_id">
                    <input type="hidden" value="<?php echo $post_id; ?>" name="post_id">
                    <input type="hidden" value="<?php echo esc_attr($redirect_to); ?>" name="redirect_to">
                </form>

            <?php } ?>
        </div>
    </div>
</div>;