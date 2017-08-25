<?php

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://themeegg.com/plugins/teg-wp-dialog//
 * @since      1.0.0
 *
 * @package    Popup Dialog_For_WP
 * @subpackage Popup Dialog_For_WP/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Popup Dialog_For_WP
 * @subpackage Popup Dialog_For_WP/admin
 * @author     ThemeEgg <themeeggofficial@gmail.com>
 */
class TWD_Post_Types {

	public function __construct() {

		$this->register_custom_post_types();

		add_action( 'manage_teg-wp-dialog_custom_column', array( $this, 'action_custom_columns_content' ), 10, 3 );

		add_filter( 'manage_edit-teg-wp-dialog_columns', array( $this, 'dialog_shortcode_column' ), 10, 1 );

		/*add_action( 'twd-dialog_add_form_fields', array( $this, 'twd_dialog_add_new_meta_field' ), 10, 2 );
		add_action( 'twd-dialog_edit_form_fields', array( $this, 'twd_dialog_edit_new_meta_field' ), 10, 2 );
		add_action( 'edited_twd-dialog', array( $this, 'twd_dialog_custom_meta' ), 10, 2 );
		add_action( 'create_twd-dialog', array( $this, 'twd_dialog_custom_meta' ), 10, 2 );*/

	}

	public function twd_dialog_custom_meta( $term_id ) {


		if ( isset( $_POST['term_meta'] ) ) {

			$cat_keys = array_keys( $_POST['term_meta'] );
			foreach ( $cat_keys as $key ) {
				if ( isset ( $_POST['term_meta'][ $key ] ) ) {

					$term_meta_value = sanitize_text_field( $_POST['term_meta'][ $key ] );
					update_term_meta( $term_id, $key, $term_meta_value );

				}
			}

			// Save the option array.

		}
	}

	public function twd_dialog_add_new_meta_field() {
		?>

		<div class="form-field">
			<label for="term_meta[acwp_term_template]"><?php _e( 'Popup Dialog template', 'teg-wp-dialog' ); ?></label>
			<select style="width:94%" name="term_meta[acwp_term_template]" id="term_meta[acwp_term_template]">
				<?php
				foreach ( afwp_accordion_templates() as $template_index => $template_value ) {

					?>
					<option value="<?php echo $template_index ?>"><?php echo $template_value; ?></option>
					<?php

				}

				?>
			</select>
			<p class="description"><?php _e( 'Select template for accordion', 'teg-wp-dialog' ); ?></p>
		</div>
		<div class="form-field">
			<label for="term_meta[acwp_term_style]"><?php _e( 'Popup Dialog style', 'teg-wp-dialog' ); ?></label>
			<select style="width:94%" name="term_meta[acwp_term_style]" id="term_meta[acwp_term_style]">
				<?php
				foreach ( afwp_accordion_styles() as $template_index => $template_value ) {
					?>
					<option value="<?php echo $template_index ?>"><?php echo $template_value; ?></option>
					<?php
				}

				?>
			</select>
			<p class="description"><?php _e( 'Select style for accordion', 'teg-wp-dialog' ); ?></p>
		</div>
		<?php


	}

	public function twd_dialog_edit_new_meta_field( $term ) {
		// put the term ID into a variable
		$t_id = $term->term_id;
		// retrieve the existing value(s) for this meta field. This returns an array
		$acwp_term_template1 = get_term_meta( $t_id );

		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label
					for="term_meta[acwp_term_template]"><?php _e( 'Popup Dialog template', 'teg-wp-dialog' ); ?></label>
			</th>
			<td>
				<select style="width:94%" name="term_meta[acwp_term_template]" id="term_meta[acwp_term_template]">
					<?php
					$acwp_term_template = get_term_meta( $t_id, 'acwp_term_template', true );

					foreach ( afwp_accordion_templates() as $template_index => $template_value ) {
						?>
						<option value="<?php echo $template_index ?>"

							<?php echo $acwp_term_template === $template_index ? 'selected= "selected"' : '' ?>
						><?php echo $template_value; ?></option>
						<?php

					}

					?>
				</select>
				<p class="description"><?php _e( 'Select template for accordion', 'teg-wp-dialog' ); ?></p>
			</td>
		</tr>
		<tr class="form-field">
			<th scope="row" valign="top"><label
					for="term_meta[acwp_term_style]"><?php _e( 'Popup Dialog style', 'teg-wp-dialog' ); ?></label>
			</th>
			<td>
				<select style="width:94%" name="term_meta[acwp_term_style]" id="term_meta[acwp_term_style]">
					<?php
					$acwp_term_style = get_term_meta( $t_id, 'acwp_term_style', true );

					foreach ( afwp_accordion_styles() as $template_index => $template_value ) {
						?>
						<option value="<?php echo $template_index ?>"
							<?php echo $acwp_term_style === $template_index ? 'selected= "selected"' : '' ?>
						><?php echo $template_value; ?></option>
						<?php

					}
					?>
				</select>
				<p class="description"><?php _e( 'Select style for accordion', 'teg-wp-dialog' ); ?></p>
			</td>
		</tr>

		<?php


	}

	/**
	 * @param $column_id
	 * @param $post_id
	 *
	 * @return string
	 */
	function action_custom_columns_content( $content, $column_id, $taxonomy_id ) {
		//run a switch statement for all of the custom columns created
		switch ( $column_id ) {
			case 'dialog_shortcode':
				return '<span onclick="">[afwp_group_accordion id="' . $taxonomy_id . '"]</span>';
				break;

		}
	}

	/**
	 * @param $columns
	 *
	 * @return array
	 */
	function dialog_shortcode_column( $columns ) {

		$key    = 'author';
		$offset = array_search( $key, array_keys( $columns ) );

		$result = array_merge
		(
			array_slice( $columns, 0, $offset ),
			array( 'dialog_shortcode' => __( 'Shortcode', 'teg-wp-dialog' ) ),
			array_slice( $columns, $offset, null )
		);

		return $result;
	}

	public function register_custom_post_types() {
		$labels = array(
			'name'               => _x( 'Popup Dialog', 'post type general name', 'teg-wp-dialog' ),
			'singular_name'      => _x( 'Popup Dialog', 'post type singular name', 'teg-wp-dialog' ),
			'menu_name'          => _x( 'Popup Dialogs', 'admin menu', 'teg-wp-dialog' ),
			'name_admin_bar'     => _x( 'Popup Dialog', 'add new on admin bar', 'teg-wp-dialog' ),
			'add_new'            => _x( 'Add New', 'add new', 'teg-wp-dialog' ),
			'add_new_item'       => __( 'Add New Popup Dialog', 'teg-wp-dialog' ),
			'new_item'           => __( 'New Popup Dialog', 'teg-wp-dialog' ),
			'edit_item'          => __( 'Edit Popup Dialog', 'teg-wp-dialog' ),
			'view_item'          => __( 'View Popup Dialog', 'teg-wp-dialog' ),
			'all_items'          => __( 'All Popup Dialogs', 'teg-wp-dialog' ),
			'search_items'       => __( 'Search Popup Dialogs', 'teg-wp-dialog' ),
			'parent_item_colon'  => __( 'Parent Popup Dialogs:', 'teg-wp-dialog' ),
			'not_found'          => __( 'No popup dialogs found.', 'teg-wp-dialog' ),
			'not_found_in_trash' => __( 'No popup dialogs found in Trash.', 'teg-wp-dialog' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'teg-wp-dialog' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'meta_box_cb'        => 'teg-wp-dialog_categories_meta_box',
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'teg-wp-dialog' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'          => 'dashicons-admin-page',
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		);


		register_post_type( 'teg-wp-dialog', $args );
	}

	public function twd_dialog_dropdown( $post, $box ) {


		/*wp_dropdown_categories( array(
			'taxonomy'         => $taxonomy,
			'hide_empty'       => 0,
			'name'             => "{$name}[]",
			'selected'         => 1,
			'orderby'          => 'name',
			'hierarchical'     => 0,
			'show_option_none' => '&mdash;'
		) );*/


	}


}

new TWD_Post_Types();
