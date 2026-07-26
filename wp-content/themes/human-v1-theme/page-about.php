<?php
/**
 * Template Name: About Human Platform
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<main class="site-main" style="padding: 5rem 0;">
    <div class="container" style="max-width: 900px;">
        <span class="eyebrow">ABOUT HUMAN</span>
        <h1 class="display-title" style="margin-bottom: 1.5rem;">Built Around Real Performance</h1>
        
        <p style="font-size: 1.25rem; color: #94A3B8; margin-bottom: 2.5rem; line-height: 1.7;">
            Human is a performance technology brand built around real people, real training data, progression, and long-term performance. We believe technology should serve physical execution — not distract from it.
        </p>

        <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 16px; padding: 2.5rem; margin-bottom: 3rem;">
            <h2 style="font-size: 1.5rem; color: var(--human-white); margin-bottom: 1rem;">One Platform. Multiple Disciplines.</h2>
            <p style="color: #94A3B8; font-size: 1.05rem; line-height: 1.7; margin-bottom: 1.5rem;">
                Human Strength is our first commercial product. Moving forward, Human will expand into HIIT, Running, Recovery, Mobility, Nutrition, and Intelligent Coaching.
            </p>
            <p style="color: #94A3B8; font-size: 1.05rem; line-height: 1.7;">
                These are not isolated apps — they are connected modules sharing a unified Human performance platform and the Human Ontology knowledge engine.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem;">
                <h3 style="color: var(--human-white); margin-bottom: 0.75rem;">Reliable Offline First</h3>
                <p style="color: #94A3B8; font-size: 0.95rem;">
                    Your training should never stop because of bad cellular signal. Our applications utilize Room local storage as the primary source of truth.
                </p>
            </div>

            <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem;">
                <h3 style="color: var(--human-white); margin-bottom: 0.75rem;">Data Ownership</h3>
                <p style="color: #94A3B8; font-size: 0.95rem;">
                    Your workouts, sets, routines, and body measurements belong to you. Subscription expiry will never wipe your historical training data.
                </p>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
