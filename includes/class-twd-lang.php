<?php
/**
 * Contains language string
 *
 * @class       TWD_Lang
 * @version     1.0.0
 * @package     TEG_WP_Dialog/Classes
 * @category    Class
 * @author      ThemeEgg
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * TWD_Lang Class.
 */
class TWD_Lang {


	public static function text( $language_key ) {


		$language_array = self::language_array();

		if ( isset( $language_array[ $language_key ] ) ) {


			return $language_array[ $language_key ];

		}

		return $language_key;

	}


	private static function language_array() {


		$language_array = array(

			'close_button_label' => __( 'Close button label', 'teg-wp-dialog' ),

			'general_tab_label' => __( 'General', 'teg-wp-dialog' ),

			'general_option' => __( 'General options', 'teg-wp-dialog' ),

			'dialog_width' => __( 'Dialog width', 'teg-wp-dialog' ),

			'dialog_width_description' => __( 'Dialog width, you can use, % or px or auto', 'teg-wp-dialog' ),

			'show_dialog_close_button' => __( 'Show dialog close button ? ', 'teg-wp-dialog' ),

			'show_dialog_close_button_description' => __( 'Label for dialog close button.', 'teg-wp-dialog' ),

		);


		return apply_filters( 'teg_wp_dialog_language_array', $language_array );
	}

}
