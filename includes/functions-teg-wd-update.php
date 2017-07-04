<?php
/**
 * TEG_WP_Dialog Updates
 *
 * Function for updating data, used by the background updater.
 *
 * @author   ThemeEgg
 * @category Core
 * @package  FrontendDilaog/Functions
 * @version  1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

function fd_update_100_db_version()
{
    TEG_WD_Install::update_db_version('1.0.0');
}
