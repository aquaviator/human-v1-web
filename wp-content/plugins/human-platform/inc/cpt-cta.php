<?php
/**
 * Custom Post Type: Human CTAs
 * 
 * Registers the 'human_cta' CPT.
 */

if (!defined('ABSPATH')) {
    exit;
}

function human_register_cta_cpt() {
    $labels = array(
        'name'               => _x('CTAs', 'post type general name', 'human-platform'),
        'singular_name'      => _x('CTA', 'post type singular name', 'human-platform'),
        'menu_name'          => _x('CTAs', 'admin menu', 'human-platform'),
        'name_admin_bar'     => _x('CTA', 'add new on admin bar', 'human-platform'),
        'add_new'            => _x('Add New CTA', 'cta', 'human-platform'),
        'add_new_item'       => __('Add New CTA', 'human-platform'),
        'new_item'           => __('New CTA', 'human-platform'),
        'edit_item'          => __('Edit CTA', 'human-platform'),
        'view_item'          => __('View CTA', 'human-platform'),
        'all_items'          => __('All CTAs', 'human-platform'),
        'search_items'       => __('Search CTAs', 'human-platform'),
        'not_found'          => __('No CTAs found.', 'human-platform'),
        'not_found_in_trash' => __('No CTAs found in Trash.', 'human-platform')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => 'edit.php?post_type=human_app',
        'query_var'          => false,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'supports'           => array('title'),
        'show_in_rest'       => true,
    );

    register_post_type('human_cta', $args);
}
add_action('init', 'human_register_cta_cpt');

// Add Meta Boxes for CTA
function human_add_cta_meta_boxes() {
    add_meta_box(
        'human_cta_details_meta_box',
        __('CTA Details', 'human-platform'),
        'human_render_cta_details_meta_box',
        'human_cta',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'human_add_cta_meta_boxes');

function human_render_cta_details_meta_box($post) {
    wp_nonce_field('human_cta_meta_nonce_action', 'human_cta_meta_nonce');

    $cta_label = get_post_meta($post->ID, '_human_cta_label', true);
    $supporting_text = get_post_meta($post->ID, '_human_cta_supporting_text', true);
    $destination_url = get_post_meta($post->ID, '_human_cta_destination_url', true);
    $cta_type = get_post_meta($post->ID, '_human_cta_type', true);
    $associated_app = get_post_meta($post->ID, '_human_cta_associated_app', true);
    $associated_campaign = get_post_meta($post->ID, '_human_cta_associated_campaign', true);
    $status = get_post_meta($post->ID, '_human_cta_status', true);
    $utm_source = get_post_meta($post->ID, '_human_cta_utm_source', true);
    $utm_medium = get_post_meta($post->ID, '_human_cta_utm_medium', true);
    $utm_campaign = get_post_meta($post->ID, '_human_cta_utm_campaign', true);
    $utm_content = get_post_meta($post->ID, '_human_cta_utm_content', true);
    $new_tab = get_post_meta($post->ID, '_human_cta_new_tab', true);

    $apps = get_posts(array('post_type' => 'human_app', 'numberposts' => -1, 'post_status' => 'publish'));
    $campaigns = get_posts(array('post_type' => 'human_campaign', 'numberposts' => -1, 'post_status' => 'publish'));
    ?>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:15px;padding:10px 0;">
        <div>
            <label for="human_cta_label"><strong><?php _e('CTA Label / Button Text', 'human-platform'); ?></strong></label>
            <input type="text" id="human_cta_label" name="_human_cta_label" value="<?php echo esc_attr($cta_label); ?>" class="widefat" required>
        </div>
        <div>
            <label for="human_cta_destination_url"><strong><?php _e('Destination URL', 'human-platform'); ?></strong></label>
            <input type="url" id="human_cta_destination_url" name="_human_cta_destination_url" value="<?php echo esc_url($destination_url); ?>" class="widefat">
        </div>
        <div style="grid-column: 1 / -1;">
            <label for="human_cta_supporting_text"><strong><?php _e('Supporting Text', 'human-platform'); ?></strong></label>
            <textarea id="human_cta_supporting_text" name="_human_cta_supporting_text" rows="2" class="widefat"><?php echo esc_textarea($supporting_text); ?></textarea>
        </div>
        <div>
            <label for="human_cta_type"><strong><?php _e('CTA Type', 'human-platform'); ?></strong></label>
            <select id="human_cta_type" name="_human_cta_type" class="widefat">
                <option value="product" <?php selected($cta_type, 'product'); ?>>Product</option>
                <option value="download" <?php selected($cta_type, 'download'); ?>>Download</option>
                <option value="learn" <?php selected($cta_type, 'learn'); ?>>Learn</option>
                <option value="content" <?php selected($cta_type, 'content'); ?>>Content</option>
                <option value="newsletter" <?php selected($cta_type, 'newsletter'); ?>>Newsletter</option>
                <option value="campaign" <?php selected($cta_type, 'campaign'); ?>>Campaign</option>
            </select>
        </div>
        <div>
            <label for="human_cta_status"><strong><?php _e('Status', 'human-platform'); ?></strong></label>
            <select id="human_cta_status" name="_human_cta_status" class="widefat">
                <option value="active" <?php selected($status, 'active'); ?>>Active</option>
                <option value="inactive" <?php selected($status, 'inactive'); ?>>Inactive</option>
            </select>
        </div>
        <div>
            <label for="human_cta_associated_app"><strong><?php _e('Associated Human App', 'human-platform'); ?></strong></label>
            <select id="human_cta_associated_app" name="_human_cta_associated_app" class="widefat">
                <option value=""><?php _e('None', 'human-platform'); ?></option>
                <?php foreach ($apps as $app) : ?>
                    <option value="<?php echo esc_attr($app->ID); ?>" <?php selected($associated_app, $app->ID); ?>><?php echo esc_html($app->post_title); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="human_cta_associated_campaign"><strong><?php _e('Associated Campaign', 'human-platform'); ?></strong></label>
            <select id="human_cta_associated_campaign" name="_human_cta_associated_campaign" class="widefat">
                <option value=""><?php _e('None', 'human-platform'); ?></option>
                <?php foreach ($campaigns as $camp) : ?>
                    <option value="<?php echo esc_attr($camp->ID); ?>" <?php selected($associated_campaign, $camp->ID); ?>><?php echo esc_html($camp->post_title); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="human_cta_utm_source"><strong><?php _e('UTM Source', 'human-platform'); ?></strong></label>
            <input type="text" id="human_cta_utm_source" name="_human_cta_utm_source" value="<?php echo esc_attr($utm_source); ?>" class="widefat">
        </div>
        <div>
            <label for="human_cta_utm_medium"><strong><?php _e('UTM Medium', 'human-platform'); ?></strong></label>
            <input type="text" id="human_cta_utm_medium" name="_human_cta_utm_medium" value="<?php echo esc_attr($utm_medium); ?>" class="widefat">
        </div>
        <div>
            <label for="human_cta_utm_campaign"><strong><?php _e('UTM Campaign', 'human-platform'); ?></strong></label>
            <input type="text" id="human_cta_utm_campaign" name="_human_cta_utm_campaign" value="<?php echo esc_attr($utm_campaign); ?>" class="widefat">
        </div>
        <div>
            <label for="human_cta_utm_content"><strong><?php _e('UTM Content (Optional)', 'human-platform'); ?></strong></label>
            <input type="text" id="human_cta_utm_content" name="_human_cta_utm_content" value="<?php echo esc_attr($utm_content); ?>" class="widefat">
        </div>
        <div style="grid-column: 1 / -1;">
            <label>
                <input type="checkbox" name="_human_cta_new_tab" value="1" <?php checked($new_tab, '1'); ?>>
                <strong><?php _e('Open in new tab?', 'human-platform'); ?></strong>
            </label>
        </div>
    </div>
    <?php
}

function human_save_cta_meta_boxes($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!isset($_POST['human_cta_meta_nonce']) || !wp_verify_nonce($_POST['human_cta_meta_nonce'], 'human_cta_meta_nonce_action')) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (get_post_type($post_id) !== 'human_cta') return;

    $fields = array('_human_cta_label', '_human_cta_supporting_text', '_human_cta_type', '_human_cta_status', '_human_cta_utm_source', '_human_cta_utm_medium', '_human_cta_utm_campaign', '_human_cta_utm_content');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
    
    // Validate relations as integers
    $relation_fields = array('_human_cta_associated_app', '_human_cta_associated_campaign');
    foreach ($relation_fields as $field) {
        if (isset($_POST[$field]) && $_POST[$field] !== '') {
            update_post_meta($post_id, $field, intval($_POST[$field]));
        } else {
            delete_post_meta($post_id, $field);
        }
    }
    
    if (isset($_POST['_human_cta_destination_url'])) {
        update_post_meta($post_id, '_human_cta_destination_url', esc_url_raw($_POST['_human_cta_destination_url']));
    }
    
    $new_tab = isset($_POST['_human_cta_new_tab']) ? '1' : '0';
    update_post_meta($post_id, '_human_cta_new_tab', $new_tab);
}
add_action('save_post_human_cta', 'human_save_cta_meta_boxes');

// Admin Columns for CTA
add_filter('manage_human_cta_posts_columns', 'human_cta_columns');
function human_cta_columns($columns) {
    $columns = array(
        'cb' => $columns['cb'],
        'title' => __('CTA Name', 'human-platform'),
        'cta_type' => __('Type', 'human-platform'),
        'product' => __('Product', 'human-platform'),
        'campaign' => __('Campaign', 'human-platform'),
        'status' => __('Status', 'human-platform'),
        'date' => $columns['date']
    );
    return $columns;
}

add_action('manage_human_cta_posts_custom_column', 'human_cta_custom_column', 10, 2);
function human_cta_custom_column($column, $post_id) {
    switch ($column) {
        case 'cta_type':
            echo esc_html(ucfirst(get_post_meta($post_id, '_human_cta_type', true)));
            break;
        case 'product':
            $app_id = get_post_meta($post_id, '_human_cta_associated_app', true);
            if ($app_id) echo esc_html(get_the_title($app_id));
            else echo '&mdash;';
            break;
        case 'campaign':
            $camp_id = get_post_meta($post_id, '_human_cta_associated_campaign', true);
            if ($camp_id) echo esc_html(get_the_title($camp_id));
            else echo '&mdash;';
            break;
        case 'status':
            $status = get_post_meta($post_id, '_human_cta_status', true);
            echo esc_html(ucfirst($status));
            break;
    }
}
