<?php
/**
 * Plugin Name: Human Platform Core
 * Plugin URI: https://humanv1.com
 * Description: Core platform functionality for the Human ecosystem. Registers Human Apps CPT, app status taxonomies, REST API endpoints, and hooks for future human-marketing extension.
 * Version: 1.0.0
 * Author: Human V1
 * Text Domain: human-platform
 * Requires PHP: 8.2
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

define('HUMAN_PLATFORM_VERSION', '1.0.0');
define('HUMAN_PLATFORM_PATH', plugin_dir_path(__FILE__));
define('HUMAN_PLATFORM_URL', plugin_dir_url(__FILE__));

// Load dependencies
require_once HUMAN_PLATFORM_PATH . 'inc/cpt-apps.php';
require_once HUMAN_PLATFORM_PATH . 'inc/cpt-cta.php';
require_once HUMAN_PLATFORM_PATH . 'inc/cpt-campaign.php';
require_once HUMAN_PLATFORM_PATH . 'inc/marketing-meta.php';
require_once HUMAN_PLATFORM_PATH . 'inc/taxonomy.php';
require_once HUMAN_PLATFORM_PATH . 'inc/breadcrumbs.php';
require_once HUMAN_PLATFORM_PATH . 'inc/admin-settings.php';
require_once HUMAN_PLATFORM_PATH . 'inc/meta-boxes.php';
require_once HUMAN_PLATFORM_PATH . 'inc/seo-engine.php';
require_once HUMAN_PLATFORM_PATH . 'inc/seed-data.php';
require_once HUMAN_PLATFORM_PATH . 'inc/rest-api.php';
require_once HUMAN_PLATFORM_PATH . 'inc/extension-hooks.php';

/**
 * Plugin Activation
 */
function human_platform_activate() {
    human_register_apps_cpt();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'human_platform_activate');

/**
 * Plugin Deactivation
 */
function human_platform_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'human_platform_deactivate');
