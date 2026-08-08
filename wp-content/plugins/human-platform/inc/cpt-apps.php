<?php
/**
 * Custom Post Type: Human Apps
 * 
 * Registers the 'human_app' CPT and app status taxonomy.
 */

if (!defined('ABSPATH')) {
    exit;
}

function human_register_apps_cpt() {
    $labels = array(
        'name'               => _x('Human Apps', 'post type general name', 'human-platform'),
        'singular_name'      => _x('Human App', 'post type singular name', 'human-platform'),
        'menu_name'          => _x('Human Ecosystem', 'admin menu', 'human-platform'),
        'name_admin_bar'     => _x('Human App', 'add new on admin bar', 'human-platform'),
        'add_new'            => _x('Add New App', 'app', 'human-platform'),
        'add_new_item'       => __('Add New Human App', 'human-platform'),
        'new_item'           => __('New Human App', 'human-platform'),
        'edit_item'          => __('Edit Human App', 'human-platform'),
        'view_item'          => __('View Human App', 'human-platform'),
        'all_items'          => __('All Ecosystem Apps', 'human-platform'),
        'search_items'       => __('Search Ecosystem Apps', 'human-platform'),
        'not_found'          => __('No apps found.', 'human-platform'),
        'not_found_in_trash' => __('No apps found in Trash.', 'human-platform')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'apps'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-smartphone',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true,
    );

    register_post_type('human_app', $args);

    // Register Status Taxonomy
    $tax_labels = array(
        'name'              => _x('App Statuses', 'taxonomy general name', 'human-platform'),
        'singular_name'     => _x('App Status', 'taxonomy singular name', 'human-platform'),
        'search_items'      => __('Search App Statuses', 'human-platform'),
        'all_items'         => __('All App Statuses', 'human-platform'),
        'edit_item'         => __('Edit App Status', 'human-platform'),
        'update_item'       => __('Update App Status', 'human-platform'),
        'add_new_item'      => __('Add New App Status', 'human-platform'),
        'new_item_name'     => __('New App Status Name', 'human-platform'),
        'menu_name'         => __('Status', 'human-platform'),
    );

    register_taxonomy('human_app_status', array('human_app'), array(
        'hierarchical'      => true,
        'labels'            => $tax_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'app-status'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'human_register_apps_cpt');

/**
 * The six lifecycle values which may be persisted for an App.
 */
function human_get_allowed_app_statuses() {
    return array('available', 'internal_testing', 'coming_soon', 'future', 'paused', 'retired');
}

/**
 * Normalize canonical and historical lifecycle values.
 *
 * Historical values are interpreted in the context of the product. In
 * particular, an old AVAILABLE value for Strength must not make the current
 * internal test publicly available.
 */
function human_normalize_app_status($raw_status, $app_slug = '') {
    if (!is_scalar($raw_status)) {
        $raw_status = '';
    }

    $raw_status = trim((string) $raw_status);
    $status = strtolower($raw_status);
    $slug = sanitize_key((string) $app_slug);

    // Lowercase values are the canonical stored contract. Uppercase values
    // are legacy fingerprints and must be interpreted per product below.
    if ($raw_status === $status && in_array($status, human_get_allowed_app_statuses(), true)) {
        return $status;
    }

    if ($slug === 'strength') {
        return 'internal_testing';
    }

    if ($slug === 'coach') {
        return 'coming_soon';
    }

    return 'future';
}

/**
 * Return presentation data for a canonical lifecycle value.
 */
function human_get_app_status_presentation($status) {
    $presentations = array(
        'available' => array('label' => 'Available', 'color' => '#10B981'),
        'internal_testing' => array('label' => 'Internal Testing', 'color' => '#0066FF'),
        'coming_soon' => array('label' => 'Coming Soon', 'color' => '#F59E0B'),
        'future' => array('label' => 'Future Product', 'color' => '#6B7280'),
        'paused' => array('label' => 'Paused', 'color' => '#9CA3AF'),
        'retired' => array('label' => 'Retired', 'color' => '#4B5563'),
    );

    $normalized = in_array($status, human_get_allowed_app_statuses(), true) ? $status : 'future';
    return $presentations[$normalized];
}

/**
 * Generic digital product types supported by the marketing engine.
 *
 * Human Apps continue to use the existing human_app CPT. These values create
 * a portability boundary without renaming the established storage contract.
 */
function human_get_product_types() {
    return array(
        'mobile_app' => 'Mobile App',
        'wordpress_extension' => 'WordPress Extension',
        'book' => 'Book / Ebook',
        'course' => 'Course',
        'saas' => 'SaaS',
        'digital_download' => 'Digital Download',
        'membership' => 'Membership',
        'other' => 'Other',
    );
}

/**
 * Distribution channels which may be attached to a digital product.
 */
function human_get_distribution_channels() {
    return array(
        'none' => 'Not Yet Distributed',
        'google_play' => 'Google Play',
        'apple_app_store' => 'Apple App Store',
        'wordpress' => 'WordPress',
        'direct' => 'Direct',
        'amazon' => 'Amazon',
        'woocommerce' => 'WooCommerce',
        'external' => 'External',
    );
}

function human_normalize_product_type($raw_type) {
    $type = sanitize_key(is_scalar($raw_type) ? (string) $raw_type : '');
    return array_key_exists($type, human_get_product_types()) ? $type : 'other';
}

function human_normalize_distribution_channel($raw_channel) {
    $channel = sanitize_key(is_scalar($raw_channel) ? (string) $raw_channel : '');
    return array_key_exists($channel, human_get_distribution_channels()) ? $channel : 'none';
}

/**
 * Validate a generic distribution destination.
 *
 * Google Play keeps its existing strict Store validation. Other channels use
 * HTTPS destinations; direct and WooCommerce products may also use local paths.
 */
function human_validate_distribution_url($url, $channel) {
    if (!is_string($url) || trim($url) === '') {
        return '';
    }

    $channel = human_normalize_distribution_channel($channel);
    $url = trim($url);

    if ($channel === 'none') {
        return '';
    }

    if (($channel === 'direct' || $channel === 'woocommerce')
        && strpos($url, '/') === 0
        && strpos($url, '//') !== 0
    ) {
        return $url;
    }

    if ($channel === 'google_play') {
        return human_validate_google_play_url($url, 'public');
    }

    $validated = esc_url_raw($url, array('https'));
    if ($validated === '') {
        return '';
    }

    $parts = wp_parse_url($validated);
    if (!is_array($parts)
        || strtolower($parts['scheme'] ?? '') !== 'https'
        || empty($parts['host'])
        || isset($parts['user'])
        || isset($parts['pass'])
        || (isset($parts['port']) && (int) $parts['port'] !== 443)
    ) {
        return '';
    }

    return $validated;
}

/**
 * Validate the generic product/distribution contract without imposing Android
 * requirements on non-Android products.
 */
function human_validate_product_portability_contract($product) {
    $product = is_array($product) ? $product : array();
    $blockers = array();

    $raw_type = sanitize_key((string) ($product['product_type'] ?? ''));
    $raw_channel = sanitize_key((string) ($product['distribution_channel'] ?? ''));
    $type = human_normalize_product_type($raw_type);
    $channel = human_normalize_distribution_channel($raw_channel);
    $status = human_normalize_app_status($product['current_status'] ?? '', $product['slug'] ?? '');
    $external_identifier = trim((string) ($product['external_identifier'] ?? ''));
    $distribution_url = trim((string) ($product['distribution_url'] ?? ''));

    if ($raw_type === '' || !array_key_exists($raw_type, human_get_product_types())) {
        $blockers['INVALID_PRODUCT_TYPE'] = 'A supported digital product type is required.';
    }
    if ($raw_channel === '' || !array_key_exists($raw_channel, human_get_distribution_channels())) {
        $blockers['INVALID_DISTRIBUTION_CHANNEL'] = 'A supported distribution channel is required.';
    }

    if ($channel === 'google_play') {
        if ($type !== 'mobile_app') {
            $blockers['GOOGLE_PLAY_REQUIRES_MOBILE_APP'] = 'Google Play distribution is only valid for mobile app products.';
        }
        if (!preg_match('/^[A-Za-z][A-Za-z0-9_]*(?:\\.[A-Za-z][A-Za-z0-9_]*){1,}$/', $external_identifier)) {
            $blockers['MISSING_ANDROID_PACKAGE_ID'] = 'Google Play products require a valid Android package identifier.';
        }
        if ($status === 'available' && human_validate_distribution_url($distribution_url, $channel) === '') {
            $blockers['MISSING_PUBLIC_DISTRIBUTION_URL'] = 'Available Google Play products require a valid public Store listing URL.';
        }
    }

    if ($channel === 'apple_app_store' && $type !== 'mobile_app') {
        $blockers['APP_STORE_REQUIRES_MOBILE_APP'] = 'Apple App Store distribution is only valid for mobile app products.';
    }

    if ($distribution_url !== '' && human_validate_distribution_url($distribution_url, $channel) === '') {
        $blockers['INVALID_DISTRIBUTION_URL'] = 'The distribution URL is invalid for the selected channel.';
    }

    return array(
        'valid' => empty($blockers),
        'product_type' => $type,
        'distribution_channel' => $channel,
        'blocker_codes' => array_keys($blockers),
        'blocker_messages' => array_values($blockers),
    );
}

/**
 * Validate a Google Play destination and return its normalized URL.
 *
 * Public links must be Store listing URLs with a valid Android package ID.
 * Internal links must use Google's internal-test or testing opt-in paths.
 */
function human_validate_google_play_url($url, $type = 'public') {
    if (!is_string($url) || trim($url) === '') {
        return '';
    }

    $url = esc_url_raw(trim($url), array('https'));
    if ($url === '') {
        return '';
    }

    $parts = wp_parse_url($url);
    if (!is_array($parts)
        || strtolower($parts['scheme'] ?? '') !== 'https'
        || strtolower($parts['host'] ?? '') !== 'play.google.com'
        || isset($parts['user'])
        || isset($parts['pass'])
        || (isset($parts['port']) && (int) $parts['port'] !== 443)
    ) {
        return '';
    }

    $path = isset($parts['path']) ? rtrim($parts['path'], '/') : '';
    if ($type === 'public') {
        if ($path !== '/store/apps/details') {
            return '';
        }

        $query = array();
        parse_str($parts['query'] ?? '', $query);
        $package_id = isset($query['id']) && is_string($query['id']) ? $query['id'] : '';
        if (!preg_match('/^[A-Za-z][A-Za-z0-9_]*(?:\.[A-Za-z][A-Za-z0-9_]*){1,}$/', $package_id)) {
            return '';
        }
    } elseif ($type === 'internal') {
        if (!preg_match('#^/apps/(?:internaltest|testing)/[A-Za-z0-9._-]+$#', $path)) {
            return '';
        }
    } else {
        return '';
    }

    return $url;
}

/**
 * Boolean convenience wrapper for template and schema checks.
 */
function human_is_valid_google_play_url($url, $type = 'public') {
    return human_validate_google_play_url($url, $type) !== '';
}

/**
 * Canonical Human product contract. Every seeded record deliberately has the same 24 fields.
 */
function human_get_app_definitions() {
    return array(
        'strength' => array(
            'slug' => 'strength',
            'title' => 'Human Strength',
            'product_type' => 'mobile_app',
            'distribution_channel' => 'google_play',
            'distribution_url' => '',
            'external_identifier' => 'com.aistudio.humanstrength.kfqjza',
            'current_status' => 'internal_testing',
            'status_label' => 'Internal Testing',
            'badge_color' => '#0066FF',
            'description' => 'Human Strength is the first Human V1 product: an Android strength-training application currently in Google Play Internal Testing for eligible or invited testers.',
            'app_id' => 'com.aistudio.humanstrength.kfqjza',
            'pricing' => '£24/year through Google Play',
            'price_amount' => '24.00',
            'price_currency' => 'GBP',
            'billing_period' => 'year',
            'trial_days' => '30',
            'target_url' => '/strength/',
            'play_url' => '',
            'internal_test_url' => '',
            'cta_label' => '',
            'legacy_statuses' => array('PLANNED'),
            'legacy_descriptions' => array(
                'Commercial launch product. Offline-first strength training & volume analytics powered by local Room DB and optional cloud identity.',
            ),
            'legacy_target_urls' => array('/strength'),
            'legacy_pricing' => array(
                '30-day introductory trial, then £24/year',
            ),
        ),
        'hiit' => array(
            'slug' => 'hiit',
            'title' => 'Human HIIT',
            'product_type' => 'mobile_app',
            'distribution_channel' => 'none',
            'distribution_url' => '',
            'external_identifier' => '',
            'current_status' => 'future',
            'status_label' => 'Future Product',
            'badge_color' => '#6B7280',
            'description' => 'Human HIIT is a future Human V1 application focused on high-intensity interval training. Features and release timing have not been announced.',
            'app_id' => '',
            'pricing' => '',
            'price_amount' => '',
            'price_currency' => '',
            'billing_period' => '',
            'trial_days' => '',
            'target_url' => '/apps/#hiit',
            'play_url' => '',
            'internal_test_url' => '',
            'cta_label' => '',
            'legacy_statuses' => array('IN_DEVELOPMENT'),
            'legacy_descriptions' => array(
                'High-intensity interval training, telemetry tracking, and dynamic work-to-rest interval programming.',
            ),
            'legacy_target_urls' => array('/hiit'),
            'legacy_pricing' => array('Planned for platform inclusion'),
        ),
        'running' => array(
            'slug' => 'running',
            'title' => 'Human Running',
            'product_type' => 'mobile_app',
            'distribution_channel' => 'none',
            'distribution_url' => '',
            'external_identifier' => '',
            'current_status' => 'future',
            'status_label' => 'Future Product',
            'badge_color' => '#6B7280',
            'description' => 'Human Running is a future Human V1 application focused on running and endurance. Features and release timing have not been announced.',
            'app_id' => '',
            'pricing' => '',
            'price_amount' => '',
            'price_currency' => '',
            'billing_period' => '',
            'trial_days' => '',
            'target_url' => '/apps/#running',
            'play_url' => '',
            'internal_test_url' => '',
            'cta_label' => '',
            'legacy_statuses' => array('PLANNED'),
            'legacy_descriptions' => array(
                'Endurance metrics, cadence analysis, elevation profiling, and cardio progression tracking.',
            ),
            'legacy_target_urls' => array('/running'),
            'legacy_pricing' => array('Planned for platform inclusion'),
        ),
        'recovery' => array(
            'slug' => 'recovery',
            'title' => 'Human Recovery',
            'product_type' => 'mobile_app',
            'distribution_channel' => 'none',
            'distribution_url' => '',
            'external_identifier' => '',
            'current_status' => 'future',
            'status_label' => 'Future Product',
            'badge_color' => '#6B7280',
            'description' => 'Human Recovery is a future Human V1 application focused on recovery. Features and release timing have not been announced.',
            'app_id' => '',
            'pricing' => '',
            'price_amount' => '',
            'price_currency' => '',
            'billing_period' => '',
            'trial_days' => '',
            'target_url' => '/apps/#recovery',
            'play_url' => '',
            'internal_test_url' => '',
            'cta_label' => '',
            'legacy_statuses' => array('PLANNED'),
            'legacy_descriptions' => array(
                'Heart rate variability, sleep-to-load readiness scoring, and active recovery protocol guidance.',
            ),
            'legacy_target_urls' => array('/recovery'),
            'legacy_pricing' => array('Planned for platform inclusion'),
        ),
        'mobility' => array(
            'slug' => 'mobility',
            'title' => 'Human Mobility',
            'product_type' => 'mobile_app',
            'distribution_channel' => 'none',
            'distribution_url' => '',
            'external_identifier' => '',
            'current_status' => 'future',
            'status_label' => 'Future Product',
            'badge_color' => '#6B7280',
            'description' => 'Human Mobility is a future Human V1 application focused on mobility. Features and release timing have not been announced.',
            'app_id' => '',
            'pricing' => '',
            'price_amount' => '',
            'price_currency' => '',
            'billing_period' => '',
            'trial_days' => '',
            'target_url' => '/apps/#mobility',
            'play_url' => '',
            'internal_test_url' => '',
            'cta_label' => '',
            'legacy_statuses' => array('PLANNED'),
            'legacy_descriptions' => array(
                'Joint health, movement prep, range-of-motion assessments, and pre/post training sessions.',
            ),
            'legacy_target_urls' => array('/mobility'),
            'legacy_pricing' => array('Planned for platform inclusion'),
        ),
        'nutrition' => array(
            'slug' => 'nutrition',
            'title' => 'Human Nutrition',
            'product_type' => 'mobile_app',
            'distribution_channel' => 'none',
            'distribution_url' => '',
            'external_identifier' => '',
            'current_status' => 'future',
            'status_label' => 'Future Product',
            'badge_color' => '#6B7280',
            'description' => 'Human Nutrition is a future Human V1 application focused on nutrition. Features and release timing have not been announced.',
            'app_id' => '',
            'pricing' => '',
            'price_amount' => '',
            'price_currency' => '',
            'billing_period' => '',
            'trial_days' => '',
            'target_url' => '/apps/#nutrition',
            'play_url' => '',
            'internal_test_url' => '',
            'cta_label' => '',
            'legacy_statuses' => array('PLANNED'),
            'legacy_descriptions' => array(
                'Fueling protocols, macronutrient tracking, and metabolic output alignment for training days.',
            ),
            'legacy_target_urls' => array('/nutrition'),
            'legacy_pricing' => array('Planned for platform inclusion'),
        ),
        'coach' => array(
            'slug' => 'coach',
            'title' => 'Human Coach',
            'product_type' => 'mobile_app',
            'distribution_channel' => 'none',
            'distribution_url' => '',
            'external_identifier' => '',
            'current_status' => 'coming_soon',
            'status_label' => 'Coming Soon',
            'badge_color' => '#F59E0B',
            'description' => 'Human Coach is a future Human V1 coaching application marked Coming Soon. Features and release timing have not been announced.',
            'app_id' => '',
            'pricing' => '',
            'price_amount' => '',
            'price_currency' => '',
            'billing_period' => '',
            'trial_days' => '',
            'target_url' => '/apps/#coach',
            'play_url' => '',
            'internal_test_url' => '',
            'cta_label' => '',
            'legacy_statuses' => array('COMING_SOON'),
            'legacy_descriptions' => array(
                'AI-assisted periodization engine utilizing the Human Ontology knowledge graph for intelligent workout adaptation.',
            ),
            'legacy_target_urls' => array('/coach'),
            'legacy_pricing' => array('Coming Soon'),
        ),
        'community' => array(
            'slug' => 'community',
            'title' => 'Human Community',
            'product_type' => 'mobile_app',
            'distribution_channel' => 'none',
            'distribution_url' => '',
            'external_identifier' => '',
            'current_status' => 'future',
            'status_label' => 'Future Product',
            'badge_color' => '#6B7280',
            'description' => 'Human Community is a future Human V1 community application. Features and release timing have not been announced.',
            'app_id' => '',
            'pricing' => '',
            'price_amount' => '',
            'price_currency' => '',
            'billing_period' => '',
            'trial_days' => '',
            'target_url' => '/apps/#community',
            'play_url' => '',
            'internal_test_url' => '',
            'cta_label' => '',
            'legacy_statuses' => array('PLANNED'),
            'legacy_descriptions' => array(
                'Peer performance benchmarks, verified movement sharing, and ecosystem challenge leaderboards.',
            ),
            'legacy_target_urls' => array('/community'),
            'legacy_pricing' => array('Planned for platform inclusion'),
        ),
    );
}

/**
 * Resolve the canonical contract from WordPress records without discarding
 * editor-owned values. Migration 1.4.0 is responsible for replacing exact
 * historical seed fingerprints before this resolver reads them.
 */
function human_get_canonical_apps() {
    $apps = array();

    foreach (human_get_app_definitions() as $slug => $definition) {
        $app = $definition;
        $post = get_page_by_path($slug, OBJECT, 'human_app');

        if ($post instanceof WP_Post && $post->post_status === 'publish') {
            if ($post->post_title !== '') {
                $app['title'] = $post->post_title;
            }
            if ($post->post_content !== '') {
                $app['description'] = $post->post_content;
            }

            $meta_map = array(
                'product_type' => '_human_product_type',
                'distribution_channel' => '_human_distribution_channel',
                'distribution_url' => '_human_distribution_url',
                'external_identifier' => '_human_external_identifier',
                'app_id' => '_human_app_package_id',
                'pricing' => '_human_app_pricing',
                'price_amount' => '_human_app_price_amount',
                'price_currency' => '_human_app_price_currency',
                'billing_period' => '_human_app_billing_period',
                'trial_days' => '_human_app_trial_days',
                'target_url' => '_human_app_target_url',
                'play_url' => '_human_app_play_url',
                'internal_test_url' => '_human_app_internal_test_url',
                'cta_label' => '_human_app_cta_label',
            );

            foreach ($meta_map as $field => $meta_key) {
                if (metadata_exists('post', $post->ID, $meta_key)) {
                    $app[$field] = (string) get_post_meta($post->ID, $meta_key, true);
                }
            }

            $raw_status = metadata_exists('post', $post->ID, '_human_app_status')
                ? get_post_meta($post->ID, '_human_app_status', true)
                : $definition['current_status'];
            $app['current_status'] = human_normalize_app_status($raw_status, $slug);
        }

        $app['product_type'] = human_normalize_product_type($app['product_type'] ?? 'mobile_app');
        $app['distribution_channel'] = human_normalize_distribution_channel($app['distribution_channel'] ?? 'none');
        if ($app['distribution_channel'] === 'google_play' && empty($app['external_identifier'])) {
            $app['external_identifier'] = (string) ($app['app_id'] ?? '');
        }
        if ($app['distribution_channel'] === 'google_play' && empty($app['distribution_url']) && !empty($app['play_url'])) {
            $app['distribution_url'] = (string) $app['play_url'];
        }
        $app['distribution_url'] = human_validate_distribution_url(
            (string) ($app['distribution_url'] ?? ''),
            $app['distribution_channel']
        );

        $presentation = human_get_app_status_presentation($app['current_status']);
        $app['status_label'] = $presentation['label'];
        $app['badge_color'] = $presentation['color'];
        $app['play_url'] = human_validate_google_play_url($app['play_url'], 'public');
        $app['internal_test_url'] = human_validate_google_play_url($app['internal_test_url'], 'internal');

        // Historical fingerprints exist only for migration decisions. They
        // are never part of the public App resolver or REST representation.
        unset(
            $app['legacy_statuses'],
            $app['legacy_descriptions'],
            $app['legacy_target_urls'],
            $app['legacy_pricing']
        );

        // The v1 Apps REST endpoint historically exposed `status`. Retain a
        // canonical alias while new consumers move to `current_status`.
        $app['status'] = $app['current_status'];
        $apps[] = $app;
    }

    return $apps;
}

/**
 * Original seed shape retained for migrations 1.0.0 through 1.2.0.
 * Fresh installs receive the current contract; migration 1.4.0 uses the
 * explicit legacy fingerprints above to reconcile older databases.
 */
function human_get_fallback_canonical_apps() {
    $fallback = array();
    foreach (human_get_app_definitions() as $definition) {
        $fallback[] = array(
            'slug' => $definition['slug'],
            'title' => $definition['title'],
            'status' => $definition['current_status'],
            'status_label' => $definition['status_label'],
            'badge_color' => $definition['badge_color'],
            'description' => $definition['description'],
            'app_id' => $definition['app_id'],
            'pricing' => $definition['pricing'],
            'price_amount' => $definition['price_amount'],
            'price_currency' => $definition['price_currency'],
            'billing_period' => $definition['billing_period'],
            'trial_days' => $definition['trial_days'],
            'target_url' => $definition['target_url'],
        );
    }

    return $fallback;
}
