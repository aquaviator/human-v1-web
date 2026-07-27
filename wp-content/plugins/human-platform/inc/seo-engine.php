<?php
/**
 * SEO & Open Graph Meta Engine for Human Platform
 * 
 * Computes intelligent SEO titles, descriptions, canonical URLs,
 * Open Graph, Twitter Cards, and JSON-LD Structured Data.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get resolved SEO and Social Data for current view or post
 */
function human_get_seo_metadata($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $domain = human_get_option('canonical_domain', 'https://humanv1.com');
    $brand_name = human_get_option('brand_name', 'Human V1');
    $default_title = human_get_option('default_seo_title', 'Human V1 — Performance Technology Platform | Train. Track. Transform.');
    $default_desc = human_get_option('default_meta_description', 'A performance technology platform connecting strength training, volume analytics, and movement science into a unified ecosystem. Starting with Human Strength for Android.');
    $default_social_img = human_get_option('default_social_image', get_template_directory_uri() . '/assets/human-og-share.png');

    $seo_data = array(
        'title'             => $default_title,
        'description'       => $default_desc,
        'canonical_url'     => rtrim($domain, '/') . $_SERVER['REQUEST_URI'],
        'og_type'           => 'website',
        'og_title'          => $default_title,
        'og_description'    => $default_desc,
        'og_image'          => $default_social_img,
        'og_image_width'    => '1200',
        'og_image_height'   => '630',
        'og_image_alt'      => 'Human V1 Performance Technology Platform — Train. Track. Transform.',
        'site_name'         => 'Human',
        'twitter_card'      => 'summary_large_image',
        'twitter_title'     => $default_title,
        'twitter_description'=> $default_desc,
        'twitter_image'     => $default_social_img,
        'json_ld'           => array()
    );

    // Front page check
    if (is_front_page() || is_home() && is_front_page()) {
        $seo_data['title'] = 'Human V1 — Performance Technology Platform | Train. Track. Transform.';
        $seo_data['description'] = 'Human is a performance technology platform connecting physical disciplines. Discover Human Strength, the offline-first strength training app with Room local database for Android.';
        $seo_data['og_title'] = $seo_data['title'];
        $seo_data['og_description'] = $seo_data['description'];
        $seo_data['canonical_url'] = rtrim($domain, '/') . '/';
        $seo_data['json_ld'][] = human_get_organization_schema();
        $seo_data['json_ld'][] = human_get_website_schema();
        return $seo_data;
    }

    // Single post or page or CPT
    if (is_singular() && $post_id) {
        $post = get_post($post_id);
        
        $custom_title = get_post_meta($post_id, '_human_seo_title', true);
        $custom_desc  = get_post_meta($post_id, '_human_seo_description', true);
        $custom_canon = get_post_meta($post_id, '_human_canonical_url', true);
        $custom_stitle= get_post_meta($post_id, '_human_social_title', true);
        $custom_sdesc = get_post_meta($post_id, '_human_social_description', true);
        $custom_simg  = get_post_meta($post_id, '_human_social_image', true);

        // Title fallback
        if (!empty($custom_title)) {
            $seo_data['title'] = $custom_title;
        } else {
            $seo_data['title'] = get_the_title($post_id) . ' — ' . $brand_name;
        }

        // Description fallback
        if (!empty($custom_desc)) {
            $seo_data['description'] = $custom_desc;
        } elseif (has_excerpt($post_id)) {
            $seo_data['description'] = wp_strip_all_tags(get_the_excerpt($post_id));
        } else {
            $excerpt_text = wp_trim_words(wp_strip_all_tags($post->post_content), 28, '...');
            $seo_data['description'] = !empty($excerpt_text) ? $excerpt_text : $default_desc;
        }

        // Canonical URL
        if (!empty($custom_canon)) {
            $seo_data['canonical_url'] = $custom_canon;
        } else {
            $seo_data['canonical_url'] = get_permalink($post_id);
        }

        // Image Fallback Hierarchy: explicit_social -> featured_image -> brand_default
        if (!empty($custom_simg)) {
            $seo_data['og_image'] = $custom_simg;
        } elseif (has_post_thumbnail($post_id)) {
            $thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
            if ($thumb_url) {
                $seo_data['og_image'] = $thumb_url[0];
            }
        }

        // Open Graph & Twitter mapping
        $seo_data['og_title'] = !empty($custom_stitle) ? $custom_stitle : $seo_data['title'];
        $seo_data['og_description'] = !empty($custom_sdesc) ? $custom_sdesc : $seo_data['description'];
        $seo_data['twitter_title'] = $seo_data['og_title'];
        $seo_data['twitter_description'] = $seo_data['og_description'];
        $seo_data['twitter_image'] = $seo_data['og_image'];

        if (is_single()) {
            $seo_data['og_type'] = 'article';
            $seo_data['json_ld'][] = human_get_article_schema($post_id);
        } else {
            $seo_data['json_ld'][] = human_get_webpage_schema($post_id);
        }

        $breadcrumb_schema = human_get_breadcrumb_schema();
        if ($breadcrumb_schema) {
            $seo_data['json_ld'][] = $breadcrumb_schema;
        }

        // Special handling for Human Strength page
        if (is_page('strength') || get_post_field('post_name', $post_id) === 'strength') {
            $seo_data['title'] = 'Human Strength — Android Gym Workout Tracker & Volume Analytics App';
            $seo_data['description'] = 'Track strength progress offline with Human Strength for Android. Features local Room database, estimated 1RM, supersets, and tonnage volume analytics. £24/yr after ~30-day trial.';
            $seo_data['og_title'] = $seo_data['title'];
            $seo_data['og_description'] = $seo_data['description'];
            $seo_data['json_ld'][] = human_get_software_app_schema();
        }

        return $seo_data;
    }

    // Journal Archive Page
    if (is_home()) {
        $seo_data['title'] = 'Human Journal — Performance Science, Product Engineering & Training Insights';
        $seo_data['description'] = 'Articles, product engineering updates, performance science, and training insights from the Human engineering and research team.';
        $seo_data['og_title'] = $seo_data['title'];
        $seo_data['og_description'] = $seo_data['description'];
        $seo_data['canonical_url'] = rtrim($domain, '/') . '/journal';
    } elseif (is_category()) {
        $cat = get_category(get_query_var('cat'));
        $seo_data['title'] = $cat->name . ' — Human Journal';
        $seo_data['description'] = wp_strip_all_tags(category_description($cat->term_id));
        if (empty($seo_data['description'])) {
            $seo_data['description'] = 'Read articles about ' . $cat->name . ' from the Human engineering and research team.';
        }
        $seo_data['og_title'] = $seo_data['title'];
        $seo_data['og_description'] = $seo_data['description'];
        $seo_data['canonical_url'] = get_category_link($cat->term_id);
    }
    
    $breadcrumb_schema = human_get_breadcrumb_schema();
    if ($breadcrumb_schema) {
        $seo_data['json_ld'][] = $breadcrumb_schema;
    }

    return $seo_data;
}

/**
 * Output SEO and Open Graph Meta Tags in wp_head
 */
function human_output_seo_meta_tags() {
    $meta = human_get_seo_metadata();
    ?>
    <!-- Human Platform SEO Engine -->
    <meta name="description" content="<?php echo esc_attr($meta['description']); ?>">
    <link rel="canonical" href="<?php echo esc_url($meta['canonical_url']); ?>">

    <!-- Open Graph Protocol -->
    <meta property="og:type" content="<?php echo esc_attr($meta['og_type']); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr($meta['site_name']); ?>">
    <meta property="og:title" content="<?php echo esc_attr($meta['og_title']); ?>">
    <meta property="og:description" content="<?php echo esc_attr($meta['og_description']); ?>">
    <meta property="og:url" content="<?php echo esc_url($meta['canonical_url']); ?>">
    <meta property="og:image" content="<?php echo esc_url($meta['og_image']); ?>">
    <meta property="og:image:width" content="<?php echo esc_attr($meta['og_image_width']); ?>">
    <meta property="og:image:height" content="<?php echo esc_attr($meta['og_image_height']); ?>">
    <meta property="og:image:alt" content="<?php echo esc_attr($meta['og_image_alt']); ?>">

    <!-- Twitter / X Card Metadata -->
    <meta name="twitter:card" content="<?php echo esc_attr($meta['twitter_card']); ?>">
    <meta name="twitter:title" content="<?php echo esc_attr($meta['twitter_title']); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($meta['twitter_description']); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($meta['twitter_image']); ?>">

    <!-- JSON-LD Structured Data -->
    <?php if (!empty($meta['json_ld'])) : ?>
        <?php foreach ($meta['json_ld'] as $schema) : ?>
            <script type="application/ld+json">
                <?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
            </script>
        <?php endforeach; ?>
    <?php endif; ?>
    <!-- End Human Platform SEO Engine -->
    <?php
}
add_action('wp_head', 'human_output_seo_meta_tags', 1);

/**
 * Schema Generators
 */
function human_get_organization_schema() {
    $domain = human_get_option('canonical_domain', 'https://humanv1.com');
    return array(
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => human_get_option('brand_name', 'Human V1'),
        'url' => $domain,
        'logo' => get_template_directory_uri() . '/assets/human_logo_master.svg',
        'email' => human_get_option('support_email', 'support@humanv1.com'),
        'sameAs' => array_filter(array(
            human_get_option('facebook_url'),
            human_get_option('instagram_url'),
            human_get_option('linkedin_url'),
            human_get_option('x_twitter_url')
        ))
    );
}

function human_get_website_schema() {
    $domain = human_get_option('canonical_domain', 'https://humanv1.com');
    return array(
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => 'Human Platform',
        'url' => $domain,
        'potentialAction' => array(
            '@type' => 'SearchAction',
            'target' => rtrim($domain, '/') . '/?s={search_term_string}',
            'query-input' => 'required name=search_term_string'
        )
    );
}

function human_get_article_schema($post_id) {
    $post = get_post($post_id);
    $domain = human_get_option('canonical_domain', 'https://humanv1.com');
    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
    $image_url = $thumb ? $thumb[0] : human_get_option('default_social_image', get_template_directory_uri() . '/assets/human-og-share.png');

    return array(
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => get_the_title($post_id),
        'description' => wp_strip_all_tags(get_the_excerpt($post_id)),
        'image' => $image_url,
        'datePublished' => get_the_date('c', $post_id),
        'dateModified' => get_the_modified_date('c', $post_id),
        'author' => array(
            '@type' => 'Organization',
            'name' => 'Human Editorial & Research Team',
            'url' => $domain
        ),
        'publisher' => human_get_organization_schema(),
        'mainEntityOfPage' => array(
            '@type' => 'WebPage',
            '@id' => get_permalink($post_id)
        )
    );
}

function human_get_webpage_schema($post_id) {
    return array(
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        'name' => get_the_title($post_id),
        'url' => get_permalink($post_id),
        'description' => wp_strip_all_tags(get_the_excerpt($post_id))
    );
}

function human_get_software_app_schema() {
    return array(
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => 'Human Strength',
        'operatingSystem' => 'Android 8.0+',
        'applicationCategory' => 'HealthApplication',
        'offers' => array(
            '@type' => 'Offer',
            'price' => '24.00',
            'priceCurrency' => 'GBP',
            'priceValidUntil' => '2027-12-31',
            'description' => 'Annual subscription includes ~30-day introductory trial.'
        ),
        'downloadUrl' => 'https://play.google.com/store/apps/details?id=com.aistudio.humanstrength.kfqjza'
    );
}

function human_get_breadcrumb_schema() {
    if (!function_exists('human_get_breadcrumbs')) return null;
    $breadcrumbs = human_get_breadcrumbs();
    if (empty($breadcrumbs) || count($breadcrumbs) <= 1) return null;

    $items = array();
    foreach ($breadcrumbs as $index => $crumb) {
        $items[] = array(
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => $crumb['title'],
            'item' => $crumb['url']
        );
    }

    return array(
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $items
    );
}
