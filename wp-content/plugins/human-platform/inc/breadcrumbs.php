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
        'title' => 'Human',
        'url' => home_url('/')
    );

    if (is_home() || is_category() || is_tag() || is_singular('post')) {
        $breadcrumbs[] = array(
            'title' => 'Journal',
            'url' => home_url('/journal/')
        );
        
        if (is_category()) {
            $cat = get_category(get_query_var('cat'));
            $breadcrumbs[] = array(
                'title' => $cat->name,
                'url' => get_category_link($cat->term_id)
            );
        } elseif (is_singular('post')) {
            $categories = get_the_category();
            if (!empty($categories)) {
                // Get first category
                $cat = $categories[0];
                if ($cat->parent) {
                    $parent_cat = get_category($cat->parent);
                    $breadcrumbs[] = array(
                        'title' => $parent_cat->name,
                        'url' => get_category_link($parent_cat->term_id)
                    );
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
            'title' => 'Apps',
            'url' => home_url('/apps/')
        );
    } elseif (is_singular('human_app')) {
        $breadcrumbs[] = array(
            'title' => 'Apps',
            'url' => home_url('/apps/')
        );
        $breadcrumbs[] = array(
            'title' => get_the_title(),
            'url' => get_permalink()
        );
    } elseif (is_page()) {
        $post = get_post();
        if ($post->post_parent) {
            $parent = get_post($post->post_parent);
            $breadcrumbs[] = array(
                'title' => $parent->post_title,
                'url' => get_permalink($parent->ID)
            );
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
    echo '<ol style="list-style:none; padding:0; margin:0; display:flex; flex-wrap:wrap; align-items:center; gap:0.5rem;" itemscope itemtype="https://schema.org/BreadcrumbList">';
    
    foreach ($breadcrumbs as $index => $crumb) {
        $position = $index + 1;
        $is_last = ($index === count($breadcrumbs) - 1);
        
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" style="display:flex; align-items:center; gap:0.5rem;">';
        
        if ($is_last) {
            echo '<span itemprop="name" style="color:var(--human-white); font-weight:500;">' . esc_html($crumb['title']) . '</span>';
            echo '<meta itemprop="position" content="' . $position . '" />';
        } else {
            echo '<a itemprop="item" href="' . esc_url($crumb['url']) . '" style="color:#94A3B8; text-decoration:none;">';
            echo '<span itemprop="name">' . esc_html($crumb['title']) . '</span>';
            echo '</a>';
            echo '<meta itemprop="position" content="' . $position . '" />';
            echo '<span style="color:#475569;" aria-hidden="true">&rsaquo;</span>';
        }
        
        echo '</li>';
    }
    
    echo '</ol>';
    echo '</nav>';
}
