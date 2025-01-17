<?php
$user = wp_get_current_user();
$user_id = $user->get('id');
$account_page_id = mi_get_option('mi_account_page');
$redirect_to = $account_page_id ? get_page_link($account_page_id) : get_home_url();
$mi_add_form_update_user_nonce = wp_create_nonce('mi_form_update_user_nonce');
?>
<form name="update-user-form" id="update-user-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="needs-validation" novalidate>
    <div class="row">
        <div class="mb-3">
            <label for="user_name" class="form-label"><?php _e('Nome', 'mi'); ?></label>
            <input type="text" class="form-control" id="user_name" name="user_name" tabindex="1" value="<?php echo $user->get('first_name'); ?>" required>
            <div class="invalid-feedback"><?php _e('Campo obrigatório', 'mi'); ?></div>
        </div>

        <div class="mb-3">
            <label for="user_surname" class="form-label"><?php _e('Sobrenome', 'mi'); ?></label>
            <input type="text" class="form-control" id="user_surname" name="user_surname" tabindex="2" value="<?php echo $user->get('last_name'); ?>" required>
            <div class="invalid-feedback"><?php _e('Campo obrigatório', 'mi'); ?></div>
        </div>

        <div class="mb-3">
            <label for="user_email" class="form-label"><?php _e('E-mail', 'mi') ?></label>
            <input type="email" class="form-control" id="user_email" name="user_email" tabindex="3" value="<?php echo $user->get('user_email'); ?>" required>
            <div class="invalid-feedback"><?php _e('Campo obrigatório', 'mi'); ?></div>
        </div>

        <div class="mb-3">
            <label for="user_pass" class="form-label"><?php _e('Senha', 'mi'); ?></label>
            <input type="password" class="form-control" name="user_pass" id="user_pass" autocomplete="off" aria-autocomplete="list" aria-label="Password" aria-describedby="passwordHelp" tabindex="4">
            <div class="invalid-feedback"><?php _e('Campo obrigatório', 'mi'); ?></div>
            <div class="password-meter">
                <div class="meter-section rounded me-2"></div>
                <div class="meter-section rounded me-2"></div>
                <div class="meter-section rounded me-2"></div>
                <div class="meter-section rounded"></div>
            </div>
            <div id="passwordHelp" class="form-text text-muted"><?php _e('Use 8 ou mais caracteres com uma mistura de letras, números e símbolos.', 'mi'); ?></div>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary" tabindex="6"><?php _e('Salvar', 'mi'); ?></button>

        </div>
    </div>

    <input type="hidden" name="mi_form_update_user_nonce" value="<?php echo $mi_add_form_update_user_nonce ?>" />
    <input type="hidden" value="mi_update_user_form" name="action">
    <input type="hidden" value="<?php echo $user_id; ?>" name="user_id">
    <input type="hidden" value="<?php echo esc_attr($redirect_to); ?>" name="redirect_to">
</form>