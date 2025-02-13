<?php

/**
 * Template part for displaying login page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Moarada Ideal
 */

?>

<?php
$redirect_to = get_home_url();
$mi_add_form_login_nonce = wp_create_nonce('mi_form_login_nonce');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="container">
        <div class="row justify-content-md-center">

            <?php if (!is_user_logged_in()) { ?>

                <div class="col-md-6">

                    <?php
                    // Mensagens de erro de login 
                    if (isset($_SESSION['mi_login_error_message']) && $_SESSION['mi_login_error_message']) {
                        echo mi_dismissible_alert($_SESSION['mi_login_error_message'], 'danger');
                        unset($_SESSION['mi_login_error_message']);
                    }

                    // Mensagens de erro de reset password 
                    if (isset($_SESSION['mi_resetpassword_error_message']) && $_SESSION['mi_resetpassword_error_message']) {
                        echo mi_dismissible_alert($_SESSION['mi_resetpassword_error_message'], 'danger');
                        unset($_SESSION['mi_resetpassword_error_message']);
                    }

                    // Mensagens de successo de senha perdida
                    if (isset($_SESSION['mi_lostpassword_success_message']) && $_SESSION['mi_lostpassword_success_message']) {
                        echo mi_dismissible_alert($_SESSION['mi_lostpassword_success_message'], 'success');
                        unset($_SESSION['mi_lostpassword_success_message']);
                    }

                    // Mensagens de successo de redefinição senha
                    if (isset($_SESSION['mi_resetpassword_success_message']) && $_SESSION['mi_resetpassword_success_message']) {
                        echo mi_dismissible_alert($_SESSION['mi_resetpassword_success_message'], 'success');
                        unset($_SESSION['mi_resetpassword_success_message']);
                    }
                    ?>

                    <h3 class="mb-4"><?php _e('Login', 'mi'); ?></h3>

                    <form name="loginform" id="loginform" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="needs-validation" novalidate>

                        <div class="row">
                            <div class="mb-3">
                                <label for="user_login" class="form-label">E-mail</label>
                                <input type="text" class="form-control" id="user_login" name="log" required>
                                <div class="invalid-feedback"><?php _e('Campo obrigatório', 'mi'); ?></div>
                            </div>

                            <div class="mb-3">
                                <label for="user_pass" class="form-label"><?php _e('Senha', 'mi'); ?></label>
                                <input type="password" class="form-control" name="pwd" id="user_pass" required>
                                <div class="invalid-feedback"><?php _e('Campo obrigatório', 'mi'); ?></div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary"><?php _e('Entrar', 'mi'); ?></button>
                            </div>
                        </div>

                        <input type="hidden" name="mi_form_login_nonce" value="<?php echo $mi_add_form_login_nonce ?>" />
                        <input type="hidden" value="mi_login_form" name="action">
                        <input type="hidden" value="<?php echo esc_attr($redirect_to); ?>" name="redirect_to">
                    </form>

                    <?php if (mi_get_page_id('newuser') && mi_get_page_id('lostpassword')) { ?>
                        <div class="d-flex justify-content-between gap-2">

                            <a class="link-underline link-underline-opacity-50 link-offset-2" href="<?php echo mi_get_page_url('newuser'); ?>"><?php _e('Cadastre-se', 'mi'); ?></a>

                            <a class="link-underline link-underline-opacity-50 link-offset-2" href="<?php echo mi_get_page_url('lostpassword'); ?>"><?php _e('Perdeu a senha?', 'mi'); ?></a>

                        </div>
                    <?php } ?>

                </div>

            <?php } else {
                get_template_part('template-parts/content/login/content-already-logged-user');
            } ?>

        </div>
    </div>

</article><!-- #post-<?php the_ID(); ?> -->