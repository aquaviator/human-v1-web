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
    <!-- HERO -->
    <section style="padding: 5rem 0 4rem; background: linear-gradient(180deg, rgba(0,102,255,0.15) 0%, rgba(10,13,16,1) 100%); border-bottom: 1px solid var(--human-border-dark);">
        <div class="container" style="max-width: 900px; text-align: center;">
            <span class="eyebrow">MAJOR HUMAN PROGRAMME</span>
            <h1 class="display-title" style="margin-bottom: 1.25rem;">Human Ontology</h1>
            <p style="font-size: 1.25rem; color: #94A3B8; margin-bottom: 2rem; line-height: 1.6;">
                A structured exercise knowledge system designed to understand movements, equipment, anatomy, biomechanics, substitutions, and training context across the entire Human platform.
            </p>
            <div style="background: rgba(0,102,255,0.08); border: 1px solid rgba(0,102,255,0.3); border-radius: 12px; padding: 1.25rem 2rem; display: inline-block; font-size: 0.95rem; color: var(--human-white);">
                "Human is building an exercise ontology designed to scale far beyond a traditional exercise library."
            </div>
        </div>
    </section>

    <!-- WHY ORDINARY LIBRARIES ARE LIMITED -->
    <section style="padding: 5rem 0; border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;">
                <div>
                    <span class="eyebrow">THE ARCHITECTURAL DIFFERENCE</span>
                    <h2 class="section-title">Beyond Flat Exercise Lists</h2>
                    <p style="font-size: 1.05rem; color: #94A3B8; margin-bottom: 1.25rem; line-height: 1.6;">
                        Traditional fitness apps treat exercises as flat strings of text ("Bench Press", "Squat"). This prevents intelligent exercise substitution, biomechanical load analysis, or cross-discipline training recommendations.
                    </p>
                    <p style="font-size: 1.05rem; color: #94A3B8; line-height: 1.6;">
                        The Human Ontology models exercises as rich knowledge nodes with equipment taxonomy, plane of motion, anatomical primary/secondary/stabilizer muscle relationships, force vectors, and fatigue cost profiles.
                    </p>
                </div>

                <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 16px; padding: 2rem;">
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
    <section style="padding: 5rem 0; background: var(--human-dark-surface);">
        <div class="container" style="text-align: center; max-width: 800px;">
            <span class="eyebrow">ECOSYSTEM INTEGRATION</span>
            <h2 class="section-title">Built Once. Used Across Human.</h2>
            <p style="font-size: 1.1rem; color: #94A3B8; margin-bottom: 3rem;">
                The Human Ontology serves as the single source of truth for exercise intelligence across Human Strength, Human HIIT, Human Mobility, and future Human Coach AI engines.
            </p>
            <a href="<?php echo esc_url(home_url('/apps')); ?>" class="btn btn-primary">View Ecosystem Applications</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
