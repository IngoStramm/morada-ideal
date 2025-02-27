<?php
if (!is_user_logged_in()) { ?>
    <?php $login_page_url = mi_get_page_url('login'); ?>
    <a href="<?php echo $login_page_url; ?>" class="btn btn-has-icon btn-outline-primary me-2">
        <span class="icon"><?php echo mi_get_icon('user'); ?></span>
        <?php _e('Login', 'mi'); ?>
    </a>
<?php } else { ?>
    <?php $account_page_url = mi_get_page_url('account'); ?>
    <a href="<?php echo $account_page_url; ?>" class="btn btn-has-icon btn-outline-primary me-2">
        <span class="icon"><?php echo mi_get_icon('user'); ?></span>
        <?php _e('Sua Conta', 'mi'); ?>
    </a>
<?php }
