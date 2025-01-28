<?php
$post_type = isset($args['post_type']) && $args['post_type'] ? $args['post_type'] : null;
$mi_add_form_filter_imovel_nonce = wp_create_nonce('mi_form_filter_imovel_nonce');
$selected = isset($_GET['orderby']) && $_GET['orderby'] ? $_GET['orderby'] : 'date_desc';
$order_options = array(
    'date_desc'             => __('Mais recentes primeiro', 'mi'),
    'date_asc'              => __('Mais antigos primeiro', 'mi'),
    'title_asc'             => __('Ordem alfabética (A-Z)', 'mi'),
    'title_desc'            => __('Ordem alfabética reversa (Z-A)', 'mi'),
);
$start_date = isset($_GET['start-date']) && $_GET['start-date'] ? $_GET['start-date'] : null;
$end_date = isset($_GET['end-date']) && $_GET['end-date'] ? $_GET['end-date'] : null;

$prices = mi_get_imoveis_by_price();
// mi_debug($prices);
$css_display = 'flex';
if ($post_type === 'anuncios' && ($prices && count($prices) > 0)) {
    $css_display = 'block';
    $max = max($prices);
    $min = min($prices);
}
$params = array(
    'orderby',
    'start-date',
    'end-date',
    'action',
);
$full_url = $_SERVER['HTTP_REFERER'];
$reset_url = mi_remove_url_parameters($full_url, $params);
?>
<form class="sort-form d-md-<?php echo $css_display; ?> align-items-center justify-content-between gap-3 mb-3 w-100" name="sort-form" method="get">

    <div class="d-flex justify-content-end  align-items-center gap-3 mb-3">
        <select class="form-select" name="orderby" aria-label="<?php _e('Ordenar anúncios', 'mi'); ?>">
            <?php foreach ($order_options as $value => $text) { ?>
                <option value="<?php echo $value; ?>" <?php echo $selected === $value ? 'selected=""' : '' ?>><?php echo $text; ?></option>
            <?php } ?>
        </select>
        <i class="bi bi-arrow-down-up"></i>
    </div>

    <div class="d-md-<?php echo $css_display; ?> justify-content-start align-items-center gap-3 mb-4 mb-md-0">

        <label class="form-label flex-shrink-0 mb-2" for="start-date">
            <?php _e('Data inicial', 'mi'); ?>
        </label>
        <span class="d-flex align-items-start mb-3">
            <input type="date" class="form-control mb-3 mb-md-0" name="start-date" id="start-date" value="<?php echo $start_date ? $start_date : ''; ?>" />
            <a href="#" class="clear-input-value link-danger ms-1" data-input="start-date"><i class="bi bi-x"></i></a>
        </span>

        <label class="form-label flex-shrink-0 mb-2" for="end-date">
            <?php _e('Data final', 'mi'); ?>
        </label>
        <span class="d-flex align-items-start mb-3">
            <input type="date" class="form-control" name="end-date" id="end-date" value="<?php echo $end_date ? $end_date : ''; ?>" />
            <a href="#" class="clear-input-value link-danger ms-1" data-input="end-date"><i class="bi bi-x"></i></a>
        </span>

    </div>

    <a class="btn btn-secondary" href="<?php echo $reset_url; ?>"><?php _e('Resetar filtro', ' mi') ?></a>

    <?php echo mi_add_query_params_as_inputs(); ?>

    <button class="btn btn-primary"><?php _e('Filtrar', 'mi'); ?></button>

</form>