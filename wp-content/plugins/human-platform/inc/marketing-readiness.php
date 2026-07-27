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

    if (!empty($seo_title)) {
        $seo_score += 5;
        $readiness['sections']['seo']['ready'][] = 'SEO title complete';
    } else {
        $readiness['sections']['seo']['warnings'][] = 'SEO title is missing';
    }

    if (!empty($seo_desc)) {
        $seo_score += 5;
        $readiness['sections']['seo']['ready'][] = 'Meta description complete';
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

    if (!empty($social_title)) {
        $social_score += 5;
        $readiness['sections']['social']['ready'][] = 'Social title complete';
    } else {
        $readiness['sections']['social']['warnings'][] = 'Social title is missing';
    }

    if (!empty($social_desc)) {
        $social_score += 5;
        $readiness['sections']['social']['ready'][] = 'Social description complete';
    } else {
        $readiness['sections']['social']['warnings'][] = 'Social description is missing';
    }

    if (!empty($social_image)) {
        $social_score += 5;
        $readiness['sections']['social']['ready'][] = 'Social share image configured';
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
        if ($camp_status === 'completed' || $camp_status === 'cancelled') {
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

    if ($total_score >= 90 && empty($readiness['sections']['conversion']['warnings'])) {
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

