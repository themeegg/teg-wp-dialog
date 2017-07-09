<?php
/**
 * The template for displaying wp dialog
 *
 * This template can be overridden by copying it to yourtheme/teg-twitter-api/content-widget-twitter-trends.php
 *
 * HOWEVER, on occasion TEG Twitter API will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see    https://docs.themeegg.com/document/template-structure/
 * @author  ThemeEgg
 * @package TEGTwitterApi/Templates
 * @version 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;

}


?>

<div class="teg-wp-dialog" data-remodal-id="modal">
    <button data-remodal-action="close" class="remodal-close"></button>
    <h2><?php echo $post_title; ?></h2>
    <p>
        <?php echo $post_content; ?>
    </p>
    <br>
    <button data-remodal-action="cancel" class="remodal-cancel"><?php echo __('Close', 'teg-wp-dialog'); ?></button>
    <!--        <button data-remodal-action="confirm" class="remodal-confirm">OK</button>-->
</div>


