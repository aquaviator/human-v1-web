<?php
/**
 * Admin Settings Page for Human Platform
 *
 * Provides a central management UI in WordPress Admin for Brand, Google Play,
 * SEO defaults, Social profiles, and Marketing settings.
 */

if (!defined('ABSPATH')) {
    exit;
}

function human_register_admin_settings() {
    register_setting('human_platform_options_group', 'human_options', 'human_sanitize_options');

    add_action('admin_menu', function() {
        add_submenu_page(
            'edit.php?post_type=human_app',
            __('Platform Settings', 'human-platform'),
            __('Settings', 'human-platform'),
            'manage_options',
            'human-platform-settings',
            'human_render_settings_page'
        );
    });
}
add_action('admin_init', 'human_register_admin_settings');

function human_get_option($key, $default = '') {
    $options = get_option('human_options', array());
    return isset($options[$key]) && $options[$key] !== '' ? $options[$key] : $default;
}

function human_get_default_options() {
    return array(
        'brand_name' => 'Human V1',
        'umbrella_brand' => 'Human',
        'tagline' => 'Train. Track. Transform.',
        'canonical_domain' => 'https://humanv1.com',
        'content_label' => 'Journal',
        'catalogue_label' => 'Apps',
        'default_seo_title' => 'Human V1 | Be the best version of you',
        'default_meta_description' => 'Human V1 is the platform behind Human Strength and future Human applications. Human Strength is currently in Google Play Internal Testing.',
        'support_email' => 'support@humanv1.com',
        'contact_email' => 'hello@humanv1.com',
        'ontology_email' => 'ontology@humanv1.com',
        'google_play_strength_url' => 'https://play.google.com/store/apps/details?id=com.aistudio.humanstrength.kfqjza',
        'strength_package_id' => 'com.aistudio.humanstrength.kfqjza',
        'strength_pricing_text' => '30-day introductory trial, then £24/year',
        'default_social_image' => get_template_directory_uri() . '/assets/human-og-share.png',
        'ga_measurement_id' => '',
        'gsc_verification_code' => '',
        'facebook_url' => 'https://facebook.com/humanv1',
        'instagram_url' => 'https://instagram.com/humanv1',
        'linkedin_url' => 'https://linkedin.com/company/humanv1',
        'x_twitter_url' => 'https://x.com/humanv1',
        'operator_legal_name' => '',
        'operator_capacity' => '',
        'public_contact_email' => '',
        'privacy_contact_email' => '',
        'support_contact_email' => '',
        'privacy_review_state' => 'not_reviewed',
        'privacy_review_date' => '',
        'terms_review_state' => 'not_reviewed',
        'terms_review_date' => '',
        'data_deletion_review_state' => 'not_reviewed',
        'data_deletion_review_date' => '',
        'android_data_flow_review_state' => 'not_reviewed',
        'android_data_flow_review_date' => '',
        'deletion_process_review_state' => 'not_reviewed',
        'deletion_process_review_date' => '',
        'retention_review_state' => 'not_reviewed',
        'retention_review_date' => '',
        'processor_review_state' => 'not_reviewed',
        'processor_review_date' => ''
    );
}

/**
 * Canonical brand-shell helpers.
 *
 * Human-prefixed function names are intentionally retained for compatibility;
 * the returned values are configuration-driven so the presentation layer is
 * not coupled to Human V1 literals.
 */
function human_get_brand_name() {
    $defaults = human_get_default_options();
    return human_get_option('brand_name', $defaults['brand_name']);
}

function human_get_brand_short_name() {
    $defaults = human_get_default_options();
    return human_get_option('umbrella_brand', $defaults['umbrella_brand']);
}

function human_get_brand_tagline() {
    $defaults = human_get_default_options();
    return human_get_option('tagline', $defaults['tagline']);
}

function human_get_canonical_domain() {
    $defaults = human_get_default_options();
    $configured = human_get_option('canonical_domain', $defaults['canonical_domain']);
    $parts = wp_parse_url($configured);

    if (!is_array($parts)
        || strtolower($parts['scheme'] ?? '') !== 'https'
        || empty($parts['host'])) {
        return $defaults['canonical_domain'];
    }

    return rtrim($configured, '/');
}

function human_get_canonical_host() {
    $parts = wp_parse_url(human_get_canonical_domain());
    return is_array($parts) && !empty($parts['host']) ? strtolower($parts['host']) : 'humanv1.com';
}

function human_get_content_label() {
    $defaults = human_get_default_options();
    return human_get_option('content_label', $defaults['content_label']);
}

function human_get_catalogue_label() {
    $defaults = human_get_default_options();
    return human_get_option('catalogue_label', $defaults['catalogue_label']);
}

function human_validate_review_date($value) {
    $value = is_scalar($value) ? trim((string) $value) : '';
    if ($value === '') {
        return '';
    }

    $date = DateTime::createFromFormat('!Y-m-d', $value);
    $errors = DateTime::getLastErrors();
    $has_errors = is_array($errors) && (!empty($errors['warning_count']) || !empty($errors['error_count']));

    if (!$date || $has_errors || $date->format('Y-m-d') !== $value) {
        return false;
    }

    return $value;
}

function human_sanitize_options($input) {
    $defaults = human_get_default_options();
    $current = get_option('human_options', array());
    $current = is_array($current) ? $current : array();

    // Preserve existing and unknown keys. A malformed request must not reset
    // previously stored platform configuration.
    $sanitized = array_merge($defaults, $current);
    if (!is_array($input)) {
        return $sanitized;
    }

    $allowed_review_states = array('not_reviewed', 'in_review', 'approved');
    $allowed_capacities = array('individual', 'sole_trader', 'incorporated_entity', 'other');

    foreach ($defaults as $key => $default_val) {
        if (!array_key_exists($key, $input)) {
            continue;
        }

        $value = wp_unslash($input[$key]);

        if ($key === 'operator_capacity') {
            $candidate = sanitize_key($value);
            if ($candidate === '' || in_array($candidate, $allowed_capacities, true)) {
                $sanitized[$key] = $candidate;
            }
            continue;
        }

        if (substr($key, -13) === '_review_state') {
            $candidate = sanitize_key($value);
            if (in_array($candidate, $allowed_review_states, true)) {
                $sanitized[$key] = $candidate;
            }
            continue;
        }

        if (substr($key, -12) === '_review_date') {
            $candidate = human_validate_review_date($value);
            if ($candidate !== false) {
                $sanitized[$key] = $candidate;
            }
            continue;
        }

        if (strpos($key, 'email') !== false) {
            $sanitized[$key] = sanitize_email($value);
        } elseif (strpos($key, 'url') !== false || $key === 'canonical_domain') {
            $sanitized[$key] = esc_url_raw($value);
        } else {
            $sanitized[$key] = sanitize_text_field($value);
        }
    }

    return $sanitized;
}

function human_render_settings_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $options = wp_parse_args(get_option('human_options', array()), human_get_default_options());

    // Foundation Diagnostics
    $health = function_exists('human_get_marketing_foundation_health') ? human_get_marketing_foundation_health() : null;
    ?>
    <div class="wrap">
        <h1><span class="dashicons dashicons-performance" style="font-size:30px;width:30px;height:30px;margin-right:10px;"></span> <?php _e('Human Platform Settings', 'human-platform'); ?></h1>

        <?php if ($health): ?>
        <div style="background:#fff; border-left:4px solid <?php echo $health['status'] === 'HEALTHY' ? '#46b450' : '#d63638'; ?>; padding:15px; margin-bottom:20px; box-shadow:0 1px 1px rgba(0,0,0,0.04);">
            <h3 style="margin-top:0;">Marketing Foundation <span style="background:<?php echo $health['status'] === 'HEALTHY' ? '#46b450' : '#d63638'; ?>;color:#fff;padding:2px 6px;border-radius:3px;font-size:11px;font-weight:normal;margin-left:10px;"><?php echo esc_html($health['status']); ?></span></h3>
            <div style="display:grid; grid-template-columns: repeat(4, 1fr); gap:15px; font-size:13px;">
                <div>
                    <strong>Schema:</strong> <?php echo esc_html($health['schema_version']); ?>
                </div>
                <div>
                    <strong>Apps:</strong> <?php echo $health['apps']['found'] . ' / ' . $health['apps']['expected']; ?>
                </div>
                <div>
                    <strong>CTAs:</strong> <?php echo $health['ctas']['missing'] === 0 ? 'Complete' : $health['ctas']['found'] . '/' . $health['ctas']['expected']; ?>
                </div>
                <div>
                    <strong>Campaign:</strong> <?php echo $health['campaigns']['missing'] === 0 ? 'Complete' : 'Missing'; ?>
                </div>
                <div>
                    <strong>Primary Menu:</strong> <?php echo esc_html(ucfirst($health['navigation']['primary-menu'])); ?>
                </div>
                <div>
                    <strong>Footer Menu:</strong> <?php echo esc_html(ucfirst($health['navigation']['footer-menu'])); ?>
                </div>
                <div>
                    <strong>Apps Menu:</strong> <?php echo esc_html(ucfirst($health['navigation']['apps-menu'])); ?>
                </div>
                <div>
                    <strong>Taxonomy:</strong> <?php echo empty($health['taxonomy']['missing']) ? 'Complete' : 'Missing ' . count($health['taxonomy']['missing']); ?>
                </div>
                <div>
                    <strong>Pages:</strong> <?php echo $health['pages']['missing'] === 0 ? 'Complete' : $health['pages']['found'] . '/' . $health['pages']['expected']; ?>
                </div>
                <div>
                    <strong>Front/Posts Page:</strong> <?php echo ($health['front_page']['is_page'] && $health['front_page']['posts_page_set']) ? 'Configured' : 'Needs Config'; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <p><?php echo esc_html(sprintf(__('Central configuration for brand details, Google Play integration, SEO defaults, and marketing options across %s.', 'human-platform'), human_get_canonical_host())); ?></p>

        <form method="post" action="options.php">
            <?php
            settings_fields('human_platform_options_group');
            ?>
            <?php
            $legal_readiness = array(
                'Privacy' => function_exists('human_get_privacy_readiness') ? human_get_privacy_readiness() : null,
                'Terms' => function_exists('human_get_terms_readiness') ? human_get_terms_readiness() : null,
                'Data Deletion' => function_exists('human_get_data_deletion_readiness') ? human_get_data_deletion_readiness() : null,
                'Support' => function_exists('human_get_support_readiness') ? human_get_support_readiness() : null,
            );
            ?>
            <h2><?php _e('Legal & Operational Readiness', 'human-platform'); ?></h2>
            <p><?php _e('Review states are editorial records. Missing facts do not rewrite an approved selection; they keep readiness blocked until every dependency is satisfied.', 'human-platform'); ?></p>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:12px;margin-bottom:20px;">
                <?php foreach ($legal_readiness as $label => $readiness): ?>
                    <?php
                    $is_ready = is_array($readiness) && !empty($readiness['ready']);
                    $codes = is_array($readiness) && !empty($readiness['blocker_codes']) ? (array) $readiness['blocker_codes'] : array();
                    $messages = is_array($readiness) && !empty($readiness['blocker_messages']) ? (array) $readiness['blocker_messages'] : array();
                    ?>
                    <div style="background:#fff;border-left:4px solid <?php echo $is_ready ? '#46b450' : '#d63638'; ?>;padding:12px;">
                        <strong><?php echo esc_html($label); ?>:</strong>
                        <span><?php echo $is_ready ? esc_html__('Ready', 'human-platform') : esc_html__('Blocked', 'human-platform'); ?></span>
                        <?php if (!$is_ready && ($codes || $messages)): ?>
                            <ul style="margin:8px 0 0 18px;">
                                <?php foreach ($codes as $index => $code): ?>
                                    <li><code><?php echo esc_html($code); ?></code><?php echo isset($messages[$index]) ? ': ' . esc_html($messages[$index]) : ''; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <h2><?php _e('Operator & Review Facts', 'human-platform'); ?></h2>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="operator_legal_name"><?php _e('Operator Legal Name', 'human-platform'); ?></label></th>
                    <td><input name="human_options[operator_legal_name]" type="text" id="operator_legal_name" value="<?php echo esc_attr($options['operator_legal_name']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="operator_capacity"><?php _e('Operator Capacity', 'human-platform'); ?></label></th>
                    <td>
                        <select name="human_options[operator_capacity]" id="operator_capacity">
                            <option value="" <?php selected($options['operator_capacity'], ''); ?>><?php _e('Select', 'human-platform'); ?></option>
                            <option value="individual" <?php selected($options['operator_capacity'], 'individual'); ?>><?php _e('Individual', 'human-platform'); ?></option>
                            <option value="sole_trader" <?php selected($options['operator_capacity'], 'sole_trader'); ?>><?php _e('Sole Trader', 'human-platform'); ?></option>
                            <option value="incorporated_entity" <?php selected($options['operator_capacity'], 'incorporated_entity'); ?>><?php _e('Incorporated Entity', 'human-platform'); ?></option>
                            <option value="other" <?php selected($options['operator_capacity'], 'other'); ?>><?php _e('Other', 'human-platform'); ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="public_contact_email"><?php _e('Public Contact Email', 'human-platform'); ?></label></th>
                    <td><input name="human_options[public_contact_email]" type="email" id="public_contact_email" value="<?php echo esc_attr($options['public_contact_email']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="privacy_contact_email"><?php _e('Privacy Contact Email', 'human-platform'); ?></label></th>
                    <td><input name="human_options[privacy_contact_email]" type="email" id="privacy_contact_email" value="<?php echo esc_attr($options['privacy_contact_email']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="support_contact_email"><?php _e('Support Contact Email', 'human-platform'); ?></label></th>
                    <td><input name="human_options[support_contact_email]" type="email" id="support_contact_email" value="<?php echo esc_attr($options['support_contact_email']); ?>" class="regular-text"></td>
                </tr>
                <?php
                $review_fields = array(
                    'privacy' => __('Privacy', 'human-platform'),
                    'terms' => __('Terms', 'human-platform'),
                    'data_deletion' => __('Data Deletion', 'human-platform'),
                    'android_data_flow' => __('Android Data Flow', 'human-platform'),
                    'deletion_process' => __('Deletion Process', 'human-platform'),
                    'retention' => __('Retention', 'human-platform'),
                    'processor' => __('Processors / Transfers', 'human-platform'),
                );
                foreach ($review_fields as $review_key => $review_label):
                    $state_key = $review_key . '_review_state';
                    $date_key = $review_key . '_review_date';
                ?>
                <tr>
                    <th scope="row"><?php echo esc_html($review_label); ?></th>
                    <td>
                        <select name="human_options[<?php echo esc_attr($state_key); ?>]">
                            <option value="not_reviewed" <?php selected($options[$state_key], 'not_reviewed'); ?>><?php _e('Not Reviewed', 'human-platform'); ?></option>
                            <option value="in_review" <?php selected($options[$state_key], 'in_review'); ?>><?php _e('In Review', 'human-platform'); ?></option>
                            <option value="approved" <?php selected($options[$state_key], 'approved'); ?>><?php _e('Approved', 'human-platform'); ?></option>
                        </select>
                        <input name="human_options[<?php echo esc_attr($date_key); ?>]" type="date" value="<?php echo esc_attr($options[$date_key]); ?>">
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>

            <h2><?php _e('Platform Settings', 'human-platform'); ?></h2>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="brand_name"><?php _e('Brand Name', 'human-platform'); ?></label></th>
                    <td><input name="human_options[brand_name]" type="text" id="brand_name" value="<?php echo esc_attr($options['brand_name']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="umbrella_brand"><?php _e('Brand Short Name', 'human-platform'); ?></label></th>
                    <td><input name="human_options[umbrella_brand]" type="text" id="umbrella_brand" value="<?php echo esc_attr($options['umbrella_brand']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="tagline"><?php _e('Brand Tagline', 'human-platform'); ?></label></th>
                    <td><input name="human_options[tagline]" type="text" id="tagline" value="<?php echo esc_attr($options['tagline']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="canonical_domain"><?php _e('Canonical Domain URL', 'human-platform'); ?></label></th>
                    <td><input name="human_options[canonical_domain]" type="url" id="canonical_domain" value="<?php echo esc_attr($options['canonical_domain']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="content_label"><?php _e('Content Section Label', 'human-platform'); ?></label></th>
                    <td><input name="human_options[content_label]" type="text" id="content_label" value="<?php echo esc_attr($options['content_label']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="catalogue_label"><?php _e('Catalogue Label', 'human-platform'); ?></label></th>
                    <td><input name="human_options[catalogue_label]" type="text" id="catalogue_label" value="<?php echo esc_attr($options['catalogue_label']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="default_seo_title"><?php _e('Default SEO Title', 'human-platform'); ?></label></th>
                    <td><input name="human_options[default_seo_title]" type="text" id="default_seo_title" value="<?php echo esc_attr($options['default_seo_title']); ?>" class="large-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="default_meta_description"><?php _e('Default Meta Description', 'human-platform'); ?></label></th>
                    <td><textarea name="human_options[default_meta_description]" id="default_meta_description" rows="3" class="large-text"><?php echo esc_textarea($options['default_meta_description']); ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row"><label for="google_play_strength_url"><?php _e('Human Strength Google Play URL', 'human-platform'); ?></label></th>
                    <td><input name="human_options[google_play_strength_url]" type="url" id="google_play_strength_url" value="<?php echo esc_attr($options['google_play_strength_url']); ?>" class="large-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="strength_package_id"><?php _e('Human Strength Package ID', 'human-platform'); ?></label></th>
                    <td><input name="human_options[strength_package_id]" type="text" id="strength_package_id" value="<?php echo esc_attr($options['strength_package_id']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="support_email"><?php _e('Support Email Address', 'human-platform'); ?></label></th>
                    <td><input name="human_options[support_email]" type="email" id="support_email" value="<?php echo esc_attr($options['support_email']); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="ga_measurement_id"><?php _e('Google Analytics Measurement ID', 'human-platform'); ?></label></th>
                    <td><input name="human_options[ga_measurement_id]" type="text" id="ga_measurement_id" value="<?php echo esc_attr($options['ga_measurement_id']); ?>" class="regular-text" placeholder="G-XXXXXXXXXX"></td>
                </tr>
            </table>

            <?php submit_button(__('Save Human Platform Settings', 'human-platform')); ?>
        </form>
    </div>
    <?php
}
