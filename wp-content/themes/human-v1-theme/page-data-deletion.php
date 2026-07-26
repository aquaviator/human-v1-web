<?php
/**
 * Template Name: Data Deletion Instructions
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<main class="site-main section-padding">
    <div class="container" style="max-width: 800px;">
        <span class="eyebrow">GOOGLE PLAY COMPLIANCE</span>
        <h1 class="display-title" style="margin-bottom: 1.5rem;">Data & Account Deletion</h1>
        <p style="font-size: clamp(1rem, 2.5vw, 1.1rem); color: #94A3B8; margin-bottom: 2.5rem; line-height: 1.6;">
            Instructions for deleting your local database, cloud account, and personal training data from Human apps.
        </p>

        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px;">
                <h3 style="color: var(--human-white); margin-bottom: 0.75rem;">1. Deleting Local App Data (Android)</h3>
                <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6;">
                    Because Human Strength operates on an offline-first Room database, you can erase all local workout logs, routines, and measurements instantly by opening Android Settings &gt; Apps &gt; Human Strength &gt; Storage &gt; Clear Storage / Clear Data.
                </p>
            </div>

            <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px;">
                <h3 style="color: var(--human-white); margin-bottom: 0.75rem;">2. Deleting Cloud Account & Firestore Sync</h3>
                <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1rem;">
                    If you created an optional Firebase cloud sync account, you can request full cloud record deletion:
                </p>
                <ul style="color: #94A3B8; font-size: 0.95rem; padding-left: 1.25rem; display: flex; flex-direction: column; gap: 0.5rem;">
                    <li>Open Human Strength &gt; Settings &gt; Profile &gt; Delete Account.</li>
                    <li>Alternatively, send an email from your registered account email to <code style="word-break: break-all;">support@humanv1.com</code> with subject "Cloud Account Deletion Request".</li>
                </ul>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
