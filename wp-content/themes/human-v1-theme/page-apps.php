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
        <div style="text-align: center; max-width: 800px; margin: 0 auto 3rem;">
            <span class="eyebrow">HUMAN ECOSYSTEM CATALOGUE</span>
            <h1 class="display-title" style="margin-bottom: 1rem;">Human Platform Apps</h1>
            <p style="font-size: clamp(1rem, 2.5vw, 1.2rem); color: #94A3B8; line-height: 1.6;">
                One Human umbrella brand. Specialized applications designed to connect strength, endurance, mobility, recovery, and intelligent coaching into one evolving system.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
            <?php
            $apps = human_get_canonical_apps();
            foreach ($apps as $app) :
            ?>
                <div class="card-padding" style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 16px; display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 0.5rem; margin-bottom: 1.25rem; flex-wrap: wrap;">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/hv1-icon.svg'); ?>" alt="Human V1 App Icon" style="width: 32px; height: 32px; border-radius: 6px;">
                                <h2 style="font-size: 1.3rem; color: var(--human-white);"><?php echo esc_html($app['title']); ?></h2>
                            </div>
                            <?php echo human_get_status_badge($app['status']); ?>
                        </div>
                        <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem;">
                            <?php echo esc_html($app['description']); ?>
                        </p>
                    </div>

                    <div style="border-top: 1px solid var(--human-border-dark); padding-top: 1.25rem; margin-top: 1rem; display: flex; justify-content: space-between; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                        <span style="font-size: 0.8rem; color: #64748B; font-family: var(--font-mono);"><?php echo esc_html($app['pricing']); ?></span>
                        <a href="<?php echo esc_url(home_url($app['target_url'])); ?>" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.85rem;">
                            View Module &rarr;
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
