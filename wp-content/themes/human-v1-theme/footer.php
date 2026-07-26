<?php
/**
 * Footer Template
 */
if (!defined('ABSPATH')) {
    exit;
}
?>

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-logo" style="margin-bottom: 1rem;">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/human_logo_master.svg'); ?>" alt="Human V1 Master Logo" style="height: 42px; width: auto; max-width: 220px;">
                </a>
                <p style="color: #94A3B8; font-size: 0.9rem; margin-bottom: 1.5rem; max-width: 320px;">
                    Train. Track. Transform.<br>
                    A performance technology platform built around real people, structured progression, and long-term human performance.
                </p>
                <div style="font-family: var(--font-mono); font-size: 0.8rem; color: #64748B;">
                    Primary Domain: humanv1.com
                </div>
            </div>

            <div class="footer-col">
                <h4>Ecosystem Apps</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/strength')); ?>">Human Strength (Available)</a></li>
                    <li><a href="<?php echo esc_url(home_url('/apps')); ?>">Human HIIT (In Dev)</a></li>
                    <li><a href="<?php echo esc_url(home_url('/apps')); ?>">Human Running</a></li>
                    <li><a href="<?php echo esc_url(home_url('/apps')); ?>">Human Recovery</a></li>
                    <li><a href="<?php echo esc_url(home_url('/apps')); ?>">Human Mobility</a></li>
                    <li><a href="<?php echo esc_url(home_url('/apps')); ?>">Human Nutrition</a></li>
                    <li><a href="<?php echo esc_url(home_url('/apps')); ?>">Human Coach</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Knowledge & Brand</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/ontology')); ?>">Human Ontology</a></li>
                    <li><a href="<?php echo esc_url(home_url('/journal')); ?>">Human Journal</a></li>
                    <li><a href="<?php echo esc_url(home_url('/about')); ?>">About Platform</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact & Media</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Support & Legal</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/support')); ?>">Customer Support</a></li>
                    <li><a href="<?php echo esc_url(home_url('/privacy')); ?>">Privacy Policy</a></li>
                    <li><a href="<?php echo esc_url(home_url('/terms')); ?>">Terms of Service</a></li>
                    <li><a href="<?php echo esc_url(home_url('/data-deletion')); ?>">Data Deletion</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; padding-top: 1.5rem; border-top: 1px solid var(--human-border-dark);">
            <div>&copy; <?php echo date('Y'); ?> Human Performance Technology. All rights reserved.</div>
            <div style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
                <a href="<?php echo esc_url(home_url('/privacy')); ?>" style="color: #64748B;">Privacy</a>
                <a href="<?php echo esc_url(home_url('/terms')); ?>" style="color: #64748B;">Terms</a>
                <a href="<?php echo esc_url(home_url('/data-deletion')); ?>" style="color: #64748B;">Data Deletion</a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
