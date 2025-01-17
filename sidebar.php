<form class="" role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
    <div class="input-group mb-3">
        <input type="text" name="s" class="form-control" placeholder="<?php _e('Pesquisar', 'wt'); ?>" aria-label="<?php _e('Pesquisar', 'wt'); ?>" aria-describedby="button-addon2">
        <input type="hidden" name="post_type" value="imovel" />
        <button class="btn btn-secondary" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
    </div>
</form>

<?php
$tipo_terms = get_terms(array(
    'taxonomy'   => 'tipo',
    'hide_empty' => false,
));
?>

<?php if ($tipo_terms) { ?>
    <label for="tipo-terms"><?php _e('Tipo de imóvel', 'mi'); ?></label>
    <select name="tipo-terms" id="tipo-terms" class="form-select" aria-label="<?php _e('Tipo de imóvel', 'mi'); ?>">
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