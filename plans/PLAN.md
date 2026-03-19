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

## Phase 5: Polylang & Final Polish
- [ ] Enable UA (Primary) and EN (Secondary) languages.
- [ ] Translate all CPT labels and ACF fields.
- [ ] Hardening: Wordfence, backups (UpdraftPlus), SSL config.