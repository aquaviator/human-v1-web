<?php
/**
 * Single Journal Post Template (single.php)
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<main class="site-main" style="padding: 5rem 0;">
    <article class="container" style="max-width: 800px;">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <header style="margin-bottom: 2.5rem; text-align: center;">
                <span style="font-family: var(--font-mono); font-size: 0.85rem; color: var(--human-electric-blue); text-transform: uppercase;">
                    <?php the_category(', '); ?>
                </span>
                <h1 class="display-title" style="margin: 1rem 0 1.5rem;"><?php the_title(); ?></h1>
                <div style="color: #64748B; font-size: 0.9rem;">
                    By <?php the_author(); ?> | Published on <?php echo get_the_date(); ?>
                </div>
            </header>

            <div style="color: #CBD5E1; font-size: 1.1rem; line-height: 1.8;" class="entry-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile; endif; ?>
    </article>
</main>

<?php get_footer(); ?>
