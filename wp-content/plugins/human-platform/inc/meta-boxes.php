<?php
/**
 * Custom Meta Boxes for Human Platform
 * 
 * Provides SEO controls and App Product Metadata fields in WordPress Admin.
 */

if (!defined('ABSPATH')) {
    exit;
}

function human_add_custom_meta_boxes() {
    $screens = array('page', 'human_app');
    
    foreach ($screens as $screen) {
        add_meta_box(
            'human_seo_meta_box',
            __('Human SEO & Social Sharing Settings', 'human-platform'),
            'human_render_seo_meta_box',
            $screen,
            'normal',
            'high'
        );
    }

    add_meta_box(
        'human_app_details_meta_box',
        __('Human App Commercial & Marketing Details', 'human-platform'),
        'human_render_app_details_meta_box',
        'human_app',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'human_add_custom_meta_boxes');

function human_render_seo_meta_box($post) {
    wp_nonce_field('human_seo_meta_nonce_action', 'human_seo_meta_nonce');

    $seo_title = get_post_meta($post->ID, '_human_seo_title', true);
    $seo_desc  = get_post_meta($post->ID, '_human_seo_description', true);
    $canonical = get_post_meta($post->ID, '_human_canonical_url', true);
    $social_title = get_post_meta($post->ID, '_human_social_title', true);
    $social_desc  = get_post_meta($post->ID, '_human_social_description', true);
    $social_img   = get_post_meta($post->ID, '_human_social_image', true);
    ?>
    <div style="display:grid;gap:15px;padding:10px 0;">
        <div>
            <label for="human_seo_title"><strong><?php _e('Custom SEO Title', 'human-platform'); ?></strong></label>
            <input type="text" id="human_seo_title" name="_human_seo_title" value="<?php echo esc_attr($seo_title); ?>" class="large-text" placeholder="Defaults to post title + Human">
        </div>
        <div>
            <label for="human_seo_description"><strong><?php _e('Meta Description', 'human-platform'); ?></strong></label>
            <textarea id="human_seo_description" name="_human_seo_description" rows="3" class="large-text" placeholder="Recommended: 140-160 characters describing the content or product."><?php echo esc_textarea($seo_desc); ?></textarea>
        </div>
        <div>
            <label for="human_canonical_url"><strong><?php _e('Canonical URL Override (Optional)', 'human-platform'); ?></strong></label>
            <input type="url" id="human_canonical_url" name="_human_canonical_url" value="<?php echo esc_url($canonical); ?>" class="large-text" placeholder="<?php echo esc_url(get_permalink($post->ID)); ?>">
        </div>
        <hr style="border:0;border-top:1px solid #ddd;margin:10px 0;">
        <div>
            <label for="human_social_title"><strong><?php _e('Open Graph / Social Title', 'human-platform'); ?></strong></label>
            <input type="text" id="human_social_title" name="_human_social_title" value="<?php echo esc_attr($social_title); ?>" class="large-text" placeholder="Fallback to SEO Title or Post Title">
        </div>
        <div>
            <label for="human_social_description"><strong><?php _e('Open Graph / Social Description', 'human-platform'); ?></strong></label>
            <textarea id="human_social_description" name="_human_social_description" rows="2" class="large-text" placeholder="Fallback to Meta Description"><?php echo esc_textarea($social_desc); ?></textarea>
        </div>
        <div>
            <label for="human_social_image"><strong><?php _e('Social Share Image URL (1200x630)', 'human-platform'); ?></strong></label>
            <input type="url" id="human_social_image" name="_human_social_image" value="<?php echo esc_url($social_img); ?>" class="large-text" placeholder="Fallback to Post Featured Image or Default Brand Banner">
        </div>
    </div>
    <?php
}

function human_render_app_details_meta_box($post) {
    wp_nonce_field('human_app_meta_nonce_action', 'human_app_meta_nonce');

    $app_status  = get_post_meta($post->ID, '_human_app_status', true);
    $package_id  = get_post_meta($post->ID, '_human_app_package_id', true);
    $pricing     = get_post_meta($post->ID, '_human_app_pricing', true);
    $price_amount = get_post_meta($post->ID, '_human_app_price_amount', true);
    $price_currency = get_post_meta($post->ID, '_human_app_price_currency', true) ?: 'GBP';
    $billing_period = get_post_meta($post->ID, '_human_app_billing_period', true) ?: 'year';
    $trial_days   = get_post_meta($post->ID, '_human_app_trial_days', true) ?: '30';
    $play_url    = get_post_meta($post->ID, '_human_app_play_url', true);
    $cta_label   = get_post_meta($post->ID, '_human_app_cta_label', true);
    $cta_target  = get_post_meta($post->ID, '_human_app_target_url', true);
    ?>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:15px;padding:10px 0;">
        <div>
            <label for="human_app_status"><strong><?php _e('App Commercial Status', 'human-platform'); ?></strong></label>
            <select id="human_app_status" name="_human_app_status" class="widefat">
                <option value="AVAILABLE" <?php selected($app_status, 'AVAILABLE'); ?>>AVAILABLE (Commercial Launch)</option>
                <option value="IN_DEVELOPMENT" <?php selected($app_status, 'IN_DEVELOPMENT'); ?>>IN DEVELOPMENT (Next Module)</option>
                <option value="COMING_SOON" <?php selected($app_status, 'COMING_SOON'); ?>>COMING SOON</option>
                <option value="PLANNED" <?php selected($app_status, 'PLANNED'); ?>>PLANNED (Platform Vision)</option>
            </select>
        </div>
        <div>
            <label for="human_app_package_id"><strong><?php _e('Android Package ID', 'human-platform'); ?></strong></label>
            <input type="text" id="human_app_package_id" name="_human_app_package_id" value="<?php echo esc_attr($package_id); ?>" class="widefat" placeholder="e.g. com.aistudio.humanstrength.kfqjza">
        </div>
        <div>
            <label for="human_app_pricing"><strong><?php _e('Display Pricing & Trial Copy', 'human-platform'); ?></strong></label>
            <input type="text" id="human_app_pricing" name="_human_app_pricing" value="<?php echo esc_attr($pricing); ?>" class="widefat" placeholder="e.g. 30-day introductory trial, then £24/year">
        </div>
        <div style="display:grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap:10px;">
            <div>
                <label for="human_app_price_amount"><small>Amount</small></label>
                <input type="number" step="0.01" id="human_app_price_amount" name="_human_app_price_amount" value="<?php echo esc_attr($price_amount); ?>" class="widefat" placeholder="24.00">
            </div>
            <div>
                <label for="human_app_price_currency"><small>Currency</small></label>
                <input type="text" id="human_app_price_currency" name="_human_app_price_currency" value="<?php echo esc_attr($price_currency); ?>" class="widefat" placeholder="GBP">
            </div>
            <div>
                <label for="human_app_billing_period"><small>Billing Period</small></label>
                <select id="human_app_billing_period" name="_human_app_billing_period" class="widefat">
                    <option value="year" <?php selected($billing_period, 'year'); ?>>Year</option>
                    <option value="month" <?php selected($billing_period, 'month'); ?>>Month</option>
                    <option value="one_time" <?php selected($billing_period, 'one_time'); ?>>One-time</option>
                </select>
            </div>
            <div>
                <label for="human_app_trial_days"><small>Trial Days</small></label>
                <input type="number" id="human_app_trial_days" name="_human_app_trial_days" value="<?php echo esc_attr($trial_days); ?>" class="widefat" placeholder="30">
            </div>
        </div>
        <div>
            <label for="human_app_play_url"><strong><?php _e('Google Play Listing URL', 'human-platform'); ?></strong></label>
            <input type="url" id="human_app_play_url" name="_human_app_play_url" value="<?php echo esc_url($play_url); ?>" class="widefat" placeholder="https://play.google.com/store/apps/details?id=...">
        </div>
        <div>
            <label for="human_app_cta_label"><strong><?php _e('Primary CTA Label', 'human-platform'); ?></strong></label>
            <input type="text" id="human_app_cta_label" name="_human_app_cta_label" value="<?php echo esc_attr($cta_label); ?>" class="widefat" placeholder="e.g. Explore Human Strength">
        </div>
        <div>
            <label for="human_app_target_url"><strong><?php _e('Target Page URL / Path', 'human-platform'); ?></strong></label>
            <input type="text" id="human_app_target_url" name="_human_app_target_url" value="<?php echo esc_attr($cta_target); ?>" class="widefat" placeholder="e.g. /strength">
        </div>
    </div>
    <?php
}

function human_save_meta_boxes($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['human_seo_meta_nonce']) && wp_verify_nonce($_POST['human_seo_meta_nonce'], 'human_seo_meta_nonce_action')) {
        $fields = array('_human_seo_title', '_human_seo_description', '_human_canonical_url', '_human_social_title', '_human_social_description', '_human_social_image');
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                if ($field === '_human_canonical_url' || $field === '_human_social_image') {
                    update_post_meta($post_id, $field, esc_url_raw($_POST[$field]));
                } else {
                    update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
                }
            }
        }
    }

    if (isset($_POST['human_app_meta_nonce']) && wp_verify_nonce($_POST['human_app_meta_nonce'], 'human_app_meta_nonce_action')) {
        $app_fields = array(
            '_human_app_status', '_human_app_package_id', '_human_app_pricing', 
            '_human_app_price_amount', '_human_app_price_currency', '_human_app_billing_period', '_human_app_trial_days',
            '_human_app_play_url', '_human_app_cta_label', '_human_app_target_url'
        );
        foreach ($app_fields as $field) {
            if (isset($_POST[$field])) {
                if ($field === '_human_app_play_url') {
                    update_post_meta($post_id, $field, esc_url_raw($_POST[$field]));
                } else {
                    update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
                }
            }
        }
    }
}
add_action('save_post', 'human_save_meta_boxes');
