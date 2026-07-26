import express from 'express';
import path from 'path';

const app = express();
const PORT = 3000;

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

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

// Master Layout HTML wrapper
function layoutHtml(title: string, contentHtml: string, activePath: string = '') {
  return `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>${title} — Human | Train. Track. Transform.</title>
    <link rel="icon" type="image/svg+xml" href="/hv1-icon.svg">
    <link rel="apple-touch-icon" href="/hv1-icon.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600&display=swap" rel="stylesheet">
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
      .brand-icon { width: 32px; height: 32px; background: linear-gradient(135deg, var(--human-electric-blue), #003399); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-weight: 900; font-size: 0.85rem; }
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
                <a href="/strength" class="btn btn-primary" style="padding: 0.55rem 1.1rem; font-size: 0.85rem;">Human Strength</a>
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

// REST API Endpoints matching human-platform plugin
app.get('/wp-json/human/v1/apps', (req, res) => {
  res.json({
    success: true,
    brand: 'Human',
    domain: 'humanv1.com',
    data: canonicalApps
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

// ROUTE 1: FRONT PAGE (/)
app.get('/', (req, res) => {
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
                <a href="/strength" class="btn btn-primary" style="padding: 1rem 2rem; font-size: 1.05rem;">
                    Explore Human Strength
                </a>
                <a href="/ontology" class="btn btn-secondary" style="padding: 1rem 2rem; font-size: 1.05rem;">
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
                    <a href="/strength" class="btn btn-primary">Learn More About Strength &rarr;</a>
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
  res.send(layoutHtml('Home', content, '/'));
});

// ROUTE 2: APPS CATALOGUE (/apps)
app.get('/apps', (req, res) => {
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
  res.send(layoutHtml('Ecosystem Apps', content, '/apps'));
});

// ROUTE 3: HUMAN STRENGTH MARKETING (/strength)
app.get('/strength', (req, res) => {
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
                    <a href="https://play.google.com/store/apps/details?id=com.aistudio.humanstrength.kfqjza" target="_blank" class="btn btn-primary" style="padding: 0.9rem 1.8rem;">
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
                    <p style="color: #94A3B8; font-size: 0.95rem;">
                        Build custom workout routines with supersets, target rep ranges, RPE targets, and configurable rest timers.
                    </p>
                </div>

                <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); padding: 2rem; border-radius: 12px;">
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; color: var(--human-white);">Live Workout Logging</h3>
                    <p style="color: #94A3B8; font-size: 0.95rem;">
                        Manual set logging, automatic rest timer notifications, live 1RM estimations, and set completions with kg/lb unit conversion.
                    </p>
                </div>

                <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); padding: 2rem; border-radius: 12px;">
                    <h3 style="font-size: 1.2rem; margin-bottom: 0.75rem; color: var(--human-white);">Volume & Progress Analytics</h3>
                    <p style="color: #94A3B8; font-size: 0.95rem;">
                        Track total tonnage, muscle group volume distribution, estimated 1RM progression curves, personal records, and body measurements over time.
                    </p>
                </div>
            </div>
        </div>
    </section>
  `;
  res.send(layoutHtml('Human Strength', content, '/strength'));
});

// ROUTE 4: HUMAN ONTOLOGY (/ontology)
app.get('/ontology', (req, res) => {
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
  res.send(layoutHtml('Human Ontology', content, '/ontology'));
});

// ROUTE 5: JOURNAL (/journal)
app.get('/journal', (req, res) => {
  const content = `
    <section style="padding: 5rem 0;">
      <div class="container">
          <div style="text-align: center; max-width: 800px; margin: 0 auto 4rem;">
              <span class="eyebrow">EDITORIAL & RESEARCH</span>
              <h1 class="display-title" style="margin-bottom: 1rem;">Human Journal</h1>
              <p style="font-size: 1.2rem; color: #94A3B8;">
                  Articles, product engineering updates, performance science, and behind-the-scenes developments across the Human ecosystem.
              </p>
          </div>

          <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 2rem;">
              <article style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem;">
                  <span style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--human-electric-blue);">HUMAN PHILOSOPHY</span>
                  <h2 style="font-size: 1.3rem; margin: 0.75rem 0; color: var(--human-white);">Why Human Starts With Strength</h2>
                  <p style="color: #94A3B8; font-size: 0.95rem; margin-bottom: 1.5rem; line-height: 1.6;">
                      Strength training provides the foundational neural, musculoskeletal, and hormonal bedrock for all physical performance. Here is why Strength is our launch focus.
                  </p>
                  <span style="font-size: 0.85rem; color: #64748B;">July 2026 | Human Editorial</span>
              </article>

              <article style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem;">
                  <span style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--human-electric-blue);">ARCHITECTURE</span>
                  <h2 style="font-size: 1.3rem; margin: 0.75rem 0; color: var(--human-white);">Why Your Workout Should Not Depend On Signal</h2>
                  <p style="color: #94A3B8; font-size: 0.95rem; margin-bottom: 1.5rem; line-height: 1.6;">
                      An engineering look into offline-first Android architecture using Room database, avoiding gym connectivity latency or cloud dependency failures.
                  </p>
                  <span style="font-size: 0.85rem; color: #64748B;">July 2026 | Tech Lead</span>
              </article>

              <article style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem;">
                  <span style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--human-electric-blue);">ONTOLOGY</span>
                  <h2 style="font-size: 1.3rem; margin: 0.75rem 0; color: var(--human-white);">Building The Human Ontology</h2>
                  <p style="color: #94A3B8; font-size: 0.95rem; margin-bottom: 1.5rem; line-height: 1.6;">
                      Why we are building a structured exercise knowledge system designed to model movement mechanics, equipment taxonomy, and joint actions across the entire platform.
                  </p>
                  <span style="font-size: 0.85rem; color: #64748B;">July 2026 | Research Team</span>
              </article>
          </div>
      </div>
    </section>
  `;
  res.send(layoutHtml('Human Journal', content, '/journal'));
});

// ROUTE 6: ABOUT (/about)
app.get('/about', (req, res) => {
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
  res.send(layoutHtml('About Platform', content, '/about'));
});

// ROUTE 7: SUPPORT (/support)
app.get('/support', (req, res) => {
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
                  <h3 style="color: var(--human-white); font-size: 1.25rem; margin-bottom: 1rem;">What happens if my subscription expires?</h3>
                  <p style="color: #94A3B8; font-size: 1rem; line-height: 1.6;">
                      Your data is safe. Expiration does NOT erase your logged workouts, routines, sets, body measurements, or settings. You retain full access to view your historical data and export local records.
                  </p>
              </div>

              <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem;">
                  <h3 style="color: var(--human-white); font-size: 1.25rem; margin-bottom: 1rem;">How do I request data deletion?</h3>
                  <p style="color: #94A3B8; font-size: 1rem; line-height: 1.6;">
                      Visit our <a href="/data-deletion" style="color: var(--human-electric-blue);">Data Deletion Page</a> for step-by-step instructions on deleting your local Room database or cloud account.
                  </p>
              </div>
          </div>
      </div>
    </section>
  `;
  res.send(layoutHtml('Support', content, '/support'));
});

// ROUTE 8: PRIVACY (/privacy)
app.get('/privacy', (req, res) => {
  const content = `
    <section style="padding: 5rem 0;">
      <div class="container" style="max-width: 800px;">
          <span class="eyebrow">LEGAL COMPLIANCE</span>
          <h1 class="display-title" style="margin-bottom: 1.5rem;">Privacy Policy</h1>
          <p style="color: #64748B; font-family: var(--font-mono); font-size: 0.9rem; margin-bottom: 2.5rem;">
              Effective Date: July 26, 2026 | Domain: humanv1.com
          </p>

          <div style="color: #94A3B8; font-size: 1rem; line-height: 1.7; display: flex; flex-direction: column; gap: 1.75rem;">
              <p>Human Performance Technology ("Human", "we", "our") respects your privacy. This policy describes how we process data across humanv1.com and Human applications including Human Strength (App ID: <code>com.aistudio.humanstrength.kfqjza</code>).</p>
              <h2 style="color: var(--human-white); font-size: 1.35rem;">1. Offline Local Storage</h2>
              <p>Human Strength stores logged workouts, routines, sets, and measurements locally in Room DB on your device.</p>
              <h2 style="color: var(--human-white); font-size: 1.35rem;">2. Google Play Billing</h2>
              <p>Purchases are managed through Google Play Billing. We do not process or store credit card details directly.</p>
          </div>
      </div>
    </section>
  `;
  res.send(layoutHtml('Privacy Policy', content));
});

// ROUTE 9: TERMS (/terms)
app.get('/terms', (req, res) => {
  const content = `
    <section style="padding: 5rem 0;">
      <div class="container" style="max-width: 800px;">
          <span class="eyebrow">TERMS & CONDITIONS</span>
          <h1 class="display-title" style="margin-bottom: 1.5rem;">Terms of Service</h1>
          <p style="color: #64748B; font-family: var(--font-mono); font-size: 0.9rem; margin-bottom: 2.5rem;">
              Effective Date: July 26, 2026 | Domain: humanv1.com
          </p>
          <div style="color: #94A3B8; font-size: 1rem; line-height: 1.7; display: flex; flex-direction: column; gap: 1.5rem;">
              <p>By accessing humanv1.com or using Human Strength, you agree to these Terms.</p>
              <h2 style="color: var(--human-white); font-size: 1.35rem;">1. Entitlement & Subscriptions</h2>
              <p>Human Strength features an introductory trial (~30 days) followed by an annual £24/year Google Play subscription.</p>
          </div>
      </div>
    </section>
  `;
  res.send(layoutHtml('Terms of Service', content));
});

// ROUTE 10: DATA DELETION (/data-deletion)
app.get('/data-deletion', (req, res) => {
  const content = `
    <section style="padding: 5rem 0;">
      <div class="container" style="max-width: 800px;">
          <span class="eyebrow">GOOGLE PLAY COMPLIANCE</span>
          <h1 class="display-title" style="margin-bottom: 1.5rem;">Data & Account Deletion</h1>
          <div style="display: flex; flex-direction: column; gap: 2rem;">
              <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem;">
                  <h3 style="color: var(--human-white); margin-bottom: 0.75rem;">1. Clear Local Data</h3>
                  <p style="color: #94A3B8; font-size: 0.95rem;">Android Settings &gt; Apps &gt; Human Strength &gt; Storage &gt; Clear Storage.</p>
              </div>
              <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem;">
                  <h3 style="color: var(--human-white); margin-bottom: 0.75rem;">2. Request Cloud Deletion</h3>
                  <p style="color: #94A3B8; font-size: 0.95rem;">Email <code>support@humanv1.com</code> with subject "Cloud Account Deletion Request".</p>
              </div>
          </div>
      </div>
    </section>
  `;
  res.send(layoutHtml('Data Deletion', content));
});

// ROUTE 11: CONTACT (/contact)
app.get('/contact', (req, res) => {
  const content = `
    <section style="padding: 5rem 0;">
      <div class="container" style="max-width: 800px;">
          <span class="eyebrow">GET IN TOUCH</span>
          <h1 class="display-title" style="margin-bottom: 1.5rem;">Contact Human</h1>
          <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 16px; padding: 2.5rem;">
              <p style="color: #94A3B8; font-size: 1.05rem; margin-bottom: 1.5rem;">Inquiries, support, and ontology research contacts:</p>
              <ul style="list-style: none; display: flex; flex-direction: column; gap: 1rem; color: var(--human-white);">
                  <li><strong>Support:</strong> support@humanv1.com</li>
                  <li><strong>General:</strong> hello@humanv1.com</li>
                  <li><strong>Ontology Programme:</strong> ontology@humanv1.com</li>
              </ul>
          </div>
      </div>
    </section>
  `;
  res.send(layoutHtml('Contact', content));
});

// ROUTE 12: WORDPRESS ADMIN PREVIEW INSPECTOR (/wp-admin-preview)
app.get('/wp-admin-preview', (req, res) => {
  const content = `
    <section style="padding: 4rem 0;">
      <div class="container">
          <span class="eyebrow">WORDPRESS ARCHITECTURE INSPECTOR</span>
          <h1 class="display-title" style="margin-bottom: 1.5rem;">WordPress Admin &amp; Extension Engine</h1>
          <p style="font-size: 1.1rem; color: #94A3B8; margin-bottom: 2.5rem;">
              Review production WordPress custom post types, status taxonomies, REST API outputs, and future <code>human-marketing</code> extension hooks.
          </p>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
              <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem;">
                  <h3 style="color: var(--human-white); margin-bottom: 1rem;">1. Registered Custom Post Types</h3>
                  <div style="font-family: var(--font-mono); font-size: 0.85rem; color: #94A3B8; line-height: 1.8;">
                      cpt: <strong>human_app</strong><br>
                      menu_label: "Human Ecosystem"<br>
                      taxonomy: <strong>human_app_status</strong><br>
                      statuses: ["AVAILABLE", "IN_DEVELOPMENT", "COMING_SOON", "PLANNED"]<br>
                      supports: ["title", "editor", "thumbnail", "excerpt", "custom-fields"]
                  </div>
              </div>

              <div style="background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem;">
                  <h3 style="color: var(--human-white); margin-bottom: 1rem;">2. REST API Endpoints</h3>
                  <div style="font-family: var(--font-mono); font-size: 0.85rem; color: #94A3B8; line-height: 1.8;">
                      GET <a href="/wp-json/human/v1/apps" target="_blank" style="color: var(--human-electric-blue);">/wp-json/human/v1/apps</a><br>
                      GET <a href="/wp-json/human/v1/ontology/summary" target="_blank" style="color: var(--human-electric-blue);">/wp-json/human/v1/ontology/summary</a>
                  </div>
              </div>

              <div style="grid-column: span 2; background: var(--human-dark-surface); border: 1px solid var(--human-border-dark); border-radius: 12px; padding: 2rem;">
                  <h3 style="color: var(--human-white); margin-bottom: 1rem;">3. Future <code>human-marketing</code> Buffer-Style Architecture</h3>
                  <p style="color: #94A3B8; font-size: 0.95rem; margin-bottom: 1rem;">
                      Reserved extension points &amp; hooks for future Buffer-style social publishing queue, CTA library, and campaign tracking:
                  </p>
                  <div style="font-family: var(--font-mono); font-size: 0.825rem; color: #10B981; line-height: 1.8;">
                      do_action('human_marketing_enqueue_journal_post', $post_id, $post);<br>
                      apply_filters('human_marketing_format_utm_url', $url, $campaign_id, $medium);<br>
                      reserved_tables: ["wp_human_campaigns", "wp_human_social_queue", "wp_human_social_publications", "wp_human_cta_library"]
                  </div>
              </div>
          </div>
      </div>
    </section>
  `;
  res.send(layoutHtml('WordPress Admin Architecture', content));
});

app.listen(PORT, '0.0.0.0', () => {
  console.log(`Human WordPress Marketing Web Platform running at http://0.0.0.0:${PORT}`);
});
