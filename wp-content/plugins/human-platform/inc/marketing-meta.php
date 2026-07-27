<?php
/**
 * Journal Marketing Metadata
 * 
 * Extends normal WordPress Posts with Human Marketing meta panel.
 */

if (!defined('ABSPATH')) {
    exit;
}

function human_add_marketing_meta_boxes() {
    add_meta_box(
        'human_marketing_details_meta_box',
        __('Human Marketing', 'human-platform'),
        'human_render_marketing_details_meta_box',
        'post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'human_add_marketing_meta_boxes');

function human_render_marketing_details_meta_box($post) {
    wp_nonce_field('human_marketing_meta_nonce_action', 'human_marketing_meta_nonce');

    // Product
    $primary_product = get_post_meta($post->ID, '_human_post_primary_product', true);
    $related_products = get_post_meta($post->ID, '_human_post_related_products', true) ?: array();

    // CTA
    $primary_cta = get_post_meta($post->ID, '_human_post_primary_cta', true);
    $secondary_cta = get_post_meta($post->ID, '_human_post_secondary_cta', true);

    // Campaign
    $primary_campaign = get_post_meta($post->ID, '_human_post_primary_campaign', true);

    // Content Lifecycle
    $content_type = get_post_meta($post->ID, '_human_post_content_type', true);
    $marketing_status = get_post_meta($post->ID, '_human_post_marketing_status', true);
    $review_date = get_post_meta($post->ID, '_human_post_review_date', true);
    $evergreen = get_post_meta($post->ID, '_human_post_evergreen', true);

    // Search Intent
    $primary_topic = get_post_meta($post->ID, '_human_post_primary_topic', true);
    $search_intent = get_post_meta($post->ID, '_human_post_search_intent', true);

    $apps = get_posts(array('post_type' => 'human_app', 'numberposts' => -1, 'post_status' => 'publish'));
    $ctas = get_posts(array('post_type' => 'human_cta', 'numberposts' => -1, 'post_status' => 'publish'));
    $campaigns = get_posts(array('post_type' => 'human_campaign', 'numberposts' => -1, 'post_status' => 'publish'));
    ?>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;padding:10px 0;">
        <!-- Product Section -->
        <div>
            <h4 style="margin-top:0; border-bottom:1px solid #ccc; padding-bottom:5px;">Product</h4>
            <div style="margin-bottom:10px;">
                <label for="human_post_primary_product"><strong><?php _e('Primary Human Product', 'human-platform'); ?></strong></label><br>
                <select id="human_post_primary_product" name="_human_post_primary_product" class="widefat">
                    <option value=""><?php _e('None', 'human-platform'); ?></option>
                    <?php foreach ($apps as $app) : ?>
                        <option value="<?php echo esc_attr($app->ID); ?>" <?php selected($primary_product, $app->ID); ?>><?php echo esc_html($app->post_title); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="human_post_related_products"><strong><?php _e('Related Products', 'human-platform'); ?></strong></label><br>
                <select id="human_post_related_products" name="_human_post_related_products[]" class="widefat" multiple style="height:80px;">
                    <?php foreach ($apps as $app) : ?>
                        <option value="<?php echo esc_attr($app->ID); ?>" <?php echo in_array($app->ID, (array)$related_products) ? 'selected' : ''; ?>><?php echo esc_html($app->post_title); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- CTA & Campaign Section -->
        <div>
            <h4 style="margin-top:0; border-bottom:1px solid #ccc; padding-bottom:5px;">CTA & Campaign</h4>
            <div style="margin-bottom:10px;">
                <label for="human_post_primary_cta"><strong><?php _e('Primary CTA', 'human-platform'); ?></strong></label><br>
                <select id="human_post_primary_cta" name="_human_post_primary_cta" class="widefat">
                    <option value=""><?php _e('None', 'human-platform'); ?></option>
                    <?php foreach ($ctas as $cta) : ?>
                        <option value="<?php echo esc_attr($cta->ID); ?>" <?php selected($primary_cta, $cta->ID); ?>><?php echo esc_html($cta->post_title); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div style="margin-bottom:10px;">
                <label for="human_post_secondary_cta"><strong><?php _e('Secondary CTA', 'human-platform'); ?></strong></label><br>
                <select id="human_post_secondary_cta" name="_human_post_secondary_cta" class="widefat">
                    <option value=""><?php _e('None', 'human-platform'); ?></option>
                    <?php foreach ($ctas as $cta) : ?>
                        <option value="<?php echo esc_attr($cta->ID); ?>" <?php selected($secondary_cta, $cta->ID); ?>><?php echo esc_html($cta->post_title); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="human_post_primary_campaign"><strong><?php _e('Primary Campaign', 'human-platform'); ?></strong></label><br>
                <select id="human_post_primary_campaign" name="_human_post_primary_campaign" class="widefat">
                    <option value=""><?php _e('None', 'human-platform'); ?></option>
                    <?php foreach ($campaigns as $camp) : ?>
                        <option value="<?php echo esc_attr($camp->ID); ?>" <?php selected($primary_campaign, $camp->ID); ?>><?php echo esc_html($camp->post_title); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Content Lifecycle Section -->
        <div>
            <h4 style="margin-top:0; border-bottom:1px solid #ccc; padding-bottom:5px;">Content Lifecycle</h4>
            <div style="margin-bottom:10px;">
                <label for="human_post_content_type"><strong><?php _e('Content Type', 'human-platform'); ?></strong></label><br>
                <select id="human_post_content_type" name="_human_post_content_type" class="widefat">
                    <option value="evergreen" <?php selected($content_type, 'evergreen'); ?>>Evergreen</option>
                    <option value="seasonal" <?php selected($content_type, 'seasonal'); ?>>Seasonal</option>
                    <option value="news" <?php selected($content_type, 'news'); ?>>News</option>
                    <option value="product" <?php selected($content_type, 'product'); ?>>Product</option>
                    <option value="guide" <?php selected($content_type, 'guide'); ?>>Guide</option>
                </select>
            </div>
            <div style="margin-bottom:10px;">
                <label for="human_post_marketing_status"><strong><?php _e('Marketing Status', 'human-platform'); ?></strong></label><br>
                <select id="human_post_marketing_status" name="_human_post_marketing_status" class="widefat">
                    <option value="draft" <?php selected($marketing_status, 'draft'); ?>>Draft</option>
                    <option value="needs_review" <?php selected($marketing_status, 'needs_review'); ?>>Needs Review</option>
                    <option value="marketing_ready" <?php selected($marketing_status, 'marketing_ready'); ?>>Marketing Ready</option>
                    <option value="active" <?php selected($marketing_status, 'active'); ?>>Active</option>
                    <option value="retired" <?php selected($marketing_status, 'retired'); ?>>Retired</option>
                </select>
            </div>
            <div style="margin-bottom:10px;">
                <label for="human_post_review_date"><strong><?php _e('Review Date', 'human-platform'); ?></strong></label><br>
                <input type="date" id="human_post_review_date" name="_human_post_review_date" value="<?php echo esc_attr($review_date); ?>" class="widefat">
            </div>
            <div>
                <label>
                    <input type="checkbox" name="_human_post_evergreen" value="1" <?php checked($evergreen, '1'); ?>>
                    <strong><?php _e('Evergreen Eligibility', 'human-platform'); ?></strong>
                </label>
            </div>
        </div>

        <!-- Search Intent Section -->
        <div>
            <h4 style="margin-top:0; border-bottom:1px solid #ccc; padding-bottom:5px;">Search Intent</h4>
            <div style="margin-bottom:10px;">
                <label for="human_post_primary_topic"><strong><?php _e('Primary Topic / Keyword', 'human-platform'); ?></strong></label><br>
                <input type="text" id="human_post_primary_topic" name="_human_post_primary_topic" value="<?php echo esc_attr($primary_topic); ?>" class="widefat">
            </div>
            <div>
                <label for="human_post_search_intent"><strong><?php _e('Search Intent', 'human-platform'); ?></strong></label><br>
                <select id="human_post_search_intent" name="_human_post_search_intent" class="widefat">
                    <option value="informational" <?php selected($search_intent, 'informational'); ?>>Informational</option>
                    <option value="commercial" <?php selected($search_intent, 'commercial'); ?>>Commercial</option>
                    <option value="transactional" <?php selected($search_intent, 'transactional'); ?>>Transactional</option>
                    <option value="navigational" <?php selected($search_intent, 'navigational'); ?>>Navigational</option>
                </select>
            </div>
        </div>
    </div>
    <?php
}

function human_save_marketing_meta_boxes($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!isset($_POST['human_marketing_meta_nonce']) || !wp_verify_nonce($_POST['human_marketing_meta_nonce'], 'human_marketing_meta_nonce_action')) return;

    // Single fields
    $fields = array(
        '_human_post_primary_product',
        '_human_post_primary_cta',
        '_human_post_secondary_cta',
        '_human_post_primary_campaign',
        '_human_post_content_type',
        '_human_post_marketing_status',
        '_human_post_review_date',
        '_human_post_primary_topic',
        '_human_post_search_intent'
    );
    foreach ($fields as $field) {
        if (isset($_POST[$field])) update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
    }

    // Array fields
    if (isset($_POST['_human_post_related_products'])) {
        $related = array_map('sanitize_text_field', $_POST['_human_post_related_products']);
        update_post_meta($post_id, '_human_post_related_products', $related);
    } else {
        delete_post_meta($post_id, '_human_post_related_products');
    }

    // Checkboxes
    $evergreen = isset($_POST['_human_post_evergreen']) ? '1' : '0';
    update_post_meta($post_id, '_human_post_evergreen', $evergreen);
}
add_action('save_post_post', 'human_save_marketing_meta_boxes');
