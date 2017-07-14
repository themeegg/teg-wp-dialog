/*
 * global teg_wp_dialog_frontend_script_params
 */
(function ($, document, window) {

    var options = {};

    $('.teg-wp-dialog').remodal(options).open();

    var dialog_width = teg_wp_dialog_frontend_script_params.dialog_width;

    if ('' != dialog_width && dialog_width != 'auto') {

        $('.teg-wp-dialog.remodal').css({

            width: dialog_width,
            'max-width': dialog_width
        });

    }
}(jQuery, document, window));
