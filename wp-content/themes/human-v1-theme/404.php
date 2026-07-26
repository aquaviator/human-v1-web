<?php
/**
 * 404 Error Template (404.php)
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<main class="site-main section-padding" style="min-height: 60vh; display: flex; align-items: center;">
    <div class="container" style="text-align: center; max-width: 600px;">
        <span class="eyebrow" style="color: var(--human-error);">404 — PAGE NOT FOUND</span>
        <h1 class="display-title" style="margin: 1rem 0;">Lost Your Training Path?</h1>
        <p style="color: #94A3B8; font-size: 1.05rem; margin-bottom: 2rem; line-height: 1.6;">
            The page or route you are looking for does not exist on humanv1.com. Explore our core platform modules below.
        </p>
        <div class="btn-group" style="justify-content: center;">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">Return to Homepage</a>
            <a href="<?php echo esc_url(home_url('/strength')); ?>" class="btn btn-secondary">Human Strength</a>
            <a href="<?php echo esc_url(home_url('/journal')); ?>" class="btn btn-outline">Human Journal</a>
        </div>
    </div>
</main>

<?php get_footer(); ?>
