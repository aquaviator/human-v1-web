<?php
/**
 * Extension Hooks & Extension Architecture for Future Plugins (e.g., human-marketing)
 * 
 * Provides clean action/filter hooks for campaign management, social publication queues,
 * CTA libraries, and UTM tracking without coupling theme code.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Action triggered when an article is published in Human Journal
 * Future human-marketing plugin listens to this hook to automatically enqueue social posts.
 */
function human_journal_post_published($post_id, $post) {
    if ($post->post_type !== 'post') {
        return;
    }
    
    // Extension hook for human-marketing social publication queue
    do_action('human_marketing_enqueue_journal_post', $post_id, $post);
}
add_action('publish_post', 'human_journal_post_published', 10, 2);

/**
 * Filter hook to append UTM parameters to promotional CTAs
 */
function human_apply_cta_utm_params($url, $campaign_id = 'default', $medium = 'website') {
    $filtered_url = apply_filters('human_marketing_format_utm_url', $url, $campaign_id, $medium);
    return $filtered_url;
}

/**
 * Reserved REST Namespace Documentation for human-marketing
 * 
 * Future REST Endpoints:
 * - /wp-json/human-marketing/v1/campaigns
 * - /wp-json/human-marketing/v1/social-queue
 * - /wp-json/human-marketing/v1/social-publications
 * - /wp-json/human-marketing/v1/cta-library
 */
