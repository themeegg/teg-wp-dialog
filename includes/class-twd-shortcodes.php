<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * TWD_Shortcodes class
 *
 * @class       TWD_Shortcodes
 * @version     1.0.0
 * @package     TEG_Twitter_Api/Classes
 * @category    Class
 * @author      ThemeEgg
 */
class TWD_Shortcodes
{

    /**
     * Init shortcodes.
     */
    public static function init()
    {
        $shortcodes = array(

            'teg_wp_dialog' => __CLASS__ . '::teg_wp_dialog',

        );

        foreach ($shortcodes as $shortcode => $function) {
            add_shortcode(apply_filters("{$shortcode}_shortcode_tag", $shortcode), $function);
        }


    }

    /**
     * Shortcode Wrapper.
     *
     * @param string[] $function
     * @param array $atts (default: array())
     * @param array $wrapper
     *
     * @return string
     */
    public static function shortcode_wrapper(
        $function,
        $atts = array(),
        $wrapper = array(
            'class' => 'teg-wp-dialog-wrapper',
            'before' => null,
            'after' => null,
        )
    )
    {
        ob_start();

        echo empty($wrapper['before']) ? '<div class="' . esc_attr($wrapper['class']) . '">' : $wrapper['before'];
        call_user_func($function, $atts);
        echo empty($wrapper['after']) ? '</div>' : $wrapper['after'];

        return ob_get_clean();
    }

    /**
     * wp dialog shortcodes
     *
     * @param mixed $atts
     * @return string
     */
    public static function teg_wp_dialog($atts)
    {
        return self::shortcode_wrapper(array('TWD_Shortcode_WP_Dialog', 'output'), $atts);
    }

}
