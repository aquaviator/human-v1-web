<?php
/**
 * Single Journal Post Template (single.php)
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$current_slug = get_query_var('name');
$fallback_article = null;

if (!have_posts() && !empty($current_slug) && function_exists('human_get_cornerstone_articles')) {
    $articles = human_get_cornerstone_articles();
    foreach ($articles as $art) {
        if ($art['slug'] === $current_slug) {
            $fallback_article = $art;
            break;
        }
    }
}
?>

<main class="site-main section-padding">
    <article class="container" style="max-width: 800px;">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="Breadcrumb" style="margin-bottom: 2rem; font-family: var(--font-mono); font-size: 0.85rem; color: #64748B;">
            <a href="<?php echo esc_url(home_url('/')); ?>" style="color: #94A3B8;">Home</a> &gt; 
            <a href="<?php echo esc_url(home_url('/journal')); ?>" style="color: #94A3B8;">Journal</a> &gt; 
            <span style="color: var(--human-electric-blue);"><?php echo $fallback_article ? esc_html($fallback_article['title']) : get_the_title(); ?></span>
        </nav>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <header style="margin-bottom: 2.5rem; text-align: left; border-bottom: 1px solid var(--human-border-dark); padding-bottom: 1.5rem;">
                <span style="font-family: var(--font-mono); font-size: 0.85rem; color: var(--human-electric-blue); text-transform: uppercase;">
                    <?php the_category(', '); ?>
                </span>
                <h1 class="display-title" style="margin: 0.75rem 0 1.25rem; font-size: clamp(1.75rem, 4vw, 2.5rem); line-height: 1.25;"><?php the_title(); ?></h1>
                <div style="color: #64748B; font-size: 0.85rem; font-family: var(--font-mono);">
                    By <?php the_author(); ?> | Published on <?php echo get_the_date(); ?>
                </div>
            </header>

            <div style="color: #CBD5E1; font-size: 1.05rem; line-height: 1.8; overflow-wrap: break-word;" class="entry-content">
                <?php the_content(); ?>
            </div>

            <footer style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--human-border-dark);">
                <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; text-align: center;">
                    <span class="eyebrow">HUMAN PERFORMANCE ECOSYSTEM</span>
                    <h3 style="color: var(--human-white); margin-bottom: 0.5rem;">Take Your Training Data Seriously</h3>
                    <p style="color: #94A3B8; margin-bottom: 1.5rem; font-size: 0.95rem;">
                        Human Strength provides offline-first Room local database workout logging with automated volume analytics and estimated 1RM progression on Android.
                    </p>
                    <a href="<?php echo esc_url(home_url('/strength')); ?>" class="btn btn-primary">Explore Human Strength &rarr;</a>
                </div>
            </footer>
        <?php endwhile; elseif ($fallback_article) : ?>
            <header style="margin-bottom: 2.5rem; text-align: left; border-bottom: 1px solid var(--human-border-dark); padding-bottom: 1.5rem;">
                <span style="font-family: var(--font-mono); font-size: 0.85rem; color: var(--human-electric-blue); text-transform: uppercase;">
                    <?php echo esc_html($fallback_article['category']); ?>
                </span>
                <h1 class="display-title" style="margin: 0.75rem 0 1.25rem; font-size: clamp(1.75rem, 4vw, 2.5rem); line-height: 1.25;"><?php echo esc_html($fallback_article['title']); ?></h1>
                <div style="color: #64748B; font-size: 0.85rem; font-family: var(--font-mono);">
                    By <?php echo esc_html($fallback_article['author']); ?> | Published on <?php echo esc_html($fallback_article['date']); ?>
                </div>
            </header>

            <div style="color: #CBD5E1; font-size: 1.05rem; line-height: 1.8; overflow-wrap: break-word;" class="entry-content">
                <?php echo $fallback_article['content']; ?>
            </div>

            <footer style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--human-border-dark);">
                <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; text-align: center;">
                    <span class="eyebrow">HUMAN PERFORMANCE ECOSYSTEM</span>
                    <h3 style="color: var(--human-white); margin-bottom: 0.5rem;">Take Your Training Data Seriously</h3>
                    <p style="color: #94A3B8; margin-bottom: 1.5rem; font-size: 0.95rem;">
                        Human Strength provides offline-first Room local database workout logging with automated volume analytics and estimated 1RM progression on Android.
                    </p>
                    <a href="<?php echo esc_url(home_url('/strength')); ?>" class="btn btn-primary">Explore Human Strength &rarr;</a>
                </div>
            </footer>
        <?php else : ?>
            <div style="text-align: center; padding: 4rem 0;">
                <h1 style="color: var(--human-white); margin-bottom: 1rem;">Article Not Found</h1>
                <p style="color: #94A3B8; margin-bottom: 2rem;">The requested article could not be located in the Human Journal archive.</p>
                <a href="<?php echo esc_url(home_url('/journal')); ?>" class="btn btn-primary">&larr; Return to Human Journal</a>
            </div>
        <?php endif; ?>
    </article>
</main>

<?php get_footer(); ?>
