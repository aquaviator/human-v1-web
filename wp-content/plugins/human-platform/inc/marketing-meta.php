<?php
/**
 * Journal Marketing Metadata
 * 
 * Extends normal WordPress Posts with Human Marketing meta panel.
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once HUMAN_PLATFORM_PATH . 'inc/marketing-readiness.php';

function human_add_marketing_meta_boxes() {
    add_meta_box(
        'human_marketing_details_meta_box',
        __('Human Post Marketing Studio', 'human-platform'),
        'human_render_marketing_details_meta_box',
        'post',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'human_add_marketing_meta_boxes');

// Admin Styles for the Studio
function human_marketing_studio_styles() {
    ?>
    <style>
        .human-studio-container {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            background: #fff;
            padding: 20px;
            margin: -6px -12px -12px;
            color: #1e1e1e;
        }
        .human-studio-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e4e7;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .human-studio-score {
            text-align: right;
        }
        .human-studio-score h2 {
            margin: 0;
            font-size: 32px;
            line-height: 1;
            color: #1e1e1e;
        }
        .human-studio-score span {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            padding: 2px 8px;
            border-radius: 4px;
            background: #f0f0f1;
        }
        .human-studio-score span.status-ready { background: #d4edda; color: #155724; }
        .human-studio-score span.status-attention { background: #fff3cd; color: #856404; }
        .human-studio-score span.status-incomplete { background: #f8d7da; color: #721c24; }
        
        .human-studio-panels {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
        .human-studio-section {
            background: #f9f9f9;
            border: 1px solid #e2e4e7;
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .human-studio-section h3 {
            margin-top: 0;
            border-bottom: 1px solid #e2e4e7;
            padding-bottom: 10px;
            font-size: 16px;
        }
        .human-form-group {
            margin-bottom: 15px;
        }
        .human-form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .human-form-group input[type="text"],
        .human-form-group input[type="url"],
        .human-form-group textarea,
        .human-form-group select {
            width: 100%;
        }
        .human-preview-box {
            background: #fff;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 6px;
            margin-top: 10px;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        .human-preview-box.search-preview {
            max-width: 600px;
        }
        .human-preview-box.search-preview .sp-url { color: #202124; font-size: 12px; margin-bottom: 2px; }
        .human-preview-box.search-preview .sp-title { color: #1a0dab; font-size: 20px; font-weight: 400; text-decoration: none; margin: 0 0 3px; }
        .human-preview-box.search-preview .sp-desc { color: #4d5156; font-size: 14px; line-height: 1.58; }
        
        .human-warning-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .human-warning-list li {
            padding: 6px 0 6px 24px;
            position: relative;
            font-size: 13px;
        }
        .human-warning-list li.warn::before { content: "⚠️"; position: absolute; left: 0; }
        .human-warning-list li.ready::before { content: "✓"; position: absolute; left: 0; color: #46b450; }
    </style>
    <?php
}
add_action('admin_head', 'human_marketing_studio_styles');

function human_render_marketing_details_meta_box($post) {
    wp_nonce_field('human_marketing_meta_nonce_action', 'human_marketing_meta_nonce');

    $readiness = human_get_post_marketing_readiness($post->ID);
    
    // SEO Data
    $seo_title = get_post_meta($post->ID, '_human_seo_title', true);
    $seo_desc = get_post_meta($post->ID, '_human_seo_description', true);
    $seo_canonical = get_post_meta($post->ID, '_human_seo_canonical', true);
    $primary_topic = get_post_meta($post->ID, '_human_post_primary_topic', true);
    $search_intent = get_post_meta($post->ID, '_human_post_search_intent', true);

    // Social Data
    $social_title = get_post_meta($post->ID, '_human_social_title', true);
    $social_desc = get_post_meta($post->ID, '_human_social_description', true);
    $social_image = get_post_meta($post->ID, '_human_social_image', true);
    $promo_copy = get_post_meta($post->ID, '_human_promo_copy', true);
    $promo_variant_edu = get_post_meta($post->ID, '_human_promo_variant_edu', true);
    $promo_variant_qna = get_post_meta($post->ID, '_human_promo_variant_qna', true);
    $promo_variant_prob = get_post_meta($post->ID, '_human_promo_variant_prob', true);
    
    // Product & CTA
    $primary_product = get_post_meta($post->ID, '_human_post_primary_product', true);
    $related_products = get_post_meta($post->ID, '_human_post_related_products', true) ?: array();
    $primary_cta = get_post_meta($post->ID, '_human_post_primary_cta', true);
    $secondary_cta = get_post_meta($post->ID, '_human_post_secondary_cta', true);

    // Campaign
    $primary_campaign = get_post_meta($post->ID, '_human_post_primary_campaign', true);

    // Lifecycle
    $content_type = get_post_meta($post->ID, '_human_post_content_type', true);
    $marketing_status = get_post_meta($post->ID, '_human_post_marketing_status', true);
    $review_date = get_post_meta($post->ID, '_human_post_review_date', true);
    $evergreen = get_post_meta($post->ID, '_human_post_evergreen', true);

    $apps = get_posts(array('post_type' => 'human_app', 'numberposts' => -1, 'post_status' => 'publish'));
    $ctas = get_posts(array('post_type' => 'human_cta', 'numberposts' => -1, 'post_status' => 'publish'));
    $campaigns = get_posts(array('post_type' => 'human_campaign', 'numberposts' => -1, 'post_status' => 'publish'));

    $status_class = 'status-incomplete';
    if ($readiness['state'] === 'MARKETING READY') $status_class = 'status-ready';
    elseif ($readiness['state'] === 'NEEDS ATTENTION') $status_class = 'status-attention';

    ?>
    <div class="human-studio-container">
        
        <!-- HEADER: READINESS OVERVIEW -->
        <div class="human-studio-header">
            <div>
                <h2 style="margin:0 0 10px 0; font-size:24px;">Marketing Readiness Overview</h2>
                <div style="display:flex; gap:30px;">
                    <div>
                        <strong>Needs attention:</strong>
                        <ul class="human-warning-list">
                            <?php if (empty($readiness['all_warnings'])): ?>
                                <li class="ready">All requirements met</li>
                            <?php else: ?>
                                <?php foreach ($readiness['all_warnings'] as $warning): ?>
                                    <li class="warn"><?php echo esc_html($warning); ?></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div>
                        <strong>Ready:</strong>
                        <ul class="human-warning-list">
                            <?php foreach (array_slice($readiness['all_ready'], 0, 5) as $ready): ?>
                                <li class="ready"><?php echo esc_html($ready); ?></li>
                            <?php endforeach; ?>
                            <?php if (count($readiness['all_ready']) > 5): ?>
                                <li class="ready">...and <?php echo (count($readiness['all_ready']) - 5); ?> more.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="human-studio-score">
                <span class="<?php echo $status_class; ?>"><?php echo esc_html($readiness['state']); ?></span>
                <h2><?php echo esc_html($readiness['score']); ?>%</h2>
            </div>
        </div>

        <div class="human-studio-panels">
            <!-- LEFT COLUMN -->
            <div>
                <!-- SEO & SEARCH -->
                <div class="human-studio-section">
                    <h3>SEO & Search Workspace</h3>
                    <div class="human-form-group">
                        <label for="human_seo_title">SEO Title</label>
                        <input type="text" id="human_seo_title" name="_human_seo_title" value="<?php echo esc_attr($seo_title); ?>" placeholder="Optimised title for search engines">
                        <p class="description">Recommended: 50-60 characters.</p>
                    </div>
                    <div class="human-form-group">
                        <label for="human_seo_description">Meta Description</label>
                        <textarea id="human_seo_description" name="_human_seo_description" rows="2"><?php echo esc_textarea(get_post_meta($post->ID, '_human_seo_description', true)); ?></textarea>
                        <p class="description">Recommended: 150-160 characters.</p>
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                        <div class="human-form-group">
                            <label for="human_post_primary_topic">Primary Topic / Keyword</label>
                            <input type="text" id="human_post_primary_topic" name="_human_post_primary_topic" value="<?php echo esc_attr($primary_topic); ?>">
                        </div>
                        <div class="human-form-group">
                            <label for="human_post_search_intent">Search Intent</label>
                            <select id="human_post_search_intent" name="_human_post_search_intent">
                                <option value="">Select Intent...</option>
                                <option value="informational" <?php selected($search_intent, 'informational'); ?>>Informational</option>
                                <option value="commercial" <?php selected($search_intent, 'commercial'); ?>>Commercial</option>
                                <option value="transactional" <?php selected($search_intent, 'transactional'); ?>>Transactional</option>
                                <option value="navigational" <?php selected($search_intent, 'navigational'); ?>>Navigational</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="human-form-group">
                        <label>Search Preview</label>
                        <div class="human-preview-box search-preview">
                            <div class="sp-url">humanv1.com &rsaquo; journal &rsaquo; ...</div>
                            <div class="sp-title"><?php echo !empty($seo_title) ? esc_html($seo_title) : '<i>(SEO Title missing)</i>'; ?></div>
                            <div class="sp-desc"><?php echo !empty(get_post_meta($post->ID, '_human_seo_description', true)) ? esc_html(get_post_meta($post->ID, '_human_seo_description', true)) : '<i>(Meta description missing)</i>'; ?></div>
                        </div>
                    </div>
                </div>

                <!-- SOCIAL MARKETING -->
                <div class="human-studio-section">
                    <h3>Social Marketing Workspace</h3>
                    <div class="human-form-group">
                        <label for="human_social_title">Social Title</label>
                        <input type="text" id="human_social_title" name="_human_social_title" value="<?php echo esc_attr($social_title); ?>">
                    </div>
                    <div class="human-form-group">
                        <label for="human_social_description">Social Description</label>
                        <textarea id="human_social_description" name="_human_social_description" rows="2"><?php echo esc_textarea($social_desc); ?></textarea>
                    </div>
                    <div class="human-form-group">
                        <label for="human_social_image">Social Share Image URL</label>
                        <input type="url" id="human_social_image" name="_human_social_image" value="<?php echo esc_attr($social_image); ?>" placeholder="https://...">
                        <?php if (empty($social_image) && has_post_thumbnail($post->ID)): ?>
                            <p class="description" style="color:#d63638;">⚠️ Using Featured Image as fallback. A dedicated social image is recommended.</p>
                        <?php endif; ?>
                    </div>
                    <div class="human-form-group">
                        <label for="human_promo_copy">Default Promotional Copy</label>
                        <textarea id="human_promo_copy" name="_human_promo_copy" rows="2" placeholder="Copy for social networks..."><?php echo esc_textarea($promo_copy); ?></textarea>
                    </div>
                    
                    <details style="margin-bottom:15px;">
                        <summary style="font-weight:600; cursor:pointer;">Promotional Variants (Optional)</summary>
                        <div style="padding:10px 0;">
                            <div class="human-form-group">
                                <label>Educational Variant</label>
                                <textarea name="_human_promo_variant_edu" rows="2"><?php echo esc_textarea($promo_variant_edu); ?></textarea>
                            </div>
                            <div class="human-form-group">
                                <label>Problem/Solution Variant</label>
                                <textarea name="_human_promo_variant_prob" rows="2"><?php echo esc_textarea($promo_variant_prob); ?></textarea>
                            </div>
                        </div>
                    </details>
                    
                    <div class="human-form-group">
                        <label>Social Card Preview</label>
                        <div class="human-preview-box" style="padding:0; overflow:hidden;">
                            <div style="background:#f0f2f5; height:150px; display:flex; align-items:center; justify-content:center; color:#999; border-bottom:1px solid #ddd;">
                                <?php if ($social_image): ?>
                                    <img src="<?php echo esc_url($social_image); ?>" style="width:100%; height:100%; object-fit:cover;">
                                <?php elseif (has_post_thumbnail($post->ID)): ?>
                                    <img src="<?php echo get_the_post_thumbnail_url($post->ID, 'large'); ?>" style="width:100%; height:100%; object-fit:cover;">
                                <?php else: ?>
                                    [ No Image ]
                                <?php endif; ?>
                            </div>
                            <div style="padding:15px;">
                                <div style="font-size:12px; color:#65676B; margin-bottom:5px; text-transform:uppercase;">humanv1.com</div>
                                <div style="font-weight:600; font-size:16px; margin-bottom:5px;"><?php echo !empty($social_title) ? esc_html($social_title) : '<i>(Social Title missing)</i>'; ?></div>
                                <div style="color:#65676B; font-size:14px;"><?php echo !empty($social_desc) ? esc_html($social_desc) : '<i>(Social description missing)</i>'; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div>
                <!-- PRODUCT & CONVERSION -->
                <div class="human-studio-section">
                    <h3>Product & Conversion</h3>
                    <div class="human-form-group">
                        <label for="human_post_primary_product">Primary Human Product</label>
                        <select id="human_post_primary_product" name="_human_post_primary_product">
                            <option value="">Select Product...</option>
                            <?php foreach ($apps as $app) : ?>
                                <option value="<?php echo esc_attr($app->ID); ?>" <?php selected($primary_product, $app->ID); ?>><?php echo esc_html($app->post_title); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if ($primary_product): ?>
                            <p class="description">Status: <strong><?php echo esc_html(get_post_meta($primary_product, '_human_app_status', true)); ?></strong></p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="human-form-group">
                        <label for="human_post_primary_cta">Primary CTA</label>
                        <select id="human_post_primary_cta" name="_human_post_primary_cta">
                            <option value="">Select CTA...</option>
                            <?php foreach ($ctas as $cta) : ?>
                                <option value="<?php echo esc_attr($cta->ID); ?>" <?php selected($primary_cta, $cta->ID); ?>><?php echo esc_html($cta->post_title); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if ($primary_cta): ?>
                            <?php $cta_status = get_post_meta($primary_cta, '_human_cta_status', true); ?>
                            <p class="description" style="<?php echo $cta_status !== 'active' ? 'color:#d63638;font-weight:bold;' : ''; ?>">CTA Status: <strong><?php echo esc_html(strtoupper($cta_status)); ?></strong></p>
                        <?php endif; ?>
                    </div>
                    
                    <?php if ($primary_cta): ?>
                    <div class="human-form-group">
                        <label>CTA Preview</label>
                        <div class="human-preview-box" style="text-align:center;">
                            <h4 style="margin-top:0;"><?php echo esc_html(get_post_meta($primary_cta, '_human_cta_label', true) ?: get_the_title($primary_cta)); ?></h4>
                            <p style="color:#666; margin-bottom:15px;"><?php echo esc_html(get_post_meta($primary_cta, '_human_cta_supporting_text', true)); ?></p>
                            <a href="#" style="display:inline-block; background:#000; color:#fff; padding:10px 20px; text-decoration:none; border-radius:4px; font-weight:600;">
                                <?php echo esc_html(get_post_meta($primary_cta, '_human_cta_label', true) ?: 'Action'); ?>
                            </a>
                            <div style="font-size:11px; color:#999; margin-top:10px;">
                                Dest: <?php echo esc_html(get_post_meta($primary_cta, '_human_cta_destination_url', true) ?: 'None'); ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- CAMPAIGN -->
                <div class="human-studio-section">
                    <h3>Campaign Workspace</h3>
                    <div class="human-form-group">
                        <label for="human_post_primary_campaign">Associated Campaign</label>
                        <select id="human_post_primary_campaign" name="_human_post_primary_campaign">
                            <option value="">None (Evergreen / BAU)</option>
                            <?php foreach ($campaigns as $camp) : ?>
                                <option value="<?php echo esc_attr($camp->ID); ?>" <?php selected($primary_campaign, $camp->ID); ?>><?php echo esc_html($camp->post_title); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if ($primary_campaign): ?>
                            <p class="description">Campaign Status: <strong><?php echo esc_html(get_post_meta($primary_campaign, '_human_camp_status', true)); ?></strong></p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- CONTENT LIFECYCLE -->
                <div class="human-studio-section">
                    <h3>Content Lifecycle</h3>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                        <div class="human-form-group">
                            <label for="human_post_content_type">Content Type</label>
                            <select id="human_post_content_type" name="_human_post_content_type">
                                <option value="evergreen" <?php selected($content_type, 'evergreen'); ?>>Evergreen</option>
                                <option value="seasonal" <?php selected($content_type, 'seasonal'); ?>>Seasonal</option>
                                <option value="news" <?php selected($content_type, 'news'); ?>>News</option>
                                <option value="product" <?php selected($content_type, 'product'); ?>>Product</option>
                                <option value="guide" <?php selected($content_type, 'guide'); ?>>Guide</option>
                            </select>
                        </div>
                        <div class="human-form-group">
                            <label for="human_post_marketing_status">Marketing Status</label>
                            <select id="human_post_marketing_status" name="_human_post_marketing_status">
                                <option value="draft" <?php selected($marketing_status, 'draft'); ?>>Draft</option>
                                <option value="needs_review" <?php selected($marketing_status, 'needs_review'); ?>>Needs Review</option>
                                <option value="marketing_ready" <?php selected($marketing_status, 'marketing_ready'); ?>>Marketing Ready</option>
                                <option value="active" <?php selected($marketing_status, 'active'); ?>>Active</option>
                                <option value="retired" <?php selected($marketing_status, 'retired'); ?>>Retired</option>
                            </select>
                        </div>
                    </div>
                    <div class="human-form-group">
                        <label for="human_post_review_date">Next Review Date</label>
                        <input type="date" id="human_post_review_date" name="_human_post_review_date" value="<?php echo esc_attr($review_date); ?>">
                    </div>
                    <div class="human-form-group">
                        <label>
                            <input type="checkbox" name="_human_post_evergreen" value="1" <?php checked($evergreen, '1'); ?>>
                            <strong>Eligible for Evergreen Rotation</strong>
                        </label>
                        <?php if ($evergreen): ?>
                            <p class="description">Future Rotation: <span style="color:#46b450; font-weight:bold;">ELIGIBLE</span></p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- INTERNAL LINKS -->
                <div class="human-studio-section">
                    <h3>Internal Link Foundation</h3>
                    <p class="description">Suggesting related content based on category and tags to strengthen Human's content network.</p>
                    <ul style="margin:0; padding-left:20px; font-size:13px;">
                        <?php
                        $tags = wp_get_post_tags($post->ID, array('fields' => 'ids'));
                        $cats = wp_get_post_categories($post->ID);
                        $args = array(
                            'post_type' => 'post',
                            'post__not_in' => array($post->ID),
                            'posts_per_page' => 3,
                            'category__in' => $cats,
                        );
                        $related_posts = get_posts($args);
                        if ($related_posts) {
                            foreach ($related_posts as $rp) {
                                echo '<li><a href="' . esc_url(get_edit_post_link($rp->ID)) . '">' . esc_html($rp->post_title) . '</a></li>';
                            }
                        } else {
                            echo '<li>No related content found.</li>';
                        }
                        ?>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
    <?php
}

function human_save_marketing_meta_boxes($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!isset($_POST['human_marketing_meta_nonce']) || !wp_verify_nonce($_POST['human_marketing_meta_nonce'], 'human_marketing_meta_nonce_action')) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (get_post_type($post_id) !== 'post') return;

    // Single fields
    $fields = array(
        '_human_seo_title',
        '_human_seo_description',
        '_human_post_primary_topic',
        '_human_post_search_intent',
        '_human_social_title',
        '_human_social_description',
        '_human_social_image',
        '_human_promo_copy',
        '_human_promo_variant_edu',
        '_human_promo_variant_prob',
        '_human_post_content_type',
        '_human_post_marketing_status',
        '_human_post_review_date'
    );
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
    
    // Relation fields
    $relation_fields = array(
        '_human_post_primary_product',
        '_human_post_primary_cta',
        '_human_post_primary_campaign'
    );
    foreach ($relation_fields as $field) {
        if (isset($_POST[$field]) && $_POST[$field] !== '') {
            update_post_meta($post_id, $field, intval($_POST[$field]));
        } else {
            delete_post_meta($post_id, $field);
        }
    }

    // Checkboxes
    $evergreen = isset($_POST['_human_post_evergreen']) ? '1' : '0';
    update_post_meta($post_id, '_human_post_evergreen', $evergreen);
}
add_action('save_post_post', 'human_save_marketing_meta_boxes');
