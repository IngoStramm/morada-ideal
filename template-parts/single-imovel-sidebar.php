<?php
$post_id = get_the_ID();
$author_id = get_the_author_meta('ID');
$author_email = get_the_author_meta('email');
$author_name = get_the_author();
$author_avatar = get_user_meta($author_id, 'mi_user_avatar', true);
$author_phone = get_user_meta($author_id, 'mi_user_phone', true);
?>
<div class="d-flex flex-column align-items-lg-stretch justify-content-between gap-2">
    <div class="sidebar-widget">
        <h4 class="mb-0"><?php _e('Contacte o anunciante', 'mi'); ?></h4>
        <div class="anunciante-info">
            <h6 class="anunciante-title"><?php echo $author_name; ?></h6>
            <ul class="anunciante-contacts">
                <li><?php echo mi_get_icon('phone-alt'); ?><?php echo $author_phone; ?></li>
                <li><?php echo mi_get_icon('envelope-alt'); ?><?php echo $author_email; ?></li>
            </ul>
            <img class="anunciante-logo img-fluid" src="<?php echo $author_avatar; ?>" alt="">
        </div>
        <?php echo do_shortcode('[anunciante_contact_form author_id="' . $author_id . '" post_id="' . $post_id . '"]'); ?>
    </div>
</div>