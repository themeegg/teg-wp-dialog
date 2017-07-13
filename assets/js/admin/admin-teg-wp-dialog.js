/**
 * TEG_WP_Dialog Admin JS
 */

// (function ($, teg_wp_dialog_admin_data, ajaxurl) {
//
//
//     $(function () {
//
//     });
//
// })(jQuery, teg_wp_dialog_admin_data, ajaxurl);

jQuery(function ( $ ) {
    // Tooltips
    $(document.body).on('init_tooltips', function () {
        var tiptip_args = {
            'attribute': 'data-tip',
            'fadeIn': 50,
            'fadeOut': 50,
            'delay': 200
        };
        $('.tips, .help_tip, .teg-wp-dialog-help-tip').tipTip(tiptip_args);
        // Add tiptip to parent element for widefat tables
        $('.parent-tips').each(function () {
            $(this).closest('a, th').attr('data-tip', $(this).data('tip')).tipTip(tiptip_args).css('cursor', 'help');
        });
    }).trigger('init_tooltips');
});