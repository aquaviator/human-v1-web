<?php
/**
 * Template Name: Contact Page
 */
if (!defined('ABSPATH')) {
    exit;
}

$options = wp_parse_args(get_option('human_options', array()), function_exists('human_get_default_options') ? human_get_default_options() : array());
$public_email = !empty($options['public_contact_email']) && is_email($options['public_contact_email'])
    ? $options['public_contact_email']
    : (!empty($options['contact_email']) && is_email($options['contact_email']) ? $options['contact_email'] : '');
$support_email = !empty($options['support_contact_email']) && is_email($options['support_contact_email'])
    ? $options['support_contact_email']
    : (!empty($options['support_email']) && is_email($options['support_email']) ? $options['support_email'] : '');

get_header();
?>

<main class="site-main section-padding">
    <div class="container" style="max-width: 800px;">
        <span class="eyebrow">GET IN TOUCH</span>
        <h1 class="display-title" style="margin-bottom: 1.5rem;">Contact Human V1</h1>
        <p style="font-size: clamp(1rem, 2.5vw, 1.1rem); color: #94A3B8; margin-bottom: 2.5rem; line-height: 1.6;">
            Contact Human V1 about the platform, Human Strength, support, or general enquiries.
        </p>

        <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 16px;">
            <div class="grid-2col">
                <?php if ($public_email): ?>
                <div>
                    <h3 style="color: var(--human-white); font-size: 1.1rem; margin-bottom: 0.5rem;">General Enquiries</h3>
                    <p style="color: #94A3B8; font-size: 0.95rem;">
                        <a href="mailto:<?php echo esc_attr($public_email); ?>" style="color: var(--human-electric-blue);"><?php echo esc_html($public_email); ?></a>
                    </p>
                </div>
                <?php endif; ?>

                <?php if ($support_email): ?>
                <div>
                    <h3 style="color: var(--human-white); font-size: 1.1rem; margin-bottom: 0.5rem;">Human Strength Support</h3>
                    <p style="color: #94A3B8; font-size: 0.95rem;">
                        <a href="mailto:<?php echo esc_attr($support_email); ?>" style="color: var(--human-electric-blue);"><?php echo esc_html($support_email); ?></a>
                    </p>
                </div>
                <?php endif; ?>
            </div>

            <?php if (!$public_email && !$support_email): ?>
                <p style="color: #94A3B8; font-size: 0.95rem;">Contact channels are being verified. Please check this page again before sending a request.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
