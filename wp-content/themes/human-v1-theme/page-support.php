<?php
/**
 * Template Name: Customer Support & Help
 */
if (!defined('ABSPATH')) {
    exit;
}

$options = wp_parse_args(get_option('human_options', array()), function_exists('human_get_default_options') ? human_get_default_options() : array());
$support_email = !empty($options['support_contact_email']) && is_email($options['support_contact_email'])
    ? $options['support_contact_email']
    : (!empty($options['support_email']) && is_email($options['support_email']) ? $options['support_email'] : '');

get_header();
?>

<main class="site-main section-padding">
    <div class="container" style="max-width: 900px;">
        <span class="eyebrow">HELP & SUPPORT</span>
        <h1 class="display-title" style="margin-bottom: 1.5rem;">Human V1 Support</h1>
        <p style="font-size: clamp(1rem, 2.5vw, 1.2rem); color: #94A3B8; margin-bottom: 2.5rem; line-height: 1.6;">
            Help with Human Strength, Google Play membership management, account access, and data requests.
        </p>

        <div style="display: grid; gap: 1.5rem;">
            <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px;">
                <h3 style="color: var(--human-white); font-size: 1.2rem; margin-bottom: 0.75rem;">What is the current availability of Human Strength?</h3>
                <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6;">
                    Human Strength is currently in Google Play Internal Testing. Access is limited to eligible or invited testers.
                </p>
            </div>

            <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px;">
                <h3 style="color: var(--human-white); font-size: 1.2rem; margin-bottom: 0.75rem;">How does account access relate to Google Play membership?</h3>
                <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6;">
                    Google Sign-In is required for Human V1 account access. Introductory Human V1 account access is separate from a paid Google Play membership and does not automatically create a paid subscription.
                </p>
            </div>

            <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px;">
                <h3 style="color: var(--human-white); font-size: 1.2rem; margin-bottom: 0.75rem;">How do I manage a Google Play membership?</h3>
                <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6;">
                    Google Play manages paid membership transactions. Use the subscriptions section of Google Play to view or manage an active membership.
                </p>
            </div>

            <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px;">
                <h3 style="color: var(--human-white); font-size: 1.2rem; margin-bottom: 0.75rem;">How do I request account or data deletion?</h3>
                <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6;">
                    See the <a href="<?php echo esc_url(home_url('/data-deletion/')); ?>" style="color: var(--human-electric-blue);">Data Deletion page</a> for the current verified options.
                </p>
            </div>

            <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; text-align: center;">
                <h3 style="color: var(--human-white); font-size: 1.2rem; margin-bottom: 0.75rem;">Need additional help?</h3>
                <?php if ($support_email): ?>
                    <p style="color: #94A3B8; font-size: 0.95rem; margin-bottom: 1.5rem;">
                        Email <a href="mailto:<?php echo esc_attr($support_email); ?>" style="color: var(--human-electric-blue);"><?php echo esc_html($support_email); ?></a>.
                    </p>
                <?php else: ?>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Contact Human V1</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
