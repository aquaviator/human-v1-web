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
 * Get Canonical Ecosystem Apps (Source of truth: Database, fallback to Seed data)
 */
function human_get_canonical_apps() {
    $apps = array();
    
    // Check if the migration/seeding is fully completed
    $schema_version = get_option('human_marketing_schema_version', '0.0.0');
    
    if (version_compare($schema_version, '1.0.0', '>=')) {
        $query = new WP_Query(array(
            'post_type' => 'human_app',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'menu_order title',
            'order' => 'ASC'
        ));

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $status = get_post_meta(get_the_ID(), '_human_app_status', true) ?: 'PLANNED';
                $badge_color = '#6B7280';
                $status_label = 'Planned';
                switch ($status) {
                    case 'AVAILABLE': $badge_color = '#10B981'; $status_label = 'Available'; break;
                    case 'IN_DEVELOPMENT': $badge_color = '#0066FF'; $status_label = 'In Development'; break;
                    case 'COMING_SOON': $badge_color = '#F59E0B'; $status_label = 'Coming Soon'; break;
                }

                $apps[] = array(
                    'slug' => get_post_field('post_name', get_the_ID()),
                    'title' => get_the_title(),
                    'status' => $status,
                    'status_label' => $status_label,
                    'badge_color' => $badge_color,
                    'description' => get_the_content(),
                    'app_id' => get_post_meta(get_the_ID(), '_human_app_package_id', true),
                    'pricing' => get_post_meta(get_the_ID(), '_human_app_pricing', true),
                    'target_url' => get_post_meta(get_the_ID(), '_human_app_target_url', true)
                );
            }
            wp_reset_postdata();
        }
    } else {
        // Fallback if not seeded yet
        $apps = human_get_fallback_canonical_apps();
    }

    return $apps;
}

/**
 * Default Canonical Ecosystem Seed Data Helper
 */
function human_get_fallback_canonical_apps() {
    return array(
        array(
            'slug' => 'strength',
            'title' => 'Human Strength',
            'status' => 'PLANNED',
            'status_label' => 'Planned',
            'badge_color' => '#6B7280',
            'description' => 'Commercial launch product. Offline-first strength training & volume analytics powered by local Room DB and optional cloud identity.',
            'app_id' => 'com.aistudio.humanstrength.kfqjza',
            'pricing' => '30-day introductory trial, then £24/year',
            'target_url' => '/strength'
        ),
        array(
            'slug' => 'hiit',
            'title' => 'Human HIIT',
            'status' => 'IN_DEVELOPMENT',
            'status_label' => 'In Development',
            'badge_color' => '#0066FF',
            'description' => 'High-intensity interval training, telemetry tracking, and dynamic work-to-rest interval programming.',
            'app_id' => '',
            'pricing' => 'Planned for platform inclusion',
            'target_url' => '/hiit'
        ),
        array(
            'slug' => 'running',
            'title' => 'Human Running',
            'status' => 'PLANNED',
            'status_label' => 'Planned',
            'badge_color' => '#6B7280',
            'description' => 'Endurance metrics, cadence analysis, elevation profiling, and cardio progression tracking.',
            'app_id' => '',
            'pricing' => 'Planned for platform inclusion',
            'target_url' => '/running'
        ),
        array(
            'slug' => 'recovery',
            'title' => 'Human Recovery',
            'status' => 'PLANNED',
            'status_label' => 'Planned',
            'badge_color' => '#6B7280',
            'description' => 'Heart rate variability, sleep-to-load readiness scoring, and active recovery protocol guidance.',
            'app_id' => '',
            'pricing' => 'Planned for platform inclusion',
            'target_url' => '/recovery'
        ),
        array(
            'slug' => 'mobility',
            'title' => 'Human Mobility',
            'status' => 'PLANNED',
            'status_label' => 'Planned',
            'badge_color' => '#6B7280',
            'description' => 'Joint health, movement prep, range-of-motion assessments, and pre/post training sessions.',
            'app_id' => '',
            'pricing' => 'Planned for platform inclusion',
            'target_url' => '/mobility'
        ),
        array(
            'slug' => 'nutrition',
            'title' => 'Human Nutrition',
            'status' => 'PLANNED',
            'status_label' => 'Planned',
            'badge_color' => '#6B7280',
            'description' => 'Fueling protocols, macronutrient tracking, and metabolic output alignment for training days.',
            'app_id' => '',
            'pricing' => 'Planned for platform inclusion',
            'target_url' => '/nutrition'
        ),
        array(
            'slug' => 'coach',
            'title' => 'Human Coach',
            'status' => 'COMING_SOON',
            'status_label' => 'Coming Soon',
            'badge_color' => '#F59E0B',
            'description' => 'AI-assisted periodization engine utilizing the Human Ontology knowledge graph for intelligent workout adaptation.',
            'app_id' => '',
            'pricing' => 'Coming Soon',
            'target_url' => '/coach'
        ),
        array(
            'slug' => 'community',
            'title' => 'Human Community',
            'status' => 'PLANNED',
            'status_label' => 'Planned',
            'badge_color' => '#6B7280',
            'description' => 'Peer performance benchmarks, verified movement sharing, and ecosystem challenge leaderboards.',
            'app_id' => '',
            'pricing' => 'Planned for platform inclusion',
            'target_url' => '/community'
        )
    );
}
