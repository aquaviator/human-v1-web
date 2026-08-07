<?php
/**
 * Template Name: Privacy Policy
 */
if (!defined('ABSPATH')) {
    exit;
}

$options = wp_parse_args(get_option('human_options', array()), function_exists('human_get_default_options') ? human_get_default_options() : array());
$operator_name = !empty($options['operator_legal_name']) ? $options['operator_legal_name'] : '';
$operator_capacity = !empty($options['operator_capacity']) ? $options['operator_capacity'] : '';
$privacy_email = !empty($options['privacy_contact_email']) && is_email($options['privacy_contact_email'])
    ? $options['privacy_contact_email']
    : '';
$review_date = !empty($options['privacy_review_date']) && function_exists('human_validate_review_date') && human_validate_review_date($options['privacy_review_date']) !== false
    ? $options['privacy_review_date']
    : '';

$capacity_labels = array(
    'individual' => 'individual operator',
    'sole_trader' => 'sole trader',
    'incorporated_entity' => 'incorporated entity',
    'other' => 'operator',
);

get_header();
?>

<main class="site-main section-padding">
    <div class="container" style="max-width: 800px;">
        <span class="eyebrow">PRIVACY</span>
        <h1 class="display-title" style="margin-bottom: 1.5rem;">Privacy Policy</h1>
        <?php if ($review_date): ?>
        <p style="color: #64748B; font-family: var(--font-mono); font-size: 0.85rem; margin-bottom: 2rem;">
            Last reviewed: <?php echo esc_html($review_date); ?> | Domain: humanv1.com
        </p>
        <?php endif; ?>

        <div style="color: #94A3B8; font-size: 0.95rem; line-height: 1.7; display: flex; flex-direction: column; gap: 1.5rem;">
            <?php if ($operator_name): ?>
                <p>
                    For data-protection purposes, the operator is <strong><?php echo esc_html($operator_name); ?></strong><?php
                    if ($operator_capacity && isset($capacity_labels[$operator_capacity])) {
                        echo ', acting as ' . esc_html($capacity_labels[$operator_capacity]);
                    }
                    ?>.
                </p>
            <?php else: ?>
                <p>
                    Human V1 is the platform behind Human Strength and future Human applications. Human V1 is currently operated independently and has not yet been incorporated as a separate legal entity.
                </p>
            <?php endif; ?>

            <p>
                This policy explains the current known handling of information through humanv1.com and Human Strength. Website processing and Android application processing are separate contexts.
            </p>

            <h2 style="color: var(--human-white); font-size: 1.35rem;">1. Human Strength Local Data</h2>
            <p>
                Human Strength uses an Android Room database for local workout information. Training routines, logged workouts, sets, repetitions, weight measurements, and personal records may be stored locally on the device.
            </p>

            <h2 style="color: var(--human-white); font-size: 1.35rem;">2. Human V1 Account and Cloud Services</h2>
            <p>
                Google Sign-In is required for Human V1 account access. Firebase Authentication is used for account authentication and Firestore is used for cloud-backed account or synchronisation functions where implemented. Information handled through these services may include account identifiers and workout-related information required for those functions.
            </p>

            <h2 style="color: var(--human-white); font-size: 1.35rem;">3. Google Play Membership</h2>
            <p>
                Paid Human Strength membership transactions are handled through Google Play. Human V1 does not receive or store your full payment-card details. Human V1 introductory account access is separate from a paid Google Play membership.
            </p>

            <h2 style="color: var(--human-white); font-size: 1.35rem;">4. Retention, Access and Deletion</h2>
            <p>
                Retention depends on the type of information and the service involved. This policy does not promise permanent retention or immediate deletion. You can clear local Android app storage separately from requesting deletion of your Human V1 account and eligible cloud data. See the <a href="<?php echo esc_url(home_url('/data-deletion/')); ?>" style="color: var(--human-electric-blue);">Data Deletion page</a> for current options.
            </p>

            <h2 style="color: var(--human-white); font-size: 1.35rem;">5. Your Rights and Contact</h2>
            <p>
                You may contact the operator about access, correction, deletion, objection, restriction, portability, or other applicable data-protection rights. You may also have the right to complain to the UK Information Commissioner's Office.
            </p>
            <p>
                <?php if ($privacy_email): ?>
                    Privacy enquiries: <a href="mailto:<?php echo esc_attr($privacy_email); ?>" style="color: var(--human-electric-blue);"><?php echo esc_html($privacy_email); ?></a>.
                <?php else: ?>
                    Use the <a href="<?php echo esc_url(home_url('/contact/')); ?>" style="color: var(--human-electric-blue);">Contact page</a> for privacy enquiries while the dedicated privacy contact is being verified.
                <?php endif; ?>
            </p>
        </div>
    </div>
</main>

<?php get_footer(); ?>
