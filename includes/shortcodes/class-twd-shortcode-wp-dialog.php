<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * TWD Shortcodes
 *
 * Used to frontend dialog
 *
 * @author       ThemeEgg
 * @category    Shortcodes
 * @package     TEG_WP_Dialog/Shortcodes/Dialog
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

            $id = is_numeric($atts['post_id']) ? $atts['page_id'] : 0;

            $post_or_page = "post";

        } else if (isset($atts['page_id'])) {


            $id = is_numeric($atts['page_id']) ? $atts['page_id'] : 0;

            $post_or_page = "page";
        }


        $args = array(


            'post_type' => $post_or_page,

            'post_status' => 'publish',

            'post__in' => array($id)
        );
        $post_data_obj = get_posts($args);


        $post_data = isset($post_data_obj[0]) ? $post_data_obj[0] : array();

        $data = array(

            'post_title' => isset($post_data->post_title) ? $post_data->post_title : __('Post not available', 'teg-wp-dialog'),

            'post_id' => isset($post_data->ID) ? $post_data->ID : 0,

            'post_content' => isset($post_data->post_content) ? $post_data->post_content : __('Post not available, please check your shortcode once.', 'teg-wp-dialog'),
        );

        twd_get_template('shortcodes/content-shortcode-wp-dialog.php', $data);


    }
}
