<?php
/**
 * Human Apps archive template.
 *
 * The human_app post-type archive owns the /apps/ route. Reuse the curated
 * catalogue template so the archive and the optional WordPress Page remain
 * one presentation rather than maintaining two copies of the same markup.
 */

if (!defined('ABSPATH')) {
    exit;
}

require get_theme_file_path('/page-apps.php');
