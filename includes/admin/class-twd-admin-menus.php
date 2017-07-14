<?php
/**
 * Setup menus in WP admin.
 *
 * @author   ThemeEgg
 * @category Admin
 * @package  TEG_WP_Dialog/Admin
 * @version  1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('TWD_Admin_Menus', false)) :

    /**
     * TWD_Admin_Menus Class.
     */
    class TWD_Admin_Menus
    {

        /**
         * Hook in tabs.
         */
        public function __construct()
        {
            // Add menus
            add_action('admin_menu', array($this, 'admin_menu'), 9);


        }

        /**
         * Add menu items.
         */
        public function admin_menu()
        {
            global $menu;


            add_menu_page(__('Dialog Settings', 'teg-wp-dialog'),
                __('Dialog Settings', 'teg-wp-dialog'),
                'manage_options',
                'teg-wp-dialog',
                array($this, 'settings_page'), 'dashicons-admin-page', '55.5');


        }


        /**
         * Init the settings page.
         */
        public function settings_page()
        {
            TWD_Admin_Settings::output();
        }

    }

endif;

return new TWD_Admin_Menus();
