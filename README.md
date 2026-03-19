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

## Next Steps (Phase 2) ✅
Phase 2 Complete! See `docs/PHASE-2-SUMMARY.md` for details.

**Custom Post Types Registered:**
- Lecturers (`lecturers`) - Викладачі з повною біографією
- Courses (`courses`) - Навчальні курси з силабусами  
- Publications (`publications`) - Наукові публікації

**Plugin Created:** `wp-content/plugins/mmi-data/`

**To activate:**
1. Install ACF Pro plugin
2. Activate "MMI Data Architecture" plugin in WP Admin
3. Go to Settings → Permalinks → Save

## Next Steps (Phase 3)
- Telegram-to-News Integration
- Configure WP Telegram plugin
- Setup bot connection to MMI channel
