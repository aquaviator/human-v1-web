<?php
/**
 * Template Name: Human Strength Marketing Page
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<main class="site-main">
    <!-- HERO -->
    <section style="padding: 3rem 0 4rem; background: linear-gradient(180deg, rgba(0,102,255,0.18) 0%, rgba(10,13,16,1) 100%); border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div style="border-radius: 20px; overflow: hidden; border: 1px solid var(--human-border-dark); box-shadow: 0 25px 60px rgba(0, 102, 255, 0.25); margin-bottom: 3rem;">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/hv1-banner.svg'); ?>" alt="Human V1 Strength Official Banner" style="width: 100%; height: auto; display: block;">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center;">
                <div>
                    <div style="display: flex; gap: 0.75rem; align-items: center; margin-bottom: 1rem;">
                        <span class="eyebrow" style="margin-bottom:0;">ANDROID APPLICATION</span>
                    <?php echo human_get_status_badge('AVAILABLE'); ?>
                </div>
                <h1 class="display-title" style="margin-bottom: 1.25rem;">Human Strength</h1>
                <p style="font-size: 1.2rem; color: #94A3B8; margin-bottom: 2rem;">
                    A serious strength-training product designed to become part of a broader Human performance ecosystem. Built for total local reliability with deep progression tracking.
                </p>
                <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                    <a href="#google-play" class="btn btn-primary" style="padding: 0.9rem 1.8rem;">
                        Get On Google Play
                    </a>
                    <span style="color: #64748B; font-size: 0.9rem; font-family: var(--font-mono);">
                        App ID: com.aistudio.humanstrength.kfqjza
                    </span>
                </div>
            </div>

            <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 16px; padding: 2rem;">
                <h3 style="font-size: 1.1rem; color: var(--human-white); margin-bottom: 1rem;">Commercial Subscription Model</h3>
                <div style="background: var(--human-dark-bg); border-radius: 8px; padding: 1.5rem; border: 1px solid var(--human-border-dark); margin-bottom: 1.25rem;">
                    <div style="font-size: 0.85rem; color: #94A3B8; text-transform: uppercase;">Introductory Trial</div>
                    <div style="font-size: 1.5rem; font-weight: 800; color: var(--human-white); margin: 0.25rem 0;">~30 Days Full Access</div>
                    <div style="font-size: 0.85rem; color: #10B981;">No initial charge. Test every feature in real training.</div>
                </div>
                <div style="background: var(--human-dark-bg); border-radius: 8px; padding: 1.5rem; border: 1px solid var(--human-border-dark);">
                    <div style="font-size: 0.85rem; color: #94A3B8; text-transform: uppercase;">Annual Subscription</div>
                    <div style="font-size: 1.5rem; font-weight: 800; color: var(--human-white); margin: 0.25rem 0;">£24 / Year</div>
                    <div style="font-size: 0.85rem; color: #94A3B8;">Single entitlement. Subscription expiry never erases your workouts, sets, routines, or measurements.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CORE FEATURE AREAS -->
    <section style="padding: 5rem 0; border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
                <span class="eyebrow">BUILT FOR ATHLETES & LIFTERS</span>
                <h2 class="section-title">Core Strength Features</h2>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); padding: 2rem; border-radius: 12px;">
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; color: var(--human-white);">Structured Routines</h3>
                    <p style="color: #94A3B8; font-size: 0.95rem;">
                        Build custom workout routines with supersets, target rep ranges, RPE targets, and configurable rest timers.
                    </p>
                </div>

                <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); padding: 2rem; border-radius: 12px;">
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; color: var(--human-white);">Live Workout Logging</h3>
                    <p style="color: #94A3B8; font-size: 0.95rem;">
                        Manual set logging, automatic rest timer notifications, live 1RM estimations, and set completions with kg/lb unit conversion.
                    </p>
                </div>

                <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); padding: 2rem; border-radius: 12px;">
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; color: var(--human-white);">Volume & Progress Analytics</h3>
                    <p style="color: #94A3B8; font-size: 0.95rem;">
                        Track total tonnage, muscle group volume distribution, estimated 1RM progression curves, personal records, and body measurements over time.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- GOOGLE PLAY SECTION -->
    <section id="google-play" style="padding: 5rem 0; background: var(--human-dark-surface); text-align: center;">
        <div class="container" style="max-width: 700px;">
            <span class="eyebrow">GET HUMAN STRENGTH</span>
            <h2 class="section-title">Start Your 30-Day Introductory Trial</h2>
            <p style="color: #94A3B8; font-size: 1.1rem; margin-bottom: 2rem;">
                Available for Android devices on Google Play. Requires Android 8.0 or higher.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; align-items: center;">
                <a href="https://play.google.com/store/apps/details?id=com.aistudio.humanstrength.kfqjza" target="_blank" rel="noopener noreferrer" class="btn btn-primary" style="padding: 1rem 2rem; font-size: 1.1rem;">
                    Download on Google Play
                </a>
            </div>
            <p style="font-size: 0.85rem; color: #64748B; margin-top: 1.5rem; font-family: var(--font-mono);">
                Application ID: com.aistudio.humanstrength.kfqjza
            </p>
        </div>
    </section>
</main>

<?php get_footer(); ?>
