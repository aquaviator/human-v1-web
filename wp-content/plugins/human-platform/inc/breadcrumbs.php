<?php
/**
 * Reusable Breadcrumb Architecture for Human Platform
 */

if (!defined('ABSPATH')) {
    exit;
}

function human_get_breadcrumbs() {
    $breadcrumbs = array();
    
    // Always start with Home
    $breadcrumbs[] = array(
        'title' => function_exists('human_get_brand_short_name') ? human_get_brand_short_name() : (get_bloginfo('name') ?: 'Home'),
        'url' => home_url('/')
    );

    if (is_home() || is_category() || is_tag() || is_singular('post')) {
        $breadcrumbs[] = array(
            'title' => function_exists('human_get_content_label') ? human_get_content_label() : 'Journal',
            'url' => home_url('/journal/')
        );
        
        if (is_category()) {
            $cat = get_category(get_query_var('cat'));
            $ancestors = get_ancestors($cat->term_id, 'category');
            if (!empty($ancestors)) {
                $ancestors = array_reverse($ancestors);
                foreach ($ancestors as $ancestor_id) {
                    $ancestor = get_category($ancestor_id);
                    $breadcrumbs[] = array(
                        'title' => $ancestor->name,
                        'url' => get_category_link($ancestor->term_id)
                    );
                }
            }
            $breadcrumbs[] = array(
                'title' => $cat->name,
                'url' => get_category_link($cat->term_id)
            );
        } elseif (is_singular('post')) {
            $categories = get_the_category();
            if (!empty($categories)) {
                $cat = $categories[0];
                $ancestors = get_ancestors($cat->term_id, 'category');
                if (!empty($ancestors)) {
                    $ancestors = array_reverse($ancestors);
                    foreach ($ancestors as $ancestor_id) {
                        $ancestor = get_category($ancestor_id);
                        $breadcrumbs[] = array(
                            'title' => $ancestor->name,
                            'url' => get_category_link($ancestor->term_id)
                        );
                    }
                }
                $breadcrumbs[] = array(
                    'title' => $cat->name,
                    'url' => get_category_link($cat->term_id)
                );
            }
            $breadcrumbs[] = array(
                'title' => get_the_title(),
                'url' => get_permalink()
            );
        }
    } elseif (is_post_type_archive('human_app') || is_page('apps')) {
        $breadcrumbs[] = array(
            'title' => function_exists('human_get_catalogue_label') ? human_get_catalogue_label() : 'Apps',
            'url' => home_url('/apps/')
        );
    } elseif (is_singular('human_app')) {
        $breadcrumbs[] = array(
            'title' => function_exists('human_get_catalogue_label') ? human_get_catalogue_label() : 'Apps',
            'url' => home_url('/apps/')
        );
        $breadcrumbs[] = array(
            'title' => get_the_title(),
            'url' => get_permalink()
        );
    } elseif (is_page()) {
        $post = get_post();
        $ancestors = get_post_ancestors($post->ID);
        if (!empty($ancestors)) {
            $ancestors = array_reverse($ancestors);
            foreach ($ancestors as $ancestor_id) {
                $ancestor = get_post($ancestor_id);
                $breadcrumbs[] = array(
                    'title' => $ancestor->post_title,
                    'url' => get_permalink($ancestor->ID)
                );
            }
        }
        $breadcrumbs[] = array(
            'title' => get_the_title(),
            'url' => get_permalink()
        );
    }

    return $breadcrumbs;
}

function human_render_breadcrumbs() {
    $breadcrumbs = human_get_breadcrumbs();
    if (count($breadcrumbs) <= 1) return; // Don't show if just "Home"

    echo '<nav aria-label="Breadcrumb" class="human-breadcrumbs" style="font-size:0.875rem; color:#94A3B8; margin-bottom:1.5rem; font-family:var(--font-sans);">';
    echo '<ol style="list-style:none; padding:0; margin:0; display:flex; flex-wrap:wrap; align-items:center; gap:0.5rem;">';
    
    foreach ($breadcrumbs as $index => $crumb) {
        $is_last = ($index === count($breadcrumbs) - 1);
        
        echo '<li style="display:flex; align-items:center; gap:0.5rem;">';
        
        if ($is_last) {
            echo '<span style="color:var(--human-white); font-weight:500;">' . esc_html($crumb['title']) . '</span>';
        } else {
            echo '<a href="' . esc_url($crumb['url']) . '" style="color:#94A3B8; text-decoration:none;">';
            echo esc_html($crumb['title']);
            echo '</a>';
            echo '<span style="color:#475569;" aria-hidden="true">&rsaquo;</span>';
        }
        
        echo '</li>';
    }
    
    echo '</ol>';
    echo '</nav>';
}
