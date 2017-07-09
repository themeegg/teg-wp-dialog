<?php
/**
 * Contains the query functions for TEG WP Dialog which alter the front-end post queries and loops
 *
 * @class        TWD_Query
 * @version        1.0.0
 * @package        TEG_WP_Dialog/Classes
 * @category    Class
 * @author        ThemeEgg
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * TWD_Query Class.
 */
class TWD_Query
{

    /** @public array Query vars to add to wp */
    public $query_vars = array();

    /**
     * Stores chosen attributes
     * @var array
     */
    private static $_chosen_attributes;

    /**
     * Constructor for the query class. Hooks in methods.
     *
     * @access public
     */
    public function __construct()
    {
        add_action('init', array($this, 'add_endpoints'));
        if (!is_admin()) {
            add_filter('query_vars', array($this, 'add_query_vars'), 0);
            add_action('parse_request', array($this, 'parse_request'), 0);
            add_action('pre_get_posts', array($this, 'pre_get_posts'));
        }
        $this->init_query_vars();
    }


    /**
     * Init query vars by loading options.
     */
    public function init_query_vars()
    {
        // Query vars to add to WP.
        $this->query_vars = array();
    }

    /**
     * Get page title for an endpoint.
     * @param  string
     * @return string
     */
    public function get_endpoint_title($endpoint)
    {
        global $wp;

        switch ($endpoint) {
            case 'order-pay' :
                $title = __('Pay for order', 'teg-wp-dialog');
                break;

            default :
                $title = '';
                break;
        }

        return apply_filters('teg_wp_dialog_endpoint_' . $endpoint . '_title', $title, $endpoint);
    }

    /**
     * Endpoint mask describing the places the endpoint should be added.
     *
     * @since 2.6.2
     * @return int
     */
    public function get_endpoints_mask()
    {
        if ('page' === get_option('show_on_front')) {
            $page_on_front = get_option('page_on_front');
            $myaccount_page_id = get_option('teg_wp_dialog_myaccount_page_id');
            $checkout_page_id = get_option('teg_wp_dialog_checkout_page_id');

            if (in_array($page_on_front, array($myaccount_page_id, $checkout_page_id))) {
                return EP_ROOT | EP_PAGES;
            }
        }

        return EP_PAGES;
    }

    /**
     * Add endpoints for query vars.
     */
    public function add_endpoints()
    {
        $mask = $this->get_endpoints_mask();

        foreach ($this->query_vars as $key => $var) {
            if (!empty($var)) {
                add_rewrite_endpoint($var, $mask);
            }
        }
    }

    /**
     * Add query vars.
     *
     * @access public
     * @param array $vars
     * @return array
     */
    public function add_query_vars($vars)
    {
        foreach ($this->get_query_vars() as $key => $var) {
            $vars[] = $key;
        }
        return $vars;
    }

    /**
     * Get query vars.
     *
     * @return array
     */
    public function get_query_vars()
    {
        return apply_filters('teg_wp_dialog_get_query_vars', $this->query_vars);
    }

    /**
     * Get query current active query var.
     *
     * @return string
     */
    public function get_current_endpoint()
    {
        global $wp;
        foreach ($this->get_query_vars() as $key => $value) {
            if (isset($wp->query_vars[$key])) {
                return $key;
            }
        }
        return '';
    }

    /**
     * Parse the request and look for query vars - endpoints may not be supported.
     */
    public function parse_request()
    {
        global $wp;

        // Map query vars to their keys, or get them if endpoints are not supported
        foreach ($this->get_query_vars() as $key => $var) {
            if (isset($_GET[$var])) {
                $wp->query_vars[$key] = $_GET[$var];
            } elseif (isset($wp->query_vars[$var])) {
                $wp->query_vars[$key] = $wp->query_vars[$var];
            }
        }
    }

    /**
     * Are we currently on the front page?
     *
     * @param object $q
     *
     * @return bool
     */
    private function is_showing_page_on_front($q)
    {
        return $q->is_home() && 'page' === get_option('show_on_front');
    }

    /**
     * Is the front page a page we define?
     *
     * @param int $page_id
     *
     * @return bool
     */
    private function page_on_front_is($page_id)
    {
        return absint(get_option('page_on_front')) === absint($page_id);
    }

    /**
     * Hook into pre_get_posts to do the main product query.
     *
     * @param object $q query object
     */
    public function pre_get_posts($q)
    {
        // We only want to affect the main query
        if (!$q->is_main_query()) {
            return;
        }

        // Fix for endpoints on the homepage
        if ($this->is_showing_page_on_front($q) && !$this->page_on_front_is($q->get('page_id'))) {
            $_query = wp_parse_args($q->query);
            if (!empty($_query) && array_intersect(array_keys($_query), array_keys($this->query_vars))) {
                $q->is_page = true;
                $q->is_home = false;
                $q->is_singular = true;
                $q->set('page_id', (int)get_option('page_on_front'));
                add_filter('redirect_canonical', '__return_false');
            }
        }


        // Special check for shops with the product archive on front


        // And remove the pre_get_posts hook
    }


}
