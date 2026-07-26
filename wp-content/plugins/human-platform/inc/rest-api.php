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
