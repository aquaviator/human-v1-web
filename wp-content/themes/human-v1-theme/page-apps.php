<?php
/**
 * Template Name: Human Apps Catalogue
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>

<main class="site-main section-padding">
    <div class="container">
        <!-- Breadcrumb Navigation -->
        <?php if (function_exists('human_render_breadcrumbs')) human_render_breadcrumbs(); ?>

        <div style="text-align: center; max-width: 800px; margin: 0 auto 3rem;">
            <span class="eyebrow">HUMAN ECOSYSTEM CATALOGUE</span>
            <h1 class="display-title" style="margin-bottom: 1rem;">Human Platform Apps</h1>
            <p style="font-size: clamp(1rem, 2.5vw, 1.2rem); color: #94A3B8; line-height: 1.6;">
                Human Strength is the first Human V1 product. The other applications listed here are future products unless their status says otherwise; features and release timing remain unannounced.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
            <?php
            $apps = function_exists('human_get_canonical_apps') ? human_get_canonical_apps() : array();
            foreach ($apps as $app) :
                $app_slug = isset($app['slug']) && is_scalar($app['slug']) ? sanitize_key((string) $app['slug']) : '';
                $app_status = human_v1_get_app_status($app);
                $app_action = human_v1_get_app_action($app);
            ?>
                <div id="<?php echo esc_attr($app_slug); ?>" class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 16px; display: flex; flex-direction: column; justify-content: space-between; scroll-margin-top: 6rem;">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 0.5rem; margin-bottom: 1.25rem; flex-wrap: wrap;">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/hv1-icon.svg'); ?>" alt="Human V1 App Icon" style="width: 32px; height: 32px; border-radius: 6px;">
                                <h2 style="font-size: 1.3rem; color: var(--human-white);"><?php echo esc_html($app['title']); ?></h2>
                            </div>
                            <?php echo human_get_status_badge($app_status, $app_slug); ?>
                        </div>
                        <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem;">
                            <?php echo esc_html($app['description']); ?>
                        </p>
                    </div>

                    <div style="border-top: 1px solid var(--human-border-dark); padding-top: 1.25rem; margin-top: 1rem; display: flex; justify-content: space-between; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                        <span style="font-size: 0.8rem; color: #64748B; font-family: var(--font-mono);"><?php echo esc_html($app['pricing']); ?></span>
                        <?php if ($app_action['enabled']) : ?>
                            <a href="<?php echo esc_url($app_action['url']); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.85rem;">
                                <?php echo esc_html($app_action['label']); ?> &rarr;
                            </a>
                        <?php else : ?>
                            <span class="btn btn-secondary" aria-disabled="true" style="padding: 0.5rem 1rem; font-size: 0.85rem; opacity: 0.65; cursor: default;">
                                <?php echo esc_html($app_action['label']); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
