# MMI University Portal - Phase 1 Setup Complete ✅

This document explains how to run your local Docker environment for the MMI Portal.

## Prerequisites
- Docker & Docker Compose installed
- Port 8080 available

## Quick Start

### 1. Build and Start Containers
```bash
docker-compose up -d
```

### 2. Install WordPress with Ukrainian Locale
```bash
docker exec -it mmi_app install-wp.sh
```

Alternatively, run the WP-CLI commands directly:
```bash
docker exec -it mmi_app wp core install \
  --url="http://localhost:8080" \
  --title="MMI University Portal" \
  --admin_user="admin" \
  --admin_password="admin_password" \
  --admin_email="admin@mmi.kpi.ua" \
  --locale="uk" \
  --allow-root
```

### 3. Access Your Site
- **Frontend:** http://localhost:8080
- **Admin Panel:** http://localhost:8080/wp-admin
  - Username: `admin`
  - Password: `admin_password`

## Project Structure
```
.
├── docker-compose.yml     # Docker services configuration
├── Dockerfile             # Custom PHP 8.3 image with WP-CLI
├── install-wp.sh          # WordPress installation script
└── wp-content/            # Mapped WordPress content
    ├── themes/
    ├── plugins/
    └── uploads/
```

## Services
- **db**: MariaDB 10.11 (database)
- **wordpress**: WordPress with PHP 8.3, Apache, WP-CLI

## Installed PHP Extensions
- gd (image processing)
- mysqli (database connection)
- zip (file compression)

## Next Steps (Phase 4) ✅
Phase 4 Complete! See `docs/PHASE-4-SUMMARY.md` for complete details.

**Custom Theme Created: `mmi-portal`**
- Based on GeneratePress parent theme
- Archive templates for Lecturers, Courses, Publications
- Single templates with ACF relationship displays
- BEM CSS methodology with KPI branding
- Responsive design with Ukrainian UI
- Footer credits with KPI branding

**Templates:**
- `archive-lecturers.php` - Grid of lecturers
- `archive-courses.php` - List of courses
- `archive-publications.php` - List of publications
- `single-lecturers.php` - Profile + linked courses/publications
- `single-courses.php` - Details + linked lecturer
- `single-publications.php` - Full publication data

**To activate:**
1. Install GeneratePress: `wp theme install generatepress --activate --allow-root`
2. Activate child theme: `wp theme activate mmi-portal --allow-root`
3. Set up menus in WP Admin → Appearance → Menus

## Next Steps (Phase 5)
- Polylang multilingual (UA/EN)
- Security: Wordfence
- Backups: UpdraftPlus
- SSL configuration
- Final polish and optimization
