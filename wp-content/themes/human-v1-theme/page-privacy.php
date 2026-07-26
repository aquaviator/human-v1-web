<?php
/**
 * Template Name: Privacy Policy
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<main class="site-main" style="padding: 5rem 0;">
    <div class="container" style="max-width: 800px;">
        <span class="eyebrow">LEGAL COMPLIANCE</span>
        <h1 class="display-title" style="margin-bottom: 1.5rem;">Privacy Policy</h1>
        <p style="color: #64748B; font-family: var(--font-mono); font-size: 0.9rem; margin-bottom: 2.5rem;">
            Effective Date: July 26, 2026 | Domain: humanv1.com
        </p>

        <div style="color: #94A3B8; font-size: 1rem; line-height: 1.7; display: flex; flex-direction: column; gap: 1.75rem;">
            <p>
                Human Performance Technology ("Human", "we", "our") respects your privacy. This Privacy Policy describes how we collect, store, and process data across humanv1.com and the Human application ecosystem, including Human Strength (App ID: <code>com.aistudio.humanstrength.kfqjza</code>).
            </p>

            <h2 style="color: var(--human-white); font-size: 1.35rem;">1. Local Storage First</h2>
            <p>
                Human Strength is built as an offline-first mobile application using Android Room local database. Your training routines, logged workouts, sets, reps, weight measurements, and personal records are stored locally on your device.
            </p>

            <h2 style="color: var(--human-white); font-size: 1.35rem;">2. Optional Cloud Identity & Firebase</h2>
            <p>
                A Firebase account is optional. If you choose to enable cloud backup or sync across devices, your account email and encrypted training logs are synced securely using Firebase Authentication and Firestore.
            </p>

            <h2 style="color: var(--human-white); font-size: 1.35rem;">3. Billing & Google Play Purchases</h2>
            <p>
                All subscription purchases (including the £24/year annual access after introductory trial) are processed exclusively through Google Play Billing APIs. We do not store, process, or transmit credit card details.
            </p>

            <h2 style="color: var(--human-white); font-size: 1.35rem;">4. Retention & User Rights</h2>
            <p>
                You maintain complete control over your training records. Expired subscriptions do not erase your stored workouts or measurements. You may delete local data directly via app settings or request cloud record deletion.
            </p>

            <h2 style="color: var(--human-white); font-size: 1.35rem;">5. Contact Information</h2>
            <p>
                For privacy requests or questions regarding data processing, contact us at <code>privacy@humanv1.com</code>.
            </p>
        </div>
    </div>
</main>

<?php get_footer(); ?>
