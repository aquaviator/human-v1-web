<?php
/**
 * REST API Endpoints for Human Platform
 * 
 * Namespace: /wp-json/human/v1
 */

if (!defined('ABSPATH')) {
    exit;
}

function human_register_rest_routes() {
    register_rest_route('human/v1', '/apps', array(
        'methods'  => 'GET',
        'callback' => 'human_rest_get_apps',
        'permission_callback' => '__return_true',
    ));

    register_rest_route('human/v1', '/ontology/summary', array(
        'methods'  => 'GET',
        'callback' => 'human_rest_get_ontology_summary',
        'permission_callback' => '__return_true',
    ));

    register_rest_route('human/v1', '/journal', array(
        'methods'  => 'GET',
        'callback' => 'human_rest_get_journal',
        'permission_callback' => '__return_true',
    ));

    register_rest_route('human/v1', '/seo', array(
        'methods'  => 'GET',
        'callback' => 'human_rest_get_seo',
        'permission_callback' => '__return_true',
    ));
}
add_action('rest_api_init', 'human_register_rest_routes');

function human_rest_get_apps() {
    $apps = human_get_canonical_apps();
    return new WP_REST_Response(array(
        'success' => true,
        'brand' => 'Human',
        'domain' => 'humanv1.com',
        'data' => $apps
    ), 200);
}

function human_rest_get_journal() {
    $articles = function_exists('human_get_cornerstone_articles') ? human_get_cornerstone_articles() : array();
    return new WP_REST_Response(array(
        'success' => true,
        'count' => count($articles),
        'data' => $articles
    ), 200);
}

function human_rest_get_seo() {
    $meta = function_exists('human_get_seo_metadata') ? human_get_seo_metadata() : array();
    return new WP_REST_Response(array(
        'success' => true,
        'metadata' => $meta
    ), 200);
}

function human_rest_get_ontology_summary() {
    return new WP_REST_Response(array(
        'success' => true,
        'program' => 'Human Ontology',
        'vision' => 'Structured exercise knowledge system designed to scale far beyond a traditional exercise library.',
        'status' => 'Active Major Human Programme',
        'taxonomy_pillars' => array(
            'canonical_identity' => 'Names, aliases, internationalized search terms',
            'biomechanics' => 'Planes of motion, movement patterns, force direction, joint actions',
            'anatomy' => 'Primary muscles, secondary muscles, synergists, stabilizer roles',
            'equipment' => 'Barbells, dumbbells, cables, selectorised, plate-loaded, Smith machine, landmine',
            'coaching' => 'Substitutions, regressions, progressions, spinal loading, fatigue cost'
        )
    ), 200);
}
