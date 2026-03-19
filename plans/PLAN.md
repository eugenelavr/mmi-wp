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

## Phase 6: UPenn-Inspired Redesign
**Reference:** https://www.upenn.edu/ design language, scaled for a department-level academic portal.

### 6.1 — Custom Header (override GeneratePress)
- [ ] Create `header.php` in child theme.
- [ ] **Top bar**: KPI logo + "КПІ ім. Ігоря Сікорського" link, language switcher (Polylang).
- [ ] **Main bar**: Department name "Кафедра ММІ", primary nav with dropdown sub-menus, search toggle.
- [ ] **Sticky behavior**: shrinks on scroll (vanilla JS).
- [ ] **Mobile**: hamburger menu with slide-out panel.
- [ ] Register `header-resources` nav menu location in `functions.php`.

### 6.2 — Front Page Template
- [ ] Create `front-page.php` with the following sections:
  1. **Hero** (`.hero`) — full-width background image, category label, headline, description, CTA button, overlay gradient.
  2. **News Grid** (`.news-section`) — tab bar filtering by category (Всі / Новини / Оголошення / Події), 1 featured large card + 4–5 smaller cards, "Всі новини" link.
  3. **Quick Access** (`.priorities`) — 4 image overlay cards: Викладачі, Курси, Публікації, Вступникам.
  4. **Feature Story** (`.feature`) — full-width image with overlay text, highlights a sticky/featured post.
  5. **About Department** (`.about-section`) — intro text, key stats (lecturers, courses, years), "Про кафедру" link.
  6. **Contact CTA** (`.cta-section`) — address, email, phone, map link, "Зв'язатись" button.

### 6.3 — Custom Footer
- [ ] Create `footer.php` in child theme.
- [ ] **4-column layout**: (1) KPI logo + dept name, (2) Nav links, (3) Contact info, (4) Social links + lang switcher.
- [ ] **Bottom bar**: copyright + KPI affiliation + legal links.

### 6.4 — CSS Overhaul (`assets/css/main.css`)
- [ ] **Color palette**: keep `#0066CC` primary, add navy `#002855` for header/footer, warm accent for CTAs, subtle grays.
- [ ] **Typography**: Google Fonts — `Source Serif Pro` (headings) + `Inter` (body).
- [ ] **New components**: `.hero`, `.news-section`, `.news-card`, `.news-card--featured`, `.priorities`, `.priority-card`, `.feature`, `.about-section`, `.cta-section`, `.site-header`, `.site-footer`.
- [ ] **Refine existing**: `.lecturer-card`, `.course-card`, `.publication-card` — subtler shadows, refined spacing.
- [ ] **Container**: increase max-width to 1400px.
- [ ] **Responsive**: mobile-first breakpoints at 480px, 768px, 1024px, 1400px.

### 6.5 — JavaScript Enhancements (`assets/js/main.js`)
- [ ] Sticky header with shrink-on-scroll.
- [ ] Mobile hamburger toggle with animated slide-out.
- [ ] Search toggle (expand/collapse in header).
- [ ] News tab filtering (show/hide cards by category).
- [ ] Accessible keyboard-navigable dropdown menus.
- [ ] All vanilla JS, no jQuery.

### 6.6 — Events Support (Optional)
- [ ] Register `events` CPT with date, time, location, type fields in `mmi-data` plugin.
- [ ] Or: use "Події" category on WP Posts (simpler alternative).
- [ ] Display upcoming events on front page in UPenn date-badge style.

### 6.7 — Template Parts
- [ ] Create `template-parts/` directory with reusable components:
  - `news-card.php` (featured + compact variants)
  - `priority-card.php` (image overlay card)
  - `event-item.php` (event with date badge)
  - `hero.php` (hero section)

### 6.8 — ACF Options Page for Homepage
- [ ] Add ACF options page in `functions.php` for admin-configurable homepage:
  - Hero image, title, subtitle, CTA link
  - Featured content post selection
  - Priority card images
  - Department stats (lecturers count, years, etc.)

### File Change Summary
- **Create**: `header.php`, `footer.php`, `front-page.php`
- **Create**: `template-parts/news-card.php`, `priority-card.php`, `event-item.php`, `hero.php`
- **Rewrite**: `assets/css/main.css` (~1500+ lines), `assets/js/main.js`
- **Update**: `functions.php`, archive templates, single templates
- **Optional**: `mmi-data.php` (events CPT)