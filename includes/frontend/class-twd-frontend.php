<?php
/**
 * TEG_WP_Dialog Frontend.
 *
 * @class    TWD_Admin
 * @version  1.0.0
 * @package  TEG_WP_Dialog/Frontend
 * @category Admin
 * @author   ThemeEgg
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * TWD_Admin Class
 */
class TWD_Frontend
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

        include_once(TWD_ABSPATH . 'includes' . TWD_DS . 'frontend' . TWD_DS . 'class-twd-frontend-scripts.php');

       
    }
}

return new TWD_Frontend();
