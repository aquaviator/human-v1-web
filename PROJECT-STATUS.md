# PROJECT STATUS — Human (humanv1.com)

**Last Updated:** July 26, 2026  
**Brand:** Human (Train. Track. Transform.)  
**Primary Domain:** humanv1.com  
**Target Architecture:** WordPress 6.x / PHP 8.2+ Custom Theme & Platform Plugin  

---

## 1. Executive Summary
Human is a performance technology brand built around real people, real training data, progression, and long-term performance. `humanv1.com` is the public marketing, editorial, SEO, and product promotional platform for the Human app ecosystem.

This platform communicates the unified "One Human" brand vision, showcases the **Human Ontology** exercise knowledge system, promotes the **Human Strength** app, and serves as the publishing hub for the **Human Journal**.

---

## 2. Canonical Product Roadmap & Statuses

| Product | Status | Description |
| :--- | :--- | :--- |
| **Human Strength** | **AVAILABLE** | First commercial product. Android app (`com.aistudio.humanstrength.kfqjza`). Offline-first, Room local database, optional cloud sync. £24/year after ~30-day trial. |
| **Human HIIT** | **IN DEVELOPMENT (NEXT)** | High-intensity interval training module with telemetry & interval programming. |
| **Human Running** | **PLANNED** | Endurance and running analytics module. |
| **Human Recovery** | **PLANNED** | HRV, readiness, and sleep-to-load recovery tracking. |
| **Human Mobility** | **PLANNED** | Joint health, movement prep, and range-of-motion routines. |
| **Human Nutrition** | **PLANNED** | Fueling, macronutrient, and energy balance module. |
| **Human Coach** | **COMING SOON** | AI-assisted programming & movement feedback engine. |
| **Human Community** | **PLANNED** | Social performance sharing & peer benchmarks. |

---

## 3. Architecture & WordPress Design

### A. Core Architecture Stack
- **WordPress 6.x** core compatibility
- **PHP 8.2+** standard APIs
- **Custom Theme:** `human-v1-theme` (`/wp-content/themes/human-v1-theme`)
- **Custom Plugin:** `human-platform` (`/wp-content/plugins/human-platform`)
- **Database:** MySQL / MariaDB (Standard WordPress schema with extensible custom post types & metadata)
- **Styling:** CSS Custom Properties + Human Electric Blue `#0066FF` design system
- **Performance Targets:** High-efficiency PHP, semantic HTML5, zero heavy dependencies (No Elementor, Divi, WPBakery, or bloated frameworks).

### B. Theme File Hierarchy (`wp-content/themes/human-v1-theme`)
- `style.css` — Theme headers & master CSS custom properties.
- `functions.php` — Theme initialization, asset enqueueing, block editor support, SVG handling, and metadata helpers.
- `header.php` — Universal responsive header with navigation & logo.
- `footer.php` — Footer layout with legal, navigation, and brand statement.
- `front-page.php` — Homepage layout with hero, product intro, platform grid, Ontology preview, offline-first philosophy, and Journal highlights.
- `page-apps.php` — Complete Human Apps catalogue (`/apps`).
- `page-strength.php` — Product marketing page for Human Strength (`/strength`).
- `page-ontology.php` — Major editorial marketing page for Human Ontology (`/ontology`).
- `page-about.php` — Brand vision & philosophy (`/about`).
- `page-support.php` — User support & Google Play help (`/support`).
- `page-privacy.php` — Privacy policy (`/privacy`).
- `page-terms.php` — Terms of service (`/terms`).
- `page-data-deletion.php` — Account & data deletion instructions (`/data-deletion`).
- `page-contact.php` — Contact form & inquiry details (`/contact`).
- `home.php` — Human Journal archive page (`/journal`).
- `single.php` — Journal single post view.
- `page.php` — Fallback page template.

### C. Plugin Architecture (`wp-content/plugins/human-platform`)
- Registers `human_app` Custom Post Type with status taxonomy (`Available`, `In Development`, `Coming Soon`, `Planned`).
- Provides REST API extension points (`/wp-json/human/v1/...`).
- Reserves extension hooks for future `human-marketing` plugin (Buffer-style social publication queue, campaigns, CTA library, and UTM tracking).

---

## 4. Brand Design System Tokens

```css
:root {
  --human-electric-blue: #0066FF;
  --human-electric-blue-pressed: #0052D4;
  --human-electric-blue-muted: #003399;
  --human-dark-bg: #0A0D10;
  --human-dark-surface: #121519;
  --human-dark-elevated: #1C2026;
  --human-light-bg: #F4F6F8;
  --human-white: #FFFFFF;
  --human-text-primary: #111827;
  --human-text-muted: #6B7280;
  --human-border-dark: #2A303A;
  --human-border-light: #E5E7EB;
  --human-success: #10B981;
  --human-warning: #F59E0B;
  --human-error: #EF4444;
}
```

---

## 5. Implementation Roadmap
1. [x] Architectural definition and `PROJECT-STATUS.md` updated.
2. [ ] Build complete `human-platform` WordPress plugin (`wp-content/plugins/human-platform/`).
3. [ ] Build complete `human-v1-theme` WordPress theme (`wp-content/themes/human-v1-theme/`).
4. [ ] Build Node/Express dev preview bridge (`server.ts`) to serve the live theme interface in AI Studio preview.
5. [ ] Provide complete `README.md` with deployment, database structure, and WordPress administration guide.
