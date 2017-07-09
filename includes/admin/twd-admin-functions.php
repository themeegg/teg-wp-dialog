<?php
/**
 * TEG_WP_Dialog Admin Functions
 *
 * @author   ThemeEgg
 * @category Core
 * @package  TEG_WP_Dialog/Admin/Functions
 * @version  1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Get all TEG_WP_Dialog screen ids.
 *
 * @return array
 */
function teg_ta_get_screen_ids()
{

    $teg_ta_screen_id = sanitize_title(__('TEG WP Dialog', 'teg-twitter-api'));
    $screen_ids = array(
        'toplevel_page_' . $teg_ta_screen_id,
        //$teg_ta_screen_id . '_page_teg_ta-reports',
    );


    return apply_filters('teg_wp_dialog_screen_ids', $screen_ids);
}


/**
 * Get current tab ID
 *
 * @return array
 */
function teg_ta_get_current_tab()
{

    $current_tab = isset($_GET['tab']) ? $_GET['tab'] : '';

    return apply_filters('teg_wp_dialog_current_tab', $current_tab);
}

/**
 * Get current section
 *
 * @return array
 */
function teg_ta_get_current_section()
{

    $current_tab = isset($_GET['section']) ? $_GET['section'] : '';

    return apply_filters('teg_wp_dialog_current_section', $current_tab);
}





