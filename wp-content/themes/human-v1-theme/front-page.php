<?php
/**
 * Front Page Template
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<main class="site-main">
    <!-- HERO SECTION -->
    <section class="hero-section" style="padding: 5rem 0 4.5rem; background: radial-gradient(circle at 50% 20%, rgba(0, 102, 255, 0.18) 0%, rgba(10, 13, 16, 1) 75%); border-bottom: 1px solid var(--human-border-dark);">
        <div class="container" style="text-align: center; max-width: 960px;">
            <div style="margin-bottom: 1.5rem; display: flex; justify-content: center;">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/human_logo_master.svg'); ?>" alt="Human V1 Master Logo" style="height: 64px; width: auto; max-width: 100%; filter: drop-shadow(0 8px 24px rgba(0, 102, 255, 0.35));">
            </div>
            <span class="eyebrow">UMBRELLA BRAND — HUMAN PLATFORM</span>
            <h1 class="display-title" style="margin-bottom: 1.25rem;">Train. Track. Transform.</h1>
            <p style="font-size: 1.25rem; color: #94A3B8; margin-bottom: 2.5rem; line-height: 1.6;">
                A performance technology platform built around how humans train, progress, and evolve. Connecting physical disciplines into one evolving performance platform.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo esc_url(home_url('/strength')); ?>" class="btn btn-primary" style="padding: 1rem 2rem; font-size: 1.05rem;">
                    Explore Human Strength
                </a>
                <a href="<?php echo esc_url(home_url('/ontology')); ?>" class="btn btn-secondary" style="padding: 1rem 2rem; font-size: 1.05rem;">
                    Discover Human Ontology
                </a>
            </div>
        </div>
    </section>

    <!-- BRAND BANNER SHOWCASE -->
    <section style="padding: 3rem 0; background-color: var(--human-dark-bg); border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div style="border-radius: 16px; overflow: hidden; border: 1px solid var(--human-border-dark); box-shadow: 0 20px 50px rgba(0, 102, 255, 0.15);">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/hv1-banner.svg'); ?>" alt="Human V1 Strength Official Banner" style="width: 100%; height: auto; display: block;">
            </div>
        </div>
    </section>

    <!-- PRODUCT INTRO: HUMAN STRENGTH -->
    <section style="padding: 5rem 0; border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;">
                <div>
                    <span class="eyebrow">COMMERCIAL LAUNCH PRODUCT</span>
                    <h2 class="section-title">Human Strength</h2>
                    <p style="font-size: 1.1rem; color: #94A3B8; margin-bottom: 1.5rem;">
                        The first commercial product in the Human ecosystem. Built natively for Android with Jetpack Compose, Material 3, and Room. Designed for offline reliability without sacrificing progression analytics.
                    </p>
                    <ul style="list-style: none; margin-bottom: 2rem; display: flex; flex-direction: column; gap: 0.85rem;">
                        <li style="display: flex; align-items: center; gap: 0.75rem; color: var(--human-white); font-weight: 500;">
                            <span style="color: var(--human-electric-blue);">✓</span> Offline-first Room database — train anywhere without signal
                        </li>
                        <li style="display: flex; align-items: center; gap: 0.75rem; color: var(--human-white); font-weight: 500;">
                            <span style="color: var(--human-electric-blue);">✓</span> Volume analytics, estimated 1RM, PR tracking, and supersets
                        </li>
                        <li style="display: flex; align-items: center; gap: 0.75rem; color: var(--human-white); font-weight: 500;">
                            <span style="color: var(--human-electric-blue);">✓</span> Simple £24/year subscription after ~30-day introductory trial
                        </li>
                    </ul>
                    <a href="<?php echo esc_url(home_url('/strength')); ?>" class="btn btn-primary">Learn More About Strength &rarr;</a>
                </div>

                <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 16px; padding: 2.5rem; box-shadow: 0 20px 40px rgba(0,0,0,0.5);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; border-bottom: 1px solid var(--human-border-dark); padding-bottom: 1rem;">
                        <div style="font-weight: 700; color: var(--human-white); font-size: 1.1rem;">Human Strength v1</div>
                        <?php echo human_get_status_badge('AVAILABLE'); ?>
                    </div>
                    <div style="font-family: var(--font-mono); font-size: 0.85rem; color: #64748B; margin-bottom: 1.5rem;">
                        App ID: com.aistudio.humanstrength.kfqjza<br>
                        Stack: Kotlin | Jetpack Compose | Room DB | Firebase
                    </div>
                    <div style="background: var(--human-dark-bg); border-radius: 8px; padding: 1.25rem; border: 1px solid var(--human-border-dark);">
                        <div style="font-size: 0.85rem; color: #94A3B8; margin-bottom: 0.5rem;">SUBSCRIPTION ENTITLEMENT</div>
                        <div style="font-size: 1.5rem; font-weight: 800; color: var(--human-white);">£24 / year</div>
                        <div style="font-size: 0.85rem; color: #10B981; margin-top: 0.25rem;">Includes ~30-day introductory trial. Data never erased on expiration.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PLATFORM GRID -->
    <section style="padding: 5rem 0; background-color: var(--human-dark-surface); border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
                <span class="eyebrow">THE HUMAN ECOSYSTEM</span>
                <h2 class="section-title">One Human. Multiple Disciplines.</h2>
                <p style="color: #94A3B8; font-size: 1.05rem;">
                    Human Strength is just the start. The Human platform is built to connect physical disciplines into a unified performance technology engine.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.5rem;">
                <?php
                $apps = human_get_canonical_apps();
                foreach ($apps as $app) :
                ?>
                    <div style="background: var(--human-dark-bg); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 1.75rem; transition: border-color 0.2s;" onmouseover="this.style.borderColor='var(--human-electric-blue)'" onmouseout="this.style.borderColor='var(--human-border-dark)'">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                            <h3 style="font-size: 1.2rem; color: var(--human-white);"><?php echo esc_html($app['title']); ?></h3>
                            <?php echo human_get_status_badge($app['status']); ?>
                        </div>
                        <p style="font-size: 0.9rem; color: #94A3B8; margin-bottom: 1.5rem; line-height: 1.5; min-height: 4.5em;">
                            <?php echo esc_html($app['description']); ?>
                        </p>
                        <a href="<?php echo esc_url(home_url($app['target_url'])); ?>" style="font-size: 0.85rem; font-weight: 600; color: var(--human-electric-blue);">
                            View Details &rarr;
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ONTOLOGY FEATURE -->
    <section style="padding: 5rem 0; border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;">
                <div>
                    <span class="eyebrow">HUMAN ONTOLOGY PROGRAMME</span>
                    <h2 class="section-title">More Than An Exercise Library</h2>
                    <p style="font-size: 1.05rem; color: #94A3B8; margin-bottom: 1.5rem;">
                        Human is building a structured exercise knowledge system designed to understand movements, equipment taxonomy, anatomical mechanics, relationships, substitutions, and training context across the entire Human platform.
                    </p>
                    <p style="font-size: 0.95rem; color: #64748B; margin-bottom: 2rem;">
                        Our ambition is to build one of the world's most comprehensive structured exercise databases, providing the intelligence foundation for Human Strength, HIIT, Recovery, Coach, and beyond.
                    </p>
                    <a href="<?php echo esc_url(home_url('/ontology')); ?>" class="btn btn-secondary">Explore The Human Ontology &rarr;</a>
                </div>

                <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem; font-family: var(--font-mono); font-size: 0.85rem;">
                    <div style="color: var(--human-electric-blue); font-weight: 700; margin-bottom: 1rem;">// ONTOLOGY STRUCTURED KNOWLEDGE</div>
                    <div style="color: #94A3B8; line-height: 1.8;">
                        canonical_name: "Barbell Back Squat"<br>
                        movement_pattern: "Squat / Knee Dominant"<br>
                        plane_of_motion: "Sagittal"<br>
                        primary_muscles: ["Quadriceps", "Gluteus Maximus"]<br>
                        stabilisers: ["Erector Spinae", "Transverse Abdominis"]<br>
                        spinal_loading: "High (Axial)"<br>
                        substitutions: ["Goblet Squat", "Leg Press", "Safety Bar Squat"]<br>
                        relationships: ["Front Squat (Variation)", "Overhead Squat (Progression)"]
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- OFFLINE FIRST PHILOSOPHY -->
    <section style="padding: 5rem 0; background-color: var(--human-dark-surface); text-align: center; border-bottom: 1px solid var(--human-border-dark);">
        <div class="container" style="max-width: 800px;">
            <span class="eyebrow">CORE PRODUCT PHILOSOPHY</span>
            <h2 class="section-title">Your Workout Should Not Depend On Signal</h2>
            <p style="font-size: 1.1rem; color: #94A3B8; margin-bottom: 2rem; line-height: 1.6;">
                Human Strength is designed around reliable local training. Room local database is the source of truth, giving you instant responsiveness in basement gyms or remote locations. Cloud identity and sync are optional.
            </p>
            <a href="<?php echo esc_url(home_url('/about')); ?>" class="btn btn-outline">Read Our Architecture Philosophy</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
