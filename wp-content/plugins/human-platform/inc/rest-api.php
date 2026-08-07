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

    register_rest_route('human/v1', '/campaigns', array(
        'methods'  => 'GET',
        'callback' => 'human_rest_get_campaigns',
        'permission_callback' => function () {
            return current_user_can('edit_posts');
        },
    ));
}
add_action('rest_api_init', 'human_register_rest_routes');

function human_rest_get_apps() {
    $apps = human_get_canonical_apps();
    return new WP_REST_Response(array(
        'success' => true,
        'brand' => 'Human V1',
        'domain' => 'humanv1.com',
        'data' => $apps
    ), 200);
}

function human_rest_get_journal() {
    $posts = get_posts(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
    ));

    $data = array();
    foreach ($posts as $post) {
        $data[] = array(
            'id' => (int) $post->ID,
            'slug' => $post->post_name,
            'title' => get_the_title($post),
            'excerpt' => $post->post_excerpt !== '' ? $post->post_excerpt : wp_trim_words(wp_strip_all_tags($post->post_content), 35),
            'url' => get_permalink($post),
            'date' => get_the_date(DATE_ATOM, $post),
            'modified' => get_the_modified_date(DATE_ATOM, $post),
            'author' => get_the_author_meta('display_name', $post->post_author),
            'seo_title' => get_post_meta($post->ID, '_human_seo_title', true),
            'seo_description' => get_post_meta($post->ID, '_human_seo_description', true),
            'social_title' => get_post_meta($post->ID, '_human_social_title', true),
            'social_description' => get_post_meta($post->ID, '_human_social_description', true),
            'social_image' => get_post_meta($post->ID, '_human_social_image', true),
        );
    }

    return new WP_REST_Response(array(
        'success' => true,
        'count' => count($data),
        'data' => $data,
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
        'vision' => 'An ongoing structured exercise knowledge programme within Human V1.',
        'status' => 'Ongoing programme',
        'taxonomy_pillars' => array(
            'identity' => 'Exercise names, aliases and structured identity',
            'movement' => 'Movement patterns and exercise relationships',
            'anatomy' => 'Muscle and joint context',
            'equipment' => 'Equipment categories and exercise constraints',
            'relationships' => 'Substitutions, regressions and progressions',
        ),
    ), 200);
}

/**
 * Return only Campaigns that have passed the future automation safety gate.
 *
 * Sample/reference Campaigns are always excluded.
 */
function human_rest_get_campaigns() {
    $campaigns = get_posts(array(
        'post_type' => 'human_campaign',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby' => 'modified',
        'order' => 'DESC',
    ));

    $data = array();
    foreach ($campaigns as $campaign) {
        if (get_post_meta($campaign->ID, '_human_is_sample', true) === '1') {
            continue;
        }
        if (!function_exists('human_get_campaign_readiness')) {
            continue;
        }

        $readiness = human_get_campaign_readiness($campaign->ID);
        if (empty($readiness['ready_for_automation'])) {
            continue;
        }

        $data[] = array(
            'id' => (int) $campaign->ID,
            'name' => get_the_title($campaign),
            'objective' => get_post_meta($campaign->ID, '_human_camp_objective', true),
            'status' => get_post_meta($campaign->ID, '_human_camp_status', true),
            'target_url' => get_post_meta($campaign->ID, '_human_camp_target_url', true),
            'utm' => array(
                'source' => get_post_meta($campaign->ID, '_human_camp_utm_source', true),
                'medium' => get_post_meta($campaign->ID, '_human_camp_utm_medium', true),
                'campaign' => get_post_meta($campaign->ID, '_human_camp_utm_campaign', true),
            ),
            'facebook_copy' => get_post_meta($campaign->ID, '_human_camp_facebook_copy', true),
            'instagram_copy' => get_post_meta($campaign->ID, '_human_camp_instagram_copy', true),
            'modified' => get_post_modified_time(DATE_ATOM, true, $campaign),
        );
    }

    return new WP_REST_Response(array(
        'success' => true,
        'count' => count($data),
        'data' => $data,
    ), 200);
}
