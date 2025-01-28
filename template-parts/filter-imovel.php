<form class="" role="filter" action="<?php echo site_url('/'); ?>" method="get" id="filterimoveis">
    <?php
    $tipo_terms = get_terms(array(
        'taxonomy'   => 'tipo',
        'hide_empty' => false,
    ));
    ?>

    <?php if ($tipo_terms) { ?>
        <label for="tipo-terms"><?php _e('Tipo de imóvel', 'mi'); ?></label>
        <select name="tipo-terms" id="tipo-terms" class="form-select" aria-label="<?php _e('Tipo de imóvel', 'mi'); ?>">
            <option value=""><?php _e('Selecione uma opção', 'mi'); ?></option>
            <?php foreach ($tipo_terms as $term) { ?>
                <option value="<?php echo $term->term_id ?>"><?php echo $term->name; ?></option>
            <?php } ?>
        </select>
    <?php } ?>

    <?php
    $tipologia_terms = get_terms(array(
        'taxonomy'   => 'tipologia',
        'hide_empty' => false,
    ));
    ?>

    <?php if ($tipologia_terms) { ?>
        <label><?php _e('Tipologia', 'mi'); ?></label>
        <?php foreach ($tipologia_terms as $term) { ?>
            <div class="form-check">
                <input type="radio" name="tipologia-term" id="tipologia-term-<?php echo $term->term_id ?>" value="<?php echo $term->term_id ?>" />
                <label for="tipologia-term-<?php echo $term->term_id ?>"><?php echo $term->name; ?></label>
            </div>
        <?php } ?>
        </select>
    <?php } ?>

    <?php echo mi_add_query_params_as_inputs(); ?>

    <button class="btn btn-primary"><?php _e('Pesquisar', 'mi'); ?></button>
</form>