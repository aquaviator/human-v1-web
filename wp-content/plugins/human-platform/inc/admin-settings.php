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
        'default_seo_title' => 'Human V1 — Performance Technology Platform | Train. Track. Transform.',
        'default_meta_description' => 'A performance technology platform connecting strength training, volume analytics, and movement science into a unified ecosystem. Starting with Human Strength for Android.',
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
        'x_twitter_url' => 'https://x.com/humanv1'
    );
}

function human_sanitize_options($input) {
    $sanitized = array();
    $defaults = human_get_default_options();

    foreach ($defaults as $key => $default_val) {
        if (isset($input[$key])) {
            if (strpos($key, 'email') !== false) {
                $sanitized[$key] = sanitize_email($input[$key]);
            } elseif (strpos($key, 'url') !== false) {
                $sanitized[$key] = esc_url_raw($input[$key]);
            } else {
                $sanitized[$key] = sanitize_text_field($input[$key]);
            }
        } else {
            $sanitized[$key] = $default_val;
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
            </div>
        </div>
        <?php endif; ?>

        <p><?php _e('Central configuration for brand details, Google Play integration, SEO defaults, and marketing options across humanv1.com.', 'human-platform'); ?></p>

        <form method="post" action="options.php">
            <?php
            settings_fields('human_platform_options_group');
            ?>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="brand_name"><?php _e('Brand Name', 'human-platform'); ?></label></th>
                    <td><input name="human_options[brand_name]" type="text" id="brand_name" value="<?php echo esc_attr($options['brand_name']); ?>" class="regular-text"></td>
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
