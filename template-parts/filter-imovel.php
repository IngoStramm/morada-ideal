<?php
$params = array(
    'tipo-terms',
    'tipologia-term',
);
$full_url = $_SERVER['HTTP_REFERER'];
$action_url = mi_remove_url_parameters($full_url, $params); ?>

<form class="" role="filter" method="get" name="filter-imoveis">
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
                <input type="radio" name="tipologia-term" id="tipologia-term-<?php echo $term->term_id ?>" value="<?php echo $term->term_id ?>" <?php echo $checked; ?> />
                <label for="tipologia-term-<?php echo $term->term_id ?>"><?php echo $term->name; ?></label>
            </div>
        <?php } ?>
        </select>
    <?php } ?>

    <?php echo mi_add_query_params_as_inputs($params); ?>

    <?php mi_unset_params($params); ?>

    <button class="btn btn-primary"><?php _e('Pesquisar', 'mi'); ?></button>
</form>