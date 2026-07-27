<?php
/**
 * Custom Post Type: Human Campaigns
 * 
 * Registers the 'human_campaign' CPT.
 */

if (!defined('ABSPATH')) {
    exit;
}

function human_register_campaign_cpt() {
    $labels = array(
        'name'               => _x('Campaigns', 'post type general name', 'human-platform'),
        'singular_name'      => _x('Campaign', 'post type singular name', 'human-platform'),
        'menu_name'          => _x('Campaigns', 'admin menu', 'human-platform'),
        'name_admin_bar'     => _x('Campaign', 'add new on admin bar', 'human-platform'),
        'add_new'            => _x('Add New Campaign', 'campaign', 'human-platform'),
        'add_new_item'       => __('Add New Campaign', 'human-platform'),
        'new_item'           => __('New Campaign', 'human-platform'),
        'edit_item'          => __('Edit Campaign', 'human-platform'),
        'view_item'          => __('View Campaign', 'human-platform'),
        'all_items'          => __('All Campaigns', 'human-platform'),
        'search_items'       => __('Search Campaigns', 'human-platform'),
        'not_found'          => __('No campaigns found.', 'human-platform'),
        'not_found_in_trash' => __('No campaigns found in Trash.', 'human-platform')
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
        'supports'           => array('title', 'editor'),
        'show_in_rest'       => true,
    );

    register_post_type('human_campaign', $args);
}
add_action('init', 'human_register_campaign_cpt');

// Add Meta Boxes for Campaign
function human_add_campaign_meta_boxes() {
    add_meta_box(
        'human_campaign_details_meta_box',
        __('Campaign Details', 'human-platform'),
        'human_render_campaign_details_meta_box',
        'human_campaign',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'human_add_campaign_meta_boxes');

function human_render_campaign_details_meta_box($post) {
    wp_nonce_field('human_campaign_meta_nonce_action', 'human_campaign_meta_nonce');

    $objective = get_post_meta($post->ID, '_human_camp_objective', true);
    $associated_app = get_post_meta($post->ID, '_human_camp_associated_app', true);
    $start_date = get_post_meta($post->ID, '_human_camp_start_date', true);
    $end_date = get_post_meta($post->ID, '_human_camp_end_date', true);
    $status = get_post_meta($post->ID, '_human_camp_status', true);
    $primary_cta = get_post_meta($post->ID, '_human_camp_primary_cta', true);
    $utm_id = get_post_meta($post->ID, '_human_camp_utm_id', true);
    $priority = get_post_meta($post->ID, '_human_camp_priority', true);

    $apps = get_posts(array('post_type' => 'human_app', 'numberposts' => -1, 'post_status' => 'publish'));
    $ctas = get_posts(array('post_type' => 'human_cta', 'numberposts' => -1, 'post_status' => 'publish'));
    ?>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:15px;padding:10px 0;">
        <div>
            <label for="human_camp_status"><strong><?php _e('Status', 'human-platform'); ?></strong></label>
            <select id="human_camp_status" name="_human_camp_status" class="widefat">
                <option value="draft" <?php selected($status, 'draft'); ?>>Draft</option>
                <option value="planned" <?php selected($status, 'planned'); ?>>Planned</option>
                <option value="active" <?php selected($status, 'active'); ?>>Active</option>
                <option value="paused" <?php selected($status, 'paused'); ?>>Paused</option>
                <option value="completed" <?php selected($status, 'completed'); ?>>Completed</option>
                <option value="archived" <?php selected($status, 'archived'); ?>>Archived</option>
            </select>
        </div>
        <div>
            <label for="human_camp_priority"><strong><?php _e('Priority', 'human-platform'); ?></strong></label>
            <select id="human_camp_priority" name="_human_camp_priority" class="widefat">
                <option value="low" <?php selected($priority, 'low'); ?>>Low</option>
                <option value="normal" <?php selected($priority, 'normal'); ?>>Normal</option>
                <option value="high" <?php selected($priority, 'high'); ?>>High</option>
            </select>
        </div>
        <div>
            <label for="human_camp_objective"><strong><?php _e('Campaign Objective', 'human-platform'); ?></strong></label>
            <input type="text" id="human_camp_objective" name="_human_camp_objective" value="<?php echo esc_attr($objective); ?>" class="widefat">
        </div>
        <div>
            <label for="human_camp_utm_id"><strong><?php _e('Campaign UTM Identifier', 'human-platform'); ?></strong></label>
            <input type="text" id="human_camp_utm_id" name="_human_camp_utm_id" value="<?php echo esc_attr($utm_id); ?>" class="widefat" placeholder="e.g. spring_launch_26">
        </div>
        <div>
            <label for="human_camp_start_date"><strong><?php _e('Start Date', 'human-platform'); ?></strong></label>
            <input type="date" id="human_camp_start_date" name="_human_camp_start_date" value="<?php echo esc_attr($start_date); ?>" class="widefat">
        </div>
        <div>
            <label for="human_camp_end_date"><strong><?php _e('End Date', 'human-platform'); ?></strong></label>
            <input type="date" id="human_camp_end_date" name="_human_camp_end_date" value="<?php echo esc_attr($end_date); ?>" class="widefat">
        </div>
        <div>
            <label for="human_camp_associated_app"><strong><?php _e('Associated Human App', 'human-platform'); ?></strong></label>
            <select id="human_camp_associated_app" name="_human_camp_associated_app" class="widefat">
                <option value=""><?php _e('None', 'human-platform'); ?></option>
                <?php foreach ($apps as $app) : ?>
                    <option value="<?php echo esc_attr($app->ID); ?>" <?php selected($associated_app, $app->ID); ?>><?php echo esc_html($app->post_title); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="human_camp_primary_cta"><strong><?php _e('Primary CTA', 'human-platform'); ?></strong></label>
            <select id="human_camp_primary_cta" name="_human_camp_primary_cta" class="widefat">
                <option value=""><?php _e('None', 'human-platform'); ?></option>
                <?php foreach ($ctas as $cta) : ?>
                    <option value="<?php echo esc_attr($cta->ID); ?>" <?php selected($primary_cta, $cta->ID); ?>><?php echo esc_html($cta->post_title); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <?php
}

function human_save_campaign_meta_boxes($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!isset($_POST['human_campaign_meta_nonce']) || !wp_verify_nonce($_POST['human_campaign_meta_nonce'], 'human_campaign_meta_nonce_action')) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (get_post_type($post_id) !== 'human_campaign') return;

    $fields = array('_human_camp_objective', '_human_camp_start_date', '_human_camp_end_date', '_human_camp_status', '_human_camp_utm_id', '_human_camp_priority');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
    
    // Validate relations as integers
    $relation_fields = array('_human_camp_associated_app', '_human_camp_primary_cta');
    foreach ($relation_fields as $field) {
        if (isset($_POST[$field]) && $_POST[$field] !== '') {
            update_post_meta($post_id, $field, intval($_POST[$field]));
        } else {
            delete_post_meta($post_id, $field);
        }
    }
}
add_action('save_post_human_campaign', 'human_save_campaign_meta_boxes');

// Admin Columns for Campaign
add_filter('manage_human_campaign_posts_columns', 'human_campaign_columns');
function human_campaign_columns($columns) {
    $columns = array(
        'cb' => $columns['cb'],
        'title' => __('Campaign Name', 'human-platform'),
        'product' => __('Product', 'human-platform'),
        'status' => __('Status', 'human-platform'),
        'start' => __('Start Date', 'human-platform'),
        'end' => __('End Date', 'human-platform'),
        'cta' => __('CTA', 'human-platform'),
        'date' => $columns['date']
    );
    return $columns;
}

add_action('manage_human_campaign_posts_custom_column', 'human_campaign_custom_column', 10, 2);
function human_campaign_custom_column($column, $post_id) {
    switch ($column) {
        case 'product':
            $app_id = get_post_meta($post_id, '_human_camp_associated_app', true);
            if ($app_id) echo esc_html(get_the_title($app_id));
            else echo '&mdash;';
            break;
        case 'status':
            $status = get_post_meta($post_id, '_human_camp_status', true);
            echo esc_html(ucfirst($status));
            break;
        case 'start':
            $start = get_post_meta($post_id, '_human_camp_start_date', true);
            echo esc_html($start ?: '&mdash;');
            break;
        case 'end':
            $end = get_post_meta($post_id, '_human_camp_end_date', true);
            echo esc_html($end ?: '&mdash;');
            break;
        case 'cta':
            $cta_id = get_post_meta($post_id, '_human_camp_primary_cta', true);
            if ($cta_id) echo esc_html(get_the_title($cta_id));
            else echo '&mdash;';
            break;
    }
}
