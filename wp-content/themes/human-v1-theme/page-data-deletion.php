<?php
/**
 * Template Name: Data Deletion Instructions
 */
if (!defined('ABSPATH')) {
    exit;
}

$options = wp_parse_args(get_option('human_options', array()), function_exists('human_get_default_options') ? human_get_default_options() : array());
$deletion_email = '';
if (!empty($options['support_contact_email']) && is_email($options['support_contact_email'])) {
    $deletion_email = $options['support_contact_email'];
} elseif (!empty($options['privacy_contact_email']) && is_email($options['privacy_contact_email'])) {
    $deletion_email = $options['privacy_contact_email'];
} elseif (!empty($options['support_email']) && is_email($options['support_email'])) {
    $deletion_email = $options['support_email'];
}

get_header();
?>

<main class="site-main section-padding">
    <div class="container" style="max-width: 800px;">
        <span class="eyebrow">DATA & ACCOUNT CONTROL</span>
        <h1 class="display-title" style="margin-bottom: 1.5rem;">Data & Account Deletion</h1>
        <p style="font-size: clamp(1rem, 2.5vw, 1.1rem); color: #94A3B8; margin-bottom: 2.5rem; line-height: 1.6;">
            Local app data, Human V1 account data, and Google Play membership are separate. Use the appropriate route for what you want to remove or manage.
        </p>

        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px;">
                <h3 style="color: var(--human-white); margin-bottom: 0.75rem;">1. Clear Local Android App Data</h3>
                <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6;">
                    Android provides device-level controls to clear Human Strength app storage. Clearing local storage removes data held by the app on that device; it is not the same as requesting deletion of your Human V1 account or cloud data.
                </p>
            </div>

            <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px;">
                <h3 style="color: var(--human-white); margin-bottom: 0.75rem;">2. Request Human V1 Account and Cloud Data Deletion</h3>
                <?php if ($deletion_email): ?>
                    <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6;">
                        Send a deletion request from the email associated with your Human V1 account to
                        <a href="mailto:<?php echo esc_attr($deletion_email); ?>?subject=Human%20V1%20Account%20Deletion%20Request" style="color: var(--human-electric-blue);"><?php echo esc_html($deletion_email); ?></a>.
                        The operational deletion process is still subject to internal verification; this page does not promise an immediate completion time or deletion from backups.
                    </p>
                <?php else: ?>
                    <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6;">
                        Use the <a href="<?php echo esc_url(home_url('/contact/')); ?>" style="color: var(--human-electric-blue);">Contact page</a> to request account and cloud-data deletion.
                    </p>
                <?php endif; ?>
            </div>

            <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px;">
                <h3 style="color: var(--human-white); margin-bottom: 0.75rem;">3. Manage Google Play Membership</h3>
                <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6;">
                    Account or data deletion is separate from Google Play billing. Manage or cancel an active paid membership through Google Play.
                </p>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
