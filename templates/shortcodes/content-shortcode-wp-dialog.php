<?php
/**
 * The template for displaying wp dialog
 *
 * This template can be overridden by copying it to yourtheme/teg-wp-dialog/content-shortcode-wp-dialog.php
 *
 * HOWEVER, on occasion TEG WP Dialog will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see    https://docs.themeegg.com/document/template-structure/
 * @author  ThemeEgg
 * @package TEG_WP_Dialog/Templates
 * @version 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;

}


?>

<div class="teg-wp-dialog" data-remodal-id="modal">
    <button data-remodal-action="close" class="remodal-close"></button>
    <h2><?php echo $post_title; ?></h2>
    <p>
		<?php echo do_shortcode($post_content); ?>
    </p>
    <br>
	<?php

	$close_button_node = '';

	if ( 'yes' === $show_close_button ) {

		$close_button_node = '<button data-remodal-action="cancel" class="remodal-cancel">' . $close_button_label . '</button>';
	}
	echo $close_button_node;
	?>


</div>


