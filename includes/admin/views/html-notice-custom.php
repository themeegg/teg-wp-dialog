<?php
/**
 * Admin View: Custom Notices
 */

if (!defined('ABSPATH')) {
    exit;
}

?>
<div id="message" class="updated teg-wp-dialog-message">
    <a class="teg-wp-dialog-message-close notice-dismiss"
       href="<?php echo esc_url(wp_nonce_url(add_query_arg('ur-hide-notice', $notice), 'teg_wp_dialog_hide_notices_nonce', '_fd_notice_nonce')); ?>"><?php _e('Dismiss', 'teg-wp-dialog'); ?></a>
    <?php echo wp_kses_post(wpautop($notice_html)); ?>
</div>
