<?php
if (!defined('ABSPATH')) {
    exit;
}

function human_get_post_marketing_readiness($post_id) {
    $readiness = array(
        'score' => 0,
        'state' => 'INCOMPLETE',
        'sections' => array(
            'content' => array('score' => 0, 'status' => 'INCOMPLETE', 'warnings' => array(), 'ready' => array()),
            'seo' => array('score' => 0, 'status' => 'INCOMPLETE', 'warnings' => array(), 'ready' => array()),
            'social' => array('score' => 0, 'status' => 'INCOMPLETE', 'warnings' => array(), 'ready' => array()),
            'conversion' => array('score' => 0, 'status' => 'INCOMPLETE', 'warnings' => array(), 'ready' => array()),
            'campaign' => array('score' => 0, 'status' => 'INCOMPLETE', 'warnings' => array(), 'ready' => array()),
            'lifecycle' => array('score' => 0, 'status' => 'INCOMPLETE', 'warnings' => array(), 'ready' => array())
        ),
        'all_warnings' => array(),
        'all_ready' => array()
    );

    $post = get_post($post_id);
    if (!$post) return $readiness;

    $is_sample_content = get_post_meta($post_id, '_human_is_sample', true) === '1';
    if ($is_sample_content) {
        $readiness['all_warnings'][] = 'Sample/reference content is never automation eligible.';
    }

    // 1. CONTENT (Max 20%)
    $content_score = 0;
    if (!empty($post->post_title)) {
        $content_score += 5;
        $readiness['sections']['content']['ready'][] = 'Title exists';
    } else {
        $readiness['sections']['content']['warnings'][] = 'Post title is missing';
    }

    if (!empty(trim(strip_tags($post->post_content)))) {
        $content_score += 5;
        $readiness['sections']['content']['ready'][] = 'Meaningful body content exists';
    } else {
        $readiness['sections']['content']['warnings'][] = 'Body content is empty';
    }

    if (!empty($post->post_excerpt)) {
        $content_score += 4;
        $readiness['sections']['content']['ready'][] = 'Excerpt exists';
    } else {
        $readiness['sections']['content']['warnings'][] = 'Excerpt is missing';
    }

    if (has_post_thumbnail($post_id)) {
        $content_score += 4;
        $readiness['sections']['content']['ready'][] = 'Featured image assigned';
    } else {
        $readiness['sections']['content']['warnings'][] = 'Featured image missing';
    }

    if (has_category('', $post_id)) {
        $content_score += 2;
        $readiness['sections']['content']['ready'][] = 'Category assigned';
    } else {
        $readiness['sections']['content']['warnings'][] = 'Category is not assigned';
    }

    $readiness['sections']['content']['score'] = $content_score;
    $readiness['sections']['content']['status'] = $content_score === 20 ? 'READY' : ($content_score > 10 ? 'NEEDS_ATTENTION' : 'INCOMPLETE');

    // 2. SEO (Max 20%)
    $seo_score = 0;
    $seo_title = get_post_meta($post_id, '_human_seo_title', true);
    $seo_desc = get_post_meta($post_id, '_human_seo_description', true);
    $search_intent = get_post_meta($post_id, '_human_post_search_intent', true);
    $primary_topic = get_post_meta($post_id, '_human_post_primary_topic', true);

    $seo_title_length = function_exists('mb_strlen') ? mb_strlen((string) $seo_title) : strlen((string) $seo_title);
    if ($seo_title_length >= 30 && $seo_title_length <= 65) {
        $seo_score += 5;
        $readiness['sections']['seo']['ready'][] = 'SEO title is present and within the 30-65 character quality range';
    } elseif ($seo_title_length > 0) {
        $readiness['sections']['seo']['warnings'][] = 'SEO title exists but should be reviewed for length (target 30-65 characters)';
    } else {
        $readiness['sections']['seo']['warnings'][] = 'SEO title is missing';
    }

    $seo_desc_length = function_exists('mb_strlen') ? mb_strlen((string) $seo_desc) : strlen((string) $seo_desc);
    if ($seo_desc_length >= 100 && $seo_desc_length <= 170) {
        $seo_score += 5;
        $readiness['sections']['seo']['ready'][] = 'Meta description is present and within the 100-170 character quality range';
    } elseif ($seo_desc_length > 0) {
        $readiness['sections']['seo']['warnings'][] = 'Meta description exists but should be reviewed for length (target 100-170 characters)';
    } else {
        $readiness['sections']['seo']['warnings'][] = 'Meta description is missing';
    }

    if (!empty($search_intent)) {
        $seo_score += 5;
        $readiness['sections']['seo']['ready'][] = 'Search intent defined';
    } else {
        $readiness['sections']['seo']['warnings'][] = 'Search intent is missing';
    }

    if (!empty($primary_topic)) {
        $seo_score += 5;
        $readiness['sections']['seo']['ready'][] = 'Primary topic/keyword defined';
    } else {
        $readiness['sections']['seo']['warnings'][] = 'Primary topic/keyword is missing';
    }

    $readiness['sections']['seo']['score'] = $seo_score;
    $readiness['sections']['seo']['status'] = $seo_score === 20 ? 'READY' : ($seo_score > 10 ? 'NEEDS_ATTENTION' : 'INCOMPLETE');

    // 3. SOCIAL (Max 20%)
    $social_score = 0;
    $social_title = get_post_meta($post_id, '_human_social_title', true);
    $social_desc = get_post_meta($post_id, '_human_social_description', true);
    $social_image = get_post_meta($post_id, '_human_social_image', true);
    $promo_copy = get_post_meta($post_id, '_human_promo_copy', true);

    $social_title_length = function_exists('mb_strlen') ? mb_strlen((string) $social_title) : strlen((string) $social_title);
    if ($social_title_length >= 20 && $social_title_length <= 70) {
        $social_score += 5;
        $readiness['sections']['social']['ready'][] = 'Social title is present and within the 20-70 character quality range';
    } elseif ($social_title_length > 0) {
        $readiness['sections']['social']['warnings'][] = 'Social title exists but should be reviewed for length (target 20-70 characters)';
    } else {
        $readiness['sections']['social']['warnings'][] = 'Social title is missing';
    }

    $social_desc_length = function_exists('mb_strlen') ? mb_strlen((string) $social_desc) : strlen((string) $social_desc);
    if ($social_desc_length >= 60 && $social_desc_length <= 200) {
        $social_score += 5;
        $readiness['sections']['social']['ready'][] = 'Social description is present and within the 60-200 character quality range';
    } elseif ($social_desc_length > 0) {
        $readiness['sections']['social']['warnings'][] = 'Social description exists but should be reviewed for length (target 60-200 characters)';
    } else {
        $readiness['sections']['social']['warnings'][] = 'Social description is missing';
    }

    if (!empty($social_image)) {
        $social_image_url = esc_url_raw($social_image, array('https'));
        $social_image_path = wp_parse_url($social_image_url, PHP_URL_PATH);
        $social_image_ext = is_string($social_image_path) ? strtolower(pathinfo($social_image_path, PATHINFO_EXTENSION)) : '';
        if ($social_image_url !== '' && in_array($social_image_ext, array('jpg', 'jpeg', 'png', 'webp'), true)) {
            $social_score += 5;
            $readiness['sections']['social']['ready'][] = 'Social share image is a supported HTTPS raster asset';
        } else {
            $readiness['sections']['social']['warnings'][] = 'Social share image should be an HTTPS JPG, PNG, or WebP asset';
        }
    } else {
        if (has_post_thumbnail($post_id)) {
            $social_score += 3;
            $readiness['sections']['social']['warnings'][] = 'Using featured image as social fallback (no dedicated social image)';
        } else {
            $readiness['sections']['social']['warnings'][] = 'Social share image missing';
        }
    }

    if (!empty($promo_copy)) {
        $social_score += 5;
        $readiness['sections']['social']['ready'][] = 'Promotional copy exists';
    } else {
        $readiness['sections']['social']['warnings'][] = 'Default promotional copy is missing';
    }

    $readiness['sections']['social']['score'] = $social_score;
    $readiness['sections']['social']['status'] = $social_score >= 18 ? 'READY' : ($social_score > 10 ? 'NEEDS_ATTENTION' : 'INCOMPLETE');

    // 4. CONVERSION (Max 20%)
    $conv_score = 0;
    $primary_product = get_post_meta($post_id, '_human_post_primary_product', true);
    $primary_cta = get_post_meta($post_id, '_human_post_primary_cta', true);

    if (!empty($primary_product)) {
        $conv_score += 5;
        $product_title = get_the_title($primary_product);
        $readiness['sections']['conversion']['ready'][] = 'Primary Human product associated: ' . $product_title;
    } else {
        $readiness['sections']['conversion']['warnings'][] = 'No primary Human product associated';
    }

    if (!empty($primary_cta)) {
        $conv_score += 5;
        $readiness['sections']['conversion']['ready'][] = 'Primary CTA configured';
        $cta_status = get_post_meta($primary_cta, '_human_cta_status', true);
        $cta_url = get_post_meta($primary_cta, '_human_cta_destination_url', true);

        if ($cta_status === 'active') {
            $conv_score += 5;
            $readiness['sections']['conversion']['ready'][] = 'Primary CTA is active';
        } else {
            $readiness['sections']['conversion']['warnings'][] = 'Primary CTA is inactive';
        }

        if (!empty($cta_url)) {
            $conv_score += 5;
            $readiness['sections']['conversion']['ready'][] = 'Primary CTA destination valid';
        } else {
            $readiness['sections']['conversion']['warnings'][] = 'Primary CTA has no destination URL';
        }
    } else {
        $readiness['sections']['conversion']['warnings'][] = 'No primary CTA configured';
    }

    $readiness['sections']['conversion']['score'] = $conv_score;
    $readiness['sections']['conversion']['status'] = $conv_score === 20 ? 'READY' : ($conv_score > 10 ? 'NEEDS_ATTENTION' : 'INCOMPLETE');

    // 5. CAMPAIGN (Max 10%)
    $camp_score = 0;
    $campaign_id = get_post_meta($post_id, '_human_post_primary_campaign', true);
    if (!empty($campaign_id)) {
        $camp_score = 10;
        $readiness['sections']['campaign']['ready'][] = 'Associated with campaign';

        $camp_status = get_post_meta($campaign_id, '_human_camp_status', true);
        $camp_is_sample = get_post_meta($campaign_id, '_human_is_sample', true) === '1';
        if ($camp_is_sample) {
            $readiness['sections']['campaign']['warnings'][] = 'Associated Campaign is sample/reference data and cannot be automated';
            $camp_score = 5;
        } elseif ($camp_status === 'completed' || $camp_status === 'cancelled' || $camp_status === 'archived') {
            $readiness['sections']['campaign']['warnings'][] = 'Associated campaign is ' . $camp_status;
            $camp_score = 5;
        }
    } else {
        $camp_score = 10; // Not strictly penalized for not being in a campaign, but maybe informational warning
        $readiness['sections']['campaign']['ready'][] = 'No active campaign needed (informational)';
    }

    $readiness['sections']['campaign']['score'] = $camp_score;
    $readiness['sections']['campaign']['status'] = $camp_score === 10 ? 'READY' : 'NEEDS_ATTENTION';

    // 6. LIFECYCLE (Max 10%)
    $lifecycle_score = 0;
    $content_type = get_post_meta($post_id, '_human_post_content_type', true);
    $review_date = get_post_meta($post_id, '_human_post_review_date', true);

    if (!empty($content_type)) {
        $lifecycle_score += 5;
        $readiness['sections']['lifecycle']['ready'][] = 'Content type defined';
    } else {
        $readiness['sections']['lifecycle']['warnings'][] = 'Content type is missing';
    }

    if (!empty($review_date)) {
        $lifecycle_score += 5;
        $readiness['sections']['lifecycle']['ready'][] = 'Review date set';
    } else {
        $readiness['sections']['lifecycle']['warnings'][] = 'Review date not set';
    }

    $readiness['sections']['lifecycle']['score'] = $lifecycle_score;
    $readiness['sections']['lifecycle']['status'] = $lifecycle_score === 10 ? 'READY' : 'NEEDS_ATTENTION';

    // Aggregate
    $total_score = $content_score + $seo_score + $social_score + $conv_score + $camp_score + $lifecycle_score;
    $readiness['score'] = $total_score;

    if ($is_sample_content) {
        $readiness['state'] = 'SAMPLE / REFERENCE — NOT AUTOMATION ELIGIBLE';
    } elseif ($total_score >= 90 && empty($readiness['sections']['conversion']['warnings'])) {
        $readiness['state'] = 'MARKETING READY';
    } elseif ($total_score > 50) {
        $readiness['state'] = 'NEEDS ATTENTION';
    } else {
        $readiness['state'] = 'INCOMPLETE';
    }

    foreach ($readiness['sections'] as $section) {
        $readiness['all_warnings'] = array_merge($readiness['all_warnings'], $section['warnings']);
        $readiness['all_ready'] = array_merge($readiness['all_ready'], $section['ready']);
    }

    return $readiness;
}

/**
 * Legal and operational readiness helpers.
 */
function human_readiness_result($blockers) {
    $codes = array_keys($blockers);
    return array(
        'ready' => empty($codes),
        'blocker_codes' => $codes,
        'blocker_messages' => array_values($blockers),
    );
}

function human_option_has_valid_email($options, $key) {
    return !empty($options[$key]) && is_email($options[$key]);
}

function human_option_has_valid_review_date($options, $key) {
    if (empty($options[$key]) || !function_exists('human_validate_review_date')) {
        return false;
    }
    return human_validate_review_date($options[$key]) !== false && human_validate_review_date($options[$key]) !== '';
}

function human_get_privacy_readiness() {
    $options = wp_parse_args(get_option('human_options', array()), human_get_default_options());
    $blockers = array();

    if (empty($options['operator_legal_name'])) {
        $blockers['MISSING_OPERATOR_NAME'] = 'Operator legal name is missing.';
    }
    if (empty($options['operator_capacity'])) {
        $blockers['MISSING_OPERATOR_CAPACITY'] = 'Operator capacity is missing.';
    }
    if (!human_option_has_valid_email($options, 'privacy_contact_email')) {
        $blockers['MISSING_PRIVACY_EMAIL'] = 'A valid privacy contact email is required.';
    }
    if (($options['privacy_review_state'] ?? '') !== 'approved') {
        $blockers['PRIVACY_NOT_APPROVED'] = 'Privacy review state is not approved.';
    }
    if (!human_option_has_valid_review_date($options, 'privacy_review_date')) {
        $blockers['MISSING_PRIVACY_REVIEW_DATE'] = 'A valid privacy review date is required.';
    }
    if (($options['android_data_flow_review_state'] ?? '') !== 'approved') {
        $blockers['ANDROID_FLOW_NOT_APPROVED'] = 'Android data-flow review state is not approved.';
    }
    if (($options['retention_review_state'] ?? '') !== 'approved') {
        $blockers['RETENTION_NOT_APPROVED'] = 'Retention review state is not approved.';
    }
    if (($options['processor_review_state'] ?? '') !== 'approved') {
        $blockers['PROCESSOR_NOT_APPROVED'] = 'Processor / transfer review state is not approved.';
    }

    return human_readiness_result($blockers);
}

function human_get_terms_readiness() {
    $options = wp_parse_args(get_option('human_options', array()), human_get_default_options());
    $blockers = array();

    if (empty($options['operator_legal_name'])) {
        $blockers['MISSING_OPERATOR_NAME'] = 'Operator legal name is missing.';
    }
    if (empty($options['operator_capacity'])) {
        $blockers['MISSING_OPERATOR_CAPACITY'] = 'Operator capacity is missing.';
    }
    if (!human_option_has_valid_email($options, 'public_contact_email')) {
        $blockers['MISSING_PUBLIC_EMAIL'] = 'A valid public contact email is required.';
    }
    if (($options['terms_review_state'] ?? '') !== 'approved') {
        $blockers['TERMS_NOT_APPROVED'] = 'Terms review state is not approved.';
    }
    if (!human_option_has_valid_review_date($options, 'terms_review_date')) {
        $blockers['MISSING_TERMS_REVIEW_DATE'] = 'A valid terms review date is required.';
    }

    return human_readiness_result($blockers);
}

function human_get_data_deletion_readiness() {
    $options = wp_parse_args(get_option('human_options', array()), human_get_default_options());
    $blockers = array();

    if (!human_option_has_valid_email($options, 'support_contact_email')
        && !human_option_has_valid_email($options, 'privacy_contact_email')) {
        $blockers['MISSING_DELETION_CONTACT_EMAIL'] = 'A valid support or privacy deletion contact email is required.';
    }
    if (($options['data_deletion_review_state'] ?? '') !== 'approved') {
        $blockers['DATA_DELETION_NOT_APPROVED'] = 'Data-deletion review state is not approved.';
    }
    if (!human_option_has_valid_review_date($options, 'data_deletion_review_date')) {
        $blockers['MISSING_DATA_DELETION_REVIEW_DATE'] = 'A valid data-deletion review date is required.';
    }
    if (($options['deletion_process_review_state'] ?? '') !== 'approved') {
        $blockers['DELETION_PROCESS_NOT_APPROVED'] = 'Deletion-process review state is not approved.';
    }
    if (!human_option_has_valid_review_date($options, 'deletion_process_review_date')) {
        $blockers['MISSING_DELETION_PROCESS_REVIEW_DATE'] = 'A valid deletion-process review date is required.';
    }
    if (($options['android_data_flow_review_state'] ?? '') !== 'approved') {
        $blockers['ANDROID_FLOW_NOT_APPROVED'] = 'Android data-flow review state is not approved.';
    }

    return human_readiness_result($blockers);
}

function human_get_support_readiness() {
    $options = wp_parse_args(get_option('human_options', array()), human_get_default_options());
    $blockers = array();

    if (!human_option_has_valid_email($options, 'support_contact_email')) {
        $blockers['MISSING_SUPPORT_EMAIL'] = 'A valid support contact email is required.';
    }

    return human_readiness_result($blockers);
}

/**
 * Campaign automation readiness.
 *
 * This does not publish anything. It provides a strict export gate for future
 * connectors. Sample/reference Campaigns are always blocked.
 */
function human_get_campaign_readiness($campaign_id) {
    $post = get_post($campaign_id);
    $blockers = array();

    if (!$post || $post->post_type !== 'human_campaign') {
        $blockers['INVALID_CAMPAIGN'] = 'A valid Human Campaign is required.';
        return array(
            'ready_for_automation' => false,
            'blocker_codes' => array_keys($blockers),
            'blocker_messages' => array_values($blockers),
        );
    }

    $is_sample = get_post_meta($campaign_id, '_human_is_sample', true) === '1';
    $approval_state = (string) get_post_meta($campaign_id, '_human_camp_approval_state', true);
    $automation_eligible = get_post_meta($campaign_id, '_human_camp_automation_eligible', true) === '1';
    $status = (string) get_post_meta($campaign_id, '_human_camp_status', true);
    $objective = trim((string) get_post_meta($campaign_id, '_human_camp_objective', true));
    $target_url = trim((string) get_post_meta($campaign_id, '_human_camp_target_url', true));
    $utm_source = trim((string) get_post_meta($campaign_id, '_human_camp_utm_source', true));
    $utm_medium = trim((string) get_post_meta($campaign_id, '_human_camp_utm_medium', true));
    $utm_campaign = trim((string) get_post_meta($campaign_id, '_human_camp_utm_campaign', true));
    $facebook_copy = trim((string) get_post_meta($campaign_id, '_human_camp_facebook_copy', true));
    $instagram_copy = trim((string) get_post_meta($campaign_id, '_human_camp_instagram_copy', true));

    if ($is_sample) {
        $blockers['SAMPLE_CAMPAIGN'] = 'Sample/reference Campaigns can never be automation eligible.';
    }
    if ($approval_state !== 'approved') {
        $blockers['CAMPAIGN_NOT_APPROVED'] = 'Campaign approval state must be approved.';
    }
    if (!$automation_eligible) {
        $blockers['AUTOMATION_NOT_ENABLED'] = 'Automation eligible is not enabled.';
    }
    if (!in_array($status, array('planned', 'active'), true)) {
        $blockers['CAMPAIGN_STATUS_BLOCKED'] = 'Campaign status must be Planned or Active.';
    }
    if ($objective === '') {
        $blockers['MISSING_OBJECTIVE'] = 'Campaign objective is required.';
    }
    if ($target_url === '') {
        $blockers['MISSING_TARGET_URL'] = 'Campaign target URL is required.';
    } else {
        $valid_target = false;
        if (strpos($target_url, '/') === 0 && strpos($target_url, '//') !== 0) {
            $valid_target = true;
        } else {
            $parts = wp_parse_url($target_url);
            $valid_target = is_array($parts)
                && strtolower($parts['scheme'] ?? '') === 'https'
                && strtolower($parts['host'] ?? '') === 'humanv1.com';
        }
        if (!$valid_target) {
            $blockers['INVALID_TARGET_URL'] = 'Campaign target must be a local path or an HTTPS humanv1.com URL.';
        }
    }
    if ($utm_source === '' || $utm_medium === '' || $utm_campaign === '') {
        $blockers['INCOMPLETE_UTM'] = 'UTM source, medium and campaign values are required.';
    }
    if ($facebook_copy === '' && $instagram_copy === '') {
        $blockers['MISSING_SOCIAL_COPY'] = 'At least one social copy variant is required.';
    }

    return array(
        'ready_for_automation' => empty($blockers),
        'blocker_codes' => array_keys($blockers),
        'blocker_messages' => array_values($blockers),
    );
}
