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
    $is_sample = get_post_meta($post->ID, '_human_is_sample', true) === '1';
    $approval_state = get_post_meta($post->ID, '_human_camp_approval_state', true) ?: 'draft';
    $automation_eligible = get_post_meta($post->ID, '_human_camp_automation_eligible', true) === '1';
    $target_url = get_post_meta($post->ID, '_human_camp_target_url', true);
    $utm_source = get_post_meta($post->ID, '_human_camp_utm_source', true);
    $utm_medium = get_post_meta($post->ID, '_human_camp_utm_medium', true);
    $utm_campaign = get_post_meta($post->ID, '_human_camp_utm_campaign', true);
    $facebook_copy = get_post_meta($post->ID, '_human_camp_facebook_copy', true);
    $instagram_copy = get_post_meta($post->ID, '_human_camp_instagram_copy', true);

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
        <div>
            <label for="human_camp_approval_state"><strong><?php _e('Approval State', 'human-platform'); ?></strong></label>
            <select id="human_camp_approval_state" name="_human_camp_approval_state" class="widefat">
                <option value="draft" <?php selected($approval_state, 'draft'); ?>>Draft</option>
                <option value="in_review" <?php selected($approval_state, 'in_review'); ?>>In Review</option>
                <option value="approved" <?php selected($approval_state, 'approved'); ?>>Approved</option>
            </select>
        </div>
        <div>
            <label for="human_camp_target_url"><strong><?php _e('Target URL', 'human-platform'); ?></strong></label>
            <input type="text" id="human_camp_target_url" name="_human_camp_target_url" value="<?php echo esc_attr($target_url); ?>" class="widefat" placeholder="/strength/">
        </div>
        <div>
            <label for="human_camp_utm_source"><strong><?php _e('UTM Source', 'human-platform'); ?></strong></label>
            <input type="text" id="human_camp_utm_source" name="_human_camp_utm_source" value="<?php echo esc_attr($utm_source); ?>" class="widefat" placeholder="facebook">
        </div>
        <div>
            <label for="human_camp_utm_medium"><strong><?php _e('UTM Medium', 'human-platform'); ?></strong></label>
            <input type="text" id="human_camp_utm_medium" name="_human_camp_utm_medium" value="<?php echo esc_attr($utm_medium); ?>" class="widefat" placeholder="social">
        </div>
        <div>
            <label for="human_camp_utm_campaign"><strong><?php _e('UTM Campaign', 'human-platform'); ?></strong></label>
            <input type="text" id="human_camp_utm_campaign" name="_human_camp_utm_campaign" value="<?php echo esc_attr($utm_campaign); ?>" class="widefat" placeholder="human_strength_internal_testing">
        </div>
        <div style="grid-column:1 / -1;">
            <label for="human_camp_facebook_copy"><strong><?php _e('Facebook Reference Copy', 'human-platform'); ?></strong></label>
            <textarea id="human_camp_facebook_copy" name="_human_camp_facebook_copy" rows="3" class="widefat"><?php echo esc_textarea($facebook_copy); ?></textarea>
        </div>
        <div style="grid-column:1 / -1;">
            <label for="human_camp_instagram_copy"><strong><?php _e('Instagram Reference Copy', 'human-platform'); ?></strong></label>
            <textarea id="human_camp_instagram_copy" name="_human_camp_instagram_copy" rows="3" class="widefat"><?php echo esc_textarea($instagram_copy); ?></textarea>
        </div>
        <div style="grid-column:1 / -1;display:flex;gap:2rem;align-items:center;padding-top:8px;">
            <label>
                <input type="checkbox" name="_human_is_sample" value="1" <?php checked($is_sample); ?>>
                <strong><?php _e('Sample / reference Campaign', 'human-platform'); ?></strong>
            </label>
            <label>
                <input type="checkbox" name="_human_camp_automation_eligible" value="1" <?php checked($automation_eligible); ?> <?php disabled($is_sample); ?>>
                <strong><?php _e('Automation eligible', 'human-platform'); ?></strong>
            </label>
        </div>
        <?php if ($is_sample): ?>
            <p style="grid-column:1 / -1;margin:0;color:#646970;">
                <?php _e('Sample Campaigns are always forced to draft approval and automation eligible = No when saved.', 'human-platform'); ?>
            </p>
        <?php endif; ?>
        <?php if (function_exists('human_get_campaign_readiness')): $campaign_readiness = human_get_campaign_readiness($post->ID); ?>
            <div style="grid-column:1 / -1;padding:12px;border:1px solid #dcdcde;background:#fff;">
                <strong><?php echo !empty($campaign_readiness['ready_for_automation']) ? 'Automation Readiness: READY' : 'Automation Readiness: BLOCKED'; ?></strong>
                <?php if (!empty($campaign_readiness['blocker_messages'])): ?>
                    <ul style="margin-bottom:0;">
                        <?php foreach ($campaign_readiness['blocker_messages'] as $message): ?>
                            <li><?php echo esc_html($message); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <?php
}

function human_save_campaign_meta_boxes($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!isset($_POST['human_campaign_meta_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['human_campaign_meta_nonce'])), 'human_campaign_meta_nonce_action')) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (get_post_type($post_id) !== 'human_campaign') return;

    $allowed_statuses = array('draft', 'planned', 'active', 'paused', 'completed', 'archived');
    $allowed_priorities = array('low', 'normal', 'high');
    $allowed_approval_states = array('draft', 'in_review', 'approved');

    $single_line_fields = array(
        '_human_camp_objective',
        '_human_camp_utm_id',
        '_human_camp_target_url',
        '_human_camp_utm_source',
        '_human_camp_utm_medium',
        '_human_camp_utm_campaign',
    );
    foreach ($single_line_fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field(wp_unslash($_POST[$field])));
        }
    }

    foreach (array('_human_camp_facebook_copy', '_human_camp_instagram_copy') as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_textarea_field(wp_unslash($_POST[$field])));
        }
    }

    foreach (array('_human_camp_start_date', '_human_camp_end_date') as $field) {
        if (!isset($_POST[$field])) {
            continue;
        }
        $date = sanitize_text_field(wp_unslash($_POST[$field]));
        if ($date === '') {
            update_post_meta($post_id, $field, '');
            continue;
        }
        $parsed = DateTime::createFromFormat('!Y-m-d', $date);
        if ($parsed && $parsed->format('Y-m-d') === $date) {
            update_post_meta($post_id, $field, $date);
        }
    }

    if (isset($_POST['_human_camp_status'])) {
        $status = sanitize_key(wp_unslash($_POST['_human_camp_status']));
        if (in_array($status, $allowed_statuses, true)) {
            update_post_meta($post_id, '_human_camp_status', $status);
        }
    }

    if (isset($_POST['_human_camp_priority'])) {
        $priority = sanitize_key(wp_unslash($_POST['_human_camp_priority']));
        if (in_array($priority, $allowed_priorities, true)) {
            update_post_meta($post_id, '_human_camp_priority', $priority);
        }
    }

    $approval_state = isset($_POST['_human_camp_approval_state'])
        ? sanitize_key(wp_unslash($_POST['_human_camp_approval_state']))
        : 'draft';
    if (!in_array($approval_state, $allowed_approval_states, true)) {
        $approval_state = 'draft';
    }

    $is_sample = isset($_POST['_human_is_sample']) ? '1' : '0';
    $automation_eligible = isset($_POST['_human_camp_automation_eligible']) ? '1' : '0';

    if ($is_sample === '1') {
        $approval_state = 'draft';
        $automation_eligible = '0';
    }
    if ($approval_state !== 'approved') {
        $automation_eligible = '0';
    }

    update_post_meta($post_id, '_human_is_sample', $is_sample);
    update_post_meta($post_id, '_human_camp_approval_state', $approval_state);
    update_post_meta($post_id, '_human_camp_automation_eligible', $automation_eligible);

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
        'sample' => __('Sample', 'human-platform'),
        'approval' => __('Approval', 'human-platform'),
        'automation' => __('Automation', 'human-platform'),
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
        case 'sample':
            echo get_post_meta($post_id, '_human_is_sample', true) === '1' ? 'Yes' : 'No';
            break;
        case 'approval':
            echo esc_html(ucwords(str_replace('_', ' ', (string) get_post_meta($post_id, '_human_camp_approval_state', true))));
            break;
        case 'automation':
            echo get_post_meta($post_id, '_human_camp_automation_eligible', true) === '1' ? 'Eligible' : 'Blocked';
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
