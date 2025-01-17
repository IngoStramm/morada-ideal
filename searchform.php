<form role="search" method="get" id="search-form" action="<?php echo esc_url(home_url('/')); ?>" class="">
    <div class="input-group">
        <div class="form-floating">
            <input type="search" class="form-control" name="s" id="search-input" placeholder="<?php _e('Pesquisar', 'mi'); ?>" value="<?php echo esc_attr(get_search_query()); ?>">
            <label for="search-input"><?php _e('Pesquisar', 'mi'); ?></label>
        </div>
        <span class="input-group-text"><?php echo mi_get_icon('search'); ?></span>
    </div>
    <input type="hidden" name="post_type" value="product">
</form>