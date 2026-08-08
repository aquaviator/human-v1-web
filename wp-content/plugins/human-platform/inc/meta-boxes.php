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

    $app_slug = get_post_field('post_name', $post->ID);
    $definitions = human_get_app_definitions();
    $definition = isset($definitions[$app_slug]) ? $definitions[$app_slug] : null;
    $product_type = metadata_exists('post', $post->ID, '_human_product_type')
        ? human_normalize_product_type(get_post_meta($post->ID, '_human_product_type', true))
        : human_normalize_product_type($definition['product_type'] ?? 'other');
    $distribution_channel = metadata_exists('post', $post->ID, '_human_distribution_channel')
        ? human_normalize_distribution_channel(get_post_meta($post->ID, '_human_distribution_channel', true))
        : human_normalize_distribution_channel($definition['distribution_channel'] ?? 'none');
    $distribution_url = metadata_exists('post', $post->ID, '_human_distribution_url')
        ? get_post_meta($post->ID, '_human_distribution_url', true)
        : (string) ($definition['distribution_url'] ?? '');
    $external_identifier = metadata_exists('post', $post->ID, '_human_external_identifier')
        ? get_post_meta($post->ID, '_human_external_identifier', true)
        : (string) ($definition['external_identifier'] ?? '');
    $app_status  = human_normalize_app_status(get_post_meta($post->ID, '_human_app_status', true), $app_slug);
    $package_id  = get_post_meta($post->ID, '_human_app_package_id', true);
    $pricing     = get_post_meta($post->ID, '_human_app_pricing', true);
    $price_amount = get_post_meta($post->ID, '_human_app_price_amount', true);
    $price_currency = metadata_exists('post', $post->ID, '_human_app_price_currency')
        ? get_post_meta($post->ID, '_human_app_price_currency', true)
        : ($definition['price_currency'] ?? '');
    $billing_period = metadata_exists('post', $post->ID, '_human_app_billing_period')
        ? get_post_meta($post->ID, '_human_app_billing_period', true)
        : ($definition['billing_period'] ?? '');
    $trial_days = metadata_exists('post', $post->ID, '_human_app_trial_days')
        ? get_post_meta($post->ID, '_human_app_trial_days', true)
        : ($definition['trial_days'] ?? '');
    $play_url    = get_post_meta($post->ID, '_human_app_play_url', true);
    $internal_test_url = get_post_meta($post->ID, '_human_app_internal_test_url', true);
    $cta_label   = get_post_meta($post->ID, '_human_app_cta_label', true);
    $cta_target  = get_post_meta($post->ID, '_human_app_target_url', true);
    ?>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:15px;padding:10px 0;">
        <div>
            <label for="human_app_status"><strong><?php _e('App Commercial Status', 'human-platform'); ?></strong></label>
            <select id="human_app_status" name="_human_app_status" class="widefat">
                <option value="available" <?php selected($app_status, 'available'); ?>><?php _e('Available', 'human-platform'); ?></option>
                <option value="internal_testing" <?php selected($app_status, 'internal_testing'); ?>><?php _e('Internal Testing', 'human-platform'); ?></option>
                <option value="coming_soon" <?php selected($app_status, 'coming_soon'); ?>><?php _e('Coming Soon', 'human-platform'); ?></option>
                <option value="future" <?php selected($app_status, 'future'); ?>><?php _e('Future Product', 'human-platform'); ?></option>
                <option value="paused" <?php selected($app_status, 'paused'); ?>><?php _e('Paused', 'human-platform'); ?></option>
                <option value="retired" <?php selected($app_status, 'retired'); ?>><?php _e('Retired', 'human-platform'); ?></option>
            </select>
        </div>
        <div>
            <label for="human_product_type"><strong><?php _e('Product Type', 'human-platform'); ?></strong></label>
            <select id="human_product_type" name="_human_product_type" class="widefat">
                <?php foreach (human_get_product_types() as $type_key => $type_label): ?>
                    <option value="<?php echo esc_attr($type_key); ?>" <?php selected($product_type, $type_key); ?>><?php echo esc_html($type_label); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="human_distribution_channel"><strong><?php _e('Distribution Channel', 'human-platform'); ?></strong></label>
            <select id="human_distribution_channel" name="_human_distribution_channel" class="widefat">
                <?php foreach (human_get_distribution_channels() as $channel_key => $channel_label): ?>
                    <option value="<?php echo esc_attr($channel_key); ?>" <?php selected($distribution_channel, $channel_key); ?>><?php echo esc_html($channel_label); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="human_distribution_url"><strong><?php _e('Distribution URL / Path', 'human-platform'); ?></strong></label>
            <input type="text" id="human_distribution_url" name="_human_distribution_url" value="<?php echo esc_attr($distribution_url); ?>" class="widefat" placeholder="https://... or /product/">
            <p class="description"><?php _e('Generic product destination. Google Play keeps strict Store URL validation.', 'human-platform'); ?></p>
        </div>
        <div>
            <label for="human_external_identifier"><strong><?php _e('External Identifier', 'human-platform'); ?></strong></label>
            <input type="text" id="human_external_identifier" name="_human_external_identifier" value="<?php echo esc_attr($external_identifier); ?>" class="widefat" placeholder="Package ID, SKU, ISBN, product key, etc.">
        </div>
        <div>
            <label for="human_app_package_id"><strong><?php _e('Android Package ID', 'human-platform'); ?></strong></label>
            <input type="text" id="human_app_package_id" name="_human_app_package_id" value="<?php echo esc_attr($package_id); ?>" class="widefat" placeholder="e.g. com.aistudio.humanstrength.kfqjza">
        </div>
        <div>
            <label for="human_app_pricing"><strong><?php _e('Display Pricing', 'human-platform'); ?></strong></label>
            <input type="text" id="human_app_pricing" name="_human_app_pricing" value="<?php echo esc_attr($pricing); ?>" class="widefat" placeholder="e.g. £24/year through Google Play">
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
                    <option value="" <?php selected($billing_period, ''); ?>>Not set</option>
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
            <p class="description"><?php _e('Public Store listing only. Used only when status is Available.', 'human-platform'); ?></p>
        </div>
        <div>
            <label for="human_app_internal_test_url"><strong><?php _e('Google Play Internal Testing URL', 'human-platform'); ?></strong></label>
            <input type="url" id="human_app_internal_test_url" name="_human_app_internal_test_url" value="<?php echo esc_url($internal_test_url); ?>" class="widefat" placeholder="https://play.google.com/apps/internaltest/...">
            <p class="description"><?php _e('Tester opt-in URL. Never exposed as a public Store download URL.', 'human-platform'); ?></p>
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

    if (wp_is_post_revision($post_id) || !current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['human_seo_meta_nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['human_seo_meta_nonce'])), 'human_seo_meta_nonce_action')) {
        $fields = array('_human_seo_title', '_human_seo_description', '_human_canonical_url', '_human_social_title', '_human_social_description', '_human_social_image');
        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                $submitted_value = wp_unslash($_POST[$field]);
                if ($field === '_human_canonical_url' || $field === '_human_social_image') {
                    update_post_meta($post_id, $field, esc_url_raw($submitted_value));
                } else {
                    update_post_meta($post_id, $field, sanitize_text_field($submitted_value));
                }
            }
        }
    }

    if (get_post_type($post_id) !== 'human_app'
        || !isset($_POST['human_app_meta_nonce'])
        || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['human_app_meta_nonce'])), 'human_app_meta_nonce_action')
    ) {
        return;
    }

    if (isset($_POST['_human_app_status'])) {
        $submitted_status = trim((string) wp_unslash($_POST['_human_app_status']));
        if (in_array($submitted_status, human_get_allowed_app_statuses(), true)) {
            update_post_meta($post_id, '_human_app_status', $submitted_status);
        }
    }

    if (isset($_POST['_human_product_type'])) {
        $product_type = sanitize_key(wp_unslash($_POST['_human_product_type']));
        if (array_key_exists($product_type, human_get_product_types())) {
            update_post_meta($post_id, '_human_product_type', $product_type);
        }
    }

    if (isset($_POST['_human_distribution_channel'])) {
        $distribution_channel = sanitize_key(wp_unslash($_POST['_human_distribution_channel']));
        if (array_key_exists($distribution_channel, human_get_distribution_channels())) {
            update_post_meta($post_id, '_human_distribution_channel', $distribution_channel);
        }
    }

    if (isset($_POST['_human_external_identifier'])) {
        update_post_meta(
            $post_id,
            '_human_external_identifier',
            sanitize_text_field(wp_unslash($_POST['_human_external_identifier']))
        );
    }

    if (isset($_POST['_human_distribution_url'])) {
        $distribution_channel = metadata_exists('post', $post_id, '_human_distribution_channel')
            ? get_post_meta($post_id, '_human_distribution_channel', true)
            : 'none';
        $submitted_distribution_url = trim((string) wp_unslash($_POST['_human_distribution_url']));
        if ($submitted_distribution_url === '') {
            update_post_meta($post_id, '_human_distribution_url', '');
        } else {
            $validated_distribution_url = human_validate_distribution_url(
                $submitted_distribution_url,
                $distribution_channel
            );
            if ($validated_distribution_url !== '') {
                update_post_meta($post_id, '_human_distribution_url', $validated_distribution_url);
            }
        }
    }

    $text_fields = array(
        '_human_app_pricing',
        '_human_app_cta_label',
        '_human_app_target_url',
    );
    foreach ($text_fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field(wp_unslash($_POST[$field])));
        }
    }

    if (isset($_POST['_human_app_package_id'])) {
        $package_id = sanitize_text_field(wp_unslash($_POST['_human_app_package_id']));
        if ($package_id === '' || preg_match('/^[A-Za-z][A-Za-z0-9_]*(?:\.[A-Za-z][A-Za-z0-9_]*){1,}$/', $package_id)) {
            update_post_meta($post_id, '_human_app_package_id', $package_id);
        }
    }

    if (isset($_POST['_human_app_price_amount'])) {
        $price_amount = sanitize_text_field(wp_unslash($_POST['_human_app_price_amount']));
        if ($price_amount === '') {
            update_post_meta($post_id, '_human_app_price_amount', '');
        } elseif (is_numeric($price_amount) && (float) $price_amount >= 0) {
            update_post_meta($post_id, '_human_app_price_amount', number_format((float) $price_amount, 2, '.', ''));
        }
    }

    if (isset($_POST['_human_app_price_currency'])) {
        $currency = strtoupper(sanitize_text_field(wp_unslash($_POST['_human_app_price_currency'])));
        if ($currency === '' || preg_match('/^[A-Z]{3}$/', $currency)) {
            update_post_meta($post_id, '_human_app_price_currency', $currency);
        }
    }

    if (isset($_POST['_human_app_billing_period'])) {
        $billing_period = sanitize_key(wp_unslash($_POST['_human_app_billing_period']));
        if (in_array($billing_period, array('', 'year', 'month', 'one_time'), true)) {
            update_post_meta($post_id, '_human_app_billing_period', $billing_period);
        }
    }

    if (isset($_POST['_human_app_trial_days'])) {
        $trial_days = sanitize_text_field(wp_unslash($_POST['_human_app_trial_days']));
        if ($trial_days === '') {
            update_post_meta($post_id, '_human_app_trial_days', '');
        } elseif (ctype_digit($trial_days)) {
            update_post_meta($post_id, '_human_app_trial_days', (string) absint($trial_days));
        }
    }

    $url_fields = array(
        '_human_app_play_url' => 'public',
        '_human_app_internal_test_url' => 'internal',
    );
    foreach ($url_fields as $field => $url_type) {
        if (!isset($_POST[$field])) {
            continue;
        }

        $submitted_url = trim((string) wp_unslash($_POST[$field]));
        if ($submitted_url === '') {
            update_post_meta($post_id, $field, '');
            continue;
        }

        $validated_url = human_validate_google_play_url($submitted_url, $url_type);
        if ($validated_url !== '') {
            update_post_meta($post_id, $field, $validated_url);
        }
    }
}
add_action('save_post', 'human_save_meta_boxes');
