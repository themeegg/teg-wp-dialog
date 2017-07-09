<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Twitter Shortcodes
 *
 * Used to frontend dialog
 *
 * @author        ThemeEgg
 * @category    Shortcodes
 * @package    TEG_WP_Dialog/Shortcodes/Twitter
 * @version     1.0.0
 */
class TWD_Shortcode_WP_Dialog implements TWD_Shortcode_Interface
{


    /**
     * Output the cart shortcode.
     *
     * @param array $atts
     */
    public static function output($atts = array())
    {
        if (empty($atts)) {
            return '';
        }

        if (!isset($atts['post_id']) && !isset($atts['page_id'])) {
            return '';
        }

        if (isset($atts['post_id'])) {
            $atts = shortcode_atts(array(
                'post_id' => '',
            ), $atts, 'teg_wp_dialog');
        }
        if (isset($atts['page_id'])) {
            $atts = shortcode_atts(array(
                'page_id' => '',
            ), $atts, 'teg_wp_dialog');
        }


        $id = 0;

        $post_or_page = "page";


        if (isset($atts['post_id'])) {

            $id = $atts['post_id'];

            $post_or_page = "post";

        }

        $args = array(


            'post_type' => $post_or_page,

            'post_status' => 'publish',

            'post__in' => array($id)
        );
        $post_data = get_posts($args);


        $data = array(

            'data' => $post_data
        );

        twd_get_template('shortcodes/content-shortcode-twitter-feeds.php', $data);


    }
}
