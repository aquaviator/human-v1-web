<?php
/**
 * Template Name: Customer Support & Help
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<main class="site-main section-padding">
    <div class="container" style="max-width: 900px;">
        <span class="eyebrow">HELP & CUSTOMER SUPPORT</span>
        <h1 class="display-title" style="margin-bottom: 1.5rem;">Human Platform Support</h1>
        <p style="font-size: clamp(1rem, 2.5vw, 1.2rem); color: #94A3B8; margin-bottom: 2.5rem; line-height: 1.6;">
            Find answers regarding Human Strength, subscription management via Google Play, data sync, and account options.
        </p>

        <div style="display: grid; gap: 1.5rem;">
            <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px;">
                <h3 style="color: var(--human-white); font-size: 1.2rem; margin-bottom: 0.75rem;">How do I manage or cancel my subscription?</h3>
                <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6;">
                    Human Strength subscriptions are handled directly through Google Play. To view, update, or cancel your subscription, open the Google Play Store app on your Android device, tap your profile icon &gt; Payments &amp; Subscriptions &gt; Subscriptions.
                </p>
            </div>

            <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px;">
                <h3 style="color: var(--human-white); font-size: 1.2rem; margin-bottom: 0.75rem;">What happens if my subscription expires?</h3>
                <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6;">
                    Your data is safe. Expiration does NOT erase your logged workouts, routines, sets, body measurements, or settings. You retain full access to view your historical data and export local records.
                </p>
            </div>

            <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px;">
                <h3 style="color: var(--human-white); font-size: 1.2rem; margin-bottom: 0.75rem;">How do I request account or data deletion?</h3>
                <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6;">
                    Visit our dedicated <a href="<?php echo esc_url(home_url('/data-deletion')); ?>" style="color: var(--human-electric-blue);">Data Deletion Page</a> for step-by-step instructions on deleting your local Room database or optional Firebase cloud profile.
                </p>
            </div>

            <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; text-align: center;">
                <h3 style="color: var(--human-white); font-size: 1.2rem; margin-bottom: 0.75rem;">Need additional help?</h3>
                <p style="color: #94A3B8; font-size: 0.95rem; margin-bottom: 1.5rem;">Our technical support team responds within 24 business hours.</p>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary">Contact Support Team</a>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
