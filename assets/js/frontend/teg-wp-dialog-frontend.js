/*
 * global teg_wp_dialog_frontend_script_params
 */
(function ($, document, window) {

    var options = {};

    if ($('.teg-wp-dialog').length != 0) {
        $('.teg-wp-dialog').remodal(options).open();

        var dialog_width = teg_wp_dialog_frontend_script_params.dialog_width;

        if ('' != dialog_width && dialog_width != 'auto') {

            $('.teg-wp-dialog.remodal').css({

                width: dialog_width,
                'max-width': dialog_width
            });

        }
    }

    if ($('.twd-nifty-modal .md-trigger').length != 0) {
 
        $('.twd-nifty-modal .md-trigger').trigger('click');
    }
}(jQuery, document, window));
