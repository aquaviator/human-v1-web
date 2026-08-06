<?php
/**
 * Front Page Template
 */
if (!defined('ABSPATH')) {
    exit;
}

$human_apps = function_exists('human_get_canonical_apps') ? human_get_canonical_apps() : array();
$human_strength_app = human_v1_find_app('strength', $human_apps);
$human_strength_status = human_v1_get_app_status($human_strength_app);
get_header();
?>

<main class="site-main">
    <!-- HERO SECTION -->
    <section class="hero-section section-padding" style="background: radial-gradient(circle at 50% 20%, rgba(0, 102, 255, 0.18) 0%, rgba(10, 13, 16, 1) 75%); border-bottom: 1px solid var(--human-border-dark);">
        <div class="container" style="text-align: center; max-width: 960px;">
            <div style="margin-bottom: 1.5rem; display: flex; justify-content: center;">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/human_logo_master.svg'); ?>" alt="Human V1 Master Logo" style="height: 64px; width: auto; max-width: 100%; filter: drop-shadow(0 8px 24px rgba(0, 102, 255, 0.35));">
            </div>
            <span class="eyebrow">HUMAN V1 PLATFORM</span>
            <h1 class="display-title" style="margin-bottom: 1.25rem;">Train. Track. Transform.</h1>
            <p style="font-size: clamp(1rem, 2.5vw, 1.25rem); color: #94A3B8; margin-bottom: 2.5rem; line-height: 1.6;">
                Human V1 is the platform behind Human Strength and future Human applications. Human Strength is the first product.
            </p>
            <div class="btn-group" style="justify-content: center;">
                <a href="<?php echo esc_url(home_url('/strength')); ?>" class="btn btn-primary">
                    Explore Human Strength
                </a>
                <a href="<?php echo esc_url(home_url('/ontology')); ?>" class="btn btn-secondary">
                    Discover Human Ontology
                </a>
            </div>
        </div>
    </section>

    <!-- BRAND BANNER SHOWCASE -->
    <section style="padding: clamp(1.5rem, 4vw, 3rem) 0; background-color: var(--human-dark-bg); border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div style="border-radius: 16px; overflow: hidden; border: 1px solid var(--human-border-dark); box-shadow: 0 20px 50px rgba(0, 102, 255, 0.15);">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/hv1-banner.svg'); ?>" alt="Human V1 Strength Official Banner" style="width: 100%; height: auto; display: block;">
            </div>
        </div>
    </section>

    <!-- PRODUCT INTRO: HUMAN STRENGTH -->
    <section class="section-padding" style="border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div class="grid-2col">
                <div>
                    <span class="eyebrow">FIRST HUMAN V1 PRODUCT</span>
                    <h2 class="section-title">Human Strength</h2>
                    <p style="font-size: 1.05rem; color: #94A3B8; margin-bottom: 1.5rem; line-height: 1.6;">
                        The first product in the Human V1 ecosystem. Built natively for Android with Jetpack Compose, Material 3, and Room. Designed for offline reliability without sacrificing progression analytics.
                    </p>
                    <ul style="list-style: none; margin-bottom: 2rem; display: flex; flex-direction: column; gap: 0.85rem;">
                        <li style="display: flex; align-items: flex-start; gap: 0.75rem; color: var(--human-white); font-weight: 500;">
                            <span style="color: var(--human-electric-blue); flex-shrink:0;">✓</span>
                            <span>Offline-first Room database — train anywhere without signal</span>
                        </li>
                        <li style="display: flex; align-items: flex-start; gap: 0.75rem; color: var(--human-white); font-weight: 500;">
                            <span style="color: var(--human-electric-blue); flex-shrink:0;">✓</span>
                            <span>Volume analytics, estimated 1RM, PR tracking, and supersets</span>
                        </li>
                        <li style="display: flex; align-items: flex-start; gap: 0.75rem; color: var(--human-white); font-weight: 500;">
                            <span style="color: var(--human-electric-blue); flex-shrink:0;">✓</span>
                            <span>Human V1 account access is separate from paid Google Play membership</span>
                        </li>
                    </ul>
                    <a href="<?php echo esc_url(home_url('/strength')); ?>" class="btn btn-primary">Learn More About Strength &rarr;</a>
                </div>

                <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 16px; box-shadow: 0 20px 40px rgba(0,0,0,0.5);">
                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--human-border-dark); padding-bottom: 1rem; flex-wrap: wrap;">
                        <div style="font-weight: 700; color: var(--human-white); font-size: 1.1rem;">Human Strength v1</div>
                        <?php echo human_get_status_badge($human_strength_status, 'strength'); ?>
                    </div>
                    <div style="font-family: var(--font-mono); font-size: 0.8rem; color: #64748B; margin-bottom: 1.25rem; word-break: break-all;">
                        App ID: <?php echo esc_html($human_strength_app['app_id']); ?><br>
                        Stack: Kotlin | Jetpack Compose | Room DB | Firebase
                    </div>
                    <div style="background: var(--human-dark-bg); border-radius: 8px; padding: 1.25rem; border: 1px solid var(--human-border-dark);">
                        <div style="font-size: 0.8rem; color: #94A3B8; margin-bottom: 0.25rem;">GOOGLE PLAY MEMBERSHIP</div>
                        <div style="font-size: 1.5rem; font-weight: 800; color: var(--human-white);">
                            <?php echo esc_html($human_strength_app['pricing']); ?>
                        </div>
                        <div style="font-size: 0.85rem; color: #94A3B8; margin-top: 0.25rem;">The Human V1 account trial is separate from paid Google Play membership.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PLATFORM GRID -->
    <section class="section-padding" style="background-color: var(--human-dark-surface); border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div style="text-align: center; max-width: 700px; margin: 0 auto 3rem;">
                <span class="eyebrow">THE HUMAN ECOSYSTEM</span>
                <h2 class="section-title">One Platform. Future Disciplines.</h2>
                <p style="color: #94A3B8; font-size: 1.05rem;">
                    Human Strength is the first product. The other applications below are future Human V1 products unless their status says otherwise; features and release timing remain unannounced.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
                <?php
                foreach ($human_apps as $app) :
                    $app_slug = isset($app['slug']) && is_scalar($app['slug']) ? sanitize_key((string) $app['slug']) : '';
                    $app_status = human_v1_get_app_status($app);
                    $app_target = isset($app['target_url']) && is_scalar($app['target_url']) ? trim((string) $app['target_url']) : '';
                    $app_label = isset($app['cta_label']) && is_scalar($app['cta_label']) ? trim((string) $app['cta_label']) : '';
                ?>
                    <div style="background: var(--human-dark-bg); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 1.5rem; transition: border-color 0.2s;" onmouseover="this.style.borderColor='var(--human-electric-blue)'" onmouseout="this.style.borderColor='var(--human-border-dark)'">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 0.5rem; margin-bottom: 1rem; flex-wrap: wrap;">
                            <h3 style="font-size: 1.15rem; color: var(--human-white);"><?php echo esc_html($app['title']); ?></h3>
                            <?php echo human_get_status_badge($app_status, $app_slug); ?>
                        </div>
                        <p style="font-size: 0.9rem; color: #94A3B8; margin-bottom: 1.25rem; line-height: 1.5;">
                            <?php echo esc_html($app['description']); ?>
                        </p>
                        <?php if ($app_target !== '') : ?>
                            <a href="<?php echo esc_url(home_url($app_target)); ?>" style="font-size: 0.85rem; font-weight: 600; color: var(--human-electric-blue);">
                                <?php echo esc_html($app_label !== '' ? $app_label : __('View Details', 'human-v1-theme')); ?> &rarr;
                            </a>
                        <?php else : ?>
                            <span style="font-size: 0.85rem; font-weight: 600; color: #64748B;">
                                <?php echo esc_html(human_v1_get_app_action($app)['label']); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ONTOLOGY FEATURE -->
    <section class="section-padding" style="border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div class="grid-2col">
                <div>
                    <span class="eyebrow">HUMAN ONTOLOGY PROGRAMME</span>
                    <h2 class="section-title">More Than An Exercise Library</h2>
                    <p style="font-size: 1.05rem; color: #94A3B8; margin-bottom: 1.25rem; line-height: 1.6;">
                        Human is building a structured exercise knowledge system designed to understand movements, equipment taxonomy, anatomical mechanics, relationships, substitutions, and training context across the entire Human platform.
                    </p>
                    <p style="font-size: 0.95rem; color: #64748B; margin-bottom: 2rem; line-height: 1.6;">
                        Our ambition is to build one of the world's most comprehensive structured exercise databases, providing the intelligence foundation for Human Strength, HIIT, Recovery, Coach, and beyond.
                    </p>
                    <a href="<?php echo esc_url(home_url('/ontology')); ?>" class="btn btn-secondary">Explore The Human Ontology &rarr;</a>
                </div>

                <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; font-family: var(--font-mono); font-size: 0.8rem; overflow-x: auto;">
                    <div style="color: var(--human-electric-blue); font-weight: 700; margin-bottom: 0.75rem;">// ONTOLOGY STRUCTURED KNOWLEDGE</div>
                    <div style="color: #94A3B8; line-height: 1.8; white-space: pre-wrap; word-break: break-word;">canonical_name: "Barbell Back Squat"
movement_pattern: "Squat / Knee Dominant"
plane_of_motion: "Sagittal"
primary_muscles: ["Quadriceps", "Gluteus Maximus"]
stabilisers: ["Erector Spinae", "Transverse Abdominis"]
spinal_loading: "High (Axial)"
substitutions: ["Goblet Squat", "Leg Press"]
relationships: ["Front Squat", "Overhead Squat"]</div>
                </div>
            </div>
        </div>
    </section>

    <!-- OFFLINE FIRST PHILOSOPHY -->
    <section class="section-padding" style="background-color: var(--human-dark-surface); text-align: center; border-bottom: 1px solid var(--human-border-dark);">
        <div class="container" style="max-width: 800px;">
            <span class="eyebrow">CORE PRODUCT PHILOSOPHY</span>
            <h2 class="section-title">Your Workout Should Not Depend On Signal</h2>
            <p style="font-size: 1.05rem; color: #94A3B8; margin-bottom: 2rem; line-height: 1.6;">
                Human Strength is designed around reliable local training. The Room database keeps workout logging responsive without a signal. Google Sign-In is required for account access, and cloud synchronisation is handled separately when the app is online.
            </p>
            <a href="<?php echo esc_url(home_url('/about')); ?>" class="btn btn-outline">Read Our Architecture Philosophy</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
