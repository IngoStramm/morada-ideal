<?php

/**
 * Template part for displaying Lost Password page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Morada Ideal
 */

?>

<?php
$redirect_to = get_home_url();
$mi_add_form_lostpassword_nonce = wp_create_nonce('mi_form_lostpassword_nonce');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="container">
        <div class="row justify-content-md-center">

            <?php if (!is_user_logged_in()) { ?>

                <div class="col-md-6">

                    <?php if (isset($_SESSION['mi_lostpassword_error_message']) && $_SESSION['mi_lostpassword_error_message']) { ?>
                        <div class="alert alert-danger alert-dismissible d-flex align-items-center gap-2 fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <div><?php echo $_SESSION['mi_lostpassword_error_message']; ?></div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['mi_lostpassword_error_message']); ?>
                    <?php } ?>

                    <h3 class="mb-4"><?php _e('Redefinição de senha', 'mi'); ?></h3>
                    <p><?php _e('Digite o seu nome de usuário ou endereço de e-mail. Você receberá um e-mail com instruções sobre como redefinir a sua senha.', 'mi') ?></p>

                    <form name="lostpassword-form" id="lostpassword-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="needs-validation" novalidate>

                        <div class="row">
                            <div class="mb-3">
                                <label for="user_login" class="form-label"><?php _e('E-mail', 'mi') ?></label>
                                <input type="text" class="form-control" id="user_login" name="user_login" required>
                                <div class="invalid-feedback"><?php _e('Campo obrigatório', 'mi'); ?></div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary"><?php _e('Obter nova senha', 'mi'); ?></button>
                            </div>
                        </div>

                        <input type="hidden" name="mi_form_lostpassword_nonce" value="<?php echo $mi_add_form_lostpassword_nonce ?>" />
                        <input type="hidden" value="mi_lostpassword_form" name="action">
                    </form>

                    <?php if (mi_get_page_id('login') && mi_get_page_id('newuser')) { ?>
                        <div class="d-flex justify-content-between gap-2">

                            <a class="link-underline link-underline-opacity-50 link-offset-2" href="<?php echo mi_get_page_url('login'); ?>"><?php _e('Acessar', 'mi'); ?></a>

                            <a class="link-underline link-underline-opacity-50 link-offset-2" href="<?php echo mi_get_page_url('newuser'); ?>"><?php _e('Cadastre-se', 'mi'); ?></a>

                        </div>
                    <?php } ?>

                </div>

                <?php
                // Referência: @link: https://code.tutsplus.com/build-a-custom-wordpress-user-flow-part-3-password-reset--cms-23811t
                ?>

            <?php } else {
                get_template_part('template-parts/content/login/content-already-logged-user');
            } ?>

        </div>
    </div>

</article><!-- #post-<?php the_ID(); ?> -->