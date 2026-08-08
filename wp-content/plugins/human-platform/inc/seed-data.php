<?php
/**
 * Seed Data & Initial Content Architecture for Human Platform
 * 
 * Populates database with the 10 cornerstone launch articles for Human Journal
 * and canonical CPT entries for Human ecosystem apps.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Returns the current Human Journal reference content definitions.
 *
 * These definitions are deliberately restrained. They are used for fresh installs
 * and for the 1.5.0 reconciliation migration. Only the first article is intended
 * to be published automatically, and only when the stock WordPress "Hello world!"
 * post is still untouched. The remaining entries are reference/sample drafts.
 */
function human_get_cornerstone_articles() {
    return array(
        array(
            'seed_key'      => 'journal_why_human_v1_begins_with_strength_v1',
            'slug'          => 'why-human-v1-begins-with-strength',
            'title'         => 'Why Human V1 Begins with Strength',
            'status'        => 'publish',
            'category'      => 'Human V1',
            'excerpt'       => 'Human Strength is the first Human V1 product. Here is why the platform begins with a focused Android strength-training application before expanding into future disciplines.',
            'target_intent' => 'human v1 strength app, human strength internal testing',
            'seo_title'     => 'Why Human V1 Begins with Strength | Human Journal',
            'seo_desc'      => 'Human Strength is the first Human V1 product and is currently in Google Play Internal Testing. Learn how it fits into the wider Human V1 platform.',
            'social_title'  => 'Why Human V1 Begins with Strength',
            'social_desc'   => 'Human Strength is the first Human V1 product and is currently in Google Play Internal Testing. The wider platform will grow from this focused starting point.',
            'promo_copy'    => 'Human V1 begins with one focused product: Human Strength. It is currently in Google Play Internal Testing, while the wider Human V1 platform remains a longer-term roadmap.',
            'primary_topic' => 'Human V1',
            'search_intent' => 'informational',
            'content_type'  => 'platform_update',
            'evergreen'     => '1',
            'primary_app_slug' => 'strength',
            'primary_cta_title' => 'Explore Human Strength',
            'campaign_seed_key' => 'campaign_why_strength_first_v1',
            'content'       => '<h2>Start With One Product and Make It Useful</h2>
<p>Human V1 means Human Version 1.0. The platform begins with Human Strength, an Android strength-training application currently in Google Play Internal Testing.</p>
<p>The aim is deliberately focused: build a useful first product, learn from real use, and create a sound foundation before expanding into additional Human V1 applications.</p>

<h2>Human Strength Comes First</h2>
<p>Human Strength is the first product in the Human V1 platform. It is designed around strength-training workflows such as recording workouts, routines, sets and progression while keeping normal training use reliable on Android.</p>
<p>Google Sign-In is required for Human V1 account access. Introductory Human V1 account access is separate from any paid Google Play membership. Human Strength paid membership is planned around an annual Google Play purchase when offered.</p>

<h2>What Comes After Strength?</h2>
<p>The wider Human V1 roadmap includes future products for Running, HIIT, Mobility, Recovery, Nutrition and Community. Human Coach is marked Coming Soon. Features and release dates for those future products have not been announced.</p>

<h2>Why This Matters</h2>
<p>Starting with one product keeps the public promise clear. Human V1 can build from what actually exists rather than describing future ideas as finished capabilities.</p>

<p><a href="/strength/">Learn more about Human Strength</a></p>'
        ),
        array(
            'seed_key'      => 'journal_how_human_strength_access_works_v1',
            'slug'          => 'how-human-strength-access-works',
            'title'         => 'How Human Strength Access Works',
            'status'        => 'draft',
            'category'      => 'Human Strength',
            'excerpt'       => 'A plain-English explanation of Human V1 account access, Google Sign-In, Internal Testing and the separate Google Play membership.',
            'target_intent' => 'human strength access, human strength membership',
            'seo_title'     => 'How Human Strength Access Works | Human Journal',
            'seo_desc'      => 'Understand Human Strength access: Google Sign-In, Human V1 introductory account access, Google Play Internal Testing and separate paid membership.',
            'social_title'  => 'How Human Strength Access Works',
            'social_desc'   => 'Google Sign-In, Human V1 account access, Internal Testing and paid Google Play membership are separate parts of the Human Strength access flow.',
            'promo_copy'    => 'Human Strength access has a few distinct parts. Google Sign-In creates the account relationship, introductory Human V1 access is separate from paid membership, and the app is currently in Internal Testing.',
            'primary_topic' => 'Human Strength access',
            'search_intent' => 'informational',
            'content_type'  => 'product_guide',
            'evergreen'     => '1',
            'primary_app_slug' => 'strength',
            'primary_cta_title' => 'Explore Human Strength',
            'campaign_seed_key' => 'campaign_strength_access_explainer_v1',
            'content'       => '<h2>Human Strength Is Currently in Internal Testing</h2>
<p>Human Strength is not currently presented as a general public Google Play release. Access is limited to eligible or invited testers through Google Play Internal Testing.</p>

<h2>Google Sign-In and the Human V1 Account</h2>
<p>Google Sign-In is required for Human V1 account access. The Human V1 account relationship and its introductory access period are separate from Google Play billing.</p>

<h2>Paid Membership Is Separate</h2>
<p>A paid Human Strength membership is handled through Google Play when offered. The current annual membership price is £24 per year. Introductory Human V1 account access does not automatically convert into a paid Google Play membership.</p>

<h2>Why the Distinction Matters</h2>
<p>Keeping account access and paid entitlement separate makes the product status easier to understand and avoids describing Human V1 account access as a Google Play free trial.</p>'
        ),
        array(
            'seed_key'      => 'journal_human_strength_internal_testing_v1',
            'slug'          => 'human-strength-internal-testing-what-it-means',
            'title'         => 'Human Strength Internal Testing: What It Means',
            'status'        => 'draft',
            'category'      => 'Human Strength',
            'excerpt'       => 'Human Strength is currently in Google Play Internal Testing. This reference article explains what that status means for public website copy and access.',
            'target_intent' => 'human strength internal testing',
            'seo_title'     => 'Human Strength Internal Testing: What It Means',
            'seo_desc'      => 'Human Strength is currently in Google Play Internal Testing. Learn what that status means for testers, public availability and website messaging.',
            'social_title'  => 'Human Strength Is in Internal Testing',
            'social_desc'   => 'Human Strength is currently in Google Play Internal Testing for eligible or invited testers. It is not yet described as a general public Play Store release.',
            'promo_copy'    => 'Human Strength is in Google Play Internal Testing. That means tester access is real, but general public availability is not being claimed yet.',
            'primary_topic' => 'Google Play Internal Testing',
            'search_intent' => 'informational',
            'content_type'  => 'product_update',
            'evergreen'     => '0',
            'primary_app_slug' => 'strength',
            'primary_cta_title' => 'Explore Human Strength',
            'campaign_seed_key' => 'campaign_strength_internal_testing_v1',
            'content'       => '<h2>Internal Testing Is a Real Product Stage</h2>
<p>Human Strength is currently distributed through Google Play Internal Testing. That allows eligible or invited testers to use the Android application while the product remains outside a general public release.</p>

<h2>What the Website Should Say</h2>
<p>Public Human V1 content should describe Human Strength as being in Internal Testing. It should not use a general Download on Google Play message unless a public listing is genuinely available and the product lifecycle has changed.</p>

<h2>What Testers Can Expect</h2>
<p>Test access depends on the Google Play testing configuration associated with the application. Human V1 should only publish a tester link when a verified Internal Testing URL is configured.</p>

<h2>What Happens Next?</h2>
<p>A future public release is a separate lifecycle decision. Until then, Internal Testing remains the truthful public status.</p>'
        ),
        array(
            'seed_key'      => 'journal_what_human_v1_means_v1',
            'slug'          => 'what-human-v1-version-1-0-means',
            'title'         => 'What Human V1 Means',
            'status'        => 'draft',
            'category'      => 'Human V1',
            'excerpt'       => 'Human V1 means Human Version 1.0. This reference article explains the platform idea without turning future product plans into present-day claims.',
            'target_intent' => 'what is human v1',
            'seo_title'     => 'What Human V1 Means | Human Journal',
            'seo_desc'      => 'Human V1 means Human Version 1.0: the platform behind Human Strength and future Human applications, with Human Strength as the first product.',
            'social_title'  => 'What Does Human V1 Mean?',
            'social_desc'   => 'Human V1 means Human Version 1.0. Human Strength is the first product, while the wider Human V1 roadmap remains a set of future products and ideas.',
            'promo_copy'    => 'Human V1 means Human Version 1.0: start with a useful first product, be truthful about what exists today, and grow the wider platform from there.',
            'primary_topic' => 'Human V1',
            'search_intent' => 'informational',
            'content_type'  => 'platform_guide',
            'evergreen'     => '1',
            'primary_app_slug' => '',
            'primary_cta_title' => '',
            'campaign_seed_key' => 'campaign_human_v1_brand_intro_v1',
            'content'       => '<h2>Human Version 1.0</h2>
<p>Human V1 is shorthand for Human Version 1.0. It is the platform identity behind Human Strength and future Human applications.</p>

<h2>The First Product Is Human Strength</h2>
<p>Human Strength is the first Human V1 product and is currently in Google Play Internal Testing.</p>

<h2>The Wider Roadmap</h2>
<p>Human Running, Human HIIT, Human Mobility, Human Recovery, Human Nutrition and Human Community are future products. Human Coach is marked Coming Soon. Their detailed features and release timing have not been announced.</p>

<h2>A Simple Principle</h2>
<p>The Human V1 website should distinguish clearly between what exists now and what is planned for later. That keeps product communication useful and credible as the platform develops.</p>'
        )
    );
}

/**
 * Exact SHA-256 fingerprints for the original 1.0.0 Journal seed bodies.
 *
 * Migration 1.5.0 uses these hashes only to identify untouched historical seed
 * content. If an editor changed a post, the post is preserved and reported as
 * a reconciliation conflict.
 */
function human_get_legacy_cornerstone_fingerprints() {
    return array(
        'how-to-track-strength-training-progress-properly' => array(
            'content' => '2b803bdaf5b07f9bb1cca69410fba0bdcb43b47c04db6b4e82bfaa545826c1d3',
            'title' => 'c46998ada0212f26d93778d70adbc16711739da470ce8c84984dbb9aaa9f417a',
        ),
        'progressive-overload-what-it-actually-means-and-how-to-track-it' => array(
            'content' => '167ae1aa3a48ab1348e1145b2f8b3c1e033715ac32edc3fcc869b20aa76f7a48',
            'title' => 'e509f640c215a9e95ca71c036a373c74ce6dae6a4ddc5930355f281257560300',
        ),
        'why-logging-your-workouts-changes-the-way-you-train' => array(
            'content' => '741cb73ce146da9153a6f96682c217d84b5e3f437e65d07011cbb0345215af49',
            'title' => '0ce23aa639ad861bd4faa0354d48e1822b3c04805f8baac8b4e1bdc80782559a',
        ),
        'sets-reps-load-and-volume-understanding-your-strength-training-data' => array(
            'content' => '999fba75e4771217ccd66f5b4461ea34da76f6057fd0b73814454fb733b10085',
            'title' => '909c71c9f46a3f939201da650f0157feeea1251045727cda851b22e37eb07eed',
        ),
        'how-to-build-a-strength-training-routine-you-can-actually-follow' => array(
            'content' => '49baea4fe26be25a0827ed43a249b5c5997c35bc26431a00c40c5dfe5986596f',
            'title' => '29de957ce67936f16e4c04d7eab46217b59d3240ef91f78fd3e393035911c7ae',
        ),
        'training-consistency-why-your-workout-history-matters' => array(
            'content' => 'bebadc2885783b57ee14ccc2444c6af285fa4e2459ee8cd567823af6e8020511',
            'title' => '0958e2b76dbc9cfe263c58bcbafbed60cb17c4e347f257f6205a98d040b2a2c2',
        ),
        'how-often-should-you-increase-the-weight-you-lift' => array(
            'content' => '0bf848dcdac295634ec80df0fade31ebb111a0ece38e2b50a30c91a386e80606',
            'title' => '3317a1858c8b6cbd2242b699454ffa18e3e491ab2771526cdfde0faf9b25f616',
        ),
        'workout-tracking-without-the-spreadsheet' => array(
            'content' => '99881b9b337ee7273103f01bad99a2b995dc5a5ff7d139a0d10959753edc37a8',
            'title' => '17103dff15104850af086d0b5b5a986c851365bc78de2a801f09b7509b952ea4',
        ),
        'what-makes-an-exercise-more-than-just-a-name' => array(
            'content' => 'b0620cf050538e01dd68b58e10800233de80b5f9e828a3a989c84eeb94056361',
            'title' => '3f54498bd52f82eecb802689143d7f3d7bc20d4325313f5b4aa8df438ff6833b',
        ),
        'building-the-human-ontology-towards-a-structured-exercise-knowledge-system' => array(
            'content' => 'de33d508329832c3f88a93bc3f24682dedaa385a2c63519e127ac3fc4f029987',
            'title' => 'c6b783607aeefccb1c6af2c85bb9946cd0af8234b969117a223f72c382736835',
        ),
    );
}

/**
 * Marketing Data Migration Architecture
 * 
 * Runs deterministic, idempotent migrations based on schema versions.
 * Preserves manually edited content and avoids duplicates.
 */
function human_run_migrations() {
    $current_version = get_option('human_marketing_schema_version', '0.0.0');
    
    // Backwards compatibility for early setups
    if ($current_version === '0.0.0' && get_option('human_initial_content_seeded_v1')) {
        $current_version = '1.0.0';
        update_option('human_marketing_schema_version', $current_version, false);
        if (get_option('human_marketing_schema_version', '0.0.0') !== $current_version) {
            $result = new WP_Error(
                'human_migration_legacy_version_write_failed',
                'The legacy Human marketing schema version could not be verified.'
            );
            update_option('human_marketing_migration_error', array(
                'version' => $current_version,
                'code' => $result->get_error_code(),
                'message' => $result->get_error_message(),
                'data' => $result->get_error_data(),
                'recorded_at' => time()
            ), false);
            return $result;
        }
    }
    
    $migrations = array(
        '1.0.0' => 'human_migration_1_0_0',
        '1.0.1' => 'human_migration_1_0_1',
        '1.1.0' => 'human_migration_1_1_0',
        '1.2.0' => 'human_migration_1_2_0',
        '1.3.0' => 'human_migration_1_3_0',
        '1.4.0' => 'human_migration_1_4_0',
        '1.5.0' => 'human_migration_1_5_0',
        '1.6.0' => 'human_migration_1_6_0'
    );

    foreach ($migrations as $version => $callback) {
        if (version_compare($current_version, $version, '<')) {
            if (!is_callable($callback)) {
                $result = new WP_Error(
                    'human_migration_callback_missing',
                    sprintf('Migration callback for version %s is unavailable.', $version)
                );
                update_option('human_marketing_migration_error', array(
                    'version' => $version,
                    'code' => $result->get_error_code(),
                    'message' => $result->get_error_message(),
                    'data' => $result->get_error_data(),
                    'recorded_at' => time()
                ), false);
                return $result;
            }

            $result = call_user_func($callback);
            if ($result === false) {
                $result = new WP_Error(
                    'human_migration_failed',
                    sprintf('Migration %s reported a failure.', $version)
                );
            }
            if (is_wp_error($result)) {
                update_option('human_marketing_migration_error', array(
                    'version' => $version,
                    'code' => $result->get_error_code(),
                    'message' => $result->get_error_message(),
                    'data' => $result->get_error_data(),
                    'recorded_at' => time()
                ), false);
                return $result;
            }

            update_option('human_marketing_schema_version', $version, false);
            if (get_option('human_marketing_schema_version', '0.0.0') !== $version) {
                $result = new WP_Error(
                    'human_migration_version_write_failed',
                    sprintf('Migration %s completed but its schema version could not be verified.', $version)
                );
                update_option('human_marketing_migration_error', array(
                    'version' => $version,
                    'code' => $result->get_error_code(),
                    'message' => $result->get_error_message(),
                    'data' => $result->get_error_data(),
                    'recorded_at' => time()
                ), false);
                return $result;
            }

            delete_option('human_marketing_migration_error');
            $current_version = $version;
        }
    }
}
add_action('admin_init', 'human_run_migrations');

function human_migration_1_0_0() {
    // Seed Canonical Apps
    $canonical_apps = human_get_fallback_canonical_apps();
    foreach ($canonical_apps as $app_data) {
        $existing_app = get_page_by_path($app_data['slug'], OBJECT, 'human_app');
        if (!$existing_app) {
            $post_id = wp_insert_post(array(
                'post_title'   => $app_data['title'],
                'post_name'    => $app_data['slug'],
                'post_content' => $app_data['description'],
                'post_status'  => 'publish',
                'post_type'    => 'human_app'
            ));
            
            if ($post_id && !is_wp_error($post_id)) {
                update_post_meta($post_id, '_human_app_status', $app_data['status']);
                update_post_meta($post_id, '_human_app_package_id', $app_data['app_id']);
                update_post_meta($post_id, '_human_app_pricing', $app_data['pricing']);
                if (isset($app_data['price_amount'])) update_post_meta($post_id, '_human_app_price_amount', $app_data['price_amount']);
                if (isset($app_data['price_currency'])) update_post_meta($post_id, '_human_app_price_currency', $app_data['price_currency']);
                if (isset($app_data['billing_period'])) update_post_meta($post_id, '_human_app_billing_period', $app_data['billing_period']);
                if (isset($app_data['trial_days'])) update_post_meta($post_id, '_human_app_trial_days', $app_data['trial_days']);
                update_post_meta($post_id, '_human_app_target_url', $app_data['target_url']);
            }
        }
    }

    // Seed CTAs
    $ctas_to_seed = array(
        array(
            'title' => 'Explore Human Strength',
            'label' => 'Explore Human Strength',
            'supporting' => 'Learn about Human Strength and its current Google Play Internal Testing status.',
            'url' => '/strength/',
            'type' => 'product',
            'status' => 'active'
        ),
        array(
            'title' => 'Human Strength Internal Testing',
            'label' => 'Internal Testing',
            'supporting' => 'Access is limited to eligible or invited testers.',
            'url' => '/strength/',
            'type' => 'product',
            'status' => 'inactive'
        ),
        array(
            'title' => 'Explore the Human Ontology',
            'label' => 'Discover Human Ontology',
            'supporting' => 'Explore the structured exercise knowledge system.',
            'url' => '/ontology/',
            'type' => 'learn',
            'status' => 'active'
        ),
        array(
            'title' => 'Read the Training Guides',
            'label' => 'Read Journal',
            'supporting' => 'Deep dives into progression and programming.',
            'url' => '/journal/',
            'type' => 'content',
            'status' => 'active'
        )
    );

    foreach ($ctas_to_seed as $cta) {
        $existing = get_page_by_title($cta['title'], OBJECT, 'human_cta');
        if (!$existing) {
            $post_id = wp_insert_post(array(
                'post_title' => $cta['title'],
                'post_status' => 'publish',
                'post_type' => 'human_cta'
            ));
            if ($post_id && !is_wp_error($post_id)) {
                update_post_meta($post_id, '_human_cta_label', $cta['label']);
                update_post_meta($post_id, '_human_cta_supporting_text', $cta['supporting']);
                update_post_meta($post_id, '_human_cta_destination_url', $cta['url']);
                update_post_meta($post_id, '_human_cta_type', $cta['type']);
                update_post_meta($post_id, '_human_cta_status', $cta['status']);
                
                // Associate with Human Strength if relevant
                if ($cta['type'] === 'product' || $cta['type'] === 'download') {
                    $strength_app = get_page_by_path('strength', OBJECT, 'human_app');
                    if ($strength_app) {
                        update_post_meta($post_id, '_human_cta_associated_app', $strength_app->ID);
                    }
                }
            }
        }
    }

    // Sample Campaigns are introduced by migration 1.5.0 so fresh installs
    // and upgraded installs share the same safety contract.

    $articles = human_get_cornerstone_articles();
    foreach ($articles as $art) {
        $existing = get_page_by_path($art['slug'], OBJECT, 'post');
        if (!$existing) {
            $post_status = ($art['status'] ?? 'draft') === 'publish' ? 'publish' : 'draft';
            $post_id = wp_insert_post(array(
                'post_title'   => $art['title'],
                'post_name'    => $art['slug'],
                'post_content' => $art['content'],
                'post_excerpt' => $art['excerpt'],
                'post_status'  => $post_status,
                'post_type'    => 'post'
            ));
            if ($post_id && !is_wp_error($post_id)) {
                update_post_meta($post_id, '_human_seed_key', $art['seed_key']);
                update_post_meta($post_id, '_human_is_sample', $post_status === 'draft' ? '1' : '0');
                update_post_meta($post_id, '_human_automation_eligible', '0');
                update_post_meta($post_id, '_human_content_approval_state', $post_status === 'publish' ? 'approved_reference' : 'draft');
                update_post_meta($post_id, '_human_seo_title', $art['seo_title']);
                update_post_meta($post_id, '_human_seo_description', $art['seo_desc']);
                update_post_meta($post_id, '_human_post_primary_topic', $art['primary_topic']);
                update_post_meta($post_id, '_human_post_search_intent', $art['search_intent']);
                update_post_meta($post_id, '_human_social_title', $art['social_title']);
                update_post_meta($post_id, '_human_social_description', $art['social_desc']);
                update_post_meta($post_id, '_human_social_image', get_template_directory_uri() . '/assets/human-og-share.png');
                update_post_meta($post_id, '_human_promo_copy', $art['promo_copy']);
                update_post_meta($post_id, '_human_post_content_type', $art['content_type']);
                update_post_meta($post_id, '_human_post_evergreen', $art['evergreen']);
            }
        }
    }
    
    // Retain legacy flag for reference
    update_option('human_initial_content_seeded_v1', true);
}

function human_migration_1_0_1() {
    // Future migrations go here
}

function human_migration_1_1_0() {
    // Re-run fallback canonical apps so structured pricing gets updated for existing apps
    $canonical_apps = human_get_fallback_canonical_apps();
    foreach ($canonical_apps as $app_data) {
        $existing_app = get_page_by_path($app_data['slug'], OBJECT, 'human_app');
        if ($existing_app) {
            if (isset($app_data['price_amount'])) update_post_meta($existing_app->ID, '_human_app_price_amount', $app_data['price_amount']);
            if (isset($app_data['price_currency'])) update_post_meta($existing_app->ID, '_human_app_price_currency', $app_data['price_currency']);
            if (isset($app_data['billing_period'])) update_post_meta($existing_app->ID, '_human_app_billing_period', $app_data['billing_period']);
            if (isset($app_data['trial_days'])) update_post_meta($existing_app->ID, '_human_app_trial_days', $app_data['trial_days']);
        }
    }

    // Reconcile the historical ontology article only if it exists. The content
    // itself is retired by migration 1.5.0 when it still matches the old seed.
    $post = get_page_by_path('building-the-human-ontology-towards-a-structured-exercise-knowledge-system', OBJECT, 'post');
    if ($post) {
        update_post_meta($post->ID, '_human_seo_title', 'Building the Human Ontology: Structured Exercise Knowledge');
        update_post_meta($post->ID, '_human_seo_description', 'An overview of the ongoing Human Ontology programme and its structured approach to exercise identity, movement, anatomy, equipment and relationships.');
        update_post_meta($post->ID, '_human_post_search_intent', 'informational');
        update_post_meta($post->ID, '_human_post_primary_topic', 'human ontology');
        update_post_meta($post->ID, '_human_social_title', 'Building the Human Ontology');
        update_post_meta($post->ID, '_human_social_description', 'An ongoing Human V1 programme for structuring exercise identity, movement, anatomy, equipment and relationships.');
        update_post_meta($post->ID, '_human_social_image', get_template_directory_uri() . '/assets/human-og-share.png');
        update_post_meta($post->ID, '_human_promo_copy', 'Human Ontology is an ongoing structured exercise knowledge programme within Human V1.');
        update_post_meta($post->ID, '_human_post_content_type', 'reference');
        update_post_meta($post->ID, '_human_post_marketing_status', 'needs_review');
        update_post_meta($post->ID, '_human_post_evergreen', '1');
    }

}

function human_migration_1_2_0() {
    // 1. Reconcile App Catalogue
    $canonical_apps = human_get_fallback_canonical_apps();
    foreach ($canonical_apps as $app_data) {
        $existing_app = get_page_by_path($app_data['slug'], OBJECT, 'human_app');
        if (!$existing_app) {
            $post_id = wp_insert_post(array(
                'post_title'   => $app_data['title'],
                'post_name'    => $app_data['slug'],
                'post_content' => $app_data['description'],
                'post_status'  => 'publish',
                'post_type'    => 'human_app'
            ));
            if ($post_id && !is_wp_error($post_id)) {
                update_post_meta($post_id, '_human_app_status', $app_data['status']); // Safe default
                update_post_meta($post_id, '_human_app_package_id', $app_data['app_id']);
                update_post_meta($post_id, '_human_app_pricing', $app_data['pricing']);
                if (isset($app_data['price_amount'])) update_post_meta($post_id, '_human_app_price_amount', $app_data['price_amount']);
                if (isset($app_data['price_currency'])) update_post_meta($post_id, '_human_app_price_currency', $app_data['price_currency']);
                if (isset($app_data['billing_period'])) update_post_meta($post_id, '_human_app_billing_period', $app_data['billing_period']);
                if (isset($app_data['trial_days'])) update_post_meta($post_id, '_human_app_trial_days', $app_data['trial_days']);
                update_post_meta($post_id, '_human_app_target_url', $app_data['target_url']);
            }
        }
    }

    // 2. Reconcile Canonical CTAs
    $ctas_to_seed = array(
        array(
            'title' => 'Explore Human Strength',
            'label' => 'Explore Human Strength',
            'supporting' => 'Learn about Human Strength and its current Google Play Internal Testing status.',
            'url' => '/strength/',
            'type' => 'product',
            'status' => 'active',
            'associated_app_slug' => 'strength'
        ),
        array(
            'title' => 'Human Strength Internal Testing',
            'label' => 'Internal Testing',
            'supporting' => 'Access is limited to eligible or invited testers.',
            'url' => '/strength/',
            'type' => 'product',
            'status' => 'inactive',
            'associated_app_slug' => 'strength'
        ),
        array(
            'title' => 'Explore Human Ontology',
            'label' => 'Discover Human Ontology',
            'supporting' => 'Explore the structured exercise knowledge system.',
            'url' => '/ontology/',
            'type' => 'learn',
            'status' => 'active'
        ),
        array(
            'title' => 'Read the Training Guides',
            'label' => 'Read Journal',
            'supporting' => 'Deep dives into progression and programming.',
            'url' => '/journal/',
            'type' => 'content',
            'status' => 'active'
        )
    );
    foreach ($ctas_to_seed as $cta) {
        $existing = get_page_by_title($cta['title'], OBJECT, 'human_cta');
        if (!$existing) {
            $post_id = wp_insert_post(array(
                'post_title' => $cta['title'],
                'post_status' => 'publish',
                'post_type' => 'human_cta'
            ));
            if ($post_id && !is_wp_error($post_id)) {
                update_post_meta($post_id, '_human_cta_label', $cta['label']);
                update_post_meta($post_id, '_human_cta_supporting_text', $cta['supporting']);
                update_post_meta($post_id, '_human_cta_destination_url', $cta['url']);
                update_post_meta($post_id, '_human_cta_type', $cta['type']);
                update_post_meta($post_id, '_human_cta_status', $cta['status']);
                if (isset($cta['associated_app_slug'])) {
                    $app = get_page_by_path($cta['associated_app_slug'], OBJECT, 'human_app');
                    if ($app) {
                        update_post_meta($post_id, '_human_cta_associated_app', $app->ID);
                    }
                }
            }
        }
    }

    // 3. Sample Campaigns are reconciled by migration 1.5.0.

    // Reconcile Taxonomy
    $required_cats = array('Programming', 'Human Ontology', 'Product News');
    foreach ($required_cats as $cat) {
        if (!term_exists($cat, 'category')) {
            wp_insert_term($cat, 'category');
        }
    }

    // 4. Reconcile Menus
    
    // Helper function to create missing menus and their items
    if (!function_exists('human_create_menu_if_missing')) {
        function human_create_menu_if_missing($menu_name, $location, $items) {
            $locations = get_theme_mod('nav_menu_locations');
            if (isset($locations[$location]) && $locations[$location] != 0) {
                return; // Already assigned
            }
            $menu_exists = wp_get_nav_menu_object($menu_name);
            if (!$menu_exists) {
                $menu_id = wp_create_nav_menu($menu_name);
                if (!is_wp_error($menu_id)) {
                    foreach ($items as $item) {
                        wp_update_nav_menu_item($menu_id, 0, array(
                            'menu-item-title' => $item['title'],
                            'menu-item-url' => $item['url'],
                            'menu-item-status' => 'publish'
                        ));
                    }
                    $locations[$location] = $menu_id;
                    set_theme_mod('nav_menu_locations', $locations);
                }
            } else {
                $locations[$location] = $menu_exists->term_id;
                set_theme_mod('nav_menu_locations', $locations);
            }
        }
    }
    
    // Primary Header Menu
    human_create_menu_if_missing('Primary Header Menu', 'primary-menu', array(
        array('title' => 'Home', 'url' => '/'),
        array('title' => 'Apps', 'url' => '/apps/'),
        array('title' => 'Human Ontology', 'url' => '/ontology/'),
        array('title' => 'Journal', 'url' => '/journal/'),
        array('title' => 'About', 'url' => '/about/'),
        array('title' => 'Support', 'url' => '/support/')
    ));

    // Footer Navigation Menu
    human_create_menu_if_missing('Footer Navigation Menu', 'footer-menu', array(
        array('title' => 'Human Ontology', 'url' => '/ontology/'),
        array('title' => 'Human Journal', 'url' => '/journal'),
        array('title' => 'About Platform', 'url' => '/about'),
        array('title' => 'Contact & Media', 'url' => '/contact/'),
        array('title' => 'Customer Support', 'url' => '/support/'),
        array('title' => 'Privacy Policy', 'url' => '/privacy-policy/'),
        array('title' => 'Terms of Service', 'url' => '/terms/'),
        array('title' => 'Data Deletion', 'url' => '/data-deletion/')
    ));

    // Apps Navigation Menu
    $app_items = array();
    foreach ($canonical_apps as $app_data) {
        $target = !empty($app_data['target_url']) ? $app_data['target_url'] : '/apps';
        $app_items[] = array('title' => $app_data['title'], 'url' => $target);
    }
    human_create_menu_if_missing('Apps Navigation Menu', 'apps-menu', $app_items);
}

function human_get_marketing_foundation_health() {
    $health = array(
        'schema_version' => get_option('human_marketing_schema_version', '0.0.0'),
        'apps' => array('expected' => 8, 'found' => 0, 'missing' => 0),
        'ctas' => array('expected' => 4, 'found' => 0, 'missing' => 0),
        'campaigns' => array('expected' => 4, 'found' => 0, 'missing' => 0),
        'taxonomy' => array('missing' => array()),
        'navigation' => array(
            'primary-menu' => 'unassigned',
            'footer-menu' => 'unassigned',
            'apps-menu' => 'unassigned'
        ),
        'pages' => array('expected' => 11, 'found' => 0, 'missing' => 0),
        'front_page' => array(
            'is_page' => false,
            'posts_page_set' => false
        ),
        'status' => 'HEALTHY'
    );

    // Apps
    $apps = wp_count_posts('human_app');
    $health['apps']['found'] = $apps->publish ?? 0;
    $health['apps']['missing'] = max(0, $health['apps']['expected'] - $health['apps']['found']);
    if ($health['apps']['missing'] > 0) $health['status'] = 'NEEDS ATTENTION';

    // CTAs
    $ctas = array(
        'Explore Human Strength',
        'Human Strength Internal Testing',
        'Explore Human Ontology',
        'Read the Training Guides'
    );
    foreach ($ctas as $cta_title) {
        if (get_page_by_title($cta_title, OBJECT, 'human_cta')) {
            $health['ctas']['found']++;
        } else {
            $health['ctas']['missing']++;
        }
    }
    if ($health['ctas']['missing'] > 0) $health['status'] = 'NEEDS ATTENTION';

    // Sample/reference Campaigns
    foreach (human_get_sample_campaign_definitions() as $campaign_definition) {
        $matches = get_posts(array(
            'post_type' => 'human_campaign',
            'post_status' => array('draft', 'publish'),
            'numberposts' => 1,
            'meta_key' => '_human_camp_seed_key',
            'meta_value' => $campaign_definition['seed_key'],
            'fields' => 'ids',
        ));
        if ($matches) {
            $health['campaigns']['found']++;
        } else {
            $health['campaigns']['missing']++;
        }
    }
    if ($health['campaigns']['missing'] > 0) {
        $health['status'] = 'NEEDS ATTENTION';
    }
    
    // Taxonomy
    $required_cats = array('Programming', 'Human Ontology', 'Product News');
    foreach ($required_cats as $cat) {
        if (!term_exists($cat, 'category')) {
            $health['taxonomy']['missing'][] = $cat;
            $health['status'] = 'NEEDS ATTENTION';
        }
    }

    // Navigation
    $locations = get_theme_mod('nav_menu_locations');
    if (isset($locations['primary-menu']) && $locations['primary-menu'] != 0) $health['navigation']['primary-menu'] = 'assigned';
    else $health['status'] = 'NEEDS ATTENTION';
    
    if (isset($locations['footer-menu']) && $locations['footer-menu'] != 0) $health['navigation']['footer-menu'] = 'assigned';
    else $health['status'] = 'NEEDS ATTENTION';
    
    if (isset($locations['apps-menu']) && $locations['apps-menu'] != 0) $health['navigation']['apps-menu'] = 'assigned';
    else $health['status'] = 'NEEDS ATTENTION';

    // Pages
    $canonical_pages = array(
        'home', 'apps', 'strength', 'ontology', 'journal',
        'about', 'support', 'privacy-policy', 'terms', 'data-deletion', 'contact'
    );
    
    foreach ($canonical_pages as $slug) {
        if (get_page_by_path($slug, OBJECT, 'page')) {
            $health['pages']['found']++;
        } else {
            $health['pages']['missing']++;
        }
    }
    
    if ($health['pages']['missing'] > 0) {
        $health['status'] = 'NEEDS ATTENTION';
    }

    // Front Page
    if (get_option('show_on_front') === 'page' && get_option('page_on_front')) {
        $health['front_page']['is_page'] = true;
    } else {
        $health['status'] = 'NEEDS ATTENTION';
    }
    
    if (get_option('page_for_posts')) {
        $health['front_page']['posts_page_set'] = true;
    } else {
        $health['status'] = 'NEEDS ATTENTION';
    }

    return $health;
}

function human_migration_1_3_0() {
    // 1. Canonical Pages
    $pages_to_seed = array(
        array('title' => 'Home', 'slug' => 'home', 'template' => ''),
        array('title' => 'Apps', 'slug' => 'apps', 'template' => 'page-apps.php'),
        array('title' => 'Human Strength', 'slug' => 'strength', 'template' => 'page-strength.php'),
        array('title' => 'Human Ontology', 'slug' => 'ontology', 'template' => 'page-ontology.php'),
        array('title' => 'Journal', 'slug' => 'journal', 'template' => ''),
        array('title' => 'About', 'slug' => 'about', 'template' => 'page-about.php'),
        array('title' => 'Support', 'slug' => 'support', 'template' => 'page-support.php'),
        array('title' => 'Privacy Policy', 'slug' => 'privacy-policy', 'template' => 'page-privacy.php'),
        array('title' => 'Terms', 'slug' => 'terms', 'template' => 'page-terms.php'),
        array('title' => 'Data Deletion', 'slug' => 'data-deletion', 'template' => 'page-data-deletion.php'),
        array('title' => 'Contact', 'slug' => 'contact', 'template' => 'page-contact.php')
    );

    foreach ($pages_to_seed as $p) {
        $existing = get_page_by_path($p['slug'], OBJECT, 'page');
        if (!$existing) {
            $post_id = wp_insert_post(array(
                'post_title' => $p['title'],
                'post_name' => $p['slug'],
                'post_status' => 'publish',
                'post_type' => 'page'
            ));
            if ($post_id && !is_wp_error($post_id)) {
                if (!empty($p['template'])) {
                    update_post_meta($post_id, '_wp_page_template', $p['template']);
                }
            }
        } else {
            // Apply template to existing page if not set
            if (!empty($p['template'])) {
                $current_template = get_post_meta($existing->ID, '_wp_page_template', true);
                if (empty($current_template) || $current_template === 'default') {
                    update_post_meta($existing->ID, '_wp_page_template', $p['template']);
                }
            }
        }
    }

    // 2. Set Front Page and Posts Page
    $home_page = get_page_by_path('home', OBJECT, 'page');
    if ($home_page && get_option('show_on_front') !== 'page') {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_page->ID);
    }

    $journal_page = get_page_by_path('journal', OBJECT, 'page');
    if ($journal_page && !get_option('page_for_posts')) {
        update_option('page_for_posts', $journal_page->ID);
    }

    // 3. Reconcile Menus (Update any custom URLs to point to real pages, specifically for privacy-policy)
    // Also update existing menus to point to Page objects instead of Custom Links where possible
    
    $menu_locations = get_theme_mod('nav_menu_locations');
    if (is_array($menu_locations)) {
        foreach ($menu_locations as $location => $menu_id) {
            if ($menu_id) {
                $menu_items = wp_get_nav_menu_items($menu_id);
                if ($menu_items) {
                    foreach ($menu_items as $item) {
                        // Change stray /privacy/ to /privacy-policy/
                        if ($item->type == 'custom' && (strpos($item->url, '/privacy/') !== false || strpos($item->url, '/privacy') === strlen($item->url) - 8)) {
                            $privacy_page = get_page_by_path('privacy-policy', OBJECT, 'page');
                            if ($privacy_page) {
                                wp_update_nav_menu_item($menu_id, $item->db_id, array(
                                    'menu-item-title' => $item->title,
                                    'menu-item-object-id' => $privacy_page->ID,
                                    'menu-item-object' => 'page',
                                    'menu-item-type' => 'post_type',
                                    'menu-item-status' => 'publish'
                                ));
                            }
                        } else if ($item->type == 'custom') {
                            // Attempt to map other custom URLs to canonical pages
                            $path = parse_url($item->url, PHP_URL_PATH);
                            if ($path) {
                                $slug = trim($path, '/');
                                if (empty($slug)) $slug = 'home';
                                
                                // Only remap if it matches our canonical pages exactly
                                $canonical_slugs = array_column($pages_to_seed, 'slug');
                                if (in_array($slug, $canonical_slugs)) {
                                    $page = get_page_by_path($slug, OBJECT, 'page');
                                    if ($page) {
                                        wp_update_nav_menu_item($menu_id, $item->db_id, array(
                                            'menu-item-title' => $item->title,
                                            'menu-item-object-id' => $page->ID,
                                            'menu-item-object' => 'page',
                                            'menu-item-type' => 'post_type',
                                            'menu-item-status' => 'publish'
                                        ));
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

/**
 * Acquire the app reconciliation lock.
 *
 * add_option() is used for acquisition because the option name has a unique
 * database index. Unlike a get/set transient sequence, concurrent requests
 * cannot both insert the lock. An expired lock is replaced with one atomic,
 * value-conditioned database update, so stale-lock contenders also have only
 * one winner.
 *
 * @return string|WP_Error Owner token on success.
 */
function human_acquire_app_migration_lock() {
    global $wpdb;

    $option_name = 'human_app_migration_1_4_0_lock';
    $now = time();
    $token = function_exists('wp_generate_uuid4')
        ? wp_generate_uuid4()
        : uniqid('human-app-migration-', true);
    $payload = array(
        'owner' => $token,
        'acquired_at' => $now,
        'expires_at' => $now + 900
    );

    if (add_option($option_name, $payload, '', 'no')) {
        return $token;
    }

    $existing = get_option($option_name, null);
    if (!is_array($existing) || empty($existing['expires_at']) || (int) $existing['expires_at'] > $now) {
        return new WP_Error(
            'human_app_migration_locked',
            'The Human app migration is already running.'
        );
    }

    /*
     * Atomically replace only the exact stale value that was inspected. A
     * delete/add takeover would allow one stale contender to delete a lock
     * just acquired by another contender.
     */
    $replaced = $wpdb->query($wpdb->prepare(
        "UPDATE {$wpdb->options} SET option_value = %s WHERE option_name = %s AND option_value = %s",
        maybe_serialize($payload),
        $option_name,
        maybe_serialize($existing)
    ));
    wp_cache_delete($option_name, 'options');

    if ($replaced !== 1) {
        return new WP_Error(
            'human_app_migration_lock_race',
            'Another request acquired the Human app migration lock.'
        );
    }

    return $token;
}

/**
 * Release the app reconciliation lock only when this process still owns it.
 */
function human_release_app_migration_lock($owner_token) {
    global $wpdb;

    $option_name = 'human_app_migration_1_4_0_lock';
    $existing = get_option($option_name, null);

    if (is_array($existing)
        && isset($existing['owner'])
        && hash_equals((string) $existing['owner'], (string) $owner_token)) {
        $wpdb->query($wpdb->prepare(
            "DELETE FROM {$wpdb->options} WHERE option_name = %s AND option_value = %s",
            $option_name,
            maybe_serialize($existing)
        ));
        wp_cache_delete($option_name, 'options');
    }
}

/**
 * Return every App post ID that has the exact canonical slug, including trash.
 *
 * @return int[]|WP_Error
 */
function human_find_app_ids_by_slug($slug) {
    global $wpdb;

    $post_ids = $wpdb->get_col($wpdb->prepare(
        "SELECT ID FROM {$wpdb->posts} WHERE post_type = %s AND post_name = %s ORDER BY ID ASC",
        'human_app',
        sanitize_title($slug)
    ));

    if ($wpdb->last_error) {
        return new WP_Error(
            'human_app_slug_lookup_failed',
            sprintf('Could not inspect existing Human App records for "%s".', sanitize_title($slug))
        );
    }

    return array_map('intval', $post_ids);
}

/**
 * Write a scalar meta value and verify the stored value by reading it back.
 *
 * update_post_meta() returning false is ambiguous (no change or failure), so
 * its return value is deliberately not used as the success test.
 *
 * @return true|WP_Error
 */
function human_write_verified_app_meta($post_id, $meta_key, $value) {
    $expected = (string) $value;
    $current = (string) get_post_meta($post_id, $meta_key, true);
    $exists = metadata_exists('post', $post_id, $meta_key);

    if (!$exists || $current !== $expected) {
        update_post_meta($post_id, $meta_key, $expected);
    }

    $stored = (string) get_post_meta($post_id, $meta_key, true);
    if (!metadata_exists('post', $post_id, $meta_key) || $stored !== $expected) {
        return new WP_Error(
            'human_app_meta_write_failed',
            sprintf('Could not verify %s for Human App post %d.', $meta_key, $post_id)
        );
    }

    return true;
}

/**
 * Determine whether a field is still an untouched seeded value.
 */
function human_app_value_is_reconcilable($current, $canonical, $legacy_values, $value_exists = true) {
    $current = (string) $current;
    if (!$value_exists || $current === (string) $canonical) {
        return true;
    }

    foreach ((array) $legacy_values as $legacy_value) {
        if ($current === (string) $legacy_value) {
            return true;
        }
    }

    return false;
}

/**
 * Record a preserved editor value in the in-memory migration report.
 */
function human_record_app_migration_conflict(&$conflicts, $slug, $field, $current, $canonical) {
    $conflicts[] = array(
        'slug' => (string) $slug,
        'field' => (string) $field,
        'preserved_value' => (string) $current,
        'canonical_value' => (string) $canonical
    );
}

/**
 * Reconcile the canonical Human App catalogue without deleting editor data.
 *
 * @return true|WP_Error
 */
function human_migration_1_4_0() {
    if (!function_exists('human_get_app_definitions')) {
        return new WP_Error(
            'human_app_definitions_missing',
            'The canonical Human app definitions are unavailable.'
        );
    }

    $definitions = human_get_app_definitions();
    $required_fields = array(
        'slug',
        'title',
        'product_type',
        'distribution_channel',
        'distribution_url',
        'external_identifier',
        'current_status',
        'status_label',
        'badge_color',
        'description',
        'app_id',
        'pricing',
        'price_amount',
        'price_currency',
        'billing_period',
        'trial_days',
        'target_url',
        'play_url',
        'internal_test_url',
        'cta_label',
        'legacy_statuses',
        'legacy_descriptions',
        'legacy_target_urls',
        'legacy_pricing'
    );

    if (!is_array($definitions) || count($definitions) !== 8) {
        return new WP_Error(
            'human_app_definitions_invalid',
            'The canonical Human app catalogue must contain exactly eight definitions.'
        );
    }

    $definition_slugs = array();
    foreach ($definitions as $definition_key => $definition) {
        if (!is_array($definition)
            || count($definition) !== count($required_fields)
            || array_diff($required_fields, array_keys($definition))
            || array_diff(array_keys($definition), $required_fields)) {
            return new WP_Error(
                'human_app_definition_shape_invalid',
                'Every canonical Human app definition must contain the complete 24-field contract.'
            );
        }

        $definition_slug = sanitize_title($definition['slug']);
        if ($definition_slug === ''
            || sanitize_key((string) $definition_key) !== $definition_slug
            || isset($definition_slugs[$definition_slug])
        ) {
            return new WP_Error(
                'human_app_definition_slug_invalid',
                'Canonical Human app keys and slugs must match and be non-empty and unique.'
            );
        }
        if (!in_array($definition['current_status'], human_get_allowed_app_statuses(), true)
            || human_normalize_app_status($definition['current_status'], $definition_slug) !== $definition['current_status']
        ) {
            return new WP_Error(
                'human_app_definition_status_invalid',
                sprintf('The canonical lifecycle status for "%s" is invalid.', $definition_slug)
            );
        }
        foreach (array('legacy_statuses', 'legacy_descriptions', 'legacy_target_urls', 'legacy_pricing') as $legacy_field) {
            if (!is_array($definition[$legacy_field])) {
                return new WP_Error(
                    'human_app_definition_legacy_contract_invalid',
                    sprintf('The legacy field %s for "%s" must be an array.', $legacy_field, $definition_slug)
                );
            }
        }
        $definition_slugs[$definition_slug] = true;
    }

    $owner_token = human_acquire_app_migration_lock();
    if (is_wp_error($owner_token)) {
        return $owner_token;
    }

    try {
        $matches_by_slug = array();

        // Complete duplicate preflight: no writes occur until every slug passes.
        foreach ($definitions as $definition) {
            $slug = sanitize_title($definition['slug']);
            $matches = human_find_app_ids_by_slug($slug);
            if (is_wp_error($matches)) {
                return $matches;
            }
            if (count($matches) > 1) {
                return new WP_Error(
                    'human_app_duplicate_slug',
                    sprintf('Multiple Human App records use the canonical slug "%s".', $slug),
                    array('slug' => $slug, 'post_ids' => array_map('intval', $matches))
                );
            }
            if (count($matches) === 1) {
                $existing_post = get_post((int) $matches[0]);
                if (!$existing_post
                    || $existing_post->post_type !== 'human_app'
                    || $existing_post->post_name !== $slug
                    || $existing_post->post_status !== 'publish'
                ) {
                    return new WP_Error(
                        'human_app_existing_record_not_publishable',
                        sprintf('The canonical Human App record for "%s" must be resolved before migration.', $slug),
                        array(
                            'slug' => $slug,
                            'post_id' => (int) $matches[0],
                            'post_status' => $existing_post ? $existing_post->post_status : 'missing'
                        )
                    );
                }
            }
            $matches_by_slug[$slug] = $matches;
        }

        $conflicts = array();
        $meta_contract = array(
            'product_type' => '_human_product_type',
            'distribution_channel' => '_human_distribution_channel',
            'distribution_url' => '_human_distribution_url',
            'external_identifier' => '_human_external_identifier',
            'current_status' => '_human_app_status',
            'app_id' => '_human_app_package_id',
            'pricing' => '_human_app_pricing',
            'price_amount' => '_human_app_price_amount',
            'price_currency' => '_human_app_price_currency',
            'billing_period' => '_human_app_billing_period',
            'trial_days' => '_human_app_trial_days',
            'target_url' => '_human_app_target_url',
            'play_url' => '_human_app_play_url',
            'internal_test_url' => '_human_app_internal_test_url',
            'cta_label' => '_human_app_cta_label'
        );
        $legacy_contract = array(
            'current_status' => 'legacy_statuses',
            'pricing' => 'legacy_pricing',
            'target_url' => 'legacy_target_urls'
        );

        foreach ($definitions as $definition) {
            $slug = sanitize_title($definition['slug']);
            $matches = $matches_by_slug[$slug];
            $is_new = empty($matches);

            if ($is_new) {
                $post_id = wp_insert_post(array(
                    'post_title' => (string) $definition['title'],
                    'post_name' => $slug,
                    'post_content' => (string) $definition['description'],
                    'post_status' => 'publish',
                    'post_type' => 'human_app'
                ), true);

                if (is_wp_error($post_id) || !$post_id) {
                    return is_wp_error($post_id)
                        ? $post_id
                        : new WP_Error('human_app_insert_failed', sprintf('Could not create Human App "%s".', $slug));
                }
            } else {
                $post_id = (int) $matches[0];
            }

            $post = get_post($post_id);
            if (!$post
                || $post->post_type !== 'human_app'
                || $post->post_name !== $slug
                || $post->post_status !== 'publish'
            ) {
                return new WP_Error(
                    'human_app_post_verification_failed',
                    sprintf('Could not verify the Human App post for "%s".', $slug)
                );
            }
            if ($is_new
                && ($post->post_title !== (string) $definition['title']
                    || $post->post_content !== (string) $definition['description']
                    || $post->post_status !== 'publish')) {
                return new WP_Error(
                    'human_app_insert_readback_failed',
                    sprintf('The newly created Human App "%s" did not match its canonical post fields.', $slug)
                );
            }

            $post_update = array('ID' => $post_id);
            $needs_post_update = false;

            if ($is_new || $post->post_title === (string) $definition['title']) {
                if ($post->post_title !== (string) $definition['title']) {
                    $post_update['post_title'] = (string) $definition['title'];
                    $needs_post_update = true;
                }
            } else {
                human_record_app_migration_conflict(
                    $conflicts,
                    $slug,
                    'title',
                    $post->post_title,
                    $definition['title']
                );
            }

            if ($is_new || human_app_value_is_reconcilable(
                $post->post_content,
                $definition['description'],
                $definition['legacy_descriptions'],
                true
            )) {
                if ($post->post_content !== (string) $definition['description']) {
                    $post_update['post_content'] = (string) $definition['description'];
                    $needs_post_update = true;
                }
            } else {
                human_record_app_migration_conflict(
                    $conflicts,
                    $slug,
                    'description',
                    $post->post_content,
                    $definition['description']
                );
            }

            if ($needs_post_update) {
                $updated_post_id = wp_update_post(wp_slash($post_update), true);
                if (is_wp_error($updated_post_id) || (int) $updated_post_id !== $post_id) {
                    return is_wp_error($updated_post_id)
                        ? $updated_post_id
                        : new WP_Error('human_app_post_update_failed', sprintf('Could not update Human App "%s".', $slug));
                }
            }

            $verified_post = get_post($post_id);
            if (!$verified_post
                || $verified_post->post_type !== 'human_app'
                || $verified_post->post_name !== $slug
                || $verified_post->post_status !== 'publish'
            ) {
                return new WP_Error('human_app_post_readback_failed', sprintf('Could not reload Human App "%s".', $slug));
            }
            if (isset($post_update['post_title']) && $verified_post->post_title !== (string) $definition['title']) {
                return new WP_Error('human_app_title_write_failed', sprintf('Could not verify the title for "%s".', $slug));
            }
            if (isset($post_update['post_content']) && $verified_post->post_content !== (string) $definition['description']) {
                return new WP_Error('human_app_content_write_failed', sprintf('Could not verify the description for "%s".', $slug));
            }

            foreach ($meta_contract as $field => $meta_key) {
                $current = (string) get_post_meta($post_id, $meta_key, true);
                $value_exists = metadata_exists('post', $post_id, $meta_key);
                $legacy_values = isset($legacy_contract[$field])
                    ? $definition[$legacy_contract[$field]]
                    : array();

                if ($is_new || human_app_value_is_reconcilable(
                    $current,
                    $definition[$field],
                    $legacy_values,
                    $value_exists
                )) {
                    $write_result = human_write_verified_app_meta($post_id, $meta_key, $definition[$field]);
                    if (is_wp_error($write_result)) {
                        return $write_result;
                    }
                } else {
                    human_record_app_migration_conflict(
                        $conflicts,
                        $slug,
                        $field,
                        $current,
                        $definition[$field]
                    );
                }
            }
        }

        update_option('human_app_migration_1_4_0_conflicts', $conflicts, false);
        if (get_option('human_app_migration_1_4_0_conflicts', null) !== $conflicts) {
            return new WP_Error(
                'human_app_conflict_report_write_failed',
                'Could not verify the Human app migration conflict report.'
            );
        }

        return true;
    } finally {
        human_release_app_migration_lock($owner_token);
    }
}

/**
 * Return sample Campaign definitions used as safe reference data.
 *
 * Sample campaigns are intentionally draft, unapproved and never automation
 * eligible. They exist to demonstrate the marketing workflow without becoming
 * publishable payloads.
 */
function human_get_sample_campaign_definitions() {
    return array(
        array(
            'seed_key' => 'campaign_human_v1_brand_intro_v1',
            'title' => 'Human V1 Brand Introduction',
            'objective' => 'Introduce Human V1 and explain Human Version 1.0 without overstating future products.',
            'associated_app_slug' => '',
            'target_url' => '/',
            'utm_id' => 'human_v1_brand_intro',
            'utm_source' => 'facebook',
            'utm_medium' => 'social',
            'utm_campaign' => 'human_v1_brand_intro',
            'priority' => 'normal',
            'facebook_copy' => 'Human V1 means Human Version 1.0. Human Strength is the first product, while the wider Human V1 roadmap remains a set of future products and ideas.',
            'instagram_copy' => 'Human V1 = Human Version 1.0. Start with Human Strength, stay truthful about what exists today, and build the wider platform from there.',
        ),
        array(
            'seed_key' => 'campaign_strength_internal_testing_v1',
            'title' => 'Human Strength Internal Testing',
            'objective' => 'Explain that Human Strength is currently in Google Play Internal Testing for eligible or invited testers.',
            'associated_app_slug' => 'strength',
            'target_url' => '/strength/',
            'utm_id' => 'human_strength_internal_testing',
            'utm_source' => 'facebook',
            'utm_medium' => 'social',
            'utm_campaign' => 'human_strength_internal_testing',
            'priority' => 'high',
            'facebook_copy' => 'Human Strength is currently in Google Play Internal Testing. Tester access is real, but general public Play Store availability is not being claimed yet.',
            'instagram_copy' => 'Human Strength is in Internal Testing on Google Play. Current status: eligible or invited testers, not a general public release.',
        ),
        array(
            'seed_key' => 'campaign_strength_access_explainer_v1',
            'title' => 'How Human Strength Access Works',
            'objective' => 'Explain Google Sign-In, Human V1 introductory account access and separate Google Play paid membership.',
            'associated_app_slug' => 'strength',
            'target_url' => '/how-human-strength-access-works/',
            'utm_id' => 'human_strength_access',
            'utm_source' => 'facebook',
            'utm_medium' => 'social',
            'utm_campaign' => 'human_strength_access',
            'priority' => 'normal',
            'facebook_copy' => 'Human Strength access has separate parts: Google Sign-In, Human V1 introductory account access, and paid Google Play membership. The account access period is not a Google Play free trial.',
            'instagram_copy' => 'Google Sign-In, Human V1 account access and paid Google Play membership are separate parts of the Human Strength access flow.',
        ),
        array(
            'seed_key' => 'campaign_why_strength_first_v1',
            'title' => 'Why Human V1 Begins with Strength',
            'objective' => 'Distribute the Human Journal article explaining why Human Strength is the first Human V1 product.',
            'associated_app_slug' => 'strength',
            'target_url' => '/why-human-v1-begins-with-strength/',
            'utm_id' => 'why_strength_first',
            'utm_source' => 'facebook',
            'utm_medium' => 'social',
            'utm_campaign' => 'why_strength_first',
            'priority' => 'normal',
            'facebook_copy' => 'Why begin Human V1 with strength? Because one focused product gives the platform something real to build from. Human Strength is currently in Google Play Internal Testing.',
            'instagram_copy' => 'One focused first product. Human Strength is where Human V1 begins, currently in Google Play Internal Testing.',
        ),
    );
}

/**
 * Seed or reconcile one reference Journal post without overwriting editor work.
 *
 * @return int|WP_Error
 */
function human_upsert_reference_journal_post($definition, &$conflicts) {
    $existing = get_page_by_path($definition['slug'], OBJECT, 'post');
    $post_status = $definition['status'] === 'publish' ? 'publish' : 'draft';
    $seed_hash = hash('sha256', wp_json_encode(array(
        $definition['title'],
        $definition['excerpt'],
        $definition['content'],
        $definition['seo_title'],
        $definition['seo_desc'],
        $definition['social_title'],
        $definition['social_desc'],
        $definition['promo_copy'],
    )));

    if (!$existing) {
        $post_id = wp_insert_post(array(
            'post_title' => $definition['title'],
            'post_name' => $definition['slug'],
            'post_content' => $definition['content'],
            'post_excerpt' => $definition['excerpt'],
            'post_status' => $post_status,
            'post_type' => 'post',
        ), true);
        if (is_wp_error($post_id) || !$post_id) {
            return is_wp_error($post_id)
                ? $post_id
                : new WP_Error('human_reference_post_insert_failed', 'Could not create Human Journal reference content.');
        }
    } else {
        $post_id = (int) $existing->ID;
        $stored_seed_key = (string) get_post_meta($post_id, '_human_seed_key', true);
        $stored_seed_hash = (string) get_post_meta($post_id, '_human_seed_hash', true);

        if ($stored_seed_key !== '' && $stored_seed_key !== $definition['seed_key']) {
            $conflicts[] = array(
                'type' => 'journal',
                'slug' => $definition['slug'],
                'reason' => 'Existing post belongs to a different seed key.',
                'post_id' => $post_id,
            );
            return $post_id;
        }

        if ($stored_seed_hash !== '') {
            $current_hash = hash('sha256', wp_json_encode(array(
                $existing->post_title,
                $existing->post_excerpt,
                $existing->post_content,
                get_post_meta($post_id, '_human_seo_title', true),
                get_post_meta($post_id, '_human_seo_description', true),
                get_post_meta($post_id, '_human_social_title', true),
                get_post_meta($post_id, '_human_social_description', true),
                get_post_meta($post_id, '_human_promo_copy', true),
            )));
            if (!hash_equals($stored_seed_hash, $current_hash)) {
                if ($post_status === 'draft') {
                    wp_update_post(array('ID' => $post_id, 'post_status' => 'draft'));
                    update_post_meta($post_id, '_human_is_sample', '1');
                    update_post_meta($post_id, '_human_content_approval_state', 'draft');
                }
                update_post_meta($post_id, '_human_automation_eligible', '0');
                $conflicts[] = array(
                    'type' => 'journal',
                    'slug' => $definition['slug'],
                    'reason' => 'Editor-managed content differs from the last seed fingerprint and was preserved.',
                    'post_id' => $post_id,
                );
                return $post_id;
            }
        } elseif ($existing->post_content !== $definition['content'] || $existing->post_title !== $definition['title']) {
            if ($post_status === 'draft') {
                wp_update_post(array('ID' => $post_id, 'post_status' => 'draft'));
                update_post_meta($post_id, '_human_is_sample', '1');
                update_post_meta($post_id, '_human_content_approval_state', 'draft');
                update_post_meta($post_id, '_human_automation_eligible', '0');
            }
            $conflicts[] = array(
                'type' => 'journal',
                'slug' => $definition['slug'],
                'reason' => 'Pre-existing content has no seed fingerprint and was preserved.',
                'post_id' => $post_id,
            );
            return $post_id;
        }

        $updated = wp_update_post(wp_slash(array(
            'ID' => $post_id,
            'post_title' => $definition['title'],
            'post_name' => $definition['slug'],
            'post_content' => $definition['content'],
            'post_excerpt' => $definition['excerpt'],
            'post_status' => $post_status,
        )), true);
        if (is_wp_error($updated)) {
            return $updated;
        }
    }

    update_post_meta($post_id, '_human_seed_key', $definition['seed_key']);
    update_post_meta($post_id, '_human_is_sample', $post_status === 'draft' ? '1' : '0');
    update_post_meta($post_id, '_human_automation_eligible', '0');
    update_post_meta($post_id, '_human_content_approval_state', $post_status === 'publish' ? 'approved_reference' : 'draft');
    update_post_meta($post_id, '_human_seo_title', $definition['seo_title']);
    update_post_meta($post_id, '_human_seo_description', $definition['seo_desc']);
    update_post_meta($post_id, '_human_post_primary_topic', $definition['primary_topic']);
    update_post_meta($post_id, '_human_post_search_intent', $definition['search_intent']);
    update_post_meta($post_id, '_human_social_title', $definition['social_title']);
    update_post_meta($post_id, '_human_social_description', $definition['social_desc']);
    update_post_meta($post_id, '_human_social_image', get_template_directory_uri() . '/assets/human-og-share.png');
    update_post_meta($post_id, '_human_promo_copy', $definition['promo_copy']);
    update_post_meta($post_id, '_human_post_content_type', $definition['content_type']);
    update_post_meta($post_id, '_human_post_evergreen', $definition['evergreen']);
    update_post_meta($post_id, '_human_post_marketing_status', $post_status === 'publish' ? 'reference' : 'sample');

    if (!empty($definition['primary_app_slug'])) {
        $primary_app = get_page_by_path($definition['primary_app_slug'], OBJECT, 'human_app');
        if ($primary_app) {
            update_post_meta($post_id, '_human_post_primary_product', $primary_app->ID);
        }
    } else {
        delete_post_meta($post_id, '_human_post_primary_product');
    }

    if (!empty($definition['primary_cta_title'])) {
        $primary_cta = get_page_by_title($definition['primary_cta_title'], OBJECT, 'human_cta');
        if ($primary_cta) {
            update_post_meta($post_id, '_human_post_primary_cta', $primary_cta->ID);
        }
    } else {
        delete_post_meta($post_id, '_human_post_primary_cta');
    }

    $category = get_term_by('name', $definition['category'], 'category');
    if (!$category) {
        $created = wp_insert_term($definition['category'], 'category');
        if (!is_wp_error($created)) {
            $category_id = (int) $created['term_id'];
        } else {
            $category_id = 0;
        }
    } else {
        $category_id = (int) $category->term_id;
    }
    if ($category_id) {
        wp_set_post_categories($post_id, array($category_id), false);
    }

    $fresh = get_post($post_id);
    $final_hash = hash('sha256', wp_json_encode(array(
        $fresh->post_title,
        $fresh->post_excerpt,
        $fresh->post_content,
        get_post_meta($post_id, '_human_seo_title', true),
        get_post_meta($post_id, '_human_seo_description', true),
        get_post_meta($post_id, '_human_social_title', true),
        get_post_meta($post_id, '_human_social_description', true),
        get_post_meta($post_id, '_human_promo_copy', true),
    )));
    update_post_meta($post_id, '_human_seed_hash', $final_hash);

    return $post_id;
}

/**
 * Seed or reconcile one sample Campaign.
 *
 * @return int|WP_Error
 */
function human_upsert_sample_campaign($definition, &$conflicts) {
    $matches = get_posts(array(
        'post_type' => 'human_campaign',
        'post_status' => 'any',
        'numberposts' => -1,
        'meta_key' => '_human_camp_seed_key',
        'meta_value' => $definition['seed_key'],
        'fields' => 'ids',
    ));

    if (count($matches) > 1) {
        return new WP_Error(
            'human_sample_campaign_duplicate',
            sprintf('Multiple sample Campaigns use seed key %s.', $definition['seed_key'])
        );
    }

    if ($matches) {
        $post_id = (int) $matches[0];
        $post = get_post($post_id);
        $stored_hash = (string) get_post_meta($post_id, '_human_camp_seed_hash', true);
        if ($stored_hash !== '') {
            $current_hash = hash('sha256', wp_json_encode(array(
                $post->post_title,
                $post->post_content,
                get_post_meta($post_id, '_human_camp_objective', true),
                get_post_meta($post_id, '_human_camp_target_url', true),
                get_post_meta($post_id, '_human_camp_utm_id', true),
                get_post_meta($post_id, '_human_camp_facebook_copy', true),
                get_post_meta($post_id, '_human_camp_instagram_copy', true),
            )));
            if (!hash_equals($stored_hash, $current_hash)) {
                wp_update_post(array('ID' => $post_id, 'post_status' => 'draft'));
                update_post_meta($post_id, '_human_is_sample', '1');
                update_post_meta($post_id, '_human_camp_approval_state', 'draft');
                update_post_meta($post_id, '_human_camp_automation_eligible', '0');
                $conflicts[] = array(
                    'type' => 'campaign',
                    'seed_key' => $definition['seed_key'],
                    'reason' => 'Editor-managed Campaign differs from the last sample seed fingerprint and was preserved.',
                    'post_id' => $post_id,
                );
                return $post_id;
            }
        }
    } else {
        $post_id = wp_insert_post(array(
            'post_title' => $definition['title'],
            'post_content' => $definition['objective'],
            'post_status' => 'draft',
            'post_type' => 'human_campaign',
        ), true);
        if (is_wp_error($post_id) || !$post_id) {
            return is_wp_error($post_id)
                ? $post_id
                : new WP_Error('human_sample_campaign_insert_failed', 'Could not create Human sample Campaign.');
        }
    }

    $updated = wp_update_post(array(
        'ID' => $post_id,
        'post_title' => $definition['title'],
        'post_content' => $definition['objective'],
        'post_status' => 'draft',
    ), true);
    if (is_wp_error($updated)) {
        return $updated;
    }

    update_post_meta($post_id, '_human_camp_seed_key', $definition['seed_key']);
    update_post_meta($post_id, '_human_is_sample', '1');
    update_post_meta($post_id, '_human_camp_approval_state', 'draft');
    update_post_meta($post_id, '_human_camp_automation_eligible', '0');
    update_post_meta($post_id, '_human_camp_status', 'draft');
    update_post_meta($post_id, '_human_camp_objective', $definition['objective']);
    update_post_meta($post_id, '_human_camp_target_url', $definition['target_url']);
    update_post_meta($post_id, '_human_camp_utm_id', $definition['utm_id']);
    update_post_meta($post_id, '_human_camp_utm_source', $definition['utm_source']);
    update_post_meta($post_id, '_human_camp_utm_medium', $definition['utm_medium']);
    update_post_meta($post_id, '_human_camp_utm_campaign', $definition['utm_campaign']);
    update_post_meta($post_id, '_human_camp_priority', $definition['priority']);
    update_post_meta($post_id, '_human_camp_facebook_copy', $definition['facebook_copy']);
    update_post_meta($post_id, '_human_camp_instagram_copy', $definition['instagram_copy']);

    if ($definition['associated_app_slug'] !== '') {
        $app = get_page_by_path($definition['associated_app_slug'], OBJECT, 'human_app');
        if ($app) {
            update_post_meta($post_id, '_human_camp_associated_app', $app->ID);
        }
    }

    $fresh = get_post($post_id);
    $seed_hash = hash('sha256', wp_json_encode(array(
        $fresh->post_title,
        $fresh->post_content,
        get_post_meta($post_id, '_human_camp_objective', true),
        get_post_meta($post_id, '_human_camp_target_url', true),
        get_post_meta($post_id, '_human_camp_utm_id', true),
        get_post_meta($post_id, '_human_camp_facebook_copy', true),
        get_post_meta($post_id, '_human_camp_instagram_copy', true),
    )));
    update_post_meta($post_id, '_human_camp_seed_hash', $seed_hash);

    return $post_id;
}

/**
 * Acquire the content reconciliation lock.
 *
 * @return string|WP_Error Owner token on success.
 */
function human_acquire_content_migration_lock() {
    global $wpdb;

    $option_name = 'human_content_migration_1_5_0_lock';
    $now = time();
    $token = wp_generate_uuid4();
    $payload = array(
        'owner' => $token,
        'acquired_at' => $now,
        'expires_at' => $now + 900,
    );

    if (add_option($option_name, $payload, '', 'no')) {
        return $token;
    }

    $existing = get_option($option_name, null);
    if (!is_array($existing) || empty($existing['expires_at']) || (int) $existing['expires_at'] > $now) {
        return new WP_Error('human_content_migration_locked', 'Content migration 1.5.0 is already running.');
    }

    $replaced = $wpdb->query($wpdb->prepare(
        "UPDATE {$wpdb->options} SET option_value = %s WHERE option_name = %s AND option_value = %s",
        maybe_serialize($payload),
        $option_name,
        maybe_serialize($existing)
    ));
    wp_cache_delete($option_name, 'options');

    if ($replaced !== 1) {
        return new WP_Error('human_content_migration_lock_race', 'Another request acquired the content migration lock.');
    }

    return $token;
}

/**
 * Release the content reconciliation lock only when this process still owns it.
 */
function human_release_content_migration_lock($owner_token) {
    global $wpdb;

    $option_name = 'human_content_migration_1_5_0_lock';
    $existing = get_option($option_name, null);
    if (is_array($existing)
        && isset($existing['owner'])
        && hash_equals((string) $existing['owner'], (string) $owner_token)
    ) {
        $wpdb->query($wpdb->prepare(
            "DELETE FROM {$wpdb->options} WHERE option_name = %s AND option_value = %s",
            $option_name,
            maybe_serialize($existing)
        ));
        wp_cache_delete($option_name, 'options');
    }
}

/**
 * Reconcile stale launch-era Journal and Campaign sample data.
 *
 * No editor-modified post is deleted or overwritten. Exact historical seed
 * fingerprints are moved to draft and labelled as retired samples.
 */
function human_migration_1_5_0() {
    $owner_token = human_acquire_content_migration_lock();
    if (is_wp_error($owner_token)) {
        return $owner_token;
    }

    $conflicts = array();

    try {
        // Replace the untouched stock WordPress Hello World post with the
        // canonical published Human V1 introduction article.
        $hello = get_page_by_path('hello-world', OBJECT, 'post');
        if ($hello) {
            $stock_content = 'Welcome to WordPress. This is your first post. Edit or delete it, then start writing!';
            $hello_visible_text = trim((string) preg_replace(
                '/\s+/u',
                ' ',
                html_entity_decode(wp_strip_all_tags((string) $hello->post_content), ENT_QUOTES | ENT_HTML5, 'UTF-8')
            ));
            $hello_is_stock = (
                $hello->post_title === 'Hello world!'
                && $hello_visible_text === $stock_content
                && trim($hello->post_excerpt) === ''
            );
            $intro = human_get_cornerstone_articles()[0];
            $intro_existing = get_page_by_path($intro['slug'], OBJECT, 'post');
            if ($hello_is_stock
                && (!$intro_existing || (int) $intro_existing->ID === (int) $hello->ID)
            ) {
                $updated = wp_update_post(wp_slash(array(
                    'ID' => $hello->ID,
                    'post_title' => $intro['title'],
                    'post_name' => $intro['slug'],
                    'post_content' => $intro['content'],
                    'post_excerpt' => $intro['excerpt'],
                    'post_status' => 'publish',
                )), true);
                if (is_wp_error($updated)) {
                    return $updated;
                }
            } elseif ($hello_is_stock && $intro_existing) {
                wp_update_post(array('ID' => $hello->ID, 'post_status' => 'draft'));
                update_post_meta($hello->ID, '_human_legacy_seed_retired', '1');
            } else {
                $conflicts[] = array(
                    'type' => 'journal',
                    'slug' => 'hello-world',
                    'reason' => 'The default WordPress post has been edited and was preserved.',
                    'post_id' => (int) $hello->ID,
                );
            }
        }

        // Retire untouched historical 1.0.0 seed articles. Edited articles stay
        // exactly as they are and are surfaced in the conflict report.
        foreach (human_get_legacy_cornerstone_fingerprints() as $slug => $legacy_hashes) {
            $post = get_page_by_path($slug, OBJECT, 'post');
            if (!$post) {
                continue;
            }
            $current_content_hash = hash('sha256', $post->post_content);
            $current_title_hash = hash('sha256', $post->post_title);
            if (hash_equals($legacy_hashes['content'], $current_content_hash)
                && hash_equals($legacy_hashes['title'], $current_title_hash)
            ) {
                $updated = wp_update_post(array(
                    'ID' => $post->ID,
                    'post_status' => 'draft',
                ), true);
                if (is_wp_error($updated)) {
                    return $updated;
                }
                update_post_meta($post->ID, '_human_is_sample', '1');
                update_post_meta($post->ID, '_human_automation_eligible', '0');
                update_post_meta($post->ID, '_human_content_approval_state', 'retired_legacy_seed');
                update_post_meta($post->ID, '_human_legacy_seed_retired', '1');
            } else {
                $conflicts[] = array(
                    'type' => 'journal',
                    'slug' => $slug,
                    'reason' => 'Historical seed article was edited and was preserved.',
                    'post_id' => (int) $post->ID,
                );
            }
        }

        // Seed/reconcile the current reference Journal set.
        foreach (human_get_cornerstone_articles() as $definition) {
            $result = human_upsert_reference_journal_post($definition, $conflicts);
            if (is_wp_error($result)) {
                return $result;
            }
        }

        // Retire the original public-download CTA if it is still the untouched
        // launch-era seed. Internal Testing must not expose a general Play CTA.
        $legacy_download_cta = get_page_by_title('Get Human Strength on Google Play', OBJECT, 'human_cta');
        if ($legacy_download_cta) {
            $legacy_label = (string) get_post_meta($legacy_download_cta->ID, '_human_cta_label', true);
            $legacy_url = (string) get_post_meta($legacy_download_cta->ID, '_human_cta_destination_url', true);
            $legacy_supporting = (string) get_post_meta($legacy_download_cta->ID, '_human_cta_supporting_text', true);
            $is_known_legacy_download = $legacy_url === 'https://play.google.com/store/apps/details?id=com.aistudio.humanstrength.kfqjza'
                && (
                    ($legacy_label === 'Download on Google Play'
                        && $legacy_supporting === 'Start your 30-day introductory trial today.')
                    || ($legacy_label === 'Download App'
                        && $legacy_supporting === 'Now available for early access on Android.')
                );
            if ($is_known_legacy_download) {
                update_post_meta($legacy_download_cta->ID, '_human_cta_status', 'inactive');
                update_post_meta($legacy_download_cta->ID, '_human_cta_label', 'Internal Testing');
                update_post_meta($legacy_download_cta->ID, '_human_cta_supporting_text', 'Human Strength is currently limited to eligible or invited testers.');
                update_post_meta($legacy_download_cta->ID, '_human_cta_destination_url', '/strength/');
                update_post_meta($legacy_download_cta->ID, '_human_legacy_seed_retired', '1');
            } else {
                $conflicts[] = array(
                    'type' => 'cta',
                    'title' => 'Get Human Strength on Google Play',
                    'reason' => 'Historical CTA was edited and was preserved.',
                    'post_id' => (int) $legacy_download_cta->ID,
                );
            }
        }

        // Retire the exact original launch Campaign if it is still untouched.
        $legacy_campaign = get_page_by_title('Strength V1 Launch', OBJECT, 'human_campaign');
        if ($legacy_campaign) {
            $legacy_objective = (string) get_post_meta($legacy_campaign->ID, '_human_camp_objective', true);
            $legacy_status = (string) get_post_meta($legacy_campaign->ID, '_human_camp_status', true);
            $legacy_utm = (string) get_post_meta($legacy_campaign->ID, '_human_camp_utm_id', true);
            if ($legacy_objective === 'Initial product launch and awareness'
                && $legacy_status === 'planned'
                && $legacy_utm === 'strength_v1_launch'
            ) {
                wp_update_post(array('ID' => $legacy_campaign->ID, 'post_status' => 'draft'));
                update_post_meta($legacy_campaign->ID, '_human_camp_status', 'archived');
                update_post_meta($legacy_campaign->ID, '_human_is_sample', '1');
                update_post_meta($legacy_campaign->ID, '_human_camp_approval_state', 'draft');
                update_post_meta($legacy_campaign->ID, '_human_camp_automation_eligible', '0');
                update_post_meta($legacy_campaign->ID, '_human_legacy_seed_retired', '1');
            } else {
                $conflicts[] = array(
                    'type' => 'campaign',
                    'title' => 'Strength V1 Launch',
                    'reason' => 'Historical Campaign was edited and was preserved.',
                    'post_id' => (int) $legacy_campaign->ID,
                );
            }
        }

        foreach (human_get_sample_campaign_definitions() as $definition) {
            $result = human_upsert_sample_campaign($definition, $conflicts);
            if (is_wp_error($result)) {
                return $result;
            }
        }

        // Link only seed-managed reference posts to their matching sample
        // Campaigns. Editor-owned posts are never assigned automatically.
        foreach (human_get_cornerstone_articles() as $article_definition) {
            if (empty($article_definition['campaign_seed_key'])) {
                continue;
            }
            $post = get_page_by_path($article_definition['slug'], OBJECT, 'post');
            if (!$post || get_post_meta($post->ID, '_human_seed_key', true) !== $article_definition['seed_key']) {
                continue;
            }

            $campaign_ids = get_posts(array(
                'post_type' => 'human_campaign',
                'post_status' => array('draft', 'publish'),
                'numberposts' => 1,
                'meta_key' => '_human_camp_seed_key',
                'meta_value' => $article_definition['campaign_seed_key'],
                'fields' => 'ids',
            ));
            if ($campaign_ids) {
                update_post_meta($post->ID, '_human_post_primary_campaign', (int) $campaign_ids[0]);
            }
        }

        update_option('human_content_migration_1_5_0_conflicts', $conflicts, false);
        if (get_option('human_content_migration_1_5_0_conflicts', null) !== $conflicts) {
            return new WP_Error('human_content_conflict_report_write_failed', 'Could not verify the content migration conflict report.');
        }

        update_option('human_content_seed_version', '1.5.0', false);
        if (get_option('human_content_seed_version', '') !== '1.5.0') {
            return new WP_Error('human_content_seed_version_write_failed', 'Could not verify the content seed version.');
        }

        return true;
    } finally {
        human_release_content_migration_lock($owner_token);
    }
}

/**
 * Migration 1.6.0: establish generic digital-product portability metadata on
 * the eight canonical Human V1 products without overwriting editor values.
 */
function human_migration_1_6_0() {
    if (!function_exists('human_get_app_definitions')) {
        return new WP_Error('human_product_definitions_missing', 'The canonical product definitions are unavailable.');
    }

    $definitions = human_get_app_definitions();
    if (!is_array($definitions) || count($definitions) !== 8) {
        return new WP_Error('human_product_definitions_invalid', 'The canonical Human V1 catalogue must contain exactly eight definitions.');
    }

    $owner_token = human_acquire_app_migration_lock();
    if (is_wp_error($owner_token)) {
        return $owner_token;
    }

    try {
        $conflicts = array();
        $meta_contract = array(
            'product_type' => '_human_product_type',
            'distribution_channel' => '_human_distribution_channel',
            'distribution_url' => '_human_distribution_url',
            'external_identifier' => '_human_external_identifier',
        );

        foreach ($definitions as $slug => $definition) {
            foreach (array_keys($meta_contract) as $required_field) {
                if (!array_key_exists($required_field, $definition)) {
                    return new WP_Error(
                        'human_product_definition_portability_field_missing',
                        sprintf('Product "%s" is missing portability field "%s".', $slug, $required_field)
                    );
                }
            }

            $matches = human_find_app_ids_by_slug($slug);
            if (is_wp_error($matches)) {
                return $matches;
            }
            if (count($matches) !== 1) {
                return new WP_Error(
                    'human_product_portability_record_missing',
                    sprintf('Exactly one published Human product record is required for "%s".', $slug),
                    array('slug' => $slug, 'post_ids' => array_map('intval', $matches))
                );
            }

            $post_id = (int) $matches[0];
            foreach ($meta_contract as $field => $meta_key) {
                if (!metadata_exists('post', $post_id, $meta_key)) {
                    $result = human_write_verified_app_meta($post_id, $meta_key, $definition[$field]);
                    if (is_wp_error($result)) {
                        return $result;
                    }
                    continue;
                }

                $current = (string) get_post_meta($post_id, $meta_key, true);
                if ($current !== (string) $definition[$field]) {
                    human_record_app_migration_conflict(
                        $conflicts,
                        $slug,
                        $field,
                        $current,
                        $definition[$field]
                    );
                }
            }
        }

        update_option('human_product_migration_1_6_0_conflicts', $conflicts, false);
        if (get_option('human_product_migration_1_6_0_conflicts', null) !== $conflicts) {
            return new WP_Error('human_product_migration_conflict_write_failed', 'Could not verify the 1.6.0 portability conflict report.');
        }

        return true;
    } finally {
        human_release_app_migration_lock($owner_token);
    }
}
