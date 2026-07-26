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
 * Human App Status Badge Markup Helper
 */
function human_get_status_badge($status) {
    switch (strtoupper($status)) {
        case 'AVAILABLE':
            return '<span class="badge badge-available"><span style="width:6px;height:6px;border-radius:50%;background:#10B981;display:inline-block;"></span> Available</span>';
        case 'IN_DEVELOPMENT':
        case 'IN DEVELOPMENT':
            return '<span class="badge badge-dev"><span style="width:6px;height:6px;border-radius:50%;background:#0066FF;display:inline-block;"></span> In Development</span>';
        case 'COMING_SOON':
        case 'COMING SOON':
            return '<span class="badge badge-coming"><span style="width:6px;height:6px;border-radius:50%;background:#F59E0B;display:inline-block;"></span> Coming Soon</span>';
        case 'PLANNED':
        default:
            return '<span class="badge badge-planned"><span style="width:6px;height:6px;border-radius:50%;background:#6B7280;display:inline-block;"></span> Planned</span>';
    }
}
