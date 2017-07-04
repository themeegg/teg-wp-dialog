<?php
/**
 * TEG_WP_Dialog Frontend Assets
 *
 * Load Frontend Assets.
 *
 * @class    TEG_WD_Frontend_Assets
 * @version  1.0.0
 * @package  TEG_WP_Dialog/Admin
 * @category Admin
 * @author   ThemeEgg
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * TEG_WD_Frontend_Assets Class
 */
class TEG_WD_Frontend_Assets
{

    /**
     * Hook in tabs.
     */
    public function __construct()
    {

        add_action('wp_enqueue_scripts', array($this, 'frontend_styles'));
        add_action('wp_enqueue_scripts', array($this, 'frontend_scripts'));
        //add_action('after_teg_wp_dialog_shortcode', array($this, 'teg_wp_dialog_shortcode_script'));
    }

    /**
     * Enqueue styles.
     */
    public function frontend_styles()
    {

        global $wp_scripts;

        //$jquery_version = isset($wp_scripts->registered['jquery-ui-core']->ver) ? $wp_scripts->registered['jquery-ui-core']->ver : '1.9.2';

        wp_register_style('colorbox-style', FD()->plugin_url() . '/assets/css/colorbox.css', array(), TEG_WD_VERSION);

        wp_enqueue_style('colorbox-style');


    }


    /**
     * Enqueue scripts.
     */
    public function frontend_scripts()
    {
        $suffix = "";// defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

        // Register Scripts

        wp_register_script('colorbox', FD()->plugin_url() . '/assets/js/colorbox/jquery.colorbox' . $suffix . '.js', array(
            'jquery'
        ), TEG_WD_VERSION);


        wp_register_script('teg_wp_dialog_frontend', FD()->plugin_url() . '/assets/js/frontend/frontend' . $suffix . '.js', array(
            'jquery',
            'colorbox'
        ), TEG_WD_VERSION);
        wp_enqueue_script('teg_wp_dialog_frontend');

        $params = array(
            'ajax_url' => admin_url('admin-ajax.php'),

            //'user_input_dropped' => wp_create_nonce('user_input_dropped_nonce')
        );

        wp_localize_script('teg-wp-dialog-frontend', 'teg_wp_dialog_frontend_data', $params);

    }

    public function teg_wp_dialog_shortcode_script()
    {


    }
}

new TEG_WD_Frontend_Assets();
