<?php
/**
 * Template Name: Terms of Service
 */
if (!defined('ABSPATH')) {
    exit;
}

$options = wp_parse_args(get_option('human_options', array()), function_exists('human_get_default_options') ? human_get_default_options() : array());
$operator_name = !empty($options['operator_legal_name']) ? $options['operator_legal_name'] : '';
$public_email = !empty($options['public_contact_email']) && is_email($options['public_contact_email'])
    ? $options['public_contact_email']
    : '';
$review_date = !empty($options['terms_review_date']) && function_exists('human_validate_review_date') && human_validate_review_date($options['terms_review_date']) !== false
    ? $options['terms_review_date']
    : '';

get_header();
?>

<main class="site-main section-padding">
    <div class="container" style="max-width: 800px;">
        <span class="eyebrow">TERMS & CONDITIONS</span>
        <h1 class="display-title" style="margin-bottom: 1.5rem;">Terms of Use</h1>
        <?php if ($review_date): ?>
        <p style="color: #64748B; font-family: var(--font-mono); font-size: 0.85rem; margin-bottom: 2rem;">
            Last reviewed: <?php echo esc_html($review_date); ?> | Domain: humanv1.com
        </p>
        <?php endif; ?>

        <div style="color: #94A3B8; font-size: 0.95rem; line-height: 1.7; display: flex; flex-direction: column; gap: 1.5rem;">
            <?php if ($operator_name): ?>
                <p>humanv1.com and Human Strength are operated by <strong><?php echo esc_html($operator_name); ?></strong>.</p>
            <?php else: ?>
                <p>Human V1 is the platform behind Human Strength and future Human applications. Human V1 is currently operated independently and has not yet been incorporated as a separate legal entity.</p>
            <?php endif; ?>

            <h2 style="color: var(--human-white); font-size: 1.35rem;">1. Human Strength Availability</h2>
            <p>
                Human Strength is currently in Google Play Internal Testing. Testing access is limited to eligible or invited testers and may change as the product develops.
            </p>

            <h2 style="color: var(--human-white); font-size: 1.35rem;">2. Account Access and Paid Membership</h2>
            <p>
                Human V1 introductory account access is separate from a paid Google Play membership and does not automatically create or renew a paid subscription. A paid Human Strength membership requires an active purchase through Google Play when offered. Google Play manages the transaction, displayed price, renewal, cancellation, and applicable refund process.
            </p>

            <h2 style="color: var(--human-white); font-size: 1.35rem;">3. Training Information</h2>
            <p>
                Human Strength provides training tracking and exercise information. Strength training involves physical exertion and risk. Use appropriate judgement for your circumstances and seek qualified professional advice when needed.
            </p>

            <h2 style="color: var(--human-white); font-size: 1.35rem;">4. Future Human V1 Products</h2>
            <p>
                References to future Human V1 applications describe current roadmap intentions and are not promises of particular features, release dates, or availability.
            </p>

            <h2 style="color: var(--human-white); font-size: 1.35rem;">5. Contact</h2>
            <p>
                <?php if ($public_email): ?>
                    Terms enquiries: <a href="mailto:<?php echo esc_attr($public_email); ?>" style="color: var(--human-electric-blue);"><?php echo esc_html($public_email); ?></a>.
                <?php else: ?>
                    Use the <a href="<?php echo esc_url(home_url('/contact/')); ?>" style="color: var(--human-electric-blue);">Contact page</a> for enquiries.
                <?php endif; ?>
            </p>
        </div>
    </div>
</main>

<?php get_footer(); ?>
