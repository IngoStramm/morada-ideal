<?php
$facebook_url = mi_get_option('mi_facebook_url', false, 'mi_site_social_media_options');
$linkedin_url = mi_get_option('mi_linkedin_url', false, 'mi_site_social_media_options');
$x_url = mi_get_option('mi_x_url', false, 'mi_site_social_media_options');
$pinterest_url = mi_get_option('mi_pinterest_url', false, 'mi_site_social_media_options');
$instagram_url = mi_get_option('mi_instagram_url', false, 'mi_site_social_media_options');
$youtube_url = mi_get_option('mi_youtube_url', false, 'mi_site_social_media_options');

if (
    $facebook_url || $linkedin_url || $x_url || $pinterest_url || $instagram_url || $youtube_url
) { ?>
    <div class="site-social-media">

        <span class="site-social-media-text"><?php _e('Siga-nos:', 'mi'); ?></span>
        <ul class="site-social-media-list">

            <?php if ($facebook_url) { ?>
                <li><a href="<?php echo $facebook_url; ?>" target="_blank"><?php echo mi_get_icon('facebook'); ?></a></li>
            <?php } ?>

            <?php if ($linkedin_url) { ?>
                <li><a href="<?php echo $linkedin_url; ?>" target="_blank"><?php echo mi_get_icon('linkedin'); ?></a></li>
            <?php } ?>

            <?php if ($x_url) { ?>
                <li><a href="<?php echo $x_url; ?>" target="_blank"><?php echo mi_get_icon('twitter'); ?></a></li>
            <?php } ?>

            <?php if ($pinterest_url) { ?>
                <li><a href="<?php echo $pinterest_url; ?>" target="_blank"><?php echo mi_get_icon('pinterest'); ?></a></li>
            <?php } ?>

            <?php if ($instagram_url) { ?>
                <li><a href="<?php echo $instagram_url; ?>" target="_blank"><?php echo mi_get_icon('instagram'); ?></a></li>
            <?php } ?>

            <?php if ($youtube_url) { ?>
                <li><a href="<?php echo $youtube_url; ?>" target="_blank"><?php echo mi_get_icon('youtube'); ?></a></li>
            <?php } ?>

        </ul>
    </div>
<?php } ?>