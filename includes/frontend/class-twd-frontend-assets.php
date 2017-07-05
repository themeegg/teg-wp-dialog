<?php
/**
 * TEG_WP_Dialog Frontend Assets
 *
 * Load Frontend Assets.
 *
 * @class    TWD_Frontend_Assets
 * @version  1.0.0
 * @package  TEG_WP_Dialog/Admin
 * @category Admin
 * @author   ThemeEgg
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * TWD_Frontend_Assets Class
 */
class TWD_Frontend_Assets
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

        wp_register_style('colorbox-style', TWD()->plugin_url() . '/assets/css/colorbox.css', array(), TWD_VERSION);

        wp_enqueue_style('colorbox-style');


    }


    /**
     * Enqueue scripts.
     */
    public function frontend_scripts()
    {
        $suffix = "";// defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

        // Register Scripts

        wp_register_script('colorbox', TWD()->plugin_url() . '/assets/js/colorbox/jquery.colorbox' . $suffix . '.js', array(
            'jquery'
        ), TWD_VERSION);


        wp_register_script('teg_wp_dialog_frontend', TWD()->plugin_url() . '/assets/js/frontend/frontend' . $suffix . '.js', array(
            'jquery',
            'colorbox'
        ), TWD_VERSION);
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

new TWD_Frontend_Assets();
