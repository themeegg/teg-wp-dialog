<?php
if ( ! defined( 'ABSPATH' ) ) {
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
class TWD_Shortcode_WP_Dialog implements TWD_Shortcode_Interface {


	/**
	 * Output the cart shortcode.
	 *
	 * @param array $atts
	 */
	public static function output( $atts = array() ) {
		if ( empty( $atts ) ) {
			return '';
		}

		if ( ! isset( $atts['post_id'] ) && ! isset( $atts['page_id'] ) ) {
			return '';
		}

		if ( isset( $atts['post_id'] ) ) {
			$atts = shortcode_atts( array(
				'post_id' => '',
			), $atts, 'teg_wp_dialog' );
		}
		if ( isset( $atts['page_id'] ) ) {
			$atts = shortcode_atts( array(
				'page_id' => '',
			), $atts, 'teg_wp_dialog' );
		}


		$id = 0;

		$post_or_page = "page";


		if ( isset( $atts['post_id'] ) ) {

			$id = is_numeric( $atts['post_id'] ) ? $atts['page_id'] : 0;

			$post_or_page = "post";

		} else if ( isset( $atts['page_id'] ) ) {


			$id = is_numeric( $atts['page_id'] ) ? $atts['page_id'] : 0;

			$post_or_page = "page";
		}


		$args          = array(


			'post_type' => $post_or_page,

			'post_status' => 'publish',

			'post__in' => array( $id )
		);
		$post_data_obj = get_posts( $args );


		$post_data = isset( $post_data_obj[0] ) ? $post_data_obj[0] : array();

		$show_close_button = get_option( 'teg_wp_dialog_show_close_button', 'yes' );

		$close_button_label = get_option( 'teg_wp_dialog_close_button_label', __( 'Close', 'teg-wp-dialog' ) );

		$data = array(

			'post_title' => isset( $post_data->post_title ) ? $post_data->post_title : __( 'Post not available', 'teg-wp-dialog' ),

			'post_id' => isset( $post_data->ID ) ? $post_data->ID : 0,

			'post_content' => isset( $post_data->post_content ) ? $post_data->post_content : __( 'Post not available, please check your shortcode once.', 'teg-wp-dialog' ),

			'close_button_label' => $close_button_label,

			'show_close_button' => $show_close_button,


		);

		$template = get_option( 'twd_layout_list', 'default' );

		$template = str_replace( '_', '-', $template );

		$dialog_width = get_option( 'teg_wp_dialog_width' );


		if ( $dialog_width == '' || $dialog_width == 'auto' ) {

			$dialog_width = '630';


		}
		if ( 'nifty-modal' === $template ) {

			$data['template_id'] = str_replace( 'modal-', '', get_option( 'teg_wp_dialog_nifty_modal_settings', 'modal-1' ) );
			$data['nifty_style'] = '
			.twd-nifty-modal .md-content{
				background:' . get_option( 'teg_wp_dialog_nifty_modal_background_color_setting', '#e74c3c' ) . ';
			}
			.twd-nifty-modal .md-modal {
			max-width: ' . $dialog_width . ';
            
            }
			';
		}


		if ( 'default' === $template ) {

			twd_get_template( 'shortcodes/content-shortcode-wp-dialog.php', $data );

		} else {

			twd_get_template( 'shortcodes/content-shortcode-wp-dialog-' . $template . '.php', $data );
		}


	}
}
