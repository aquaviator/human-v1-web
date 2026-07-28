<?php
/**
 * Header Template
 */
if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="<?php echo esc_url(get_template_directory_uri() . '/assets/hv1-icon.svg'); ?>">
    <link rel="apple-touch-icon" href="<?php echo esc_url(get_template_directory_uri() . '/assets/hv1-icon.svg'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container header-inner">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-logo">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/hv1-icon.svg'); ?>" alt="Human V1 Icon" style="width: 36px; height: 36px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 102, 255, 0.3);">
            <span>Human</span>
        </a>

        <button type="button" class="mobile-nav-toggle" id="mobileNavToggle" aria-expanded="false" aria-controls="primaryNav" aria-label="Toggle Navigation Menu">
            <span class="hamburger-icon">
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
                <span class="hamburger-bar"></span>
            </span>
            <span>Menu</span>
        </button>

        <nav id="primaryNav" aria-label="Primary Navigation">
            <?php
            if (has_nav_menu('primary-menu')) {
                wp_nav_menu(array(
                    'theme_location' => 'primary-menu',
                    'container'      => false,
                    'menu_class'     => 'main-nav',
                    'menu_id'        => 'mainNavList',
                    'fallback_cb'    => false,
                ));
            } else {
            ?>
            <ul class="main-nav" id="mainNavList">
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                <li><a href="<?php echo esc_url(home_url('/apps')); ?>">Apps</a></li>
                <li><a href="<?php echo esc_url(home_url('/ontology')); ?>">Human Ontology</a></li>
                <li><a href="<?php echo esc_url(home_url('/journal')); ?>">Journal</a></li>
                <li><a href="<?php echo esc_url(home_url('/about')); ?>">About</a></li>
                <li><a href="<?php echo esc_url(home_url('/support')); ?>">Support</a></li>
            </ul>
            <?php } ?>
        </nav>
        <div class="header-cta">
            <?php 
            $header_cta_label = 'Explore Human Strength';
            $header_cta_url = home_url('/strength');
            
            $strength_app = get_page_by_path('strength', OBJECT, 'human_app');
            if ($strength_app) {
                $ctas = get_posts(array(
                    'post_type' => 'human_cta',
                    'meta_key' => '_human_cta_associated_app',
                    'meta_value' => $strength_app->ID,
                    'post_status' => 'publish',
                    'numberposts' => 1,
                    'meta_query' => array(
                        array(
                            'key' => '_human_cta_status',
                            'value' => 'active',
                            'compare' => '='
                        )
                    )
                ));
                if (!empty($ctas)) {
                    $header_cta_label = get_post_meta($ctas[0]->ID, '_human_cta_label', true) ?: $ctas[0]->post_title;
                    $header_cta_url = get_post_meta($ctas[0]->ID, '_human_cta_destination_url', true) ?: home_url('/strength');
                }
            }
            ?>
            <a href="<?php echo esc_url($header_cta_url); ?>" class="btn btn-primary" style="padding: 0.6rem 1.25rem; font-size: 0.85rem;"><?php echo esc_html($header_cta_label); ?></a>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('mobileNavToggle');
    const mainNav = document.getElementById('mainNavList');
    if (!toggleBtn || !mainNav) return;

    toggleBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        const expanded = toggleBtn.getAttribute('aria-expanded') === 'true';
        toggleBtn.setAttribute('aria-expanded', !expanded);
        mainNav.classList.toggle('is-open');
    });

    document.addEventListener('click', function(e) {
        if (!mainNav.contains(e.target) && !toggleBtn.contains(e.target)) {
            toggleBtn.setAttribute('aria-expanded', 'false');
            mainNav.classList.remove('is-open');
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mainNav.classList.contains('is-open')) {
            toggleBtn.setAttribute('aria-expanded', 'false');
            mainNav.classList.remove('is-open');
            toggleBtn.focus();
        }
    });
});
</script>
