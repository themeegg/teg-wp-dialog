<?php
/**
 * TEG_WP_Dialog Admin.
 *
 * @class    TWD_Admin
 * @version  1.0.0
 * @package  TEG_WP_Dialog/Admin
 * @category Admin
 * @author   ThemeEgg
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * TWD_Admin Class
 */
class TWD_Admin
{

    /**
     * Hook in tabs.
     */
    public function __construct()
    {

        add_action('init', array($this, 'includes'));
    }

    /**
     * Includes any classes we need within admin.
     */
    public function includes()
    {

        include_once(TWD_ABSPATH . 'includes' . TWD_DS . 'admin' . TWD_DS . 'class-twd-admin-assets.php');

        include_once(dirname(__FILE__) . '/class-twd-admin-notices.php');

    }
}

return new TWD_Admin();
