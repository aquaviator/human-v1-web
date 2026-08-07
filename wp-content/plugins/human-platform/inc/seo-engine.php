<?php
/**
 * SEO & Open Graph Meta Engine for Human Platform
 *
 * Resolves truthful SEO titles, descriptions, canonical URLs, Open Graph,
 * Twitter Cards, and JSON-LD structured data for HumanV1.com.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Build a canonical URL from the canonical domain and request path only.
 * Query strings and fragments are deliberately excluded.
 */
function human_get_request_canonical_url($domain) {
    $domain = rtrim((string) $domain, '/');
    $request_uri = isset($_SERVER['REQUEST_URI']) && is_scalar($_SERVER['REQUEST_URI'])
        ? wp_unslash((string) $_SERVER['REQUEST_URI'])
        : '/';
    $path = wp_parse_url($request_uri, PHP_URL_PATH);
    $path = is_string($path) && $path !== '' ? $path : '/';

    return $domain . '/' . ltrim($path, '/');
}

/**
 * Accept a custom canonical only when it is an HTTPS URL on the configured
 * canonical host. This prevents editor mistakes from advertising another site
 * as authoritative for Human V1 content.
 */
function human_validate_canonical_url($url, $domain) {
    if (!is_string($url) || trim($url) === '') {
        return '';
    }

    $url = esc_url_raw(trim($url), array('https'));
    if ($url === '') {
        return '';
    }

    $candidate = wp_parse_url($url);
    $canonical = wp_parse_url($domain);
    if (!is_array($candidate) || !is_array($canonical)) {
        return '';
    }

    if (strtolower($candidate['scheme'] ?? '') !== 'https'
        || strtolower($candidate['host'] ?? '') !== strtolower($canonical['host'] ?? '')
        || isset($candidate['user'])
        || isset($candidate['pass'])
    ) {
        return '';
    }

    $path = isset($candidate['path']) && is_string($candidate['path']) ? $candidate['path'] : '/';
    return rtrim((string) $domain, '/') . '/' . ltrim($path, '/');
}

/**
 * Resolve a concise description for a post without inventing editorial claims.
 */
function human_get_post_description($post_id, $fallback = '') {
    $custom_desc = get_post_meta($post_id, '_human_seo_description', true);
    if (is_string($custom_desc) && trim($custom_desc) !== '') {
        return trim(wp_strip_all_tags($custom_desc));
    }

    if (has_excerpt($post_id)) {
        return trim(wp_strip_all_tags(get_the_excerpt($post_id)));
    }

    $post = get_post($post_id);
    if ($post instanceof WP_Post) {
        $excerpt_text = wp_trim_words(wp_strip_all_tags($post->post_content), 28, '…');
        if (trim($excerpt_text) !== '') {
            return trim($excerpt_text);
        }
    }

    return (string) $fallback;
}

/**
 * Get resolved SEO and Social Data for current view or post.
 */
function human_get_seo_metadata($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $domain = human_get_option('canonical_domain', 'https://humanv1.com');
    $brand_name = human_get_option('brand_name', 'Human V1');

    $default_title = human_get_option('default_seo_title', 'Human V1 | Be the best version of you');
    $legacy_titles = array(
        'Human V1 — Performance Technology Platform | Train. Track. Transform.',
    );
    if (in_array($default_title, $legacy_titles, true)) {
        $default_title = 'Human V1 | Be the best version of you';
    }

    $default_desc = human_get_option(
        'default_meta_description',
        'Human V1 is the platform behind Human Strength and future Human applications. Human Strength is currently in Google Play Internal Testing.'
    );
    $legacy_descriptions = array(
        'A performance technology platform connecting strength training, volume analytics, and movement science into a unified ecosystem. Starting with Human Strength for Android.',
    );
    if (in_array($default_desc, $legacy_descriptions, true)) {
        $default_desc = 'Human V1 is the platform behind Human Strength and future Human applications. Human Strength is currently in Google Play Internal Testing.';
    }

    $default_social_img = human_get_option(
        'default_social_image',
        get_template_directory_uri() . '/assets/human-og-share.png'
    );

    $seo_data = array(
        'title'               => $default_title,
        'description'         => $default_desc,
        'canonical_url'       => human_get_request_canonical_url($domain),
        'robots'              => 'index,follow,max-image-preview:large',
        'og_type'             => 'website',
        'og_title'            => $default_title,
        'og_description'      => $default_desc,
        'og_image'            => $default_social_img,
        'og_image_width'      => '1200',
        'og_image_height'     => '630',
        'og_image_alt'        => 'Human V1 — Be the best version of you',
        'site_name'           => 'Human V1',
        'twitter_card'        => 'summary_large_image',
        'twitter_title'       => $default_title,
        'twitter_description' => $default_desc,
        'twitter_image'       => $default_social_img,
        'json_ld'             => array(),
    );

    if (is_front_page()) {
        $seo_data['title'] = 'Human V1 | Human Strength and Future Human Apps';
        $seo_data['description'] = 'Human V1 is the platform behind Human Strength and future Human applications. Human Strength is currently in Google Play Internal Testing.';
        $seo_data['og_title'] = $seo_data['title'];
        $seo_data['og_description'] = $seo_data['description'];
        $seo_data['twitter_title'] = $seo_data['title'];
        $seo_data['twitter_description'] = $seo_data['description'];
        $seo_data['canonical_url'] = rtrim($domain, '/') . '/';
        $seo_data['json_ld'][] = human_get_website_schema();
        return $seo_data;
    }

    if (is_singular() && $post_id) {
        $post = get_post($post_id);
        if (!($post instanceof WP_Post)) {
            return $seo_data;
        }

        $custom_title = get_post_meta($post_id, '_human_seo_title', true);
        $custom_canon = get_post_meta($post_id, '_human_canonical_url', true);
        $custom_stitle = get_post_meta($post_id, '_human_social_title', true);
        $custom_sdesc = get_post_meta($post_id, '_human_social_description', true);
        $custom_simg = get_post_meta($post_id, '_human_social_image', true);

        $seo_data['title'] = is_string($custom_title) && trim($custom_title) !== ''
            ? trim($custom_title)
            : get_the_title($post_id) . ' | ' . $brand_name;
        $seo_data['description'] = human_get_post_description($post_id, $default_desc);

        $validated_canonical = human_validate_canonical_url((string) $custom_canon, $domain);
        $seo_data['canonical_url'] = $validated_canonical !== '' ? $validated_canonical : get_permalink($post_id);

        if (is_string($custom_simg) && trim($custom_simg) !== '') {
            $seo_data['og_image'] = esc_url_raw($custom_simg);
        } elseif (has_post_thumbnail($post_id)) {
            $thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
            if ($thumb_url) {
                $seo_data['og_image'] = $thumb_url[0];
            }
        }

        $seo_data['og_title'] = is_string($custom_stitle) && trim($custom_stitle) !== ''
            ? trim($custom_stitle)
            : $seo_data['title'];
        $seo_data['og_description'] = is_string($custom_sdesc) && trim($custom_sdesc) !== ''
            ? trim($custom_sdesc)
            : $seo_data['description'];
        $seo_data['og_image_alt'] = $seo_data['og_title'];
        $seo_data['twitter_title'] = $seo_data['og_title'];
        $seo_data['twitter_description'] = $seo_data['og_description'];
        $seo_data['twitter_image'] = $seo_data['og_image'];

        if (is_single()) {
            $seo_data['og_type'] = 'article';
            $seo_data['json_ld'][] = human_get_article_schema($post_id, $seo_data['description']);
        } else {
            $seo_data['json_ld'][] = human_get_webpage_schema($post_id, $seo_data['description']);
        }

        $breadcrumb_schema = human_get_breadcrumb_schema();
        if ($breadcrumb_schema) {
            $seo_data['json_ld'][] = $breadcrumb_schema;
        }

        if (is_page('strength') || get_post_field('post_name', $post_id) === 'strength') {
            $seo_data['title'] = 'Human Strength | Android Strength Training App';
            $seo_data['description'] = 'Human Strength is the first Human V1 product, an Android strength-training application currently in Google Play Internal Testing.';
            $seo_data['og_title'] = $seo_data['title'];
            $seo_data['og_description'] = $seo_data['description'];
            $seo_data['twitter_title'] = $seo_data['title'];
            $seo_data['twitter_description'] = $seo_data['description'];
            $software_schema = human_get_software_app_schema();
            if ($software_schema) {
                $seo_data['json_ld'][] = $software_schema;
            }
        }

        return $seo_data;
    }

    if (is_home()) {
        $seo_data['title'] = 'Human Journal | Training, Product and Human V1 Updates';
        $seo_data['description'] = 'Human Journal covers training, Human Strength product updates, exercise knowledge work, and the development of the Human V1 platform.';
        $seo_data['og_title'] = $seo_data['title'];
        $seo_data['og_description'] = $seo_data['description'];
        $seo_data['twitter_title'] = $seo_data['title'];
        $seo_data['twitter_description'] = $seo_data['description'];
        $seo_data['canonical_url'] = rtrim($domain, '/') . '/journal/';
    } elseif (is_post_type_archive('human_app')) {
        $seo_data['title'] = 'Human V1 Apps | Human Strength and Future Products';
        $seo_data['description'] = 'Explore Human Strength, currently in Google Play Internal Testing, and the future Human V1 product catalogue.';
        $seo_data['og_title'] = $seo_data['title'];
        $seo_data['og_description'] = $seo_data['description'];
        $seo_data['twitter_title'] = $seo_data['title'];
        $seo_data['twitter_description'] = $seo_data['description'];
        $seo_data['canonical_url'] = rtrim($domain, '/') . '/apps/';
    } elseif (is_category()) {
        $cat = get_category(get_query_var('cat'));
        if ($cat && !is_wp_error($cat)) {
            $seo_data['title'] = $cat->name . ' | Human Journal';
            $seo_data['description'] = trim(wp_strip_all_tags(category_description($cat->term_id)));
            if ($seo_data['description'] === '') {
                $seo_data['description'] = 'Read Human Journal articles filed under ' . $cat->name . '.';
            }
            $seo_data['og_title'] = $seo_data['title'];
            $seo_data['og_description'] = $seo_data['description'];
            $seo_data['twitter_title'] = $seo_data['title'];
            $seo_data['twitter_description'] = $seo_data['description'];
            $seo_data['canonical_url'] = get_category_link($cat->term_id);
        }
    } elseif (is_search()) {
        $query = get_search_query();
        $seo_data['title'] = ($query !== '' ? 'Search results for “' . $query . '”' : 'Search') . ' | Human V1';
        $seo_data['description'] = 'Search Human V1 website content.';
        $seo_data['og_title'] = $seo_data['title'];
        $seo_data['og_description'] = $seo_data['description'];
        $seo_data['twitter_title'] = $seo_data['title'];
        $seo_data['twitter_description'] = $seo_data['description'];
        $seo_data['robots'] = 'noindex,follow';
    } elseif (is_404()) {
        $seo_data['title'] = 'Page Not Found | Human V1';
        $seo_data['description'] = 'The requested Human V1 page could not be found.';
        $seo_data['og_title'] = $seo_data['title'];
        $seo_data['og_description'] = $seo_data['description'];
        $seo_data['twitter_title'] = $seo_data['title'];
        $seo_data['twitter_description'] = $seo_data['description'];
        $seo_data['robots'] = 'noindex,follow';
    }

    $breadcrumb_schema = human_get_breadcrumb_schema();
    if ($breadcrumb_schema) {
        $seo_data['json_ld'][] = $breadcrumb_schema;
    }

    return $seo_data;
}

/**
 * Output SEO and Open Graph Meta Tags in wp_head.
 */
function human_output_seo_meta_tags() {
    $meta = human_get_seo_metadata();
    ?>
    <!-- Human V1 SEO Engine -->
    <meta name="description" content="<?php echo esc_attr($meta['description']); ?>">
    <meta name="robots" content="<?php echo esc_attr($meta['robots']); ?>">
    <link rel="canonical" href="<?php echo esc_url($meta['canonical_url']); ?>">

    <meta property="og:type" content="<?php echo esc_attr($meta['og_type']); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr($meta['site_name']); ?>">
    <meta property="og:title" content="<?php echo esc_attr($meta['og_title']); ?>">
    <meta property="og:description" content="<?php echo esc_attr($meta['og_description']); ?>">
    <meta property="og:url" content="<?php echo esc_url($meta['canonical_url']); ?>">
    <meta property="og:image" content="<?php echo esc_url($meta['og_image']); ?>">
    <meta property="og:image:width" content="<?php echo esc_attr($meta['og_image_width']); ?>">
    <meta property="og:image:height" content="<?php echo esc_attr($meta['og_image_height']); ?>">
    <meta property="og:image:alt" content="<?php echo esc_attr($meta['og_image_alt']); ?>">

    <meta name="twitter:card" content="<?php echo esc_attr($meta['twitter_card']); ?>">
    <meta name="twitter:title" content="<?php echo esc_attr($meta['twitter_title']); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($meta['twitter_description']); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($meta['twitter_image']); ?>">

    <?php if (!empty($meta['json_ld'])) : ?>
        <?php foreach ($meta['json_ld'] as $schema) : ?>
            <?php if (!empty($schema) && is_array($schema)) : ?>
                <script type="application/ld+json"><?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?></script>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <!-- End Human V1 SEO Engine -->
    <?php
}
add_action('wp_head', 'human_output_seo_meta_tags', 1);

/**
 * Return an Organization schema only when an incorporated operator has been
 * explicitly configured. Human V1 itself must not be presented as a company.
 */
function human_get_organization_schema() {
    $capacity = human_get_option('operator_capacity', '');
    $legal_name = human_get_option('operator_legal_name', '');
    $terms_readiness = function_exists('human_get_terms_readiness') ? human_get_terms_readiness() : array('ready' => false);
    if ($capacity !== 'incorporated_entity'
        || trim((string) $legal_name) === ''
        || empty($terms_readiness['ready'])
    ) {
        return null;
    }

    $domain = human_get_option('canonical_domain', 'https://humanv1.com');
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => $legal_name,
        'url' => $domain,
        'logo' => get_template_directory_uri() . '/assets/human_logo_master.svg',
    );

    $public_email = human_get_option('public_contact_email', '');
    if (is_email($public_email)) {
        $schema['email'] = $public_email;
    }

    $same_as = array_filter(array(
        human_get_option('facebook_url'),
        human_get_option('instagram_url'),
        human_get_option('linkedin_url'),
        human_get_option('x_twitter_url'),
    ));
    if (!empty($same_as)) {
        $schema['sameAs'] = array_values($same_as);
    }

    return $schema;
}

function human_get_website_schema() {
    $domain = human_get_option('canonical_domain', 'https://humanv1.com');
    return array(
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => 'Human V1',
        'url' => $domain,
        'potentialAction' => array(
            '@type' => 'SearchAction',
            'target' => rtrim($domain, '/') . '/?s={search_term_string}',
            'query-input' => 'required name=search_term_string',
        ),
    );
}

function human_get_article_schema($post_id, $description = '') {
    $post = get_post($post_id);
    if (!($post instanceof WP_Post)) {
        return null;
    }

    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full');
    $image_url = $thumb ? $thumb[0] : human_get_option('default_social_image', get_template_directory_uri() . '/assets/human-og-share.png');
    $author_name = get_the_author_meta('display_name', $post->post_author);

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => get_the_title($post_id),
        'description' => $description !== '' ? $description : human_get_post_description($post_id, ''),
        'image' => $image_url,
        'datePublished' => get_the_date('c', $post_id),
        'dateModified' => get_the_modified_date('c', $post_id),
        'mainEntityOfPage' => array(
            '@type' => 'WebPage',
            '@id' => get_permalink($post_id),
        ),
    );

    if (is_string($author_name) && trim($author_name) !== '') {
        $schema['author'] = array(
            '@type' => 'Person',
            'name' => trim($author_name),
        );
    }

    $publisher = human_get_organization_schema();
    if ($publisher) {
        $schema['publisher'] = $publisher;
    }

    return $schema;
}

function human_get_webpage_schema($post_id, $description = '') {
    return array(
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        'name' => get_the_title($post_id),
        'url' => get_permalink($post_id),
        'description' => $description !== '' ? $description : human_get_post_description($post_id, ''),
    );
}

function human_get_software_app_schema() {
    if (!function_exists('human_get_canonical_apps')) {
        return null;
    }

    $strength = null;
    foreach (human_get_canonical_apps() as $app) {
        if (($app['slug'] ?? '') === 'strength') {
            $strength = $app;
            break;
        }
    }

    if (!$strength) {
        return null;
    }

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => $strength['title'],
        'description' => $strength['description'],
        'operatingSystem' => 'Android',
        'applicationCategory' => 'HealthApplication',
    );

    $status = human_normalize_app_status($strength['current_status'], 'strength');
    $play_url = human_validate_google_play_url($strength['play_url'], 'public');

    if ($status === 'available' && $play_url !== '') {
        $schema['downloadUrl'] = $play_url;

        $price_amount = trim((string) $strength['price_amount']);
        $price_currency = strtoupper(trim((string) $strength['price_currency']));
        if (preg_match('/^(?:0|[1-9][0-9]*)(?:\.[0-9]{1,2})?$/', $price_amount)
            && preg_match('/^[A-Z]{3}$/', $price_currency)
        ) {
            $schema['offers'] = array(
                '@type' => 'Offer',
                'price' => $price_amount,
                'priceCurrency' => $price_currency,
                'url' => $play_url,
            );
        }
    }

    return $schema;
}

function human_get_breadcrumb_schema() {
    if (!function_exists('human_get_breadcrumbs')) {
        return null;
    }

    $breadcrumbs = human_get_breadcrumbs();
    if (empty($breadcrumbs) || count($breadcrumbs) <= 1) {
        return null;
    }

    $items = array();
    foreach ($breadcrumbs as $index => $crumb) {
        if (empty($crumb['title']) || empty($crumb['url'])) {
            continue;
        }
        $items[] = array(
            '@type' => 'ListItem',
            'position' => count($items) + 1,
            'name' => $crumb['title'],
            'item' => $crumb['url'],
        );
    }

    if (count($items) <= 1) {
        return null;
    }

    return array(
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $items,
    );
}
