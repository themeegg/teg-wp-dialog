<?php
/**
 * TEGWPDialog General Settings
 *
 * @author      ThemeEgg
 * @category    Admin
 * @package     TEGWPDialog/Admin
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'TWD_Settings_General', false ) ) :

	/**
	 * TWD_Admin_Settings_General.
	 */
	class TWD_Settings_General extends TWD_Settings_Page {

		/**
		 * Constructor.
		 */
		public function __construct() {

			$this->id    = 'general';
			$this->label = TWD_Lang::text( 'general_tab_label' );

			add_filter( 'teg_wp_dialog_settings_tabs_array', array( $this, 'add_settings_page' ), 20 );
			add_action( 'teg_wp_dialog_settings_' . $this->id, array( $this, 'output' ) );
			add_action( 'teg_wp_dialog_settings_save_' . $this->id, array( $this, 'save' ) );
		}

		/**
		 * Get settings array.
		 *
		 * @return array
		 */
		public function get_settings() {


			$settings = array(

				array(
					'title' => TWD_Lang::text( 'general_option' ),
					'type'  => 'title',
					'desc'  => '',
					'id'    => 'general_options'
				),

				array(
					'title'    => TWD_Lang::text( 'dialog_width' ),
					'desc'     => TWD_Lang::text( 'dialog_width_description' ),
					'id'       => 'teg_wp_dialog_width',
					'default'  => 'auto',
					'type'     => 'text',
					'desc_tip' => true,


				),
				array(
					'title'    => TWD_Lang::text( 'show_dialog_close_button' ),
					'desc'     => TWD_Lang::text( 'show_dialog_close_button_description' ),
					'id'       => 'teg_wp_dialog_show_close_button',
					'type'     => 'checkbox',
					'default'  => 'yes',
					'autoload' => false,
					'desc_tip' => true,


				),
				array(
					'title'    => TWD_Lang::text( 'close_button_label' ),
					'desc'     => TWD_Lang::text( 'close_button_label_description' ),
					'id'       => 'teg_wp_dialog_close_button_label',
					'default'  => __( 'Close', 'teg-wp-dialog' ),
					'type'     => 'text',
					'autoload' => false,

					'desc_tip' => true,


				),


				array( 'type' => 'sectionend', 'id' => 'general_options' ),

			);


			return apply_filters( 'teg_wp_dialog_get_settings_' . $this->id, $settings );

		}


		/**
		 * Save settings.
		 */
		public function save() {

			$settings = $this->get_settings();


			TWD_Admin_Settings::save_fields( $settings );
		}
	}

endif;

return new TWD_Settings_General();
