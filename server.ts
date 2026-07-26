import express from 'express';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const app = express();
const PORT = 3000;

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// Serve static assets from theme & public
app.use(express.static(path.join(__dirname, 'public')));
app.use('/wp-content/themes/human-v1-theme/assets', express.static(path.join(__dirname, 'wp-content/themes/human-v1-theme/assets')));

// Canonical Ecosystem Data matching human_get_canonical_apps()
const canonicalApps = [
  {
    slug: 'strength',
    title: 'Human Strength',
    status: 'AVAILABLE',
    status_label: 'Available',
    badge_color: '#10B981',
    description: 'Commercial launch product. Offline-first strength training & volume analytics powered by local Room DB and optional cloud identity.',
    app_id: 'com.aistudio.humanstrength.kfqjza',
    pricing: '30-day introductory trial, then £24/year',
    target_url: '/strength'
  },
  {
    slug: 'hiit',
    title: 'Human HIIT',
    status: 'IN_DEVELOPMENT',
    status_label: 'In Development',
    badge_color: '#0066FF',
    description: 'High-intensity interval training, telemetry tracking, and dynamic work-to-rest interval programming.',
    app_id: '',
    pricing: 'Planned for platform inclusion',
    target_url: '/apps'
  },
  {
    slug: 'running',
    title: 'Human Running',
    status: 'PLANNED',
    status_label: 'Planned',
    badge_color: '#6B7280',
    description: 'Endurance metrics, cadence analysis, elevation profiling, and cardio progression tracking.',
    app_id: '',
    pricing: 'Planned for platform inclusion',
    target_url: '/apps'
  },
  {
    slug: 'recovery',
    title: 'Human Recovery',
    status: 'PLANNED',
    status_label: 'Planned',
    badge_color: '#6B7280',
    description: 'Heart rate variability, sleep-to-load readiness scoring, and active recovery protocol guidance.',
    app_id: '',
    pricing: 'Planned for platform inclusion',
    target_url: '/apps'
  },
  {
    slug: 'mobility',
    title: 'Human Mobility',
    status: 'PLANNED',
    status_label: 'Planned',
    badge_color: '#6B7280',
    description: 'Joint health, movement prep, range-of-motion assessments, and pre/post training sessions.',
    app_id: '',
    pricing: 'Planned for platform inclusion',
    target_url: '/apps'
  },
  {
    slug: 'nutrition',
    title: 'Human Nutrition',
    status: 'PLANNED',
    status_label: 'Planned',
    badge_color: '#6B7280',
    description: 'Fueling protocols, macronutrient tracking, and metabolic output alignment for training days.',
    app_id: '',
    pricing: 'Planned for platform inclusion',
    target_url: '/apps'
  },
  {
    slug: 'coach',
    title: 'Human Coach',
    status: 'COMING_SOON',
    status_label: 'Coming Soon',
    badge_color: '#F59E0B',
    description: 'AI-assisted periodization engine utilizing the Human Ontology knowledge graph for intelligent workout adaptation.',
    app_id: '',
    pricing: 'Coming Soon',
    target_url: '/apps'
  },
  {
    slug: 'community',
    title: 'Human Community',
    status: 'PLANNED',
    status_label: 'Planned',
    badge_color: '#6B7280',
    description: 'Peer performance benchmarks, verified movement sharing, and ecosystem challenge leaderboards.',
    app_id: '',
    pricing: 'Planned for platform inclusion',
    target_url: '/apps'
  }
];

// 10 Cornerstone Launch Articles
const cornerstoneArticles = [
  {
    slug: 'how-to-track-strength-training-progress-properly',
    title: 'How to Track Strength Training Progress Properly',
    category: 'Strength Training',
    author: 'Human Editorial Team',
    date: '2026-07-20',
    excerpt: 'Most lifters track weight and reps, but miss total tonnage, set velocity, and progressive volume trends over time. Here is the structured approach to tracking real strength gains.',
    target_intent: 'strength training progress, track strength gains, workout tracking guide',
    seo_title: 'How to Track Strength Training Progress Properly | Human Journal',
    seo_desc: 'Learn how to accurately track strength training progress beyond arbitrary weight numbers. Discover volume metrics, estimated 1RM, and local logging strategies.',
    content: `<h2>The Common Fallacy of Workout Tracking</h2>
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
    <a href="/strength?utm_source=humanv1_web&utm_medium=journal_cta&utm_campaign=track_progress" class="btn btn-primary">Explore Human Strength &rarr;</a>
</div>`
  },
  {
    slug: 'progressive-overload-what-it-actually-means-and-how-to-track-it',
    title: 'Progressive Overload: What It Actually Means and How to Track It',
    category: 'Programming',
    author: 'Human Performance Science',
    date: '2026-07-21',
    excerpt: 'Progressive overload is not just putting more weight on the bar every week. Discover the 5 mechanisms of progressive overload and how to measure them systematically.',
    target_intent: 'progressive overload guide, how to track progressive overload, strength programming',
    seo_title: 'Progressive Overload: What It Actually Means & How to Track It',
    seo_desc: 'Unpack the 5 mechanisms of progressive overload. Learn how to track reps, density, range of motion, and load systematically for continuous strength adaptation.',
    content: `<h2>Beyond Adding Weight to the Bar</h2>
<p>Progressive overload is the fundamental physiological rule governing strength and muscular adaptation. Simply stated: to trigger adaptation, you must subject the body to unaccustomed mechanical stress. However, many lifters erroneously equate progressive overload solely with adding resistance to the barbell.</p>

<h3>The 5 Dimensions of Progressive Overload</h3>
<ul style="margin-left: 1.5rem; margin-bottom: 1.5rem; line-height: 1.8;">
    <li><strong>1. Load Progression:</strong> Increasing total weight lifted while keeping reps and execution identical.</li>
    <li><strong>2. Repetition Progression:</strong> Completing more repetitions with identical load and mechanics.</li>
    <li><strong>3. Volume Progression:</strong> Adding working sets per muscle group per microcycle.</li>
    <li><strong>4. Density Progression:</strong> Completing identical work in less time by compressing rest intervals systematically.</li>
    <li><strong>5. Technical & Mechanical Progression:</strong> Improving movement efficiency, controlling tempo, or expanding range of motion.</li>
</ul>

<h3>How to Log Overload Systematically</h3>
<p>In Human Strength, double progression models are natively supported. You select a target rep range (e.g., 6–8 reps). Once you hit the top of the range across all target sets with clean technique, the system prompts a structured load increment for the subsequent microcycle.</p>`
  },
  {
    slug: 'why-logging-your-workouts-changes-the-way-you-train',
    title: 'Why Logging Your Workouts Changes the Way You Train',
    category: 'Consistency',
    author: 'Human Editorial Team',
    date: '2026-07-22',
    excerpt: 'Relying on memory leads to junk volume and ego lifting. Here is how structured workout logging creates psychological accountability and objective training clarity.',
    target_intent: 'why log workouts, gym workout log benefit, strength training tracking',
    seo_title: 'Why Logging Your Workouts Changes the Way You Train | Human',
    seo_desc: 'Explore the psychological and biomechanical benefits of structured workout logging. Avoid ego lifting and maintain clear training direction.',
    content: `<h2>The Cognitive Friction of Memory-Based Training</h2>
<p>When you walk into the gym without a precise record of your previous performance, your brain relies on approximate memory. You guess what weight you lifted last week, estimate your rest periods, and subjectively decide when a set feels "hard enough". This ambiguity breeds ego lifting or inadvertent under-training.</p>

<h3>Eliminating Guesswork at the Rack</h3>
<p>Having your previous log instantly visible before starting a set changes your psychological state. You know exactly what number you need to match or exceed. Every set becomes a focused objective rather than a casual exercise routine.</p>`
  },
  {
    slug: 'sets-reps-load-and-volume-understanding-your-strength-training-data',
    title: 'Sets, Reps, Load and Volume: Understanding Your Strength Training Data',
    category: 'Workout Tracking',
    author: 'Human Research Team',
    date: '2026-07-23',
    excerpt: 'A technical deep-dive into training variables: working sets, volume load, average intensity, and set-equated volume for strength and hypertrophy.',
    target_intent: 'strength training data, volume load formula, training variables analytics',
    seo_title: 'Sets, Reps, Load & Volume: Demystifying Strength Data | Human',
    seo_desc: 'Master the math of strength training data. Learn how working sets, volume load, and relative intensity drive neural and hypertrophy adaptations.',
    content: `<h2>Decoding Training Variables</h2>
<p>To optimize training outcomes, you must treat your workout log as performance data. Here are the primary metrics that govern training adaptation:</p>

<h3>1. Working Sets per Muscle Group</h3>
<p>Research consistently highlights direct working sets per week (sets taken within 1–3 reps of failure) as the primary proxy for hypertrophy stimulus.</p>

<h3>2. Volume Load (Tonnage)</h3>
<p>Calculated as <code>Load × Reps × Sets</code>. Useful for comparing session density across identical exercises over time.</p>`
  },
  {
    slug: 'how-to-build-a-strength-training-routine-you-can-actually-follow',
    title: 'How to Build a Strength Training Routine You Can Actually Follow',
    category: 'Programming',
    author: 'Human Editorial Team',
    date: '2026-07-24',
    excerpt: 'The best routine is not the most complex one — it is the one you can execute consistently. Learn how to structure splits, supersets, and rest periods for longevity.',
    target_intent: 'build strength routine, routine structure guide, workout program design',
    seo_title: 'How to Build a Strength Training Routine You Can Follow',
    seo_desc: 'Learn how to construct a practical, high-yield strength routine based on frequency, movement patterns, and sustainable time budgets.',
    content: `<h2>Designing for Real Life</h2>
<p>Overly complex 6-day bodypart splits fail when life intervenes. Sustainable strength routine design starts with realistic time availability and movement balance rather than idealistic bodybuilding templates.</p>`
  },
  {
    slug: 'training-consistency-why-your-workout-history-matters',
    title: 'Training Consistency: Why Your Workout History Matters',
    category: 'Consistency',
    author: 'Human Research Team',
    date: '2026-07-24',
    excerpt: 'Strength adaptation is a multi-year compounding curve. Why maintaining a continuous historical record unlocks long-term trend analysis and fatigue prevention.',
    target_intent: 'workout history benefits, training consistency, long term strength progress',
    seo_title: 'Training Consistency: Why Your Workout History Matters',
    seo_desc: 'Discover why multi-year workout history unlocks long-term trend analysis, prevents overtraining, and keeps your training trajectory compounding.',
    content: `<h2>The Power of Compounding Workout History</h2>
<p>Short-term progress is noisy. Deloads, fatigue, and life stress cause week-to-week fluctuations. Looking back at 6 to 12 months of structured workout data reveals the true macro trajectory of your strength development.</p>`
  },
  {
    slug: 'how-often-should-you-increase-the-weight-you-lift',
    title: 'How Often Should You Increase the Weight You Lift?',
    category: 'Programming',
    author: 'Human Editorial Team',
    date: '2026-07-25',
    excerpt: 'When to add weight, when to add reps, and when to hold steady. Understanding training age, linear progression limits, and autoregulated load increments.',
    target_intent: 'when to increase weight lifted, linear progression timing, strength load progression',
    seo_title: 'How Often Should You Increase the Weight You Lift? | Human',
    seo_desc: 'Discover when and how frequently to increase training weight based on training age, double progression models, and motor unit adaptation.',
    content: `<h2>The Frequency of Weight Increments</h2>
<p>Novices can increase weight on compound lifts almost every session due to rapid neural adaptation. Intermediate and advanced athletes require autoregulated progression strategies such as wave loading or percentage periodization.</p>`
  },
  {
    slug: 'workout-tracking-without-the-spreadsheet',
    title: 'Workout Tracking Without the Spreadsheet',
    category: 'Workout Tracking',
    author: 'Human Product Engineering',
    date: '2026-07-25',
    excerpt: 'Spreadsheets are powerful for desktop analysis but cumbersome on a gym floor. How purpose-built Android apps streamline live workout logging.',
    target_intent: 'workout tracking app vs spreadsheet, mobile gym log, offline strength app',
    seo_title: 'Workout Tracking Without the Spreadsheet | Human Strength',
    seo_desc: 'Ditch clunky spreadsheets on the gym floor. Human Strength brings purpose-built mobile UX, rest timers, and instant volume analytics to Android.',
    content: `<h2>Why Spreadsheets Fail in the Gym</h2>
<p>Excel and Google Sheets are fantastic analytical tools, but pinching and zooming into tiny cells with sweaty hands between heavy sets ruins session momentum. Purpose-built native mobile interfaces eliminate friction while retaining deep mathematical reporting.</p>`
  },
  {
    slug: 'what-makes-an-exercise-more-than-just-a-name',
    title: 'What Makes an Exercise More Than Just a Name?',
    category: 'Human Ontology',
    author: 'Human Research Team',
    date: '2026-07-26',
    excerpt: 'Introducing the Human Ontology concept. Why viewing exercises as structured knowledge entities unlocks biomechanical substitution and intelligent coaching.',
    target_intent: 'exercise taxonomy, exercise ontology, structured exercise knowledge system',
    seo_title: 'What Makes an Exercise More Than Just a Name? | Human Ontology',
    seo_desc: 'Discover why exercises are structured knowledge entities, not simple text labels. Learn how Human Ontology models equipment, biomechanics, and muscle roles.',
    content: `<h2>The Problem With Flat Exercise Libraries</h2>
<p>When an application stores an exercise simply as a text string like "Incline Dumbbell Press", it lacks understanding. It cannot tell you that an incline dumbbell press shares 80% muscle activation with a low-to-high cable fly, nor can it suggest a machine equivalent when dumbbell racks are crowded.</p>

<h3>Exercises as Multidimensional Knowledge Nodes</h3>
<p>The Human Ontology models exercises across 15+ dimensions: equipment classification, plane of motion, force direction, primary agonistic muscles, secondary synergists, stabilizing structures, joint actions, and fatigue cost. This knowledge graph forms the intelligence bedrock for the entire Human ecosystem.</p>

<div class="journal-cta-box" style="background:var(--human-dark-surface);border:1px solid var(--human-border-dark);border-radius:12px;padding:2rem;margin:2.5rem 0;text-align:center;">
    <span class="eyebrow">HUMAN ONTOLOGY PROGRAMME</span>
    <h3 style="margin-bottom:0.75rem;color:var(--human-white);">Explore The Human Knowledge Engine</h3>
    <p style="color:#94A3B8;margin-bottom:1.5rem;font-size:0.95rem;">Learn how we are building one of the world's largest structured exercise databases to power intelligent adaptation.</p>
    <a href="/ontology?utm_source=humanv1_web&utm_medium=journal_cta&utm_campaign=ontology" class="btn btn-secondary">Discover Human Ontology &rarr;</a>
</div>`
  },
  {
    slug: 'building-the-human-ontology-towards-a-structured-exercise-knowledge-system',
    title: 'Building the Human Ontology: Towards a Structured Exercise Knowledge System',
    category: 'Human Ontology',
    author: 'Human Research & Tech Lead',
    date: '2026-07-26',
    excerpt: 'An engineering and kinesiology overview of the ambitious Human Ontology programme. Building a multi-product knowledge graph for human performance.',
    target_intent: 'human ontology program, exercise knowledge system, human performance ontology',
    seo_title: 'Building the Human Ontology: A Structured Exercise Knowledge System',
    seo_desc: 'An architectural overview of the Human Ontology programme: structuring exercise identity, biomechanics, equipment, and injury contraindications into a global knowledge system.',
    content: `<h2>An Ambitious Long-Term Platform Asset</h2>
<p>Human is developing a major long-term platform asset: <strong>The Human Ontology</strong>. The objective is to construct one of the world's largest, most precise structured exercise knowledge systems.</p>

<h3>Core Architectural Dimensions</h3>
<ul style="margin-left: 1.5rem; margin-bottom: 1.5rem; line-height: 1.8;">
    <li><strong>Canonical Identity & Aliases:</strong> Cross-referencing regional terminology, international search terms, and colloquial movement names.</li>
    <li><strong>Biomechanics & Planes of Motion:</strong> Sagittal, frontal, and transverse force vectors, joint rotation angles, and moment arms.</li>
    <li><strong>Anatomical Muscle Mechanics:</strong> Primary agonists, secondary synergists, dynamic stabilizers, and spinal axial loading indices.</li>
    <li><strong>Equipment & Environmental Constraints:</strong> Barbells, dumbbells, cables, plate-loaded, selectorised, Smith machines, landmines, and bodyweight variations.</li>
    <li><strong>Programming & Relationship Graphs:</strong> Movement substitutions, regressions, progressions, and movement-to-movement fatigue transfer.</li>
</ul>`
  }
];

// Helper: Render Status Badge
function renderStatusBadge(status: string) {
  switch (status.toUpperCase()) {
    case 'AVAILABLE':
      return `<span class="badge badge-available"><span style="width:6px;height:6px;border-radius:50%;background:#10B981;display:inline-block;"></span> Available</span>`;
    case 'IN_DEVELOPMENT':
    case 'IN DEVELOPMENT':
      return `<span class="badge badge-dev"><span style="width:6px;height:6px;border-radius:50%;background:#0066FF;display:inline-block;"></span> In Development</span>`;
    case 'COMING_SOON':
    case 'COMING SOON':
      return `<span class="badge badge-coming"><span style="width:6px;height:6px;border-radius:50%;background:#F59E0B;display:inline-block;"></span> Coming Soon</span>`;
    case 'PLANNED':
    default:
      return `<span class="badge badge-planned"><span style="width:6px;height:6px;border-radius:50%;background:#6B7280;display:inline-block;"></span> Planned</span>`;
  }
}

// Master Layout HTML wrapper with full SEO & Open Graph support
function layoutHtml(seoTitle: string, seoDesc: string, contentHtml: string, activePath: string = '', customOgImg?: string, jsonLdSchemas: any[] = []) {
  const domain = 'https://humanv1.com';
  const canonicalUrl = `${domain}${activePath === '/' ? '' : activePath}`;
  const socialImg = customOgImg || `${domain}/human-og-share.svg`;

  const orgSchema = {
    '@context': 'https://schema.org',
    '@type': 'Organization',
    'name': 'Human V1',
    'url': domain,
    'logo': `${domain}/human_logo_master.svg`,
    'email': 'support@humanv1.com'
  };

  const webSiteSchema = {
    '@context': 'https://schema.org',
    '@type': 'WebSite',
    'name': 'Human Platform',
    'url': domain
  };

  const allSchemas = [orgSchema, webSiteSchema, ...jsonLdSchemas];

  return `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>${seoTitle}</title>
    <meta name="description" content="${seoDesc}">
    <link rel="canonical" href="${canonicalUrl}">

    <!-- Open Graph Tags -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Human">
    <meta property="og:title" content="${seoTitle}">
    <meta property="og:description" content="${seoDesc}">
    <meta property="og:url" content="${canonicalUrl}">
    <meta property="og:image" content="${socialImg}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Human V1 Performance Technology Platform">

    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="${seoTitle}">
    <meta name="twitter:description" content="${seoDesc}">
    <meta name="twitter:image" content="${socialImg}">

    <link rel="icon" type="image/svg+xml" href="/hv1-icon.svg">
    <link rel="apple-touch-icon" href="/hv1-icon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
    
    <!-- JSON-LD Structured Data -->
    ${allSchemas.map(s => `<script type="application/ld+json">${JSON.stringify(s, null, 2)}</script>`).join('\n    ')}

    <style>
      :root {
        --human-electric-blue: #0066FF;
        --human-electric-blue-pressed: #0052D4;
        --human-dark-bg: #0A0D10;
        --human-dark-surface: #121519;
        --human-dark-elevated: #1C2026;
        --human-white: #FFFFFF;
        --human-border-dark: #2A303A;
        --human-success: #10B981;
        --human-warning: #F59E0B;
        --human-error: #EF4444;
        --font-sans: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        --font-mono: 'JetBrains Mono', monospace;
      }
      *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
      html { font-family: var(--font-sans); font-size: 16px; color: #E2E8F0; background-color: var(--human-dark-bg); scroll-behavior: smooth; }
      body { min-height: 100vh; display: flex; flex-direction: column; background-color: var(--human-dark-bg); }
      a { color: var(--human-electric-blue); text-decoration: none; transition: color 0.2s; }
      a:hover { color: #3385FF; }
      .container { width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }
      h1, h2, h3, h4 { color: var(--human-white); font-weight: 700; line-height: 1.25; letter-spacing: -0.02em; }
      .display-title { font-size: clamp(2.25rem, 4.5vw, 4rem); font-weight: 800; letter-spacing: -0.03em; }
      .section-title { font-size: clamp(1.75rem, 3vw, 2.5rem); margin-bottom: 1rem; }
      .eyebrow { font-family: var(--font-mono); font-size: 0.825rem; text-transform: uppercase; letter-spacing: 0.15em; color: var(--human-electric-blue); font-weight: 600; margin-bottom: 0.75rem; display: inline-block; }
      .btn { display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 0.8rem 1.6rem; border-radius: 8px; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: all 0.2s; border: 1px solid transparent; white-space: nowrap; }
      .btn-primary { background-color: var(--human-electric-blue); color: var(--human-white); }
      .btn-primary:hover { background-color: var(--human-electric-blue-pressed); transform: translateY(-1px); }
      .btn-secondary { background-color: var(--human-dark-elevated); color: var(--human-white); border-color: var(--human-border-dark); }
      .btn-secondary:hover { background-color: #262B33; }
      .btn-outline { background-color: transparent; color: var(--human-white); border-color: var(--human-border-dark); }
      .btn-outline:hover { border-color: var(--human-electric-blue); color: var(--human-electric-blue); }
      .badge { display: inline-flex; align-items: center; gap: 0.35rem; padding: 0.25rem 0.65rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }
      .badge-available { background-color: rgba(16, 185, 129, 0.12); color: var(--human-success); border: 1px solid rgba(16, 185, 129, 0.3); }
      .badge-dev { background-color: rgba(0, 102, 255, 0.12); color: var(--human-electric-blue); border: 1px solid rgba(0, 102, 255, 0.3); }
      .badge-planned { background-color: rgba(107, 114, 128, 0.12); color: #9CA3AF; border: 1px solid rgba(107, 114, 128, 0.3); }
      .badge-coming { background-color: rgba(245, 158, 11, 0.12); color: var(--human-warning); border: 1px solid rgba(245, 158, 11, 0.3); }
      .site-header { position: sticky; top: 0; z-index: 50; background-color: rgba(10, 13, 16, 0.92); backdrop-filter: blur(12px); border-bottom: 1px solid var(--human-border-dark); padding: 1rem 0; }
      .header-inner { display: flex; align-items: center; justify-content: space-between; }
      .brand-logo { display: flex; align-items: center; gap: 0.75rem; color: var(--human-white); font-weight: 800; font-size: 1.35rem; }
      .main-nav { display: flex; align-items: center; gap: 1.5rem; list-style: none; }
      .main-nav a { color: #94A3B8; font-weight: 500; font-size: 0.925rem; }
      .main-nav a:hover, .main-nav a.active { color: var(--human-white); }
      .site-footer { background-color: var(--human-dark-surface); border-top: 1px solid var(--human-border-dark); padding: 4rem 0 2rem; margin-top: auto; }
      .footer-grid { display: grid; grid-template-columns: 2fr repeat(3, 1fr); gap: 2.5rem; margin-bottom: 3rem; }
      .footer-col h4 { color: var(--human-white); font-size: 0.9rem; margin-bottom: 1.25rem; text-transform: uppercase; letter-spacing: 0.05em; }
      .footer-col ul { list-style: none; display: flex; flex-direction: column; gap: 0.65rem; }
      .footer-col a { color: #94A3B8; font-size: 0.875rem; }
      .footer-col a:hover { color: var(--human-white); }
      .footer-bottom { border-top: 1px solid var(--human-border-dark); padding-top: 2rem; display: flex; justify-content: space-between; align-items: center; color: #64748B; font-size: 0.85rem; }
      .wp-badge { font-family: var(--font-mono); font-size: 0.75rem; background: rgba(0,102,255,0.15); color: var(--human-electric-blue); border: 1px solid rgba(0,102,255,0.3); padding: 0.2rem 0.5rem; border-radius: 4px; display: inline-flex; align-items: center; gap: 0.35rem; }
      @media (max-width: 768px) { .footer-grid { grid-template-columns: 1fr; } .main-nav { display: none; } }
    </style>
</head>
<body>
    <!-- DEV PREVIEW TOP BAR -->
    <div style="background: #161B22; border-bottom: 1px solid var(--human-border-dark); padding: 0.4rem 1rem; font-family: var(--font-mono); font-size: 0.75rem; color: #94A3B8; display: flex; justify-content: space-between; align-items: center;">
      <div style="display:flex; align-items:center; gap:0.75rem;">
        <span class="wp-badge">⚡ WP 6.7 Theme Engine</span>
        <span>Theme: <code>human-v1-theme</code></span>
        <span>Plugin: <code>human-platform</code></span>
      </div>
      <div>
        <a href="/wp-admin-preview" style="color: var(--human-electric-blue); text-decoration: underline;">Inspect WP Admin &amp; REST API</a>
      </div>
    </div>

    <!-- SITE HEADER -->
    <header class="site-header">
        <div class="container header-inner">
            <a href="/" class="brand-logo">
                <img src="/hv1-icon.svg" alt="Human V1 Icon" style="width: 36px; height: 36px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 102, 255, 0.3);">
                <span>Human</span>
            </a>
            <nav>
                <ul class="main-nav">
                    <li><a href="/" class="${activePath === '/' ? 'active' : ''}">Home</a></li>
                    <li><a href="/apps" class="${activePath === '/apps' ? 'active' : ''}">Apps</a></li>
                    <li><a href="/ontology" class="${activePath === '/ontology' ? 'active' : ''}">Human Ontology</a></li>
                    <li><a href="/journal" class="${activePath === '/journal' ? 'active' : ''}">Journal</a></li>
                    <li><a href="/about" class="${activePath === '/about' ? 'active' : ''}">About</a></li>
                    <li><a href="/support" class="${activePath === '/support' ? 'active' : ''}">Support</a></li>
                </ul>
            </nav>
            <div>
                <a href="/strength?utm_source=humanv1_web&utm_medium=nav_button&utm_campaign=header" class="btn btn-primary" style="padding: 0.55rem 1.1rem; font-size: 0.85rem;">Human Strength</a>
            </div>
        </div>
    </header>

    <!-- MAIN PAGE CONTENT -->
    <main style="flex: 1;">
      ${contentHtml}
    </main>

    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <a href="/" class="brand-logo" style="margin-bottom: 1rem;">
                        <img src="/human_logo_master.svg" alt="Human V1 Master Logo" style="height: 42px; width: auto; max-width: 220px;">
                    </a>
                    <p style="color: #94A3B8; font-size: 0.875rem; margin-bottom: 1.25rem; max-width: 320px; line-height: 1.5;">
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
                        <li><a href="/strength">Human Strength (Available)</a></li>
                        <li><a href="/apps">Human HIIT (In Dev)</a></li>
                        <li><a href="/apps">Human Running</a></li>
                        <li><a href="/apps">Human Recovery</a></li>
                        <li><a href="/apps">Human Mobility</a></li>
                        <li><a href="/apps">Human Nutrition</a></li>
                        <li><a href="/apps">Human Coach</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Knowledge &amp; Brand</h4>
                    <ul>
                        <li><a href="/ontology">Human Ontology</a></li>
                        <li><a href="/journal">Human Journal</a></li>
                        <li><a href="/about">About Platform</a></li>
                        <li><a href="/contact">Contact &amp; Media</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>Support &amp; Legal</h4>
                    <ul>
                        <li><a href="/support">Customer Support</a></li>
                        <li><a href="/privacy">Privacy Policy</a></li>
                        <li><a href="/terms">Terms of Service</a></li>
                        <li><a href="/data-deletion">Data Deletion</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <div>&copy; 2026 Human Performance Technology. All rights reserved.</div>
                <div style="display: flex; gap: 1.5rem;">
                    <a href="/privacy" style="color: #64748B;">Privacy</a>
                    <a href="/terms" style="color: #64748B;">Terms</a>
                    <a href="/data-deletion" style="color: #64748B;">Data Deletion</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>`;
}

// DYNAMIC ROBOTS.TXT
app.get('/robots.txt', (req, res) => {
  res.type('text/plain');
  res.send(`User-agent: *
Allow: /
Sitemap: https://humanv1.com/sitemap.xml
`);
});

// DYNAMIC XML SITEMAP
app.get('/sitemap.xml', (req, res) => {
  const domain = 'https://humanv1.com';
  const staticUrls = [
    '/',
    '/apps',
    '/strength',
    '/ontology',
    '/about',
    '/support',
    '/contact',
    '/journal',
    '/privacy',
    '/terms',
    '/data-deletion'
  ];

  let xml = `<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">`;

  staticUrls.forEach(url => {
    xml += `
  <url>
    <loc>${domain}${url}</loc>
    <lastmod>2026-07-26</lastmod>
    <changefreq>${url === '/' || url === '/journal' ? 'daily' : 'weekly'}</changefreq>
    <priority>${url === '/' ? '1.0' : url === '/strength' ? '0.9' : '0.8'}</priority>
  </url>`;
  });

  cornerstoneArticles.forEach(art => {
    xml += `
  <url>
    <loc>${domain}/journal/${art.slug}</loc>
    <lastmod>${art.date}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>`;
  });

  xml += `
</urlset>`;

  res.type('application/xml');
  res.send(xml);
});

// REST API Endpoints matching human-platform plugin
app.get('/wp-json/human/v1/apps', (req, res) => {
  res.json({
    success: true,
    brand: 'Human',
    domain: 'humanv1.com',
    data: canonicalApps
  });
});

app.get('/wp-json/human/v1/journal', (req, res) => {
  res.json({
    success: true,
    count: cornerstoneArticles.length,
    data: cornerstoneArticles
  });
});

app.get('/wp-json/human/v1/ontology/summary', (req, res) => {
  res.json({
    success: true,
    program: 'Human Ontology',
    vision: 'Structured exercise knowledge system designed to scale far beyond a traditional exercise library.',
    status: 'Active Major Human Programme',
    taxonomy_pillars: {
      canonical_identity: 'Names, aliases, internationalized search terms',
      biomechanics: 'Planes of motion, movement patterns, force direction, joint actions',
      anatomy: 'Primary muscles, secondary muscles, synergists, stabilizer roles',
      equipment: 'Barbells, dumbbells, cables, selectorised, plate-loaded, Smith machine, landmine',
      coaching: 'Substitutions, regressions, progressions, spinal loading, fatigue cost'
    }
  });
});

app.get('/wp-json/human/v1/seo', (req, res) => {
  res.json({
    success: true,
    domain: 'https://humanv1.com',
    default_title: 'Human V1 — Performance Technology Platform | Train. Track. Transform.',
    default_description: 'A performance technology platform connecting strength training, volume analytics, and movement science into a unified ecosystem. Starting with Human Strength for Android.',
    social_share_image: 'https://humanv1.com/human-og-share.svg'
  });
});

// ROUTE 1: FRONT PAGE (/)
app.get('/', (req, res) => {
  const seoTitle = 'Human V1 — Performance Technology Platform | Train. Track. Transform.';
  const seoDesc = 'Human is a performance technology platform connecting physical disciplines. Discover Human Strength, the offline-first strength training app with Room local database for Android.';

  const content = `
    <!-- HERO -->
    <section style="padding: 5rem 0 4.5rem; background: radial-gradient(circle at 50% 20%, rgba(0, 102, 255, 0.18) 0%, rgba(10, 13, 16, 1) 75%); border-bottom: 1px solid var(--human-border-dark);">
        <div class="container" style="text-align: center; max-width: 960px;">
            <div style="margin-bottom: 1.5rem; display: flex; justify-content: center;">
                <img src="/human_logo_master.svg" alt="Human V1 Master Logo" style="height: 64px; width: auto; max-width: 100%; filter: drop-shadow(0 8px 24px rgba(0, 102, 255, 0.35));">
            </div>
            <span class="eyebrow">UMBRELLA BRAND — HUMAN PLATFORM</span>
            <h1 class="display-title" style="margin-bottom: 1.25rem;">Train. Track. Transform.</h1>
            <p style="font-size: 1.25rem; color: #94A3B8; margin-bottom: 2.5rem; line-height: 1.6;">
                A performance technology platform built around how humans train, progress, and evolve. Connecting physical disciplines into one unified ecosystem.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="/strength?utm_source=humanv1_web&utm_medium=hero_cta&utm_campaign=frontpage" class="btn btn-primary" style="padding: 1rem 2rem; font-size: 1.05rem;">
                    Explore Human Strength
                </a>
                <a href="/ontology?utm_source=humanv1_web&utm_medium=hero_cta&utm_campaign=frontpage" class="btn btn-secondary" style="padding: 1rem 2rem; font-size: 1.05rem;">
                    Discover Human Ontology
                </a>
            </div>
        </div>
    </section>

    <!-- BRAND BANNER SHOWCASE -->
    <section style="padding: 3rem 0; background-color: var(--human-dark-bg); border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div style="border-radius: 16px; overflow: hidden; border: 1px solid var(--human-border-dark); box-shadow: 0 20px 50px rgba(0, 102, 255, 0.15);">
                <img src="/hv1-banner.svg" alt="Human V1 Strength Official Banner" style="width: 100%; height: auto; display: block;">
            </div>
        </div>
    </section>

    <!-- PRODUCT INTRO -->
    <section style="padding: 5rem 0; border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;">
                <div>
                    <span class="eyebrow">COMMERCIAL LAUNCH PRODUCT</span>
                    <h2 class="section-title">Human Strength</h2>
                    <p style="font-size: 1.1rem; color: #94A3B8; margin-bottom: 1.5rem;">
                        The first commercial product in the Human ecosystem. Built natively for Android with Jetpack Compose, Material 3, and Room. Designed for offline reliability without sacrificing progression analytics.
                    </p>
                    <ul style="list-style: none; margin-bottom: 2rem; display: flex; flex-direction: column; gap: 0.85rem;">
                        <li style="display: flex; align-items: center; gap: 0.75rem; color: var(--human-white); font-weight: 500;">
                            <span style="color: var(--human-electric-blue);">✓</span> Offline-first Room database — train anywhere without signal
                        </li>
                        <li style="display: flex; align-items: center; gap: 0.75rem; color: var(--human-white); font-weight: 500;">
                            <span style="color: var(--human-electric-blue);">✓</span> Volume analytics, estimated 1RM, PR tracking, and supersets
                        </li>
                        <li style="display: flex; align-items: center; gap: 0.75rem; color: var(--human-white); font-weight: 500;">
                            <span style="color: var(--human-electric-blue);">✓</span> Simple £24/year subscription after ~30-day introductory trial
                        </li>
                    </ul>
                    <a href="/strength?utm_source=humanv1_web&utm_medium=product_card&utm_campaign=frontpage" class="btn btn-primary">Learn More About Strength &rarr;</a>
                </div>

                <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 16px; padding: 2.5rem; box-shadow: 0 20px 40px rgba(0,0,0,0.5);">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; border-bottom: 1px solid var(--human-border-dark); padding-bottom: 1rem;">
                        <div style="font-weight: 700; color: var(--human-white); font-size: 1.1rem;">Human Strength v1</div>
                        ${renderStatusBadge('AVAILABLE')}
                    </div>
                    <div style="font-family: var(--font-mono); font-size: 0.85rem; color: #64748B; margin-bottom: 1.5rem;">
                        App ID: com.aistudio.humanstrength.kfqjza<br>
                        Stack: Kotlin | Jetpack Compose | Room DB | Firebase
                    </div>
                    <div style="background: var(--human-dark-bg); border-radius: 8px; padding: 1.25rem; border: 1px solid var(--human-border-dark);">
                        <div style="font-size: 0.85rem; color: #94A3B8; margin-bottom: 0.5rem;">SUBSCRIPTION ENTITLEMENT</div>
                        <div style="font-size: 1.5rem; font-weight: 800; color: var(--human-white);">£24 / year</div>
                        <div style="font-size: 0.85rem; color: #10B981; margin-top: 0.25rem;">Includes ~30-day introductory trial. Data never erased on expiration.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ECOSYSTEM GRID -->
    <section style="padding: 5rem 0; background-color: var(--human-dark-surface); border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
                <span class="eyebrow">THE HUMAN ECOSYSTEM</span>
                <h2 class="section-title">One Human. Multiple Disciplines.</h2>
                <p style="color: #94A3B8; font-size: 1.05rem;">
                    Human Strength is just the start. The Human platform is built to connect physical disciplines into a unified performance technology engine.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.5rem;">
                ${canonicalApps.map(app => `
                    <div style="background: var(--human-dark-bg); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 1.75rem; transition: border-color 0.2s;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                            <h3 style="font-size: 1.2rem; color: var(--human-white);">${app.title}</h3>
                            ${renderStatusBadge(app.status)}
                        </div>
                        <p style="font-size: 0.9rem; color: #94A3B8; margin-bottom: 1.5rem; line-height: 1.5; min-height: 4.5em;">
                            ${app.description}
                        </p>
                        <a href="${app.target_url}" style="font-size: 0.85rem; font-weight: 600; color: var(--human-electric-blue);">
                            View Details &rarr;
                        </a>
                    </div>
                `).join('')}
            </div>
        </div>
    </section>

    <!-- ONTOLOGY FEATURE -->
    <section style="padding: 5rem 0; border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;">
                <div>
                    <span class="eyebrow">HUMAN ONTOLOGY PROGRAMME</span>
                    <h2 class="section-title">More Than An Exercise Library</h2>
                    <p style="font-size: 1.05rem; color: #94A3B8; margin-bottom: 1.5rem;">
                        Human is building a structured exercise knowledge system designed to understand movements, equipment taxonomy, anatomical mechanics, relationships, substitutions, and training context across the entire Human platform.
                    </p>
                    <p style="font-size: 0.95rem; color: #64748B; margin-bottom: 2rem;">
                        Our ambition is to build one of the world's most comprehensive structured exercise databases, providing the intelligence foundation for Human Strength, HIIT, Recovery, Coach, and beyond.
                    </p>
                    <a href="/ontology" class="btn btn-secondary">Explore The Human Ontology &rarr;</a>
                </div>

                <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem; font-family: var(--font-mono); font-size: 0.85rem;">
                    <div style="color: var(--human-electric-blue); font-weight: 700; margin-bottom: 1rem;">// ONTOLOGY STRUCTURED KNOWLEDGE</div>
                    <div style="color: #94A3B8; line-height: 1.8;">
                        canonical_name: "Barbell Back Squat"<br>
                        movement_pattern: "Squat / Knee Dominant"<br>
                        plane_of_motion: "Sagittal"<br>
                        primary_muscles: ["Quadriceps", "Gluteus Maximus"]<br>
                        stabilisers: ["Erector Spinae", "Transverse Abdominis"]<br>
                        spinal_loading: "High (Axial)"<br>
                        substitutions: ["Goblet Squat", "Leg Press", "Safety Bar Squat"]<br>
                        relationships: ["Front Squat (Variation)", "Overhead Squat (Progression)"]
                    </div>
                </div>
            </div>
        </div>
    </section>
  `;
  res.send(layoutHtml(seoTitle, seoDesc, content, '/'));
});

// ROUTE 2: APPS CATALOGUE (/apps)
app.get('/apps', (req, res) => {
  const seoTitle = 'Ecosystem Apps — Human Performance Technology Catalogue';
  const seoDesc = 'Explore the Human performance technology app suite: Human Strength for Android, plus Human HIIT, Running, Recovery, Mobility, Nutrition, Coach, and Community.';

  const content = `
    <section style="padding: 4rem 0;">
      <div class="container">
          <div style="text-align: center; max-width: 800px; margin: 0 auto 4rem;">
              <span class="eyebrow">HUMAN ECOSYSTEM CATALOGUE</span>
              <h1 class="display-title" style="margin-bottom: 1rem;">Human Platform Apps</h1>
              <p style="font-size: 1.2rem; color: #94A3B8;">
                  One Human umbrella brand. Specialized applications designed to connect strength, endurance, mobility, recovery, and intelligent coaching into one evolving system.
              </p>
          </div>

          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;">
              ${canonicalApps.map(app => `
                  <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 16px; padding: 2rem; display: flex; flex-direction: column; justify-content: space-between;">
                      <div>
                          <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1.25rem;">
                              <div style="display: flex; align-items: center; gap: 0.75rem;">
                                  <img src="/hv1-icon.svg" alt="Human V1 App Icon" style="width: 32px; height: 32px; border-radius: 6px;">
                                  <h2 style="font-size: 1.4rem; color: var(--human-white);">${app.title}</h2>
                              </div>
                              ${renderStatusBadge(app.status)}
                          </div>
                          <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem;">
                              ${app.description}
                          </p>
                      </div>

                      <div style="border-top: 1px solid var(--human-border-dark); padding-top: 1.25rem; margin-top: 1rem; display: flex; justify-content: space-between; align-items: center;">
                          <span style="font-size: 0.85rem; color: #64748B; font-family: var(--font-mono);">${app.pricing}</span>
                          <a href="${app.target_url}" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.85rem;">
                              View Module &rarr;
                          </a>
                      </div>
                  </div>
              `).join('')}
          </div>
      </div>
    </section>
  `;
  res.send(layoutHtml(seoTitle, seoDesc, content, '/apps'));
});

// ROUTE 3: HUMAN STRENGTH MARKETING (/strength)
app.get('/strength', (req, res) => {
  const seoTitle = 'Human Strength — Android Gym Workout Tracker & Volume Analytics App';
  const seoDesc = 'Track strength progress offline with Human Strength for Android. Features local Room database, estimated 1RM, supersets, and tonnage volume analytics. £24/yr after ~30-day trial.';

  const softwareSchema = {
    '@context': 'https://schema.org',
    '@type': 'SoftwareApplication',
    'name': 'Human Strength',
    'operatingSystem': 'Android 8.0+',
    'applicationCategory': 'HealthApplication',
    'offers': {
      '@type': 'Offer',
      'price': '24.00',
      'priceCurrency': 'GBP',
      'priceValidUntil': '2027-12-31',
      'description': 'Annual subscription includes ~30-day introductory trial.'
    },
    'downloadUrl': 'https://play.google.com/store/apps/details?id=com.aistudio.humanstrength.kfqjza'
  };

  const content = `
    <!-- BANNER HERO SHOWCASE -->
    <section style="padding: 3rem 0 2rem; background: linear-gradient(180deg, rgba(0,102,255,0.18) 0%, rgba(10,13,16,1) 100%); border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div style="border-radius: 20px; overflow: hidden; border: 1px solid var(--human-border-dark); box-shadow: 0 25px 60px rgba(0, 102, 255, 0.25); margin-bottom: 3rem;">
                <img src="/hv1-banner.svg" alt="Human V1 Strength Official Banner" style="width: 100%; height: auto; display: block;">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: center;">
                <div>
                    <div style="display: flex; gap: 0.75rem; align-items: center; margin-bottom: 1rem;">
                        <span class="eyebrow" style="margin-bottom:0;">ANDROID APPLICATION</span>
                        ${renderStatusBadge('AVAILABLE')}
                    </div>
                    <h1 class="display-title" style="margin-bottom: 1.25rem;">Human Strength</h1>
                    <p style="font-size: 1.2rem; color: #94A3B8; margin-bottom: 2rem;">
                        A serious strength-training product designed to become part of a broader Human performance ecosystem. Built for total local reliability with deep progression tracking.
                    </p>
                    <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                        <a href="https://play.google.com/store/apps/details?id=com.aistudio.humanstrength.kfqjza" target="_blank" rel="noopener noreferrer" class="btn btn-primary" style="padding: 0.9rem 1.8rem;">
                            Get On Google Play
                        </a>
                        <span style="color: #64748B; font-size: 0.9rem; font-family: var(--font-mono);">
                            App ID: com.aistudio.humanstrength.kfqjza
                        </span>
                    </div>
                </div>

                <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 16px; padding: 2rem;">
                    <h3 style="font-size: 1.1rem; color: var(--human-white); margin-bottom: 1rem;">Commercial Subscription Model</h3>
                    <div style="background: var(--human-dark-bg); border-radius: 8px; padding: 1.5rem; border: 1px solid var(--human-border-dark); margin-bottom: 1.25rem;">
                        <div style="font-size: 0.85rem; color: #94A3B8; text-transform: uppercase;">Introductory Trial</div>
                        <div style="font-size: 1.5rem; font-weight: 800; color: var(--human-white); margin: 0.25rem 0;">~30 Days Full Access</div>
                        <div style="font-size: 0.85rem; color: #10B981;">No initial charge. Test every feature in real training.</div>
                    </div>
                    <div style="background: var(--human-dark-bg); border-radius: 8px; padding: 1.5rem; border: 1px solid var(--human-border-dark);">
                        <div style="font-size: 0.85rem; color: #94A3B8; text-transform: uppercase;">Annual Subscription</div>
                        <div style="font-size: 1.5rem; font-weight: 800; color: var(--human-white); margin: 0.25rem 0;">£24 / Year</div>
                        <div style="font-size: 0.85rem; color: #94A3B8;">Single entitlement. Subscription expiry never erases your workouts, sets, routines, or measurements.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="padding: 5rem 0; border-bottom: 1px solid var(--human-border-dark);">
        <div class="container">
            <div style="text-align: center; max-width: 700px; margin: 0 auto 3.5rem;">
                <span class="eyebrow">BUILT FOR ATHLETES & LIFTERS</span>
                <h2 class="section-title">Core Strength Features</h2>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); padding: 2rem; border-radius: 12px;">
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; color: var(--human-white);">Structured Routines</h3>
                    <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6;">
                        Build custom workout routines with supersets, target rep ranges, RPE targets, and configurable rest timers.
                    </p>
                </div>

                <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); padding: 2rem; border-radius: 12px;">
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; color: var(--human-white);">Live Workout Logging</h3>
                    <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6;">
                        Manual set logging, automatic rest timer notifications, live 1RM estimations, and set completions with kg/lb unit conversion.
                    </p>
                </div>

                <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); padding: 2rem; border-radius: 12px;">
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; color: var(--human-white);">Volume & Progress Analytics</h3>
                    <p style="color: #94A3B8; font-size: 0.95rem; line-height: 1.6;">
                        Track total tonnage, muscle group volume distribution, estimated 1RM progression curves, personal records, and body measurements over time.
                    </p>
                </div>
            </div>
        </div>
    </section>
  `;
  res.send(layoutHtml(seoTitle, seoDesc, content, '/strength', undefined, [softwareSchema]));
});

// ROUTE 4: HUMAN ONTOLOGY (/ontology)
app.get('/ontology', (req, res) => {
  const seoTitle = 'Human Ontology — Structured Exercise Knowledge System';
  const seoDesc = 'Explore the Human Ontology programme: an ambitious structured exercise knowledge system modeling equipment taxonomy, biomechanics, anatomy, and movement relationships.';

  const content = `
    <section style="padding: 5rem 0 4rem; background: linear-gradient(180deg, rgba(0,102,255,0.15) 0%, rgba(10,13,16,1) 100%); border-bottom: 1px solid var(--human-border-dark);">
        <div class="container" style="max-width: 900px; text-align: center;">
            <span class="eyebrow">MAJOR HUMAN PROGRAMME</span>
            <h1 class="display-title" style="margin-bottom: 1.25rem;">Human Ontology</h1>
            <p style="font-size: 1.25rem; color: #94A3B8; margin-bottom: 2rem; line-height: 1.6;">
                A structured exercise knowledge system designed to understand movements, equipment, anatomy, biomechanics, substitutions, and training context across the entire Human platform.
            </p>
            <div style="background: rgba(0,102,255,0.08); border: 1px solid rgba(0,102,255,0.3); border-radius: 12px; padding: 1.25rem 2rem; display: inline-block; font-size: 0.95rem; color: var(--human-white);">
                "Human is building an exercise ontology designed to scale far beyond a traditional exercise library."
            </div>
        </div>
    </section>

    <section style="padding: 5rem 0;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;">
                <div>
                    <span class="eyebrow">THE ARCHITECTURAL DIFFERENCE</span>
                    <h2 class="section-title">Beyond Flat Exercise Lists</h2>
                    <p style="font-size: 1.05rem; color: #94A3B8; margin-bottom: 1.25rem; line-height: 1.6;">
                        Traditional fitness apps treat exercises as flat strings of text ("Bench Press", "Squat"). This prevents intelligent exercise substitution, biomechanical load analysis, or cross-discipline training recommendations.
                    </p>
                    <p style="font-size: 1.05rem; color: #94A3B8; line-height: 1.6;">
                        The Human Ontology models exercises as rich knowledge nodes with equipment taxonomy, plane of motion, anatomical primary/secondary/stabilizer muscle relationships, force vectors, and fatigue cost profiles.
                    </p>
                </div>

                <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 16px; padding: 2rem;">
                    <h3 style="font-size: 1.1rem; color: var(--human-white); margin-bottom: 1.5rem;">Ontology Coverage Dimensions</h3>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 1rem;">
                        <li style="border-bottom: 1px solid var(--human-border-dark); padding-bottom: 0.75rem;">
                            <strong style="color: var(--human-white);">Movement Mechanics:</strong> Plane of motion, force direction, unilateral/bilateral classification, joint actions.
                        </li>
                        <li style="border-bottom: 1px solid var(--human-border-dark); padding-bottom: 0.75rem;">
                            <strong style="color: var(--human-white);">Equipment Taxonomy:</strong> Barbells, dumbbells, cables, selectorised, plate-loaded, Smith machine, landmine, bodyweight.
                        </li>
                        <li style="border-bottom: 1px solid var(--human-border-dark); padding-bottom: 0.75rem;">
                            <strong style="color: var(--human-white);">Anatomical Mapping:</strong> Primary muscles, secondary synergists, stabilizer roles, spinal loading index.
                        </li>
                        <li>
                            <strong style="color: var(--human-white);">Programming Intelligence:</strong> Progressions, regressions, equivalent substitutions, fatigue cost.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
  `;
  res.send(layoutHtml(seoTitle, seoDesc, content, '/ontology'));
});

// ROUTE 5: JOURNAL (/journal)
app.get('/journal', (req, res) => {
  const seoTitle = 'Human Journal — Performance Science, Product Engineering & Training Insights';
  const seoDesc = 'Evidence-based training guides, performance science, strength analytics, and exercise ontology research from the Human team.';

  const content = `
    <section style="padding: 5rem 0;">
      <div class="container">
          <div style="text-align: center; max-width: 800px; margin: 0 auto 4rem;">
              <span class="eyebrow">EDITORIAL & RESEARCH</span>
              <h1 class="display-title" style="margin-bottom: 1rem;">Human Journal</h1>
              <p style="font-size: 1.2rem; color: #94A3B8; line-height: 1.6;">
                  Evidence-based training guides, performance science, strength analytics, and exercise ontology research from the Human team.
              </p>
          </div>

          <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem;">
              ${cornerstoneArticles.map(art => `
                  <article style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem; display: flex; flex-direction: column; justify-content: space-between;">
                      <div>
                          <span style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--human-electric-blue); text-transform: uppercase;">
                              ${art.category}
                          </span>
                          <h2 style="font-size: 1.3rem; margin: 0.75rem 0; color: var(--human-white);">
                              <a href="/journal/${art.slug}" style="color: var(--human-white);">${art.title}</a>
                          </h2>
                          <p style="color: #94A3B8; font-size: 0.95rem; margin-bottom: 1.5rem; line-height: 1.6;">
                              ${art.excerpt}
                          </p>
                      </div>
                      <div style="border-top: 1px solid var(--human-border-dark); padding-top: 1rem; font-size: 0.85rem; color: #64748B; font-family: var(--font-mono); display: flex; justify-content: space-between;">
                          <span>${art.date}</span>
                          <a href="/journal/${art.slug}" style="color: var(--human-electric-blue); font-weight: 600;">Read Article &rarr;</a>
                      </div>
                  </article>
              `).join('')}
          </div>
      </div>
    </section>
  `;
  res.send(layoutHtml(seoTitle, seoDesc, content, '/journal'));
});

// ROUTE 5B: SINGLE JOURNAL ARTICLE (/journal/:slug)
app.get('/journal/:slug', (req, res) => {
  const article = cornerstoneArticles.find(a => a.slug === req.params.slug);
  if (!article) {
    return res.status(404).send(layoutHtml('404 Article Not Found — Human', 'Requested article not found', `
      <section style="padding: 6rem 0; text-align: center;">
        <div class="container">
          <h1 style="margin-bottom: 1rem;">Article Not Found</h1>
          <p style="color: #94A3B8; margin-bottom: 2rem;">The requested article could not be located in the Human Journal archive.</p>
          <a href="/journal" class="btn btn-primary">&larr; Return to Human Journal</a>
        </div>
      </section>
    `, '/journal'));
  }

  const articleSchema = {
    '@context': 'https://schema.org',
    '@type': 'BlogPosting',
    'headline': article.title,
    'description': article.excerpt,
    'image': 'https://humanv1.com/human-og-share.svg',
    'datePublished': `${article.date}T10:00:00+00:00`,
    'author': {
      '@type': 'Organization',
      'name': article.author,
      'url': 'https://humanv1.com'
    }
  };

  const content = `
    <section style="padding: 4rem 0;">
      <article class="container" style="max-width: 800px;">
        <nav aria-label="Breadcrumb" style="margin-bottom: 2rem; font-family: var(--font-mono); font-size: 0.85rem; color: #64748B;">
            <a href="/" style="color: #94A3B8;">Home</a> &gt; 
            <a href="/journal" style="color: #94A3B8;">Journal</a> &gt; 
            <span style="color: var(--human-electric-blue);">${article.title}</span>
        </nav>

        <header style="margin-bottom: 2.5rem; text-align: left; border-bottom: 1px solid var(--human-border-dark); padding-bottom: 1.5rem;">
            <span style="font-family: var(--font-mono); font-size: 0.85rem; color: var(--human-electric-blue); text-transform: uppercase;">
                ${article.category}
            </span>
            <h1 class="display-title" style="margin: 0.75rem 0 1.25rem; font-size: clamp(1.75rem, 4vw, 2.5rem); line-height: 1.25;">${article.title}</h1>
            <div style="color: #64748B; font-size: 0.85rem; font-family: var(--font-mono);">
                By ${article.author} | Published on ${article.date}
            </div>
        </header>

        <div style="color: #CBD5E1; font-size: 1.05rem; line-height: 1.8;" class="entry-content">
            ${article.content}
        </div>

        <footer style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid var(--human-border-dark);">
            <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem; text-align: center;">
                <span class="eyebrow">HUMAN PERFORMANCE ECOSYSTEM</span>
                <h3 style="color: var(--human-white); margin-bottom: 0.5rem;">Take Your Training Data Seriously</h3>
                <p style="color: #94A3B8; margin-bottom: 1.5rem; font-size: 0.95rem;">
                    Human Strength provides offline-first Room local database workout logging with automated volume analytics and estimated 1RM progression on Android.
                </p>
                <a href="/strength?utm_source=humanv1_web&utm_medium=journal_footer&utm_campaign=${article.slug}" class="btn btn-primary">Explore Human Strength &rarr;</a>
            </div>
        </footer>
      </article>
    </section>
  `;
  res.send(layoutHtml(article.seo_title, article.seo_desc, content, `/journal/${article.slug}`, undefined, [articleSchema]));
});

// ROUTE 6: ABOUT (/about)
app.get('/about', (req, res) => {
  const seoTitle = 'About Human V1 — Brand Vision, Architecture & Ecosystem';
  const seoDesc = 'Learn about Human: a performance technology platform built around real people, structured training data, and long-term progression.';

  const content = `
    <section style="padding: 5rem 0;">
      <div class="container" style="max-width: 900px;">
          <span class="eyebrow">ABOUT HUMAN</span>
          <h1 class="display-title" style="margin-bottom: 1.5rem;">Built Around Real Performance</h1>
          
          <p style="font-size: 1.25rem; color: #94A3B8; margin-bottom: 2.5rem; line-height: 1.7;">
              Human is a performance technology brand built around real people, real training data, progression, and long-term performance. We believe technology should serve physical execution — not distract from it.
          </p>

          <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 16px; padding: 2.5rem; margin-bottom: 3rem;">
              <h2 style="font-size: 1.5rem; color: var(--human-white); margin-bottom: 1rem;">One Platform. Multiple Disciplines.</h2>
              <p style="color: #94A3B8; font-size: 1.05rem; line-height: 1.7; margin-bottom: 1.5rem;">
                  Human Strength is our first commercial product. Moving forward, Human will expand into HIIT, Running, Recovery, Mobility, Nutrition, and Intelligent Coaching.
              </p>
              <p style="color: #94A3B8; font-size: 1.05rem; line-height: 1.7;">
                  These are not isolated apps — they are connected modules sharing a unified Human performance platform and the Human Ontology knowledge engine.
              </p>
          </div>
      </div>
    </section>
  `;
  res.send(layoutHtml(seoTitle, seoDesc, content, '/about'));
});

// ROUTE 7: SUPPORT (/support)
app.get('/support', (req, res) => {
  const seoTitle = 'Customer Support & Help Center — Human V1';
  const seoDesc = 'Get help with Human Strength, Google Play subscriptions, data backups, and technical support.';

  const content = `
    <section style="padding: 5rem 0;">
      <div class="container" style="max-width: 900px;">
          <span class="eyebrow">HELP & CUSTOMER SUPPORT</span>
          <h1 class="display-title" style="margin-bottom: 1.5rem;">Human Support</h1>
          <p style="font-size: 1.2rem; color: #94A3B8; margin-bottom: 3rem;">
              Find answers regarding Human Strength, subscription management via Google Play, data sync, and account options.
          </p>

          <div style="display: grid; gap: 2rem;">
              <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem;">
                  <h3 style="color: var(--human-white); font-size: 1.25rem; margin-bottom: 1rem;">How do I manage or cancel my subscription?</h3>
                  <p style="color: #94A3B8; font-size: 1rem; line-height: 1.6;">
                      Human Strength subscriptions are handled directly through Google Play. To view, update, or cancel your subscription, open Google Play Store on your device &gt; Payments &amp; Subscriptions &gt; Subscriptions.
                  </p>
              </div>

              <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem;">
                  <h3 style="color: var(--human-white); font-size: 1.25rem; margin-bottom: 1rem;">Does Human Strength work completely offline?</h3>
                  <p style="color: #94A3B8; font-size: 1rem; line-height: 1.6;">
                      Yes. Human Strength is built offline-first using a local Room database. You can log workouts in basement gyms, remote trails, or offline environments without an active internet connection.
                  </p>
              </div>

              <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem;">
                  <h3 style="color: var(--human-white); font-size: 1.25rem; margin-bottom: 1rem;">Need Direct Support?</h3>
                  <p style="color: #94A3B8; font-size: 1rem; line-height: 1.6;">
                      Contact our technical team at <a href="mailto:support@humanv1.com" style="color: var(--human-electric-blue);">support@humanv1.com</a> with your app ID and question.
                  </p>
              </div>
          </div>
      </div>
    </section>
  `;
  res.send(layoutHtml(seoTitle, seoDesc, content, '/support'));
});

// ROUTE 8: PRIVACY (/privacy)
app.get('/privacy', (req, res) => {
  const seoTitle = 'Privacy Policy — Human V1';
  const seoDesc = 'Read the Human Privacy Policy. How we handle your workout data, account privacy, and local storage.';

  const content = `
    <section style="padding: 5rem 0;">
      <div class="container" style="max-width: 800px;">
        <h1 class="display-title" style="margin-bottom: 1.5rem;">Privacy Policy</h1>
        <p style="color: #64748B; font-family: var(--font-mono); margin-bottom: 2rem;">Last Updated: July 26, 2026</p>
        <div style="color: #CBD5E1; line-height: 1.8;">
          <p style="margin-bottom: 1.5rem;">At Human V1, we respect your privacy and treat your fitness data as strictly your personal information. Our applications are designed with local-first storage principles.</p>
          <h2 style="font-size: 1.3rem; margin: 1.5rem 0 0.75rem; color: var(--human-white);">Data Collection &amp; Local Storage</h2>
          <p style="margin-bottom: 1.5rem;">Workout logs, sets, reps, weight, and body measurements in Human Strength are stored directly on your mobile device in an encrypted Room local database.</p>
        </div>
      </div>
    </section>
  `;
  res.send(layoutHtml(seoTitle, seoDesc, content, '/privacy'));
});

// ROUTE 9: TERMS (/terms)
app.get('/terms', (req, res) => {
  const seoTitle = 'Terms of Service — Human V1';
  const seoDesc = 'Read the Human Terms of Service governing platform usage, software entitlements, and subscriptions.';

  const content = `
    <section style="padding: 5rem 0;">
      <div class="container" style="max-width: 800px;">
        <h1 class="display-title" style="margin-bottom: 1.5rem;">Terms of Service</h1>
        <p style="color: #64748B; font-family: var(--font-mono); margin-bottom: 2rem;">Last Updated: July 26, 2026</p>
        <div style="color: #CBD5E1; line-height: 1.8;">
          <p style="margin-bottom: 1.5rem;">Welcome to Human V1. By accessing humanv1.com or using Human applications, you agree to these Terms of Service.</p>
        </div>
      </div>
    </section>
  `;
  res.send(layoutHtml(seoTitle, seoDesc, content, '/terms'));
});

// ROUTE 10: DATA DELETION (/data-deletion)
app.get('/data-deletion', (req, res) => {
  const seoTitle = 'Data Deletion Instructions — Human V1';
  const seoDesc = 'Instructions on how to request complete account or cloud data deletion for Human apps.';

  const content = `
    <section style="padding: 5rem 0;">
      <div class="container" style="max-width: 800px;">
        <h1 class="display-title" style="margin-bottom: 1.5rem;">Account &amp; Data Deletion</h1>
        <p style="color: #CBD5E1; line-height: 1.8; margin-bottom: 2rem;">
          You have full control over your data in Human Strength. Because your workout logs reside on your local device, deleting the application immediately clears local records.
        </p>
      </div>
    </section>
  `;
  res.send(layoutHtml(seoTitle, seoDesc, content, '/data-deletion'));
});

// DEV PREVIEW ADMIN INSPECTOR
app.get('/wp-admin-preview', (req, res) => {
  const seoTitle = 'WordPress Admin & REST API Inspector — Human Platform';
  const seoDesc = 'Developer inspector for WordPress plugin and theme configuration in AI Studio.';

  const content = `
    <section style="padding: 4rem 0;">
      <div class="container">
        <h1 class="display-title" style="margin-bottom: 1rem;">WordPress Platform Inspector</h1>
        <p style="color: #94A3B8; margin-bottom: 2.5rem;">Direct developer links to verify WordPress Custom Post Types, REST API JSON endpoints, and Theme configuration.</p>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
          <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem;">
            <h2 style="font-size: 1.25rem; color: var(--human-white); margin-bottom: 1rem;">REST API Endpoints</h2>
            <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.75rem; font-family: var(--font-mono); font-size: 0.9rem;">
              <li><a href="/wp-json/human/v1/apps" target="_blank">GET /wp-json/human/v1/apps &rarr;</a></li>
              <li><a href="/wp-json/human/v1/journal" target="_blank">GET /wp-json/human/v1/journal &rarr;</a></li>
              <li><a href="/wp-json/human/v1/ontology/summary" target="_blank">GET /wp-json/human/v1/ontology/summary &rarr;</a></li>
              <li><a href="/wp-json/human/v1/seo" target="_blank">GET /wp-json/human/v1/seo &rarr;</a></li>
            </ul>
          </div>

          <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem;">
            <h2 style="font-size: 1.25rem; color: var(--human-white); margin-bottom: 1rem;">Technical SEO Files</h2>
            <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.75rem; font-family: var(--font-mono); font-size: 0.9rem;">
              <li><a href="/robots.txt" target="_blank">/robots.txt &rarr;</a></li>
              <li><a href="/sitemap.xml" target="_blank">/sitemap.xml &rarr;</a></li>
              <li><a href="/human-og-share.svg" target="_blank">/human-og-share.svg (1200x630 OG) &rarr;</a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  `;
  res.send(layoutHtml(seoTitle, seoDesc, content, '/wp-admin-preview'));
});

// 404 FALLBACK
app.use((req, res) => {
  res.status(404).send(layoutHtml('404 Page Not Found — Human', 'Requested page not found on humanv1.com', `
    <section style="padding: 6rem 0; text-align: center;">
      <div class="container" style="max-width: 600px;">
        <span class="eyebrow" style="color: var(--human-error);">404 — PAGE NOT FOUND</span>
        <h1 class="display-title" style="margin: 1rem 0;">Lost Your Training Path?</h1>
        <p style="color: #94A3B8; font-size: 1.05rem; margin-bottom: 2rem; line-height: 1.6;">
            The page or route you are looking for does not exist on humanv1.com.
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="/" class="btn btn-primary">Return to Homepage</a>
            <a href="/strength" class="btn btn-secondary">Human Strength</a>
            <a href="/journal" class="btn btn-outline">Human Journal</a>
        </div>
      </div>
    </section>
  `, req.path));
});

app.listen(PORT, '0.0.0.0', () => {
  console.log(`Human V1 Node/Express Preview Server running on http://0.0.0.0:${PORT}`);
});
