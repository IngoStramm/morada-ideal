<?php
$sort_params = mi_sort_params();
$filter_params =  mi_filters_params();
// $full_url = $_SERVER['HTTP_REFERER'];
$full_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$has_params = parse_url($full_url, PHP_URL_QUERY);
$reset_url = mi_remove_url_parameters($full_url, $filter_params);
$reset_url = mi_remove_url_parameters($reset_url, array('view'));
$mapa_view_url = $has_params ? $full_url . '&view=map' : $full_url . '?view=map';
$lista_view_url = mi_remove_url_parameters($full_url, array('view'));
?>

<form class="d-flex flex-column align-items-lg-stretch justify-content-between gap-2" role="filter" method="get" name="filter-imoveis">

    <?php echo mi_autocomplete_search_input(); ?>
    <?php
    $mapstatic_key = mi_get_option('mapstatic_key');
    $imovel_lat = isset($_GET['lat']) && $_GET['lat'] ? $_GET['lat'] : null;
    $imovel_lng = isset($_GET['lng']) && $_GET['lng'] ? $_GET['lng'] : null;
    if ($mapstatic_key && $imovel_lat && $imovel_lng) {
        if (!isset($_GET['view']) || $_GET['view'] !== 'map') {
            $static_img_src = "
            https://maps.googleapis.com/maps/api/staticmap?size=350x350&center=$imovel_lat,$imovel_lng&zoom=12&format=png&maptype=roadmap&language=pt&key=$mapstatic_key";
            echo "<img class='img-fluid' src='$static_img_src' />";
    ?>
            <a href="<?php echo $mapa_view_url; ?>" class="btn btn-primary"><?php _e('Ver mapa', 'mi'); ?></a>
        <?php } else { ?>
            <a href="<?php echo $lista_view_url; ?>" class="btn btn-primary"><?php _e('Ver lista', 'mi'); ?></a>
    <?php }
    } ?>

    <?php
    $operacao_terms = get_terms(array(
        'taxonomy'   => 'operacao',
        'hide_empty' => false,
    ));
    $selected_operacao_term_id = isset($_GET['operacao-term']) && $_GET['operacao-term'] ? $_GET['operacao-term'] : null;
    ?>

    <?php if ($operacao_terms) { ?>
        <label><?php _e('Operação', 'mi'); ?></label>
        <div class="form-check">
            <input type="radio" name="operacao-term" id="operacao-term-todos" value="" <?php echo !$selected_operacao_term_id ? 'checked' : ''; ?> class="form-check-input" />
            <label for="operacao-term-todos" class="form-check-label"><?php _e('Todos', 'mi'); ?></label>
        </div>
        <?php foreach ($operacao_terms as $term) { ?>
            <div class="form-check">
                <?php $checked = $term->term_id === (int)$selected_operacao_term_id ? 'checked' : ''; ?>
                <input type="radio" name="operacao-term" id="operacao-term-<?php echo $term->term_id ?>" value="<?php echo $term->term_id ?>" <?php echo $checked; ?> class="form-check-input" />
                <label for="operacao-term-<?php echo $term->term_id ?>" class="form-check-label"><?php echo $term->name; ?></label>
            </div>
        <?php } ?>
    <?php } ?>

    <?php
    $tipo_terms = get_terms(array(
        'taxonomy'   => 'tipo',
        'hide_empty' => false,
    ));
    $selected_tipo_term_id = isset($_GET['tipo-terms']) && $_GET['tipo-terms'] ? $_GET['tipo-terms'] : null;
    ?>

    <?php if ($tipo_terms) { ?>
        <label for="tipo-terms"><?php _e('Tipo de imóvel', 'mi'); ?></label>
        <select name="tipo-terms" id="tipo-terms" class="form-select" aria-label="<?php _e('Tipo de imóvel', 'mi'); ?>">
            <option value=""><?php _e('Selecione uma opção', 'mi'); ?></option>
            <?php foreach ($tipo_terms as $term) { ?>
                <?php $selected = $term->term_id === (int)$selected_tipo_term_id ? 'selected' : ''; ?>
                <option value="<?php echo $term->term_id; ?>" <?php echo $selected; ?>><?php echo $term->name; ?></option>
            <?php } ?>
        </select>
    <?php } ?>

    <label for="preco"><?php _e('Preço', 'mi'); ?></label>
    <div class="d-flex align-content-between justify-content-between gap-2">

        <select name="preco-min" id="preco-min" class="form-select">
            <option value=""><?php _e('Min', 'mi') ?></option>
            <?php
            $options = mi_precos_options();
            $selected_preco_min = isset($_GET['preco-min']) && $_GET['preco-min'] ? (int)$_GET['preco-min'] : null;
            foreach ($options as $option) { ?>
                <?php $selected = $selected_preco_min === $option ? ' selected' : ''; ?>
                <option value="<?php echo $option; ?>" <?php echo $selected; ?>><?php echo $option; ?></option>
            <?php } ?>
        </select>

        <select name="preco-max" id="preco-max" class="form-select">
            <option value=""><?php _e('Max', 'mi') ?></option>
            <?php
            $options = mi_precos_options();
            $selected_preco_max = isset($_GET['preco-max']) && $_GET['preco-max'] ? (int)$_GET['preco-max'] : null;
            foreach ($options as $option) { ?>
                <?php $selected = $selected_preco_max === $option ? ' selected' : ''; ?>
                <option value="<?php echo $option; ?>" <?php echo $selected; ?>><?php echo $option; ?></option>
            <?php } ?>
        </select>

    </div>

    <?php
    $tipologia_terms = get_terms(array(
        'taxonomy'   => 'tipologia',
        'hide_empty' => false,
    ));
    $selected_tipologia_term_id = isset($_GET['tipologia-term']) && $_GET['tipologia-term'] ? $_GET['tipologia-term'] : null;
    ?>

    <?php if ($tipologia_terms) { ?>
        <label><?php _e('Tipologia', 'mi'); ?></label>
        <?php foreach ($tipologia_terms as $term) { ?>
            <div class="form-check">
                <?php $checked = $term->term_id === (int)$selected_tipologia_term_id ? 'checked' : ''; ?>
                <input type="radio" name="tipologia-term" id="tipologia-term-<?php echo $term->term_id ?>" value="<?php echo $term->term_id ?>" <?php echo $checked; ?> class="form-check-input" />
                <label for="tipologia-term-<?php echo $term->term_id ?>" class="form-check-label"><?php echo $term->name; ?></label>
            </div>
        <?php } ?>
        </select>
    <?php } ?>

    <?php
    $caracteristica_geral_terms = get_terms(array(
        'taxonomy'   => 'caracteristica-geral',
        'hide_empty' => false,
    ));
    $selected_caracteristica_geral_terms_id = isset($_GET['caracteristica-geral-terms']) && $_GET['caracteristica-geral-terms'] ? $_GET['caracteristica-geral-terms'] : null;
    ?>

    <?php if ($caracteristica_geral_terms) { ?>
        <label><?php _e('Características Gerais', 'mi'); ?></label>
        <?php foreach ($caracteristica_geral_terms as $term) { ?>
            <div class="form-check">
                <?php $checked = $selected_caracteristica_geral_terms_id && in_array((string)$term->term_id, $selected_caracteristica_geral_terms_id) ? 'checked' : ''; ?>
                <input type="checkbox" name="caracteristica-geral-terms[]" id="caracteristica-geral-terms-<?php echo $term->term_id ?>" value="<?php echo $term->term_id ?>" <?php echo $checked; ?> class="form-check-input" />
                <label for="caracteristica-geral-terms-<?php echo $term->term_id ?>" class="form-check-label"><?php echo $term->name; ?></label>
            </div>
        <?php } ?>
    <?php } ?>

    <label for="metragem-imovel"><?php _e('Tamanho', 'mi'); ?></label>
    <div class="d-flex align-content-between justify-content-between gap-2">

        <select name="metragem-imovel-min" id="metragem-imovel-min" class="form-select">
            <option value=""><?php _e('Min', 'mi') ?></option>
            <?php
            $options = mi_metragem_options();
            $selected_preco_min = isset($_GET['metragem-imovel-min']) && $_GET['metragem-imovel-min'] ? (int)$_GET['metragem-imovel-min'] : null;
            foreach ($options as $option) { ?>
                <?php $selected = $selected_preco_min === $option ? ' selected' : ''; ?>
                <option value="<?php echo $option; ?>" <?php echo $selected; ?>><?php echo $option; ?> m²</option>
            <?php } ?>
        </select>

        <select name="metragem-imovel-max" id="metragem-imovel-max" class="form-select">
            <option value=""><?php _e('Max', 'mi') ?></option>
            <?php
            $options = mi_metragem_options();
            $selected_preco_max = isset($_GET['metragem-imovel-max']) && $_GET['metragem-imovel-max'] ? (int)$_GET['metragem-imovel-max'] : null;
            foreach ($options as $option) { ?>
                <?php $selected = $selected_preco_max === $option ? ' selected' : ''; ?>
                <option value="<?php echo $option; ?>" <?php echo $selected; ?>><?php echo $option; ?> m²</option>
            <?php } ?>
        </select>

    </div>

    <?php
    echo mi_add_query_params_as_inputs($sort_params);
    // echo mi_search_params();
    ?>
    <button class="btn btn-primary"><?php _e('Filtrar', 'mi'); ?></button>
    <a class="btn btn-secondary" href="<?php echo $reset_url; ?>"><?php _e('Resetar filtro', ' mi') ?></a>
</form>