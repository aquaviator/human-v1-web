<?php
/**
 * Template Name: Human Strength Marketing Page
 */
if (!defined('ABSPATH')) {
    exit;
}

$human_strength_app = human_v1_find_app('strength');
$human_strength_status = human_v1_get_app_status($human_strength_app);
$human_strength_action = human_v1_get_app_action($human_strength_app);
$human_strength_app_id = isset($human_strength_app['app_id']) && is_scalar($human_strength_app['app_id'])
    ? trim((string) $human_strength_app['app_id'])
    : '';
$human_strength_pricing = isset($human_strength_app['pricing']) && is_scalar($human_strength_app['pricing'])
    ? trim((string) $human_strength_app['pricing'])
    : '';
get_header();
?>

<main class="site-main">
    <!-- Breadcrumb Navigation -->
    <div class="container pt-8 pb-0">
        <?php if (function_exists('human_render_breadcrumbs')) human_render_breadcrumbs(); ?>
    </div>
    <!-- HERO -->
    <section class="section-padding" style="background: linear-gradient(180deg, rgba(0,102,255,0.18) 0%, rgba(10,13,16,1) 100%); border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div style="border-radius: 20px; overflow: hidden; border: 1px solid var(--human-border-dark); box-shadow: 0 25px 60px rgba(0, 102, 255, 0.25); margin-bottom: 2.5rem;">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/hv1-banner.svg'); ?>" alt="Human V1 Strength Official Banner" style="width: 100%; height: auto; display: block;">
            </div>

            <div class="grid-2col">
                <div>
                    <div style="display: flex; gap: 0.75rem; align-items: center; margin-bottom: 1rem; flex-wrap: wrap;">
                        <span class="eyebrow" style="margin-bottom:0;">ANDROID APPLICATION</span>
                        <?php echo human_get_status_badge($human_strength_status, 'strength'); ?>
                    </div>
                    <h1 class="display-title" style="margin-bottom: 1.25rem;">Human Strength</h1>
                    <p style="font-size: clamp(1rem, 2.5vw, 1.2rem); color: #94A3B8; margin-bottom: 2rem; line-height: 1.6;">
                        A serious strength-training product designed to become part of a broader Human performance ecosystem. Built for total local reliability with deep progression tracking.
                    </p>
                    <div class="btn-group">
                        <?php if ($human_strength_action['enabled']) : ?>
                            <a href="<?php echo esc_url($human_strength_action['url']); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                                <?php echo esc_html($human_strength_action['label']); ?>
                            </a>
                        <?php else : ?>
                            <span class="btn btn-primary" aria-disabled="true" style="opacity: 0.65; cursor: default;">
                                <?php echo esc_html($human_strength_action['label']); ?>
                            </span>
                        <?php endif; ?>
                        <span style="color: #64748B; font-size: 0.85rem; font-family: var(--font-mono); word-break: break-all;">
                            App ID: <?php echo esc_html($human_strength_app_id); ?>
                        </span>
                    </div>
                </div>

                <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 16px;">
                    <h3 style="font-size: 1.1rem; color: var(--human-white); margin-bottom: 1rem;">Access and Membership</h3>
                    <div style="background: var(--human-dark-bg); border-radius: 8px; padding: 1.25rem; border: 1px solid var(--human-border-dark); margin-bottom: 1rem;">
                        <div style="font-size: 0.8rem; color: #94A3B8; text-transform: uppercase;">Human V1 Account Access</div>
                        <div style="font-size: 1.35rem; font-weight: 800; color: var(--human-white); margin: 0.25rem 0;">Account Trial</div>
                        <div style="font-size: 0.85rem; color: #94A3B8;">The Human V1 account trial is separate from any paid Google Play membership.</div>
                    </div>
                    <div style="background: var(--human-dark-bg); border-radius: 8px; padding: 1.25rem; border: 1px solid var(--human-border-dark);">
                        <div style="font-size: 0.8rem; color: #94A3B8; text-transform: uppercase;">Google Play Membership</div>
                        <div style="font-size: 1.35rem; font-weight: 800; color: var(--human-white); margin: 0.25rem 0;">
                            <?php echo esc_html($human_strength_pricing !== '' ? $human_strength_pricing : __('Pricing not currently published', 'human-v1-theme')); ?>
                        </div>
                        <div style="font-size: 0.85rem; color: #94A3B8;">Paid membership requires a separate Google Play purchase when offered.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CORE FEATURE AREAS -->
    <section class="section-padding" style="border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div style="text-align: center; max-width: 700px; margin: 0 auto 3rem;">
                <span class="eyebrow">BUILT FOR ATHLETES & LIFTERS</span>
                <h2 class="section-title">Core Strength Features</h2>
            </div>

            <div class="grid-3col">
                <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px;">
                    <h3 style="font-size: 1.15rem; margin-bottom: 0.75rem; color: var(--human-white);">Structured Routines</h3>
                    <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6;">
                        Build custom workout routines with supersets, target rep ranges, RPE targets, and configurable rest timers.
                    </p>
                </div>

                <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px;">
                    <h3 style="font-size: 1.15rem; margin-bottom: 0.75rem; color: var(--human-white);">Live Workout Logging</h3>
                    <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6;">
                        Manual set logging, automatic rest timer notifications, live 1RM estimations, and set completions with kg/lb unit conversion.
                    </p>
                </div>

                <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px;">
                    <h3 style="font-size: 1.15rem; margin-bottom: 0.75rem; color: var(--human-white);">Volume & Progress Analytics</h3>
                    <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6;">
                        Track total tonnage, muscle group volume distribution, estimated 1RM progression curves, personal records, and body measurements over time.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- PRODUCT ACCESS SECTION -->
    <section id="access" class="section-padding" style="background: var(--human-dark-surface); text-align: center;">
        <div class="container" style="max-width: 700px;">
            <?php if ($human_strength_status === 'available' && $human_strength_action['enabled']) : ?>
                <span class="eyebrow">GET HUMAN STRENGTH</span>
                <h2 class="section-title">Human Strength on Google Play</h2>
            <?php elseif ($human_strength_status === 'available') : ?>
                <span class="eyebrow">HUMAN STRENGTH</span>
                <h2 class="section-title">Release Access</h2>
            <?php elseif ($human_strength_status === 'internal_testing') : ?>
                <span class="eyebrow">HUMAN STRENGTH TESTING</span>
                <h2 class="section-title">Internal Testing</h2>
            <?php elseif ($human_strength_status === 'coming_soon') : ?>
                <span class="eyebrow">HUMAN STRENGTH</span>
                <h2 class="section-title">Coming Soon</h2>
            <?php elseif ($human_strength_status === 'paused') : ?>
                <span class="eyebrow">HUMAN STRENGTH</span>
                <h2 class="section-title">Currently Paused</h2>
            <?php elseif ($human_strength_status === 'retired') : ?>
                <span class="eyebrow">HUMAN STRENGTH</span>
                <h2 class="section-title">Retired</h2>
            <?php else : ?>
                <span class="eyebrow">HUMAN STRENGTH</span>
                <h2 class="section-title">Future Product</h2>
            <?php endif; ?>
            <p style="color: #94A3B8; font-size: 1.05rem; margin-bottom: 2rem; line-height: 1.6;">
                <?php if ($human_strength_status === 'available' && $human_strength_action['enabled']) : ?>
                    Use the verified Google Play listing below to view the currently published Android release.
                <?php elseif ($human_strength_status === 'internal_testing') : ?>
                    Access is limited to eligible invited testers. A test link is shown only when a verified internal-testing URL is configured.
                <?php else : ?>
                    Public download access is not currently available for this product lifecycle stage.
                <?php endif; ?>
            </p>
            <div class="btn-group" style="justify-content: center;">
                <?php if ($human_strength_action['enabled']) : ?>
                    <a href="<?php echo esc_url($human_strength_action['url']); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                        <?php echo esc_html($human_strength_action['label']); ?>
                    </a>
                <?php else : ?>
                    <span class="btn btn-primary" aria-disabled="true" style="opacity: 0.65; cursor: default;">
                        <?php echo esc_html($human_strength_action['label']); ?>
                    </span>
                <?php endif; ?>
            </div>
            <p style="font-size: 0.8rem; color: #64748B; margin-top: 1.5rem; font-family: var(--font-mono); word-break: break-all;">
                Application ID: <?php echo esc_html($human_strength_app_id); ?>
            </p>
        </div>
    </section>
</main>

<?php get_footer(); ?>
