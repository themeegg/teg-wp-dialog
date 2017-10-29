<?php
/**
 * The template for displaying wp dialog
 *
 * This template can be overridden by copying it to yourtheme/teg-wp-dialog/content-shortcode-wp-dialog-nifty=modal.php
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

/*
* @since 1.0.1
*/
?>
<div class="twd-nifty-modal">
    <button class="md-trigger" data-modal="modal-<?php echo $template_id; ?>">Modal <?php echo $template_id; ?></button>
    <div class="md-overlay"></div><!-- the overlay element -->

    <div class="md-modal md-effect-<?php echo $template_id; ?>" id="modal-<?php echo $template_id; ?>">
        <div class="md-content">
            <h3><?php echo $post_title; ?></h3>
            <div>


	            <p>       <?php echo do_shortcode($post_content); ?>
                </p>

				<?php

				$close_button_node = '';

				if ( 'yes' === $show_close_button ) {

					$close_button_node = '<button class="md-close">' . $close_button_label . '</button>';
				}
				echo $close_button_node;
				?>
            </div>
        </div>
    </div>
</div>
<style>
    <?php echo $nifty_style; ?>
    .twd-nifty-modal .md-content h3 {

        color: #fff;
    }

    .twd-nifty-modal .md-trigger {
        display: none;
    }


</style>
