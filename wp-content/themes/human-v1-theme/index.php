<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 */

get_header(); ?>

<main id="main-content" class="container mx-auto px-6 py-12 md:py-24">
    <?php if (have_posts()) : ?>
        <header class="page-header mb-12">
            <h1 class="page-title text-3xl md:text-5xl font-semibold tracking-tight text-human-white">
                <?php wp_title(''); ?>
            </h1>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('bg-human-gray-800 rounded-2xl p-6 border border-human-gray-700/50 hover:border-human-gray-600 transition-colors'); ?>>
                    <header class="entry-header mb-4">
                        <?php
                        the_title(sprintf('<h2 class="entry-title text-xl font-semibold mb-2"><a href="%s" rel="bookmark" class="text-human-white hover:text-human-gray-300">', esc_url(get_permalink())), '</a></h2>');
                        ?>
                    </header>
                    <div class="entry-summary text-human-gray-400">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
                <?php
            endwhile;
            ?>
        </div>

        <?php
        the_posts_navigation(array(
            'prev_text' => __('Older posts', 'human-v1-theme'),
            'next_text' => __('Newer posts', 'human-v1-theme'),
        ));
        ?>

    <?php else : ?>
        <section class="no-results not-found text-center">
            <header class="page-header mb-8">
                <h1 class="page-title text-3xl font-semibold text-human-white"><?php esc_html_e('Nothing Found', 'human-v1-theme'); ?></h1>
            </header>
            <div class="page-content text-human-gray-400 max-w-2xl mx-auto">
                <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'human-v1-theme'); ?></p>
                <?php get_search_form(); ?>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php
get_footer();
