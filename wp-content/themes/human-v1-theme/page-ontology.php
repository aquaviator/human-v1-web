<?php
/**
 * Template Name: Human Ontology Marketing Page
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<main class="site-main">
    <!-- Breadcrumb Navigation -->
    <div class="container pt-8 pb-0">
        <?php if (function_exists('human_render_breadcrumbs')) human_render_breadcrumbs(); ?>
    </div>
    <!-- HERO -->
    <section class="section-padding" style="background: linear-gradient(180deg, rgba(0,102,255,0.15) 0%, rgba(10,13,16,1) 100%); border-bottom: 1px solid var(--human-border-dark);">
        <div class="container" style="max-width: 900px; text-align: center;">
            <span class="eyebrow">HUMAN V1 KNOWLEDGE PROGRAMME</span>
            <h1 class="display-title" style="margin-bottom: 1.25rem;">Human Ontology</h1>
            <p style="font-size: clamp(1rem, 2.5vw, 1.25rem); color: #94A3B8; margin-bottom: 2rem; line-height: 1.6;">
                An ongoing structured exercise knowledge programme covering movements, equipment, anatomy, biomechanics, substitutions, and training context.
            </p>
            <div style="background: rgba(0,102,255,0.08); border: 1px solid rgba(0,102,255,0.3); border-radius: 12px; padding: 1.25rem 2rem; display: inline-block; font-size: 0.95rem; color: var(--human-white);">
                "Human V1 is developing a structured exercise knowledge programme beyond a flat exercise list."
            </div>
        </div>
    </section>

    <!-- WHY ORDINARY LIBRARIES ARE LIMITED -->
    <section class="section-padding" style="border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div class="grid-2col">
                <div>
                    <span class="eyebrow">THE ARCHITECTURAL DIFFERENCE</span>
                    <h2 class="section-title">Beyond Flat Exercise Lists</h2>
                    <p style="font-size: 1.05rem; color: #94A3B8; margin-bottom: 1.25rem; line-height: 1.6;">
                        A flat exercise list can capture names without recording the relationships between movements, equipment, anatomy, and training context.
                    </p>
                    <p style="font-size: 1.05rem; color: #94A3B8; line-height: 1.6;">
                        The Human Ontology programme is intended to structure exercise records with fields such as equipment, plane of motion, anatomical relationships, force direction, and programming context.
                    </p>
                </div>

                <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 16px;">
                    <h3 style="font-size: 1.1rem; color: var(--human-white); margin-bottom: 1.5rem;">Ontology Coverage Dimensions</h3>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 1rem;">
                        <li style="border-bottom: 1px solid var(--human-border-dark); padding-bottom: 0.75rem;">
                            <strong style="color: var(--human-white);">Movement Mechanics:</strong> Plane of motion, force direction, unilateral/bilateral classification, joint actions.
                        </li>
                        <li style="border-bottom: 1px solid var(--human-border-dark); padding-bottom: 0.75rem;">
                            <strong style="color: var(--human-white);">Equipment Taxonomy:</strong> Barbells, dumbbells, cables, selectorised, plate-loaded, Smith machine, landmine, bodyweight.
                        </li>
                        <li style="border-bottom: 1px solid var(--human-border-dark); padding-bottom: 0.75rem;">
                            <strong style="color: var(--human-white);">Anatomical Mapping:</strong> Primary muscles, secondary synergists, stabilizer roles, spinal loading index.
                        </li>
                        <li>
                            <strong style="color: var(--human-white);">Programming Intelligence:</strong> Progressions, regressions, equivalent substitutions, fatigue cost.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- FUTURE PLATFORM INTEGRATION -->
    <section class="section-padding" style="background: var(--human-dark-surface);">
        <div class="container" style="text-align: center; max-width: 800px;">
            <span class="eyebrow">LONG-TERM PROGRAMME</span>
            <h2 class="section-title">A Shared Knowledge Direction</h2>
            <p style="font-size: 1.05rem; color: #94A3B8; margin-bottom: 2.5rem; line-height: 1.6;">
                The programme is being developed as a reusable knowledge resource for Human V1. Future product use will depend on each product as it is designed and released.
            </p>
            <a href="<?php echo esc_url(home_url('/apps')); ?>" class="btn btn-primary">View Ecosystem Applications</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
