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
        update_option('human_marketing_schema_version', $current_version);
    }
    
    $migrations = array(
        '1.0.0' => 'human_migration_1_0_0',
        '1.0.1' => 'human_migration_1_0_1',
        '1.1.0' => 'human_migration_1_1_0',
        '1.2.0' => 'human_migration_1_2_0'
    );

    foreach ($migrations as $version => $callback) {
        if (version_compare($current_version, $version, '<')) {
            if (is_callable($callback)) {
                call_user_func($callback);
                update_option('human_marketing_schema_version', $version);
                $current_version = $version;
            }
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

    return $health;
}
