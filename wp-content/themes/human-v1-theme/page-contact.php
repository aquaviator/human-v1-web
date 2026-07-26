<?php
/**
 * Template Name: Contact Page
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<main class="site-main section-padding">
    <div class="container" style="max-width: 800px;">
        <span class="eyebrow">GET IN TOUCH</span>
        <h1 class="display-title" style="margin-bottom: 1.5rem;">Contact Human</h1>
        <p style="font-size: clamp(1rem, 2.5vw, 1.1rem); color: #94A3B8; margin-bottom: 2.5rem; line-height: 1.6;">
            Have questions about the Human ecosystem, the Human Ontology programme, or product partnerships?
        </p>

        <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 16px;">
            <div class="grid-2col" style="margin-bottom: 2rem;">
                <div>
                    <h3 style="color: var(--human-white); font-size: 1.1rem; margin-bottom: 0.5rem;">General Inquiries</h3>
                    <p style="color: #94A3B8; font-size: 0.95rem;">hello@humanv1.com</p>
                </div>
                <div>
                    <h3 style="color: var(--human-white); font-size: 1.1rem; margin-bottom: 0.5rem;">Customer Support</h3>
                    <p style="color: #94A3B8; font-size: 0.95rem;">support@humanv1.com</p>
                </div>
            </div>

            <div style="border-top: 1px solid var(--human-border-dark); padding-top: 1.5rem;">
                <h3 style="color: var(--human-white); font-size: 1.1rem; margin-bottom: 0.5rem;">Human Ontology & Research</h3>
                <p style="color: #94A3B8; font-size: 0.95rem;">ontology@humanv1.com</p>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
