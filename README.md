# Human (humanv1.com) — Production WordPress Platform

**Umbrella Brand:** Human  
**Tagline:** Train. Track. Transform.  
**Primary Domain:** humanv1.com  
**Target Architecture:** WordPress 6.x / PHP 8.2+ / MySQL or MariaDB  

---

## 1. Overview
This repository contains the complete production WordPress marketing and publishing platform for **Human** (`humanv1.com`).

It is designed to:
1. Promote the **Human** umbrella brand and performance philosophy.
2. Promote and convert users to Human applications, beginning with **Human Strength** (`com.aistudio.humanstrength.kfqjza`).
3. Communicate the **Human Platform** ecosystem vision.
4. Establish the **Human Ontology** exercise knowledge system programme.
5. Publish editorial, science, and engineering updates in the **Human Journal**.
6. Provide Google Play compliant support, privacy policy, terms of service, and data deletion instructions.

---

## 2. Directory Structure

```text
/
├── wp-content/
│   ├── plugins/
│   │   └── human-platform/             # Core WordPress Plugin
│   │       ├── human-platform.php      # Main plugin bootstrap
│   │       └── inc/
│   │           ├── cpt-apps.php        # Custom Post Type 'human_app' & 'human_app_status'
│   │           ├── rest-api.php        # REST Endpoints (/wp-json/human/v1/...)
│   │           └── extension-hooks.php # Action/filter hooks for future human-marketing
│   │
│   └── themes/
│       └── human-v1-theme/             # Custom WordPress Theme
│           ├── style.css               # CSS custom properties & base styles
│           ├── functions.php           # Enqueuing, theme supports & status badge helpers
│           ├── header.php              # Header navigation bar
│           ├── footer.php              # Footer with legal links & branding
│           ├── front-page.php          # Homepage (/)
│           ├── page-apps.php           # Ecosystem Apps catalogue (/apps)
│           ├── page-strength.php       # Human Strength marketing (/strength)
│           ├── page-ontology.php       # Human Ontology programme (/ontology)
│           ├── page-about.php          # Brand vision & philosophy (/about)
│           ├── page-support.php        # Support & FAQ (/support)
│           ├── page-privacy.php        # Privacy Policy (/privacy)
│           ├── page-terms.php          # Terms of Service (/terms)
│           ├── page-data-deletion.php  # Data Deletion instructions (/data-deletion)
│           ├── page-contact.php        # Contact page (/contact)
│           ├── home.php                # Human Journal blog archive
│           ├── single.php              # Single Journal article template
│           └── page.php                # Fallback page template
│
├── PROJECT-STATUS.md                   # Canonical project decisions & roadmap status
├── README.md                           # Installation & architecture guide
└── server.ts                           # Node/Express AI Studio live preview bridge
```

---

## 3. Product Roadmap & Canonical Statuses

| Application | Status | Description |
| :--- | :--- | :--- |
| **Human Strength** | **AVAILABLE** | Android application (`com.aistudio.humanstrength.kfqjza`). Offline-first Room DB, ~30-day introductory trial, then £24/year. |
| **Human HIIT** | **IN DEVELOPMENT (NEXT)** | High-intensity interval training, telemetry tracking & interval programming. |
| **Human Running** | **PLANNED** | Endurance metrics, cadence analysis, and cardio progression tracking. |
| **Human Recovery** | **PLANNED** | HRV, sleep-to-load readiness scoring, and active recovery guidance. |
| **Human Mobility** | **PLANNED** | Joint health, movement prep, and range-of-motion routines. |
| **Human Nutrition** | **PLANNED** | Fueling protocols, macronutrient tracking, and metabolic output alignment. |
| **Human Coach** | **COMING SOON** | AI-assisted periodization engine utilizing the Human Ontology knowledge graph. |
| **Human Community** | **PLANNED** | Peer benchmarks, verified movement sharing, and challenge leaderboards. |

---

## 4. Production WordPress Installation Guide

### Step 1: Copy Theme and Plugin Folders
1. Copy `wp-content/themes/human-v1-theme` into your production WordPress `wp-content/themes/` directory.
2. Copy `wp-content/plugins/human-platform` into your production WordPress `wp-content/plugins/` directory.

### Step 2: Activate in WordPress Admin
1. Go to **Plugins** in WordPress Admin and activate **Human Platform Core**.
2. Go to **Appearance > Themes** and activate **Human V1 Theme**.

### Step 3: Permalinks Setup
1. Go to **Settings > Permalinks** in WordPress Admin.
2. Select **Post name** (`/sample-post/`) and click **Save Changes**.

---

## 5. REST API Endpoints

- `GET /wp-json/human/v1/apps` — Returns JSON list of canonical Human platform apps and status metadata.
- `GET /wp-json/human/v1/ontology/summary` — Returns JSON summary of the Human Ontology exercise knowledge system dimensions.

---

## 6. Future `human-marketing` Extension Points

The `human-platform` plugin includes pre-configured action and filter hooks for a future Buffer-style social publishing queue, CTA library, and campaign tracking plugin:

```php
// Enqueued automatically when a Journal article is published
do_action('human_marketing_enqueue_journal_post', $post_id, $post);

// Filter applied to promotional CTAs to attach campaign UTM parameters
apply_filters('human_marketing_format_utm_url', $url, $campaign_id, $medium);
```

Reserved database tables for future extension:
- `wp_human_campaigns`
- `wp_human_social_queue`
- `wp_human_social_publications`
- `wp_human_cta_library`

---

## 7. AI Studio Preview Environment

To run the live interactive development preview bridge locally or in AI Studio:

```bash
npm run dev
```

This launches Express on port `3000` at `0.0.0.0`, serving rendered views matching the WordPress theme and plugin routes.
