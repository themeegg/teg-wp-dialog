<?php
/**
 * TEG_WP_Dialog Frontend.
 *
 * @class    TEG_WD_Admin
 * @version  1.0.0
 * @package  TEG_WP_Dialog/Frontend
 * @category Admin
 * @author   ThemeEgg
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * TEG_WD_Admin Class
 */
class TEG_WD_Frontend
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

        include_once(TEG_WD_ABSPATH . 'includes' . TEG_WD_DS . 'frontend' . TEG_WD_DS . 'class-teg-wd-frontend-assets.php');

       
    }
}

return new TEG_WD_Frontend();
