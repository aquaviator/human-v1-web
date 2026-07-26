<?php
/**
 * Human Journal Posts Archive Template (home.php)
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<main class="site-main section-padding">
    <div class="container">
        <div style="text-align: center; max-width: 800px; margin: 0 auto 3rem;">
            <span class="eyebrow">EDITORIAL & RESEARCH</span>
            <h1 class="display-title" style="margin-bottom: 1rem;">Human Journal</h1>
            <p style="font-size: clamp(1rem, 2.5vw, 1.2rem); color: #94A3B8; line-height: 1.6;">
                Articles, product engineering updates, performance science, and behind-the-scenes developments across the Human ecosystem.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; display: flex; flex-direction: column; justify-content: space-between;">
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

                    <div style="font-size: 0.8rem; color: #64748B; border-top: 1px solid var(--human-border-dark); padding-top: 1rem; font-family: var(--font-mono);">
                        Published: <?php echo get_the_date(); ?>
                    </div>
                </article>
            <?php endwhile; else : ?>
                <!-- Sample Editorial Seed Posts when database has no posts yet -->
                <article class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <span style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--human-electric-blue);">HUMAN PHILOSOPHY</span>
                        <h2 style="font-size: 1.25rem; margin: 0.75rem 0; color: var(--human-white);">Why Human Starts With Strength</h2>
                        <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem;">
                            Strength training provides the foundational neural, musculoskeletal, and hormonal bedrock for all physical performance. Here is why Strength is our launch focus.
                        </p>
                    </div>
                    <span style="font-size: 0.8rem; color: #64748B; font-family: var(--font-mono); border-top: 1px solid var(--human-border-dark); padding-top: 1rem;">July 2026 | Human Editorial</span>
                </article>

                <article class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <span style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--human-electric-blue);">ARCHITECTURE</span>
                        <h2 style="font-size: 1.25rem; margin: 0.75rem 0; color: var(--human-white);">Why Your Workout Should Not Depend On Signal</h2>
                        <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem;">
                            An engineering look into offline-first Android architecture using Room database, avoiding gym connectivity latency or cloud dependency failures.
                        </p>
                    </div>
                    <span style="font-size: 0.8rem; color: #64748B; font-family: var(--font-mono); border-top: 1px solid var(--human-border-dark); padding-top: 1rem;">July 2026 | Tech Lead</span>
                </article>

                <article class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <span style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--human-electric-blue);">ONTOLOGY</span>
                        <h2 style="font-size: 1.25rem; margin: 0.75rem 0; color: var(--human-white);">Building The Human Ontology</h2>
                        <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem;">
                            Why we are building a structured exercise knowledge system designed to model movement mechanics, equipment taxonomy, and joint actions across the entire platform.
                        </p>
                    </div>
                    <span style="font-size: 0.8rem; color: #64748B; font-family: var(--font-mono); border-top: 1px solid var(--human-border-dark); padding-top: 1rem;">July 2026 | Research Team</span>
                </article>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
