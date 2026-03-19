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

## Next Steps (Phase 3) ✅
Phase 3 Complete! See `docs/PHASE-3-GUIDE.md` for complete setup instructions.

**Telegram Integration:**
- WP Telegram plugin for automatic posting
- WordPress posts → Telegram channel automation
- Featured image support
- News category integration

**Setup required:**
1. Run: `docker exec -it mmi_app install-wptelegram.sh`
2. Create Telegram bot via @BotFather
3. Configure plugin with bot token and channel
4. See `docs/PHASE-3-GUIDE.md` for step-by-step guide

## Next Steps (Phase 4)
- Frontend Development
- Create Child Theme (Astra or GeneratePress)
- Build archive and single templates
- Setup Main Menu & Footer with KPI branding
