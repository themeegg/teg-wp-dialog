<?php
/**
 * Plugin Name: TEG WP Dialog
 * Plugin URI: http://themeegg.com.np/plugins/teg-wp-dialog
 * Description: Show dialog on home page or any other page and on posts with this shortcode. Example: [teg_wp_dialog post_id="1"] or [teg_wp_dialog page_id="4"]
 * Version: 1.0.0
 * Author: ThemeEgg
 * Author URI: http://themeegg.com
 * Requires at least: 4.0
 * Tested up to: 4.8
 *
 * Text Domain: teg-wp-dialog
 * Domain Path: /languages/
 *
 * @package  TEG_WP_Dialog
 * @category Core
 * @author   ThemeEgg
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (!class_exists('TEG_WP_Dialog')) :

    /**
     * Main TEG_WP_Dialog Class.
     *
     * @class   TEG_WP_Dialog
     * @version 1.0.0
     */
    final class TEG_WP_Dialog
    {

        /**
         * Plugin version.
         * @var string
         */
        public $version = '1.0.0';

        /**
         * Query instance.
         *
         *
         */
        public $query = null;

        /**
         * Instance of this class.
         * @var object
         */
        protected static $_instance = null;

        /**
         * Return an instance of this class.
         * @return object A single instance of this class.
         */
        public static function instance()
        {
            // If the single instance hasn't been set, set it now.
            if (is_null(self::$_instance)) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        /**
         * Cloning is forbidden.
         * @since 1.0
         */
        public function __clone()
        {
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'teg-wp-dialog'), '1.0');
        }

        /**
         * Unserializing instances of this class is forbidden.
         * @since 1.0
         */
        public function __wakeup()
        {
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'teg-wp-dialog'), '1.0');
        }

        /**
         * FlashToolkit Constructor.
         */
        public function __construct()
        {
            $this->define_constants();

            $this->includes();

            $this->init_hooks();

            do_action('teg-wp-dialog-loaded');
        }

        /**
         * Hook into actions and filters.
         */
        private function init_hooks()
        {

            register_activation_hook(__FILE__, array('TWD_Install', 'install'));

            add_action('after_setup_theme', array($this, 'include_template_functions'), 11);


            add_action('init', array($this, 'init'), 0);

            add_action('init', array('TWD_Shortcodes', 'init'));


        }

        public function init()
        {
            // Before init action.
            do_action('before_teg_wp_dialog_init');

            // Set up localisation.
            $this->load_plugin_textdomain();


            // Init action.
            do_action('after_teg_wp_dialog_init');
        }

        /**
         * Define FT Constants.
         */
        private function define_constants()
        {
            $this->define('TWD_DS', DIRECTORY_SEPARATOR);
            $this->define('TWD_PLUGIN_FILE', __FILE__);
            $this->define('TWD_ABSPATH', dirname(__FILE__) . TWD_DS);
            $this->define('TWD_PLUGIN_BASENAME', plugin_basename(__FILE__));
            $this->define('TWD_VERSION', $this->version);
            $this->define('TWD_FORM_PATH', TWD_ABSPATH . 'includes' . TWD_DS . 'form' . TWD_DS);
        }


        /**
         * Define constant if not already set.
         *
         * @param string $name
         * @param string|bool $value
         */
        private function define($name, $value)
        {
            if (!defined($name)) {
                define($name, $value);
            }
        }

        /**
         * What type of request is this?
         *
         * @param  string $type admin or frontend.
         *
         * @return bool
         */
        private function is_request($type)
        {
            switch ($type) {
                case 'admin' :
                    return is_admin();
                case 'frontend' :
                    return (!is_admin() || defined('DOING_AJAX')) && !defined('DOING_CRON');
            }
        }


        public function include_template_functions()
        {
            //include_once( UR_ABSPATH . 'includes/functions-ur-template.php' );
        }

        /**
         * Includes.
         */
        private function includes()
        {


            // core
            include(TWD_ABSPATH . 'includes' . TWD_DS . 'twd-core-functions.php');

            /**
             * Class autoloader.
             */
            include_once(TWD_ABSPATH . 'includes/class-twd-autoloader.php');


            /**
             * Interfaces.
             */

            include_once(TWD_ABSPATH . 'includes/interfaces/class-twd-shortcode-interface.php');

            /**
             * Core classes.
             */

            include_once(TWD_ABSPATH . 'includes/class-twd-install.php');

            include_once(TWD_ABSPATH . 'includes/class-twd-ajax.php');

            if ($this->is_request('admin')) {

                include_once(TWD_ABSPATH . 'includes/admin/class-twd-admin.php');
            }

            if ($this->is_request('frontend')) {


                $this->frontend_includes();
            }


            $this->query = new TWD_Query();

        }


        /**
         * Include required frontend files.
         */
        public function frontend_includes()
        {
            include_once(TWD_ABSPATH . 'includes/frontend/class-twd-frontend.php');

            include_once(TWD_ABSPATH . 'includes/class-twd-shortcodes.php');         // Shortcodes Class

        }

        /**
         * Load Localisation files.
         *
         * Note: the first-loaded translation file overrides any following ones if the same translation is present.
         *
         * Locales found in:
         *      - WP_LANG_DIR/teg-wp-dialog/teg-wp-dialog-LOCALE.mo
         *      - WP_LANG_DIR/plugins/teg-wp-dialog-LOCALE.mo
         */
        public function load_plugin_textdomain()
        {
            $locale = apply_filters('plugin_locale', get_locale(), 'teg-wp-dialog');

            load_textdomain('teg-wp-dialog', WP_LANG_DIR . '/teg-wp-dialog/teg-wp-dialog-' . $locale . '.mo');
            load_plugin_textdomain('teg-wp-dialog', false, plugin_basename(dirname(__FILE__)) . '/languages');
        }

        /**
         * Get the template path.
         * @return string
         */
        public function template_path()
        {
            return apply_filters('teg_wp_dialog_template_path', 'teg-wp-dialog/');
        }

        /**
         * Get the plugin url.
         * @return string
         */
        public function plugin_url()
        {
            return untrailingslashit(plugins_url('/', __FILE__));
        }

        /**
         * Get the plugin path.
         * @return string
         */
        public function plugin_path()
        {
            return untrailingslashit(plugin_dir_path(__FILE__));
        }

        /**
         * Get Ajax URL.
         * @return string
         */
        public function ajax_url()
        {
            return admin_url('admin-ajax.php', 'relative');
        }
    }

endif;

/**
 * Main instance of TEG_WP_Dialog.
 *
 * Returns the main instance of FT to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object
 */
function TWD()
{
    return TEG_WP_Dialog::instance();
}

// Global for backwards compatibility.
$GLOBALS['teg-wp-dialog'] = TWD();
