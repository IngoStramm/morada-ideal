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

    <?php
    $mapstatic_key = mi_get_option('mapstatic_key');
    $imovel_lat = isset($_GET['lat']) && $_GET['lat'] ? $_GET['lat'] : null;
    $imovel_lng = isset($_GET['lng']) && $_GET['lng'] ? $_GET['lng'] : null;
    if ($mapstatic_key && $imovel_lat && $imovel_lng) {
        if (!isset($_GET['view']) || $_GET['view'] !== 'map') {
            $static_img_src = "
            https://maps.googleapis.com/maps/api/staticmap?size=400x400&center=$imovel_lat,$imovel_lng&zoom=12&format=png&maptype=roadmap&language=pt&key=$mapstatic_key";
    ?>
            <div class="static-map-container sidebar-widget">
                <img class="img-fluid static-map" src="<?php echo $static_img_src; ?>" />
                <a href="<?php echo $mapa_view_url; ?>" class="btn btn-primary btn-toggle-map-view"><?php _e('Ver mapa', 'mi'); ?> <?php echo mi_get_icon('arrow-right') ?></a>
            </div>
        <?php } else { ?>
            <a href="<?php echo $lista_view_url; ?>" class="btn btn-primary btn-toggle-map-view"><?php _e('Ver lista', 'mi'); ?> <?php echo mi_get_icon('arrow-right') ?></a>
        <?php } ?>
    <?php } ?>

    <div class="sidebar-widget">
        <?php
        $operacao_terms = get_terms(array(
            'taxonomy'   => 'operacao',
            'hide_empty' => false,
        ));
        $selected_operacao_term_id = isset($_GET['operacao-term']) && $_GET['operacao-term'] ? $_GET['operacao-term'] : null;
        ?>
        <?php if ($operacao_terms) { ?>
            <ul class="checkbox-list-inline">
                <li>
                    <input type="radio" name="operacao-term" id="operacao-term-todos" value="" <?php echo !$selected_operacao_term_id ? 'checked' : ''; ?> class="form-check-input btn-check" />
                    <label for="operacao-term-todos" class="form-check-label btn btn-primary"><?php _e('Todos', 'mi'); ?></label>
                </li>
                <?php foreach ($operacao_terms as $term) { ?>
                    <li>
                        <?php $checked = $term->term_id === (int)$selected_operacao_term_id ? 'checked' : ''; ?>
                        <input type="radio" name="operacao-term" id="operacao-term-<?php echo $term->term_id ?>" value="<?php echo $term->term_id ?>" <?php echo $checked; ?> class="form-check-input btn-check" />
                        <label for="operacao-term-<?php echo $term->term_id ?>" class="form-check-label btn btn-primary"><?php echo $term->name; ?></label>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>

        <?php echo mi_autocomplete_search_input(); ?>

        <?php
        $tipo_terms = get_terms(array(
            'taxonomy'   => 'tipo',
            'hide_empty' => false,
        ));
        $selected_tipo_term_id = isset($_GET['tipo-terms']) && $_GET['tipo-terms'] ? $_GET['tipo-terms'] : null;
        ?>

        <?php if ($tipo_terms) { ?>
            <div class="tipo-filter widget-item">
                <select name="tipo-terms" id="tipo-terms" class="form-select" aria-label="<?php _e('Tipo de imóvel', 'mi'); ?>">
                    <option value=""><?php _e('Tipo de imóvel', 'mi'); ?></option>
                    <?php foreach ($tipo_terms as $term) { ?>
                        <?php $selected = $term->term_id === (int)$selected_tipo_term_id ? 'selected' : ''; ?>
                        <option value="<?php echo $term->term_id; ?>" <?php echo $selected; ?>><?php echo $term->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        <?php } ?>

        <div class="preco-filter widget-item">
            <?php /* ?>
                <div class="d-flex align-content-between justify-content-between gap-2">

                    <select name="preco-min" id="preco-min" class="form-select">
                        <option value=""><?php _e('Preço Min', 'mi') ?></option>
                        <?php
                        $options = mi_precos_options();
                        $selected_preco_min = isset($_GET['preco-min']) && $_GET['preco-min'] ? (int)$_GET['preco-min'] : null;
                        foreach ($options as $v => $option) { ?>
                            <?php $selected = $selected_preco_min === $option ? ' selected' : ''; ?>
                            <option value="<?php echo $v; ?>" <?php echo $selected; ?>><?php echo $option; ?></option>
                        <?php } ?>
                        <option value=""><?php _e('Sem limite', 'mi') ?></option>
                    </select>

                    <select name="preco-max" id="preco-max" class="form-select">
                        <option value=""><?php _e('Preço Max', 'mi') ?></option>
                        <?php
                        $options = mi_precos_options();
                        $selected_preco_max = isset($_GET['preco-max']) && $_GET['preco-max'] ? (int)$_GET['preco-max'] : null;
                        foreach ($options as $v => $option) { ?>
                            <?php $selected = $selected_preco_max === $option ? ' selected' : ''; ?>
                            <option value="<?php echo $v; ?>" <?php echo $selected; ?>><?php echo $option; ?></option>
                        <?php } ?>
                        <option value=""><?php _e('Sem limite', 'mi') ?></option>
                    </select>

                </div>

                <?php */ ?>

            <?php
            $options = mi_precos_options();
            // array_unshift($options, array(0 => '0'));
            $selected_preco_min = isset($_GET['preco-min']) && $_GET['preco-min'] ? (int)$_GET['preco-min'] : 0;
            $selected_preco_max = isset($_GET['preco-max']) && $_GET['preco-max'] ? (int)$_GET['preco-max'] : 0;
            echo mi_range_slider_double_value('precos', $options, 'preco-min', 'preco-max', $selected_preco_min, $selected_preco_max, __('Preço: ', 'mi'));
            ?>
        </div>

        <?php
        $tipologia_terms = get_terms(array(
            'taxonomy'   => 'tipologia',
            'hide_empty' => false,
        ));
        $selected_tipologia_term_id = isset($_GET['tipologia-term']) && $_GET['tipologia-term'] ? $_GET['tipologia-term'] : null;
        ?>

        <?php if ($tipologia_terms) { ?>
            <div class="tipologia-filter widget-item">
                <label class="widget-title"><?php _e('Tipologia', 'mi'); ?></label>
                <?php foreach ($tipologia_terms as $term) { ?>
                    <div class="form-check">
                        <?php $checked = $term->term_id === (int)$selected_tipologia_term_id ? 'checked' : ''; ?>
                        <input type="radio" name="tipologia-term" id="tipologia-term-<?php echo $term->term_id ?>" value="<?php echo $term->term_id ?>" <?php echo $checked; ?> class="form-check-input" />
                        <label for="tipologia-term-<?php echo $term->term_id ?>" class="form-check-label"><?php echo $term->name; ?></label>
                    </div>
                <?php } ?>
                </select>
            </div>
        <?php } ?>

        <?php
        $caracteristica_geral_terms = get_terms(array(
            'taxonomy'   => 'caracteristica-geral',
            'hide_empty' => false,
        ));
        $selected_caracteristica_geral_terms_id = isset($_GET['caracteristica-geral-terms']) && $_GET['caracteristica-geral-terms'] ? $_GET['caracteristica-geral-terms'] : null;
        ?>

        <?php if ($caracteristica_geral_terms) { ?>
            <div class="caracteristicas-gerais-filter widget-item">
                <label class="widget-title"><?php _e('Características Gerais', 'mi'); ?></label>
                <?php foreach ($caracteristica_geral_terms as $term) { ?>
                    <div class="form-check">
                        <?php $checked = $selected_caracteristica_geral_terms_id && in_array((string)$term->term_id, $selected_caracteristica_geral_terms_id) ? 'checked' : ''; ?>
                        <input type="checkbox" name="caracteristica-geral-terms[]" id="caracteristica-geral-terms-<?php echo $term->term_id ?>" value="<?php echo $term->term_id ?>" <?php echo $checked; ?> class="form-check-input" />
                        <label for="caracteristica-geral-terms-<?php echo $term->term_id ?>" class="form-check-label"><?php echo $term->name; ?></label>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="metragem-filter widget-item">

            <?php /* ?>
            
                <div class="d-flex align-content-between justify-content-between gap-2">

                    <select name="metragem-imovel-min" id="metragem-imovel-min" class="form-select">
                        <option value=""><?php _e('Tamanho Min', 'mi') ?></option>
                        <?php
                        $options = mi_metragem_options();
                        $selected_preco_min = isset($_GET['metragem-imovel-min']) && $_GET['metragem-imovel-min'] ? (int)$_GET['metragem-imovel-min'] : null;
                        foreach ($options as $option) { ?>
                            <?php $selected = $selected_preco_min === $option ? ' selected' : ''; ?>
                            <option value="<?php echo $option; ?>" <?php echo $selected; ?>><?php echo $option; ?> m²</option>
                        <?php } ?>
                    </select>

                    <select name="metragem-imovel-max" id="metragem-imovel-max" class="form-select">
                        <option value=""><?php _e('Tamanho Max', 'mi') ?></option>
                        <?php
                        $options = mi_metragem_options();
                        $selected_preco_max = isset($_GET['metragem-imovel-max']) && $_GET['metragem-imovel-max'] ? (int)$_GET['metragem-imovel-max'] : null;
                        foreach ($options as $option) { ?>
                            <?php $selected = $selected_preco_max === $option ? ' selected' : ''; ?>
                            <option value="<?php echo $option; ?>" <?php echo $selected; ?>><?php echo $option; ?> m²</option>
                        <?php } ?>
                    </select>

                </div>

                <?php */ ?>

            <?php
            $options = mi_metragem_options();
            // array_unshift($options, array(0 => '0'));
            $selected_metragem_imovel_min = isset($_GET['metragem-imovel-min']) && $_GET['metragem-imovel-min'] ? (int)$_GET['metragem-imovel-min'] : 0;
            $selected_metragem_imovel_max = isset($_GET['metragem-imovel-max']) && $_GET['metragem-imovel-max'] ? (int)$_GET['metragem-imovel-max'] : 0;
            echo mi_range_slider_double_value('metragem', $options, 'metragem-imovel-min', 'metragem-imovel-max', $selected_metragem_imovel_min, $selected_metragem_imovel_max, __('Área: ', 'mi'));
            ?>
        </div>

        <?php
        echo mi_add_query_params_as_inputs($sort_params);
        // echo mi_search_params();
        ?>
        <button class="btn btn-primary has-icon"><?php _e('Filtrar', 'mi'); ?> <?php echo mi_get_icon('arrow-right'); ?></button>
        <a class="btn btn-warning has-icon" href="<?php echo $reset_url; ?>"><?php _e('Resetar filtro', ' mi') ?> <?php echo mi_get_icon('close-alt'); ?></a>
    </div>
</form>