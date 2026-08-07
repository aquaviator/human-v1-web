<?php
/**
 * Human Journal Posts Archive Template (home.php)
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$cornerstones = function_exists('human_get_cornerstone_articles') ? human_get_cornerstone_articles() : array();
?>

<main class="site-main section-padding">
    <div class="container">
        <!-- Breadcrumb Navigation -->
        <?php if (function_exists('human_render_breadcrumbs')) human_render_breadcrumbs(); ?>
        
        <div style="text-align: center; max-width: 800px; margin: 0 auto 3rem;">
            <span class="eyebrow">HUMAN V1 JOURNAL</span>
            <h1 class="display-title" style="margin-bottom: 1rem;">Human Journal</h1>
            <p style="font-size: clamp(1rem, 2.5vw, 1.2rem); color: #94A3B8; line-height: 1.6;">
                Training articles, Human Strength product updates, exercise knowledge work, and notes on the development of the Human V1 platform.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; display: flex; flex-direction: column; justify-content: space-between; transition: border-color 0.2s;" onmouseover="this.style.borderColor='var(--human-electric-blue)'" onmouseout="this.style.borderColor='var(--human-border-dark)'">
                    <div>
                        <span style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--human-electric-blue); text-transform: uppercase;">
                            <?php the_category(', '); ?>
                        </span>
                        <h2 style="font-size: 1.25rem; margin: 0.75rem 0; color: var(--human-white);">
                            <a href="<?php the_permalink(); ?>" style="color: var(--human-white);"><?php the_title(); ?></a>
                        </h2>
                        <div style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem;">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>

                    <div style="font-size: 0.8rem; color: #64748B; border-top: 1px solid var(--human-border-dark); padding-top: 1rem; font-family: var(--font-mono); display: flex; justify-content: space-between;">
                        <span><?php echo get_the_date(); ?></span>
                        <a href="<?php the_permalink(); ?>" style="color: var(--human-electric-blue); font-weight: 600;">Read Article &rarr;</a>
                    </div>
                </article>
            <?php endwhile; else : ?>
                <!-- Fallback rendering 10 Cornerstone Articles -->
                <?php foreach ($cornerstones as $art) : ?>
                    <article class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; display: flex; flex-direction: column; justify-content: space-between; transition: border-color 0.2s;" onmouseover="this.style.borderColor='var(--human-electric-blue)'" onmouseout="this.style.borderColor='var(--human-border-dark)'">
                        <div>
                            <span style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--human-electric-blue); text-transform: uppercase;">
                                <?php echo esc_html($art['category']); ?>
                            </span>
                            <h2 style="font-size: 1.25rem; margin: 0.75rem 0; color: var(--human-white);">
                                <a href="<?php echo esc_url(home_url('/journal/' . $art['slug'])); ?>" style="color: var(--human-white);"><?php echo esc_html($art['title']); ?></a>
                            </h2>
                            <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem;">
                                <?php echo esc_html($art['excerpt']); ?>
                            </p>
                        </div>

                        <div style="font-size: 0.8rem; color: #64748B; border-top: 1px solid var(--human-border-dark); padding-top: 1rem; font-family: var(--font-mono); display: flex; justify-content: space-between; align-items: center;">
                            <span><?php echo esc_html($art['date']); ?></span>
                            <a href="<?php echo esc_url(home_url('/journal/' . $art['slug'])); ?>" style="color: var(--human-electric-blue); font-weight: 600;">Read Article &rarr;</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
