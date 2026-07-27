<?php
/**
 * Generic Page Template (page.php)
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<main class="site-main section-padding">
    <div class="container" style="max-width: 800px;">
        <!-- Breadcrumb Navigation -->
        <?php if (function_exists('human_render_breadcrumbs')) human_render_breadcrumbs(); ?>
        
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <h1 class="display-title" style="margin-bottom: 2rem;"><?php the_title(); ?></h1>
            <div style="color: #CBD5E1; font-size: 1rem; line-height: 1.7; overflow-wrap: break-word;">
                <?php the_content(); ?>
            </div>
        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?>
