# Implementation Plan: MMI University Portal
**Target Domain:** mmi.kpi.ua
**Stack:** WordPress, Docker, PHP 8.3, MariaDB, WP-CLI.

## Phase 1: Local Docker Setup ✅
- [x] Create `docker-compose.yml` with services: `db`, `wordpress`, `webserver`.
- [x] Setup `Dockerfile` with PHP 8.3, WP-CLI, and necessary PHP extensions (gd, mysqli, zip).
- [x] Configure volume mapping for `./wp-content` and local theme folder.
- [x] Install WordPress via WP-CLI with Ukrainian as default locale.

## Phase 2: Data Architecture (CPT & ACF) ✅
- [x] Register **Lecturers (`lecturers`)**: Fields for position, degree, contacts, scholar links.
- [x] Register **Courses (`courses`)**: Fields for edu level, credits, syllabus PDF.
- [x] Register **Publications (`publications`)**: Fields for year, type, DOI.
- [x] Setup Relationship fields: Connect Lecturers to their Courses and Publications.

## Phase 3: Telegram-to-News Integration ✅
- [x] Install & Configure `WP Telegram` plugin.
- [x] Setup Bot connection to the MMI Telegram channel.
- [x] Map incoming posts to the "News" category.
- [x] Test automatic Featured Image extraction.

## Phase 4: Frontend Development ✅
- [x] Create a Child Theme (based on Astra or GeneratePress).
- [x] Build Archive templates for Lecturers and Courses.
- [x] Build Single templates:
   - `single-lecturers`: Bio + Auto-list of Courses/Publications.
   - `single-courses`: Details + Link to Lecturer.
- [x] Setup Main Menu & Footer (KPI Branding).

## Phase 5: Polylang & Final Polish ✅
- [x] Enable UA (Primary) and EN (Secondary) languages.
- [x] Translate all CPT labels and ACF fields.
- [x] Hardening: Wordfence, backups (UpdraftPlus), SSL config.

## Phase 6: UPenn-Inspired Redesign ✅
**Reference:** https://www.upenn.edu/ design language, scaled for a department-level academic portal.

### 6.1 — Custom Header (override GeneratePress) ✅
- [x] Create `header.php` in child theme.
- [x] **Top bar**: KPI logo + "КПІ ім. Ігоря Сікорського" link, language switcher (Polylang).
- [x] **Main bar**: Department name "Кафедра ММІ", primary nav with dropdown sub-menus, search toggle.
- [x] **Sticky behavior**: shrinks on scroll (vanilla JS).
- [x] **Mobile**: hamburger menu with slide-out panel.
- [x] Register `header-resources` nav menu location in `functions.php`.

### 6.2 — Front Page Template ✅
- [x] Create `front-page.php` with the following sections:
  1. **Hero** (`.hero`) — full-width background image, category label, headline, description, CTA button, overlay gradient.
  2. **News Grid** (`.news-section`) — tab bar filtering by category (Всі / Новини / Оголошення / події), 1 featured large card + 4–5 smaller cards, "Всі новини" link.
  3. **Quick Access** (`.priorities`) — 4 image overlay cards: Викладачі, Курси, Публікації, Вступникам.
  4. **Feature Story** (`.feature`) — full-width image with overlay text, highlights a sticky/featured post.
  5. **About Department** (`.about-section`) — intro text, key stats (lecturers, courses, years), "Про кафедру" link.
  6. **Contact CTA** (`.cta-section`) — address, email, phone, map link, "Зв'язатись" button.

### 6.3 — Custom Footer ✅
- [x] Create `footer.php` in child theme.
- [x] **4-column layout**: (1) KPI logo + dept name, (2) Nav links, (3) Contact info, (4) Social links + lang switcher.
- [x] **Bottom bar**: copyright + KPI affiliation + legal links.

### 6.4 — CSS Overhaul (`assets/css/main.css`) ✅
- [x] **Color palette**: keep `#0066CC` primary, add navy `#002855` for header/footer, gold accent `#D4A017` for CTAs.
- [x] **Typography**: Google Fonts — `Source Serif 4` (headings) + `Inter` (body).
- [x] **New components**: `.hero`, `.news-section`, `.news-card`, `.news-card--featured`, `.priorities`, `.priority-card`, `.feature-story`, `.about-section`, `.cta-section`, `.events-section`, `.site-header`, `.site-footer`.
- [x] **Refine existing**: `.lecturer-card`, `.course-card`, `.publication-card` — subtler shadows, refined spacing.
- [x] **Container**: increased max-width to 1400px.
- [x] **Responsive**: breakpoints at 480px, 768px, 1024px.

### 6.5 — JavaScript Enhancements (`assets/js/main.js`) ✅
- [x] Sticky header with shrink-on-scroll.
- [x] Mobile hamburger toggle with animated slide-out overlay.
- [x] Search toggle (expand/collapse in header).
- [x] News tab filtering (show/hide cards by category, keyboard-navigable).
- [x] Accessible keyboard-navigable dropdown menus (arrow keys, Escape).
- [x] Smooth scroll for anchor links with header offset.

### 6.6 — Events CPT ✅
- [x] Register `events` CPT with date, time, location, type fields in `mmi-data` plugin.
- [x] Display upcoming events on front page in UPenn date-badge style.

### 6.7 — Template Parts ✅
- [x] `template-parts/hero.php` — hero section, reads from ACF options.
- [x] `template-parts/news-card.php` — featured + compact variants, data-categories for JS tabs.
- [x] `template-parts/priority-card.php` — image overlay card with hover effects.
- [x] `template-parts/event-item.php` — event with date badge.

### 6.8 — ACF Options Page for Homepage ✅
- [x] ACF options page "Портал ММІ" registered in `functions.php`.
- [x] Fields: Hero (image, label, title, subtitle, CTA), Feature story (post relationship), Priority cards (repeater), About stats, Contacts.

### Files Created/Updated
- **Created**: `header.php`, `footer.php`, `front-page.php`
- **Created**: `template-parts/hero.php`, `news-card.php`, `priority-card.php`, `event-item.php`
- **Created**: `plugins/mmi-data/includes/post-types/events.php`
- **Created**: `plugins/mmi-data/includes/acf/events-fields.php`
- **Rewritten**: `assets/css/main.css` (~900 lines), `assets/js/main.js`
- **Updated**: `functions.php`, `mmi-data.php`