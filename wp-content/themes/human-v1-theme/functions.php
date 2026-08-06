<?php
/**
 * Human V1 Theme Functions & Setup
 *
 * Production WordPress Theme for humanv1.com
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function human_v1_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('custom-logo', array(
        'height'      => 40,
        'width'       => 160,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Register Navigation Menus
    register_nav_menus(array(
        'primary-menu' => __('Primary Header Menu', 'human-v1-theme'),
        'footer-menu'  => __('Footer Navigation Menu', 'human-v1-theme'),
        'apps-menu'    => __('Apps Navigation Menu', 'human-v1-theme'),
    ));
}
add_action('after_setup_theme', 'human_v1_theme_setup');

/**
 * Enqueue Styles & Scripts
 */
function human_v1_theme_scripts() {
    wp_enqueue_style('google-fonts-jakarta', 'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600&display=swap', array(), null);
    wp_enqueue_style('human-v1-style', get_stylesheet_uri(), array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'human_v1_theme_scripts');

/**
 * Custom Title Filter for Native SEO Engine
 */
function human_custom_document_title($title) {
    if (function_exists('human_get_seo_metadata')) {
        $meta = human_get_seo_metadata();
        if (!empty($meta['title'])) {
            return $meta['title'];
        }
    }
    return $title;
}
add_filter('pre_get_document_title', 'human_custom_document_title', 20);

/**
 * Human App Status Badge Markup Helper.
 *
 * Lifecycle normalization belongs to the Human Platform plugin. The theme
 * deliberately fails closed to the `future` state when the plugin is not
 * available.
 */
function human_get_status_badge($status, $app_slug = '') {
    $raw_status = is_scalar($status) ? (string) $status : '';
    $slug = is_scalar($app_slug) ? sanitize_key((string) $app_slug) : '';
    $normalized_status = function_exists('human_normalize_app_status')
        ? human_normalize_app_status($raw_status, $slug)
        : 'future';

    switch ($normalized_status) {
        case 'available':
            return '<span class="badge badge-available"><span style="width:6px;height:6px;border-radius:50%;background:#10B981;display:inline-block;"></span> Available</span>';
        case 'internal_testing':
            return '<span class="badge badge-dev"><span style="width:6px;height:6px;border-radius:50%;background:#0066FF;display:inline-block;"></span> Internal Testing</span>';
        case 'coming_soon':
            return '<span class="badge badge-coming"><span style="width:6px;height:6px;border-radius:50%;background:#F59E0B;display:inline-block;"></span> Coming Soon</span>';
        case 'paused':
            return '<span class="badge badge-coming"><span style="width:6px;height:6px;border-radius:50%;background:#F59E0B;display:inline-block;"></span> Paused</span>';
        case 'retired':
            return '<span class="badge badge-planned"><span style="width:6px;height:6px;border-radius:50%;background:#475569;display:inline-block;"></span> Retired</span>';
        case 'future':
        default:
            return '<span class="badge badge-planned"><span style="width:6px;height:6px;border-radius:50%;background:#6B7280;display:inline-block;"></span> Future Product</span>';
    }
}

/**
 * Find one product in the database-backed canonical App collection.
 */
function human_v1_find_app($slug, $apps = null) {
    $slug = sanitize_key((string) $slug);
    $apps = is_array($apps) ? $apps : (function_exists('human_get_canonical_apps') ? human_get_canonical_apps() : array());

    foreach ($apps as $app) {
        if (is_array($app) && isset($app['slug']) && sanitize_key((string) $app['slug']) === $slug) {
            return $app;
        }
    }

    return array(
        'slug' => $slug,
        'title' => '',
        'current_status' => 'future',
        'description' => '',
        'app_id' => '',
        'pricing' => '',
        'target_url' => '',
        'play_url' => '',
        'internal_test_url' => '',
        'cta_label' => '',
    );
}

/**
 * Return the normalized status for a canonical App record.
 */
function human_v1_get_app_status($app) {
    if (!is_array($app)) {
        return 'future';
    }

    if (isset($app['current_status']) && is_scalar($app['current_status'])) {
        $raw_status = (string) $app['current_status'];
    } elseif (isset($app['status']) && is_scalar($app['status'])) {
        // Compatibility for the legacy fallback record shape.
        $raw_status = (string) $app['status'];
    } else {
        $raw_status = '';
    }
    $slug = isset($app['slug']) && is_scalar($app['slug']) ? sanitize_key((string) $app['slug']) : '';

    return function_exists('human_normalize_app_status')
        ? human_normalize_app_status($raw_status, $slug)
        : 'future';
}

/**
 * Resolve a lifecycle-controlled commercial CTA.
 *
 * Public Play actions are available only for a verified public listing.
 * Internal-testing actions are available only for a verified test URL. All
 * other states deliberately return a non-clickable, truthful label.
 */
function human_v1_get_app_action($app) {
    $status = human_v1_get_app_status($app);
    $play_url = isset($app['play_url']) && is_scalar($app['play_url']) ? trim((string) $app['play_url']) : '';
    $internal_test_url = isset($app['internal_test_url']) && is_scalar($app['internal_test_url']) ? trim((string) $app['internal_test_url']) : '';
    $custom_label = isset($app['cta_label']) && is_scalar($app['cta_label']) ? trim((string) $app['cta_label']) : '';
    $valid_play_url = function_exists('human_validate_google_play_url')
        ? human_validate_google_play_url($play_url, 'public')
        : '';
    $valid_internal_test_url = function_exists('human_validate_google_play_url')
        ? human_validate_google_play_url($internal_test_url, 'internal')
        : '';

    if ($status === 'available' && $valid_play_url !== '') {
        return array(
            'enabled' => true,
            'url' => $valid_play_url,
            'label' => $custom_label !== '' && preg_match('/play|download/i', $custom_label)
                ? $custom_label
                : __('Get on Google Play', 'human-v1-theme'),
        );
    }

    if ($status === 'internal_testing' && $valid_internal_test_url !== '') {
        return array(
            'enabled' => true,
            'url' => $valid_internal_test_url,
            'label' => $custom_label !== '' && preg_match('/test/i', $custom_label)
                ? $custom_label
                : __('Open Internal Test', 'human-v1-theme'),
        );
    }

    $disabled_labels = array(
        'available' => __('Google Play listing unavailable', 'human-v1-theme'),
        'internal_testing' => __('Internal Testing — invited testers only', 'human-v1-theme'),
        'coming_soon' => __('Coming Soon', 'human-v1-theme'),
        'future' => __('Future Product', 'human-v1-theme'),
        'paused' => __('Currently Paused', 'human-v1-theme'),
        'retired' => __('Retired', 'human-v1-theme'),
    );

    return array(
        'enabled' => false,
        'url' => '',
        'label' => isset($disabled_labels[$status]) ? $disabled_labels[$status] : $disabled_labels['future'],
    );
}
