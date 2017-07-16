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

if ( ! class_exists( 'TWD_Settings_Nifty_Modal', false ) ) :

	/**
	 * TWD_Admin_Settings_General.
	 */
	class TWD_Settings_Nifty_Modal extends TWD_Settings_Page {

		/**
		 * Constructor.
		 */
		public function __construct() {

			$this->id    = 'nifty_modal';
			$this->label = TWD_Lang::text( 'nifty_modal_label' );

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
					'title' => TWD_Lang::text( 'nifty_modal_setting_title' ),
					'type'  => 'title',
					'desc'  => '',
					'id'    => 'nifty_modal_setting_options'
				),

				array(
					'title'    => TWD_Lang::text( 'nifty_modal_options' ),
					'desc'     => TWD_Lang::text( 'nifty_modal_option_descriptions' ),
					'id'       => 'teg_wp_dialog_nifty_modal_settings',
					'default'  => 'auto',
					'type'     => 'select',
					'desc_tip' => true,
					'options'  => twd_nifty_modal_setting_options()


				),
				array(
					'title'    => TWD_Lang::text( 'nifty_modal_background_color' ),
					'desc'     => TWD_Lang::text( 'nifty_modal_background_color_descriptions' ),
					'id'       => 'teg_wp_dialog_nifty_modal_background_color_setting',
					'default'  => '#e74c3c',
					'type'     => 'text',
					'desc_tip' => true,
					

				),

				array( 'type' => 'sectionend', 'id' => 'nifty_modal_setting_options' ),

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

return new TWD_Settings_Nifty_Modal();
