<?php
/**
 * Taxonomy setup for Human Platform
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Seed the editorial category foundation
 */
function human_seed_editorial_categories() {
    if (get_option('human_editorial_categories_seeded')) {
        return;
    }

    $categories = array(
        'Strength Training' => array(
            'Programming',
            'Exercise Technique',
            'Progression',
            'Beginners'
        ),
        'Training Knowledge' => array(
            'Recovery',
            'Body Composition',
            'Training Volume'
        ),
        'Human' => array(
            'Human Strength',
            'Human Ontology',
            'Product Updates',
            'Development'
        )
    );

    foreach ($categories as $parent => $children) {
        $parent_id = wp_insert_term($parent, 'category');
        if (is_wp_error($parent_id)) {
            $parent_term = get_term_by('name', $parent, 'category');
            if ($parent_term) {
                $parent_id = array('term_id' => $parent_term->term_id);
            } else {
                continue;
            }
        }

        foreach ($children as $child) {
            wp_insert_term($child, 'category', array('parent' => $parent_id['term_id']));
        }
    }

    update_option('human_editorial_categories_seeded', true);
}
add_action('admin_init', 'human_seed_editorial_categories');
