<?php
/**
 * TEG WP Dialog Core Functions
 *
 * General core functions available on both the front-end and admin.
 *
 * @author        ThemeEgg
 * @category    Core
 * @package    TEG_WP_Dialog/Functions
 * @version     1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}


include('twd-formatting-functions.php');
include('twd-widget-functions.php');


/**
 * Display a TEG WP Dialog help tip.
 *
 * @since  1.0.0
 *
 * @param  string $tip Help tip text
 * @param  bool $allow_html Allow sanitized HTML if true or escape
 * @return string
 */
function twd_help_tip($tip, $allow_html = false)
{
    if ($allow_html) {
        $tip = twd_sanitize_tooltip($tip);
    } else {
        $tip = esc_attr($tip);
    }

    return '<span class="teg-twitter-api-help-tip" data-tip="' . $tip . '"></span>';
}

/**
 * Get template part (for templates like the shop-loop).
 *
 * TWD_TEMPLATE_DEBUG_MODE will prevent overrides in themes from taking priority.
 *
 * @access public
 * @param mixed $slug
 * @param string $name (default: '')
 */
function twd_get_template_part($slug, $name = '')
{
    $template = '';

    // Look in yourtheme/slug-name.php and yourtheme/teg-twitter-api/slug-name.php
    if ($name && !TWD_TEMPLATE_DEBUG_MODE) {
        $template = locate_template(array("{$slug}-{$name}.php", TWD()->template_path() . "{$slug}-{$name}.php"));
    }

    // Get default slug-name.php
    if (!$template && $name && file_exists(TWD()->plugin_path() . "/templates/{$slug}-{$name}.php")) {
        $template = TWD()->plugin_path() . "/templates/{$slug}-{$name}.php";
    }

    // If template file doesn't exist, look in yourtheme/slug.php and yourtheme/teg-tfwitter-api/slug.php
    if (!$template && !TWD_TEMPLATE_DEBUG_MODE) {
        $template = locate_template(array("{$slug}.php", TWD()->template_path() . "{$slug}.php"));
    }

    // Allow 3rd party plugins to filter template file from their plugin.
    $template = apply_filters('twd_get_template_part', $template, $slug, $name);

    if ($template) {
        load_template($template, false);
    }
}

/**
 * Get other templates (e.g. product attributes) passing attributes and including the file.
 *
 * @access public
 * @param string $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 */
function twd_get_template($template_name, $args = array(), $template_path = '', $default_path = '')
{
    if (!empty($args) && is_array($args)) {
        extract($args);
    }

    $located = twd_locate_template($template_name, $template_path, $default_path);

    if (!file_exists($located)) {
        _doing_it_wrong(__FUNCTION__, sprintf(__('%s does not exist.', 'teg-wp-dialog'), '<code>' . $located . '</code>'), '1.0');
        return;
    }

    // Allow 3rd party plugin filter template file from their plugin.
    $located = apply_filters('twd_get_template', $located, $template_name, $args, $template_path, $default_path);

    do_action('teg_wp_dialog_before_template_part', $template_name, $template_path, $located, $args);


    include($located);

    do_action('teg_wp_dialog_after_template_part', $template_name, $template_path, $located, $args);
}


/**
 * Like twd_get_template, but returns the HTML instead of outputting.
 *
 * @see twd_get_template
 * @since 2.5.0
 * @param string $template_name
 * @param array $args
 * @param string $template_path
 * @param string $default_path
 *
 * @return string
 */
function twd_get_template_html($template_name, $args = array(), $template_path = '', $default_path = '')
{
    ob_start();
    twd_get_template($template_name, $args, $template_path, $default_path);
    return ob_get_clean();
}

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 *        yourtheme        /    $template_path    /    $template_name
 *        yourtheme        /    $template_name
 *        $default_path    /    $template_name
 *
 * @access public
 * @param string $template_name
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return string
 */
function twd_locate_template($template_name, $template_path = '', $default_path = '')
{
    if (!$template_path) {
        $template_path = TWD()->template_path();
    }

    if (!$default_path) {
        $default_path = TWD()->plugin_path() . '/templates/';
    }

    // Look within passed path within the theme - this is priority.
    $template = locate_template(
        array(
            trailingslashit($template_path) . $template_name,
            $template_name,
        )
    );

    // Get default template/
    if (!$template || TWD_TEMPLATE_DEBUG_MODE) {
        $template = $default_path . $template_name;
    }

    // Return what we found.
    return apply_filters('teg_wp_dialog_locate_template', $template, $template_name, $template_path);
}

function twd_include($path)
{
    $path = str_replace('/', DIRECTORY_SEPARATOR, $path);
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
    if (!file_exists($path)) {

        die('File not exists: ' . $path);
    }
    include_once($path);

}

