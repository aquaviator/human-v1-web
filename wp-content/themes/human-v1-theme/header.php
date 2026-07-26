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

        <nav>
            <ul class="main-nav">
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                <li><a href="<?php echo esc_url(home_url('/apps')); ?>">Apps</a></li>
                <li><a href="<?php echo esc_url(home_url('/ontology')); ?>">Human Ontology</a></li>
                <li><a href="<?php echo esc_url(home_url('/journal')); ?>">Journal</a></li>
                <li><a href="<?php echo esc_url(home_url('/about')); ?>">About</a></li>
                <li><a href="<?php echo esc_url(home_url('/support')); ?>">Support</a></li>
            </ul>
        </nav>

        <div>
            <a href="<?php echo esc_url(home_url('/strength')); ?>" class="btn btn-primary" style="padding: 0.6rem 1.25rem; font-size: 0.85rem;">Human Strength</a>
        </div>
    </div>
</header>
