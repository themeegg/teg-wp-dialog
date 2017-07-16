<div class="twd-nifty-modal">
    <button class="md-trigger" data-modal="modal-<?php echo $template_id; ?>">Modal <?php echo $template_id; ?></button>
    <div class="md-overlay"></div><!-- the overlay element -->

    <div class="md-modal md-effect-<?php echo $template_id; ?>" id="modal-<?php echo $template_id; ?>">
        <div class="md-content">
            <h3><?php echo $post_title; ?></h3>
            <div>
                <p>        <?php echo $post_content; ?>
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