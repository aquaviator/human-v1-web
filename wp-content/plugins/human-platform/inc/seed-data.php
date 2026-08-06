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
 * Returns the 10 Cornerstone Launch Articles Definition
 */
function human_get_cornerstone_articles() {
    return array(
        array(
            'slug'          => 'how-to-track-strength-training-progress-properly',
            'title'         => 'How to Track Strength Training Progress Properly',
            'category'      => 'Strength Training',
            'author'        => 'Human Editorial Team',
            'date'          => '2026-07-20',
            'excerpt'       => 'Most lifters track weight and reps, but miss total tonnage, set velocity, and progressive volume trends over time. Here is the structured approach to tracking real strength gains.',
            'target_intent' => 'strength training progress, track strength gains, workout tracking guide',
            'seo_title'     => 'How to Track Strength Training Progress Properly | Human Journal',
            'seo_desc'      => 'Learn how to accurately track strength training progress beyond arbitrary weight numbers. Discover volume metrics, estimated 1RM, and local logging strategies.',
            'cta_type'      => 'strength',
            'content'       => '<h2>The Common Fallacy of Workout Tracking</h2>
<p>Tracking your strength training sounds simple: write down the weight you lifted and how many times you lifted it. Yet thousands of lifters hit plateaus despite diligently recording every session. Why? Because recording raw numbers without understanding volume distribution, rep quality, or progressive overload metrics provides data without context.</p>

<h3>1. Total Tonnage vs. Effective Volume</h3>
<p>Tonnage (Load × Reps × Sets) offers a macro view of workload. However, not all tonnage is created equal. Moving 10,000 kg across 20 easy sets is neuro-muscularly distinct from moving 10,000 kg across 5 hard, high-stimulus sets near failure. Proper progress tracking isolates working sets performed within target RPE (Rating of Perceived Exertion) brackets.</p>

<h3>2. The Role of Estimated 1RM Progression</h3>
<p>You do not need to test a true 1-Rep Max every week to know if you are getting stronger. Using validated submaximal formulas (such as Brzycki or Epley formulas), estimated 1RM (e1RM) calculations provide a clean rolling benchmark across varying rep ranges.</p>

<h3>3. Standardising Execution and Range of Motion</h3>
<p>Data is useless if the measurement criteria change. Halving your squat depth to add 20kg to the bar is false progress. Reliable strength tracking requires standardized tempo, pause duration, and range of motion across workouts.</p>

<div class="journal-cta-box" style="background:var(--human-dark-surface);border:1px solid var(--human-border-dark);border-radius:12px;padding:2rem;margin:2.5rem 0;text-align:center;">
    <span class="eyebrow">BUILT FOR REAL TRACKING</span>
    <h3 style="margin-bottom:0.75rem;color:var(--human-white);">Track Your Strength Progression With Human Strength</h3>
    <p style="color:#94A3B8;margin-bottom:1.5rem;font-size:0.95rem;">Experience offline-first logging with automatic tonnage analytics, e1RM curves, and local Room DB performance on Android.</p>
    <a href="/strength" class="btn btn-primary">Explore Human Strength &rarr;</a>
</div>'
        ),
        array(
            'slug'          => 'progressive-overload-what-it-actually-means-and-how-to-track-it',
            'title'         => 'Progressive Overload: What It Actually Means and How to Track It',
            'category'      => 'Programming',
            'author'        => 'Human Performance Science',
            'date'          => '2026-07-21',
            'excerpt'       => 'Progressive overload is not just putting more weight on the bar every week. Discover the 5 mechanisms of progressive overload and how to measure them systematically.',
            'target_intent' => 'progressive overload guide, how to track progressive overload, strength programming',
            'seo_title'     => 'Progressive Overload: What It Actually Means & How to Track It',
            'seo_desc'      => 'Unpack the 5 mechanisms of progressive overload. Learn how to track reps, density, range of motion, and load systematically for continuous strength adaptation.',
            'cta_type'      => 'strength',
            'content'       => '<h2>Beyond Adding Weight to the Bar</h2>
<p>Progressive overload is the fundamental physiological rule governing strength and muscular adaptation. Simply stated: to trigger adaptation, you must subject the body to unaccustomed mechanical stress. However, many lifters erroneously equate progressive overload solely with adding resistance to the barbell.</p>

<h3>The 5 Dimension of Progressive Overload</h3>
<ul>
    <li><strong>1. Load Progression:</strong> Increasing total weight lifted while keeping reps and execution identical.</li>
    <li><strong>2. Repetition Progression:</strong> Completing more repetitions with identical load and mechanics.</li>
    <li><strong>3. Volume Progression:</strong> Adding working sets per muscle group per microcycle.</li>
    <li><strong>4. Density Progression:</strong> Completing identical work in less time by compressing rest intervals systematically.</li>
    <li><strong>5. Technical & Mechanical Progression:</strong> Improving movement efficiency, controlling tempo, or expanding range of motion.</li>
</ul>

<h3>How to Log Overload Systematically</h3>
<p>In Human Strength, double progression models are natively supported. You select a target rep range (e.g., 6–8 reps). Once you hit the top of the range across all target sets with clean technique, the system prompts a structured load increment for the subsequent microcycle.</p>'
        ),
        array(
            'slug'          => 'why-logging-your-workouts-changes-the-way-you-train',
            'title'         => 'Why Logging Your Workouts Changes the Way You Train',
            'category'      => 'Consistency',
            'author'        => 'Human Editorial Team',
            'date'          => '2026-07-22',
            'excerpt'       => 'Relying on memory leads to junk volume and ego lifting. Here is how structured workout logging creates psychological accountability and objective training clarity.',
            'target_intent' => 'why log workouts, gym workout log benefit, strength training tracking',
            'seo_title'     => 'Why Logging Your Workouts Changes the Way You Train | Human',
            'seo_desc'      => 'Explore the psychological and biomechanical benefits of structured workout logging. Avoid ego lifting and maintain clear training direction.',
            'cta_type'      => 'strength',
            'content'       => '<h2>The Cognitive Friction of Memory-Based Training</h2>
<p>When you walk into the gym without a precise record of your previous performance, your brain relies on approximate memory. You guess what weight you lifted last week, estimate your rest periods, and subjectively decide when a set feels "hard enough". This ambiguity breeds ego lifting or inadvertent under-training.</p>

<h3>Eliminating Guesswork at the Rack</h3>
<p>Having your previous log instantly visible before starting a set changes your psychological state. You know exactly what number you need to match or exceed. Every set becomes a focused objective rather than a casual exercise routine.</p>'
        ),
        array(
            'slug'          => 'sets-reps-load-and-volume-understanding-your-strength-training-data',
            'title'         => 'Sets, Reps, Load and Volume: Understanding Your Strength Training Data',
            'category'      => 'Workout Tracking',
            'author'        => 'Human Research Team',
            'date'          => '2026-07-23',
            'excerpt'       => 'A technical deep-dive into training variables: working sets, volume load, average intensity, and set-equated volume for strength and hypertrophy.',
            'target_intent' => 'strength training data, volume load formula, training variables analytics',
            'seo_title'     => 'Sets, Reps, Load & Volume: Demystifying Strength Data | Human',
            'seo_desc'      => 'Master the math of strength training data. Learn how working sets, volume load, and relative intensity drive neural and hypertrophy adaptations.',
            'cta_type'      => 'strength',
            'content'       => '<h2>Decoding Training Variables</h2>
<p>To optimize training outcomes, you must treat your workout log as performance data. Here are the primary metrics that govern training adaptation:</p>

<h3>1. Working Sets per Muscle Group</h3>
<p>Research consistently highlights direct working sets per week (sets taken within 1–3 reps of failure) as the primary proxy for hypertrophy stimulus.</p>

<h3>2. Volume Load (Tonnage)</h3>
<p>Calculated as <code>Load × Reps × Sets</code>. Useful for comparing session density across identical exercises over time.</p>

<h3>3. Average Relative Intensity (% 1RM)</h3>
<p>Understanding average percentage of 1RM ensures you remain in the target neurological zone for peak force production.</p>'
        ),
        array(
            'slug'          => 'how-to-build-a-strength-training-routine-you-can-actually-follow',
            'title'         => 'How to Build a Strength Training Routine You Can Actually Follow',
            'category'      => 'Programming',
            'author'        => 'Human Editorial Team',
            'date'          => '2026-07-24',
            'excerpt'       => 'The best routine is not the most complex one — it is the one you can execute consistently. Learn how to structure splits, supersets, and rest periods for longevity.',
            'target_intent' => 'build strength routine, routine structure guide, workout program design',
            'seo_title'     => 'How to Build a Strength Training Routine You Can Follow',
            'seo_desc'      => 'Learn how to construct a practical, high-yield strength routine based on frequency, movement patterns, and sustainable time budgets.',
            'cta_type'      => 'strength',
            'content'       => '<h2>Designing for Real Life</h2>
<p>Overly complex 6-day bodypart splits fail when life intervenes. Sustainable strength routine design starts with realistic time availability and movement balance rather than idealistic bodybuilding templates.</p>

<h3>Key Design Pillars</h3>
<ul>
    <li><strong>1. Frequency over Duration:</strong> 3–4 focused 45-minute sessions out-perform 2 chaotic 2-hour sessions.</li>
    <li><strong>2. Movement Pattern Balance:</strong> Pair horizontal push with horizontal pull; knee-dominant with hip-dominant movements.</li>
    <li><strong>3. Smart Supersetting:</strong> Group non-competing muscle groups (e.g., Antagonist paired sets) to compress session time without compromising motor unit recruitment.</li>
</ul>'
        ),
        array(
            'slug'          => 'training-consistency-why-your-workout-history-matters',
            'title'         => 'Training Consistency: Why Your Workout History Matters',
            'category'      => 'Consistency',
            'author'        => 'Human Research Team',
            'date'          => '2026-07-24',
            'excerpt'       => 'Strength adaptation is a multi-year compounding curve. Why maintaining a continuous historical record unlocks long-term trend analysis and fatigue prevention.',
            'target_intent' => 'workout history benefits, training consistency, long term strength progress',
            'seo_title'     => 'Training Consistency: Why Your Workout History Matters',
            'seo_desc'      => 'Discover why multi-year workout history unlocks long-term trend analysis, prevents overtraining, and keeps your training trajectory compounding.',
            'cta_type'      => 'strength',
            'content'       => '<h2>The Power of Compounding Workout History</h2>
<p>Short-term progress is noisy. Deloads, fatigue, and life stress cause week-to-week fluctuations. Looking back at 6 to 12 months of structured workout data reveals the true macro trajectory of your strength development.</p>

<h3>Preventing Overtraining & Deload Timing</h3>
<p>By reviewing long-term volume curves alongside body weight and joint comfort notes, you can spot fatigue accumulation weeks before acute injury or burnout occurs.</p>'
        ),
        array(
            'slug'          => 'how-often-should-you-increase-the-weight-you-lift',
            'title'         => 'How Often Should You Increase the Weight You Lift?',
            'category'      => 'Programming',
            'author'        => 'Human Editorial Team',
            'date'          => '2026-07-25',
            'excerpt'       => 'When to add weight, when to add reps, and when to hold steady. Understanding training age, linear progression limits, and autoregulated load increments.',
            'target_intent' => 'when to increase weight lifted, linear progression timing, strength load progression',
            'seo_title'     => 'How Often Should You Increase the Weight You Lift? | Human',
            'seo_desc'      => 'Discover when and how frequently to increase training weight based on training age, double progression models, and motor unit adaptation.',
            'cta_type'      => 'strength',
            'content'       => '<h2>The Frequency of Weight Increments</h2>
<p>Novices can increase weight on compound lifts almost every session due to rapid neural adaptation. Intermediate and advanced athletes, however, require autoregulated progression strategies such as wave loading or percentage periodization.</p>'
        ),
        array(
            'slug'          => 'workout-tracking-without-the-spreadsheet',
            'title'         => 'Workout Tracking Without the Spreadsheet',
            'category'      => 'Workout Tracking',
            'author'        => 'Human Product Engineering',
            'date'          => '2026-07-25',
            'excerpt'       => 'Spreadsheets are powerful for desktop analysis but cumbersome on a gym floor. How purpose-built Android apps streamline live workout logging.',
            'target_intent' => 'workout tracking app vs spreadsheet, mobile gym log, offline strength app',
            'seo_title'     => 'Workout Tracking Without the Spreadsheet | Human Strength',
            'seo_desc'      => 'Ditch clunky spreadsheets on the gym floor. Human Strength brings purpose-built mobile UX, rest timers, and instant volume analytics to Android.',
            'cta_type'      => 'strength',
            'content'       => '<h2>Why Spreadsheets Fail in the Gym</h2>
<p>Excel and Google Sheets are fantastic analytical tools, but pinching and zooming into tiny cells with sweaty hands between heavy sets ruins session momentum. Purpose-built native mobile interfaces eliminate friction while retaining deep mathematical reporting.</p>'
        ),
        array(
            'slug'          => 'what-makes-an-exercise-more-than-just-a-name',
            'title'         => 'What Makes an Exercise More Than Just a Name?',
            'category'      => 'Human Ontology',
            'author'        => 'Human Research Team',
            'date'          => '2026-07-26',
            'excerpt'       => 'Introducing the Human Ontology concept. Why viewing exercises as structured knowledge entities unlocks biomechanical substitution and intelligent coaching.',
            'target_intent' => 'exercise taxonomy, exercise ontology, structured exercise knowledge system',
            'seo_title'     => 'What Makes an Exercise More Than Just a Name? | Human Ontology',
            'seo_desc'      => 'Discover why exercises are structured knowledge entities, not simple text labels. Learn how Human Ontology models equipment, biomechanics, and muscle roles.',
            'cta_type'      => 'ontology',
            'content'       => '<h2>The Problem With Flat Exercise Libraries</h2>
<p>When an application stores an exercise simply as a text string like "Incline Dumbbell Press", it lacks understanding. It cannot tell you that an incline dumbbell press shares 80% muscle activation with a low-to-high cable fly, nor can it suggest a machine equivalent when dumbbell racks are crowded.</p>

<h3>Exercises as Multidimensional Knowledge Nodes</h3>
<p>The Human Ontology models exercises across 15+ dimensions: equipment classification, plane of motion, force direction, primary agonistic muscles, secondary synergists, stabilizing structures, joint actions, and fatigue cost. This knowledge graph forms the intelligence bedrock for the entire Human ecosystem.</p>

<div class="journal-cta-box" style="background:var(--human-dark-surface);border:1px solid var(--human-border-dark);border-radius:12px;padding:2rem;margin:2.5rem 0;text-align:center;">
    <span class="eyebrow">HUMAN ONTOLOGY PROGRAMME</span>
    <h3 style="margin-bottom:0.75rem;color:var(--human-white);">Explore The Human Knowledge Engine</h3>
    <p style="color:#94A3B8;margin-bottom:1.5rem;font-size:0.95rem;">Learn how we are building one of the world\'s largest structured exercise databases to power intelligent adaptation.</p>
    <a href="/ontology" class="btn btn-secondary">Discover Human Ontology &rarr;</a>
</div>'
        ),
        array(
            'slug'          => 'building-the-human-ontology-towards-a-structured-exercise-knowledge-system',
            'title'         => 'Building the Human Ontology: Towards a Structured Exercise Knowledge System',
            'category'      => 'Human Ontology',
            'author'        => 'Human Research & Tech Lead',
            'date'          => '2026-07-26',
            'excerpt'       => 'An engineering and kinesiology overview of the ambitious Human Ontology programme. Building a multi-product knowledge graph for human performance.',
            'target_intent' => 'human ontology program, exercise knowledge system, human performance ontology',
            'seo_title'     => 'Building the Human Ontology: A Structured Exercise Knowledge System',
            'seo_desc'      => 'An architectural overview of the Human Ontology programme: structuring exercise identity, biomechanics, equipment, and injury contraindications into a global knowledge system.',
            'cta_type'      => 'ontology',
            'content'       => '<h2>An Ambitious Long-Term Platform Asset</h2>
<p>Human is developing a major long-term platform asset: <strong>The Human Ontology</strong>. The objective is to construct one of the world\'s largest, most precise structured exercise knowledge systems.</p>

<h3>Core Architectural Dimensions</h3>
<ul>
    <li><strong>Canonical Identity & Aliases:</strong> Cross-referencing regional terminology, international search terms, and colloquial movement names.</li>
    <li><strong>Biomechanics & Planes of Motion:</strong> Sagittal, frontal, and transverse force vectors, joint rotation angles, and moment arms.</li>
    <li><strong>Anatomical Muscle Mechanics:</strong> Primary agonists, secondary synergists, dynamic stabilizers, and spinal axial loading indices.</li>
    <li><strong>Equipment & Environmental Constraints:</strong> Barbells, dumbbells, cables, plate-loaded, selectorised, Smith machines, landmines, and bodyweight variations.</li>
    <li><strong>Programming & Relationship Graphs:</strong> Movement substitutions, regressions, progressions, and movement-to-movement fatigue transfer.</li>
</ul>'
        )
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
        '1.4.0' => 'human_migration_1_4_0'
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
            'supporting' => 'Learn how our offline-first strength log works.',
            'url' => '/strength',
            'type' => 'product',
            'status' => 'active'
        ),
        array(
            'title' => 'Get Human Strength on Google Play',
            'label' => 'Download on Google Play',
            'supporting' => 'Start your 30-day introductory trial today.',
            'url' => 'https://play.google.com/store/apps/details?id=com.aistudio.humanstrength.kfqjza',
            'type' => 'download',
            'status' => 'inactive'
        ),
        array(
            'title' => 'Explore the Human Ontology',
            'label' => 'Discover Human Ontology',
            'supporting' => 'Explore the structured exercise knowledge system.',
            'url' => '/ontology',
            'type' => 'learn',
            'status' => 'active'
        ),
        array(
            'title' => 'Read the Training Guides',
            'label' => 'Read Journal',
            'supporting' => 'Deep dives into progression and programming.',
            'url' => '/journal',
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

    // Seed Campaign
    $existing_camp = get_page_by_title('Strength V1 Launch', OBJECT, 'human_campaign');
    if (!$existing_camp) {
        $post_id = wp_insert_post(array(
            'post_title' => 'Strength V1 Launch',
            'post_status' => 'publish',
            'post_type' => 'human_campaign'
        ));
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_human_camp_objective', 'Initial product launch and awareness');
            update_post_meta($post_id, '_human_camp_status', 'planned'); // Deliberately inactive
            update_post_meta($post_id, '_human_camp_utm_id', 'strength_v1_launch');
            update_post_meta($post_id, '_human_camp_priority', 'high');
            
            $strength_app = get_page_by_path('strength', OBJECT, 'human_app');
            if ($strength_app) {
                update_post_meta($post_id, '_human_camp_associated_app', $strength_app->ID);
            }
            
            $primary_cta = get_page_by_title('Get Human Strength on Google Play', OBJECT, 'human_cta');
            if ($primary_cta) {
                update_post_meta($post_id, '_human_camp_primary_cta', $primary_cta->ID);
            }
        }
    }

    $articles = human_get_cornerstone_articles();
    foreach ($articles as $art) {
        $existing = get_page_by_path($art['slug'], OBJECT, 'post');
        if (!$existing) {
            $post_id = wp_insert_post(array(
                'post_title'   => $art['title'],
                'post_name'    => $art['slug'],
                'post_content' => $art['content'],
                'post_excerpt' => $art['excerpt'],
                'post_status'  => 'publish',
                'post_type'    => 'post',
                'post_date'    => $art['date'] . ' 10:00:00'
            ));
            if ($post_id && !is_wp_error($post_id)) {
                update_post_meta($post_id, '_human_seo_title', $art['seo_title']);
                update_post_meta($post_id, '_human_seo_description', $art['seo_desc']);
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

    // Upgrade the ontology article with comprehensive marketing metadata
    $post = get_page_by_path('building-the-human-ontology-towards-a-structured-exercise-knowledge-system', OBJECT, 'post');
    if ($post) {
        // SEO
        update_post_meta($post->ID, '_human_seo_title', 'Building the Human Ontology: Structured Exercise Knowledge');
        update_post_meta($post->ID, '_human_seo_description', 'Discover how Human Ontology is building a standardized knowledge graph mapping the physics of human movement for AI-powered strength training apps.');
        update_post_meta($post->ID, '_human_post_search_intent', 'informational');
        update_post_meta($post->ID, '_human_post_primary_topic', 'human ontology');
        
        // Social
        update_post_meta($post->ID, '_human_social_title', 'The Future of AI Workout Programming');
        update_post_meta($post->ID, '_human_social_description', 'Building a structured exercise knowledge graph to power intelligent periodization engines.');
        update_post_meta($post->ID, '_human_social_image', 'https://humanv1.com/assets/human-ontology-diagram.jpg');
        update_post_meta($post->ID, '_human_promo_copy', 'Standardising the data structures of human movement. Read how the Human Ontology powers AI-driven workout progression. #StrengthTraining #AI');
        update_post_meta($post->ID, '_human_promo_variant_edu', 'Did you know most workout apps lack a standardized taxonomy? We are fixing that with the Human Ontology.');
        
        // Product & CTA
        $ontology_cta = get_page_by_title('Explore Human Ontology', OBJECT, 'human_cta');
        if (!$ontology_cta) {
            $cta_id = wp_insert_post(array(
                'post_title' => 'Explore Human Ontology',
                'post_type' => 'human_cta',
                'post_status' => 'publish'
            ));
            if ($cta_id && !is_wp_error($cta_id)) {
                update_post_meta($cta_id, '_human_cta_label', 'Discover Human Ontology');
                update_post_meta($cta_id, '_human_cta_supporting_text', 'Learn how we are building a structured exercise knowledge graph.');
                update_post_meta($cta_id, '_human_cta_destination_url', '/ontology');
                update_post_meta($cta_id, '_human_cta_type', 'content');
                update_post_meta($cta_id, '_human_cta_status', 'active');
                $ontology_cta = get_post($cta_id);
            }
        }
        
        if ($ontology_cta) {
            update_post_meta($post->ID, '_human_post_primary_cta', $ontology_cta->ID);
        }
        
        $coach_app = get_page_by_path('coach', OBJECT, 'human_app');
        if ($coach_app) {
            update_post_meta($post->ID, '_human_post_primary_product', $coach_app->ID);
        }

        // Lifecycle
        update_post_meta($post->ID, '_human_post_content_type', 'evergreen');
        update_post_meta($post->ID, '_human_post_marketing_status', 'marketing_ready');
        update_post_meta($post->ID, '_human_post_review_date', '2027-01-01');
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
            'supporting' => 'Learn how our offline-first strength log works.',
            'url' => '/strength',
            'type' => 'product',
            'status' => 'active',
            'associated_app_slug' => 'strength'
        ),
        array(
            'title' => 'Get Human Strength on Google Play',
            'label' => 'Download App',
            'supporting' => 'Now available for early access on Android.',
            'url' => 'https://play.google.com/store/apps/details?id=com.aistudio.humanstrength.kfqjza',
            'type' => 'download',
            'status' => 'inactive',
            'associated_app_slug' => 'strength'
        ),
        array(
            'title' => 'Explore Human Ontology',
            'label' => 'Discover Human Ontology',
            'supporting' => 'Explore the structured exercise knowledge system.',
            'url' => '/ontology',
            'type' => 'learn',
            'status' => 'active'
        ),
        array(
            'title' => 'Read the Training Guides',
            'label' => 'Read Journal',
            'supporting' => 'Deep dives into progression and programming.',
            'url' => '/journal',
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

    // 3. Reconcile Campaign
    $existing_camp = get_page_by_title('Strength V1 Launch', OBJECT, 'human_campaign');
    if (!$existing_camp) {
        $post_id = wp_insert_post(array(
            'post_title' => 'Strength V1 Launch',
            'post_status' => 'publish',
            'post_type' => 'human_campaign'
        ));
        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_human_camp_objective', 'Initial product launch and awareness');
            update_post_meta($post_id, '_human_camp_status', 'planned'); // Deliberately inactive
            update_post_meta($post_id, '_human_camp_utm_id', 'strength_v1_launch');
            update_post_meta($post_id, '_human_camp_priority', 'high');
            
            $strength_app = get_page_by_path('strength', OBJECT, 'human_app');
            if ($strength_app) {
                update_post_meta($post_id, '_human_camp_associated_app', $strength_app->ID);
            }
            
            $primary_cta = get_page_by_title('Get Human Strength on Google Play', OBJECT, 'human_cta');
            if ($primary_cta) {
                update_post_meta($post_id, '_human_camp_primary_cta', $primary_cta->ID);
            }
        }
    }

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
        array('title' => 'Apps', 'url' => '/apps'),
        array('title' => 'Human Ontology', 'url' => '/ontology'),
        array('title' => 'Journal', 'url' => '/journal'),
        array('title' => 'About', 'url' => '/about'),
        array('title' => 'Support', 'url' => '/support')
    ));

    // Footer Navigation Menu
    human_create_menu_if_missing('Footer Navigation Menu', 'footer-menu', array(
        array('title' => 'Human Ontology', 'url' => '/ontology'),
        array('title' => 'Human Journal', 'url' => '/journal'),
        array('title' => 'About Platform', 'url' => '/about'),
        array('title' => 'Contact & Media', 'url' => '/contact'),
        array('title' => 'Customer Support', 'url' => '/support'),
        array('title' => 'Privacy Policy', 'url' => '/privacy'),
        array('title' => 'Terms of Service', 'url' => '/terms'),
        array('title' => 'Data Deletion', 'url' => '/data-deletion')
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
        'campaigns' => array('expected' => 1, 'found' => 0, 'missing' => 0),
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
        'Get Human Strength on Google Play',
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

    // Campaigns
    if (get_page_by_title('Strength V1 Launch', OBJECT, 'human_campaign')) {
        $health['campaigns']['found'] = 1;
    } else {
        $health['campaigns']['missing'] = 1;
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
                'Every canonical Human app definition must contain the complete 20-field contract.'
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
