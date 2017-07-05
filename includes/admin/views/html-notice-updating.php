<?php
/**
 * Admin View: Notice - Updating
 */

if (!defined('ABSPATH')) {
    exit;
}

?>
<div id="message" class="updated teg-wp-dialog-message ur-connect">
    <p><strong><?php _e('TEG WP Dialog Data Update', 'teg-wp-dialog'); ?></strong>
        &#8211; <?php _e('Your database is being updated in the background.', 'teg-wp-dialog'); ?> <a
                href="<?php echo esc_url(add_query_arg('force_update_teg_wp_dialog', 'true', admin_url('options-general.php?page=teg-wp-dialog'))); ?>"><?php _e('Taking a while? Click here to run it now.', 'teg-wp-dialog'); ?></a>
    </p>
</div>
