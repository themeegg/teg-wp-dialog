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
			$this->label = __( 'General', 'teg-wp-dialog' );

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
					'title' => __( 'General options', 'teg-wp-dialog' ),
					'type'  => 'title',
					'desc'  => '',
					'id'    => 'general_options'
				),

				array(
					'title'    => __( 'Dialog Width', 'teg-wp-dialog' ),
					'desc'     => __( 'Dialog width, you can use, % or px or auto', 'teg-wp-dialog' ),
					'id'       => 'teg_wp_dialog_width',
					'default'  => 'auto',
					'type'     => 'text',
					'desc_tip' => true,


				),
				array(
					'title'    => __( 'Show dialog close button ? ', 'teg-wp-dialog' ),
					'desc'     => __( 'Tick right, if you want to show close button.', 'teg-wp-dialog' ),
					'id'       => 'teg_wp_dialog_show_close_button',
					'type'     => 'checkbox',
					'default'  => 'yes',
					'autoload' => false,
					'desc_tip' => true,


				),
				array(
					'title'    => __( 'Close button label', 'teg-wp-dialog' ),
					'desc'     => __( 'Label for dialog close button', 'teg-wp-dialog' ),
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
