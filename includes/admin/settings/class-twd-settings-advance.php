<?php
/**
 * TEG Twitter API Product Settings
 *
 * @author   ThemeEgg
 * @category Admin
 * @package  TEG_Twitter_Api/Admin
 * @version  1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!class_exists('TWD_Settings_Advance', false)) :

    /**
     * TWD_Settings_Advance.
     */
    class TWD_Settings_Advance extends TWD_Settings_Page
    {

        /**
         * Constructor.
         */
        public function __construct()
        {


            $this->id = 'advance';

            $this->label = __('Advance', 'teg-wp-dialog');

            add_filter('teg_wp_dialog_settings_tabs_array', array($this, 'add_settings_page'), 20);
            add_action('teg_wp_dialog_settings_' . $this->id, array($this, 'output'));
            add_action('teg_wp_dialog_settings_save_' . $this->id, array($this, 'save'));
            add_action('teg_wp_dialog_sections_' . $this->id, array($this, 'output_sections'));
        }

        /**
         * Get sections.
         *
         * @return array
         */
        public function get_sections()
        {

            $sections = array(
                '' => __('Template Setting', 'teg-wp-dialog'),

                'other_settings' => __('Other Settings', 'teg-wp-dialog'),

            );

            return apply_filters('teg_wp_dialog_get_sections_' . $this->id, $sections);
        }

        /**
         * Output the settings.
         */
        public function output()
        {
            global $current_section;

            $settings = $this->get_settings($current_section);

            TWD_Admin_Settings::output_fields($settings);
        }

        /**
         * Save settings.
         */
        public function save()
        {
            global $current_section;

            $settings = $this->get_settings($current_section);
            TWD_Admin_Settings::save_fields($settings);
        }

        /**
         * Get settings array.
         *
         * @param string $current_section
         *
         * @return array
         */
        public function get_settings($current_section = '')
        {
            if ('other_settings' == $current_section) {

                $settings = apply_filters('teg_twitter_layout_settings', array(

                    array(
                        'title' => __('Other Settings', 'teg-wp-dialog'),
                        'type' => 'title',
                        'desc' => '',
                        'id' => 'twd_advance_other_settings'
                    ),
                    array(
                        'title' => __('Templates', 'teg-wp-dialog'),
                        'desc' => __('Layout tempaltes .', 'teg-wp-dialog'),
                        'id' => 'twd_twitter_trend_shortcode_layout',
                        'default' => 'teg-trend-tmpl1',
                        'type' => 'select',
                        'class' => 'teg-select',
                        'css' => 'min-width: 350px;',
                        'desc_tip' => true,
                        'autoload' => false,
                        'options' => twd_templates(),
                    ), array(
                        'type' => 'sectionend',
                        'id' => 'teg_twitter_layout_settings',
                    ),


                ));

            } else {
                $settings = apply_filters('teg_wp_dialog_general_settings', array(
                    array(
                        'title' => __('Dialog Layouts', 'teg-wp-dialog'),
                        'type' => 'title',
                        'id' => 'twd_advance_templates_settings'),

                    array(
                        'title' => __('Templates ', 'teg-wp-dialog'),
                        'desc' => __('Templates list', 'teg-wp-dialog'),
                        'id' => 'twd_layout_list',
                        'default' => '',
                        'type' => 'select',
                        'class' => 'teg-select',
                        'css' => 'min-width: 200px;',
                        'desc_tip' => true,
                        'options' => twd_templates(),
                    ),

                    array(
                        'type' => 'sectionend',
                        'id' => 'product_rating_options',
                    ),

                ));
            }

            return apply_filters('teg_wp_dialog_get_settings_' . $this->id, $settings, $current_section);
        }
    }

endif;

return new TWD_Settings_Advance();
