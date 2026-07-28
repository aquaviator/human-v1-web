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
- `functions.php` — Theme initialization, asset enqueueing, block editor support, SVG handling, and native SEO integration.
- `header.php` — Universal responsive header with navigation & logo.
- `footer.php` — Footer layout with legal, navigation, and brand statement.
- `front-page.php` — Homepage layout fetching canonical apps and journal articles dynamically.
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
- `404.php` — Custom 404 error template.
- `page.php` — Fallback page template.

### C. Plugin Architecture (`wp-content/plugins/human-platform`)
- **Custom Post Types:** `human_app` (Ecosystem apps with status, pricing, app ID, target URL) and `human_cta` (Reusable conversion CTAs).
- **SEO Engine (`inc/seo-engine.php`):** Lightweight, zero-dependency SEO metadata generator (<title>, meta description, canonical link, Open Graph, Twitter Cards, and JSON-LD structured data for Organization, WebSite, BlogPosting, SoftwareApplication, and BreadcrumbList).
- **Admin Settings (`inc/admin-settings.php`):** Central settings panel under WordPress Admin for global brand settings, social share default image, and fallback metadata.
- **Meta Boxes (`inc/meta-boxes.php`):** Custom post/page meta fields for SEO titles, descriptions, target search intent, primary CTA selections, and commercial app parameters.
- **Seed Data (`inc/seed-data.php`):** Auto-seeding logic for 10 cornerstone launch articles, default ecosystem apps, and reusable CTAs upon plugin activation.
- **REST API (`inc/rest-api.php`):** Exposes `/wp-json/human/v1/apps`, `/wp-json/human/v1/journal`, `/wp-json/human/v1/ontology/summary`, and `/wp-json/human/v1/seo`.

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

## 5. Implementation Roadmap Status

1. [x] Architectural definition and `PROJECT-STATUS.md` updated.
2. [x] Built complete `human-platform` WordPress plugin with CPTs, SEO Engine, Meta Boxes, Admin UI, and Seed Data (`wp-content/plugins/human-platform/`).
3. [x] Built complete `human-v1-theme` WordPress theme (`wp-content/themes/human-v1-theme/`).
4. [x] Built Node/Express dev preview bridge (`server.ts`) with full SEO tags, Open Graph, 10 cornerstone articles, dynamic `/sitemap.xml`, `/robots.txt`, and REST API endpoints.
5. [x] Provided complete `README.md` with deployment, database structure, and WordPress administration guide.
6. [x] **Sprint 20: Marketing Data Foundation (Backend)**
   - Configured `human_app` to use the database as the authoritative catalogue (with code fallback).
   - Created `human_cta` and `human_campaign` CPTs.
   - Added `Marketing Metadata` panel to Journal Posts (Products, CTAs, Campaigns, Content Lifecycle, Search Intent).
   - Established hierarchical Editorial Taxonomy (Strength Training, Training Knowledge, Human).
   - Built reusable structured breadcrumb architecture.
   - Designed a coherent Admin Experience grouping Marketing configurations under the "Human Ecosystem" menu.
7. [x] **Sprint 20.1: Marketing Foundation Hardening**
   - Restored `index.php` theme fallback template.
   - Decoupled seed data from assumed active Google Play status.
   - Introduced deterministic `human_marketing_schema_version` schema versioning for migrations.
   - Hardened `human_get_canonical_apps()` to only use DB if schema version matches, preserving fallback safety during partial migrations.
   - Hardened all marketing meta save handlers with `current_user_can('edit_post')`, capability checks, and robust relation intval validation.
   - Replaced hardcoded frontend breadcrumbs with dynamic `human_render_breadcrumbs()` and added them to templates lacking them.
   - Realigned breadcrumb structured data by removing Microdata and outputting valid JSON-LD `BreadcrumbList` via SEO engine.
8. [x] **Sprint 20.2: Marketing Truth & Migration Finalisation**
   - Refactored `SoftwareApplication` JSON-LD schema to dynamically consume the release state, URL, and pricing of authoritative Human App records.
   - Expanded data seeding to a proper idempotent, non-destructive, version-based migration pipeline (`human_run_migrations`).
   - Fixed `Strength V1 Launch` campaign default seed state to "planned" and its core download CTA to "inactive" to align with a pre-release truth.
9. [x] **Sprint 21: Human Post Marketing Studio**
   - Refactored `marketing-meta.php` to provide a comprehensive Marketing Studio interface.
   - Implemented `marketing-readiness.php` for deterministic percentage score, state, and warnings based on Content, SEO, Social, Conversion, Campaign, and Lifecycle sections.
   - Integrated SEO, Search, and Social workspaces with lightweight preview components.
   - Integrated Product and Conversion workspaces using existing app and CTA architecture, showing status and warnings.
   - Established an internal link foundation suggesting related content from tags/categories.
   - Upgraded `SoftwareApplication` JSON-LD to rely on structured pricing fields (`price_amount`, `price_currency`, etc.).
   - Upgraded `cpt-apps.php` and `meta-boxes.php` to define, capture, and expose structured pricing fields for apps.
   - Upgraded `building-the-human-ontology...` article with a complete suite of marketing metadata via migration `1.1.0`.
10. [x] **Sprint 21.2: Production Data & Navigation Reconciliation**
    - Addressed migration-state drift on production where the legacy flag was set but the marketing dataset was empty.
    - Added `human_migration_1_2_0` to run idempotently on production to reconcile missing App, CTA, Campaign, and Taxonomy Canonical Data safely without overwriting marketer edits.
    - Refactored `header.php` and `footer.php` to use managed WordPress menus (`primary-menu`, `footer-menu`, `apps-menu`) to avoid hardcoded application truth or release states.
    - Updated Header promotional CTA logic to prioritize resolving active CTAs from the Marketing Foundation if possible.
    - Introduced a Foundation Health Check function (`human_get_marketing_foundation_health`) and surfaced diagnostics in the Platform Settings dashboard.
11. [x] **Sprint 21.3: Canonical Site Content Reconciliation**
    - Created schema reconciliation 1.3.0 to bootstrap canonical Pages (Home, Apps, Human Strength, Human Ontology, Journal, About, Support, Privacy Policy, Terms, Data Deletion, Contact).
    - Preserved existing /privacy-policy/ as canonical privacy location.
    - Set Home and Journal as `page_on_front` and `page_for_posts` dynamically.
    - Assigned appropriate existing theme templates (e.g. `page-apps.php`, `page-strength.php`, etc) to respective canonical pages.
    - Repaired `wp_nav_menu` structures to convert custom URLs into page objects, explicitly linking to the correct privacy page, preserving safe navigation.
    - Extended `human_get_marketing_foundation_health` diagnostics to report canonical page states and WordPress configuration values.
