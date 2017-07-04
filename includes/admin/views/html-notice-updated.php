<?php
/**
 * Admin View: Notice - Updated
 */

if (!defined('ABSPATH')) {
    exit;
}

?>
<div id="message" class="updated teg-wp-dialog-message ess-connect">
    <a class="teg-wp-dialog-message-close notice-dismiss"
       href="<?php echo esc_url(wp_nonce_url(add_query_arg('ur-hide-notice', 'update', remove_query_arg('do_update_teg_wp_dialog')), 'teg_wp_dialog_hide_notices_nonce', '_ur_notice_nonce')); ?>"><?php _e('Dismiss', 'teg-wp-dialog'); ?></a>

    <p><?php _e('Frontend Dialog data update complete. Thank you for updating to the latest version!', 'teg-wp-dialog'); ?></p>
</div>
