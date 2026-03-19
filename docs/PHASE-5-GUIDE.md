# Phase 5: Multilingual, Security & Final Polish - Complete Guide

## Overview

Phase 5 is the final implementation phase that adds multilingual support (Ukrainian/English), security hardening, automated backups, and production readiness.

---

## Part 1: Installation

### Quick Install (All Plugins at Once)

```bash
docker exec -it mmi_app install-phase5-plugins.sh
```

This installs:
- ✅ Polylang (multilingual)
- ✅ Wordfence Security
- ✅ UpdraftPlus Backups

### Manual Installation (Alternative)

```bash
# Install Polylang
docker exec -it mmi_app wp plugin install polylang --activate --allow-root

# Install Wordfence
docker exec -it mmi_app wp plugin install wordfence --activate --allow-root

# Install UpdraftPlus
docker exec -it mmi_app wp plugin install updraftplus --activate --allow-root
```

---

## Part 2: Polylang Multilingual Setup

### Step 1: Configure Languages

1. Go to **Settings → Languages**
2. Click **Add new language**

**Add Ukrainian (Primary):**
- Language: `Українська`
- Language code: `uk`
- ✅ Check **Choose a language**
- Click **Add new language**

**Add English (Secondary):**
- Language: `English`
- Language code: `en_US`
- Click **Add new language**

### Step 2: Set Default Language

1. In **Settings → Languages**
2. Under **Default language**, select **Українська**
3. Click **Save Changes**

### Step 3: Configure URL Modifications

**Recommended settings:**
- **URL modifications**: The language is set from the directory name in pretty permalinks
  - Ukrainian: `https://mmi.kpi.ua/uk/`
  - English: `https://mmi.kpi.ua/en/`
- **Hide URL for default language**: ✅ Checked (Ukrainian will be at root)
  - Ukrainian: `https://mmi.kpi.ua/`
  - English: `https://mmi.kpi.ua/en/`

### Step 4: Enable Translation for Post Types

1. Go to **Languages → Settings**
2. Scroll to **Custom post types and Taxonomies**
3. Enable translation for:
   - ✅ **Lecturers** (`lecturers`)
   - ✅ **Courses** (`courses`)
   - ✅ **Publications** (`publications`)
   - ✅ **Posts** (for News)
4. Click **Save Changes**

### Step 5: Translate Navigation Menus

1. Go to **Appearance → Menus**
2. You'll see language tabs at the top
3. Create menu for each language:

**Ukrainian Menu (Primary):**
- Menu name: `Головне меню`
- Add items:
  - Викладачі → `/lecturers/`
  - Курси → `/courses/`
  - Публікації → `/publications/`
  - Новини → `/news/`

**English Menu:**
- Menu name: `Main Menu`
- Add items:
  - Lecturers → `/en/lecturers/`
  - Courses → `/en/courses/`
  - Publications → `/en/publications/`
  - News → `/en/news/`

### Step 6: Translate Strings

1. Go to **Languages → String translations**
2. Search for `mmi-portal`
3. Translate theme strings:
   - "Викладачі кафедри" → "Department Lecturers"
   - "Навчальні курси" → "Courses"
   - "Наукові публікації" → "Scientific Publications"
   - And so on...

---

## Part 3: CPT & ACF Translation

### Translating Custom Post Types

#### Make CPTs Translatable

Add to `wp-content/plugins/mmi-data/mmi-data.php` after the class definition:

```php
/**
 * Register CPTs with Polylang
 */
function mmi_register_polylang_cpts(): void {
    if (function_exists('pll_register_post_type')) {
        pll_register_post_type('lecturers');
        pll_register_post_type('courses');
        pll_register_post_type('publications');
    }
}
add_action('init', 'mmi_register_polylang_cpts', 20);
```

#### Translate CPT Labels

The labels in your CPT files are already wrapped in `__()` functions with the `mmi-portal` text domain. Polylang will automatically detect and allow translation.

### Translating ACF Fields

ACF Pro has built-in Polylang integration:

1. Edit a **Lecturer**, **Course**, or **Publication**
2. You'll see **language selector** at the top
3. Switch to English, add English content
4. ACF fields are automatically duplicated per language

**Workflow:**
```
1. Create content in Ukrainian (primary)
2. Click "+" button next to language selector
3. Add English translation
4. Save
```

### Language Switcher Widget

1. Go to **Appearance → Widgets**
2. Add **Language Switcher** widget to sidebar or footer
3. Configure:
   - ✅ Show names
   - ✅ Show flags
   - Display: Dropdown or list

---

## Part 4: Wordfence Security

### Initial Setup

1. Go to **Wordfence → Dashboard**
2. Enter your email for security alerts
3. Click **Get Premium Key** or continue with free version

### Recommended Security Settings

#### Firewall Configuration

1. Go to **Wordfence → Firewall**
2. Click **Manage Firewall**
3. **Protection Level**: Extended Protection (recommended)
4. **Learning Mode**: Enable for 1 week, then switch to Protection
5. Click **Save Changes**

#### Scan Configuration

1. Go to **Wordfence → Scan**
2. Click **Manage Scan**
3. Enable:
   - ✅ Check core files against repository
   - ✅ Scan plugin and theme files
   - ✅ Check for malware URLs
   - ✅ Scan wp-content for backdoors
4. **Scan Schedule**: Daily at 3:00 AM (low traffic)
5. Click **Save Changes**

#### Login Security

1. Go to **Wordfence → Login Security**
2. Enable **Two-Factor Authentication** for admin users
3. **Login Attempt Limits**:
   - Lock out after: 5 failed attempts
   - Lock duration: 30 minutes
4. **reCAPTCHA**: Enable on login page (optional)

#### Blocking

1. Go to **Wordfence → Blocking**
2. **Block Countries** (if applicable):
   - Allow Ukraine, USA, EU
   - Block known bad actors
3. **Rate Limiting**:
   - Humans: 30 requests / minute
   - Bots: 10 requests / minute

### Run Initial Scan

1. Go to **Wordfence → Scan**
2. Click **Start New Scan**
3. Wait for completion (~5-10 minutes)
4. Review and fix any issues

---

## Part 5: UpdraftPlus Backups

### Configuration

1. Go to **Settings → UpdraftPlus Backups**
2. Click **Settings** tab

#### Backup Schedule

**Files Backup:**
- Schedule: Weekly
- Day: Sunday
- Time: 2:00 AM
- Retain: 4 backups

**Database Backup:**
- Schedule: Daily
- Time: 3:00 AM
- Retain: 7 backups

#### What to Backup

✅ Check all:
- Plugins
- Themes
- Uploads
- wp-content (other)
- Database

#### Remote Storage (Recommended)

**Option 1: Google Drive**
1. Select **Google Drive**
2. Click **Authenticate with Google**
3. Grant permissions
4. Select folder for backups

**Option 2: Dropbox**
1. Select **Dropbox**
2. Authenticate
3. Choose backup folder

**Option 3: Local** (Development only)
- Backups saved to `wp-content/updraft/`
- ⚠️ Not recommended for production!

### Manual Backup

1. Go to **Settings → UpdraftPlus Backups**
2. Click **Backup Now**
3. Select:
   - ✅ Include your database
   - ✅ Include all files
4. Click **Backup Now**
5. Wait for completion

### Test Restore

1. Click **Existing Backups** tab
2. Find a recent backup
3. Click **Restore**
4. Select components to restore
5. Click **Restore**
6. ⚠️ **TEST THIS IN DEVELOPMENT FIRST!**

---

## Part 6: SSL Configuration

### For Local Development (Docker)

SSL is optional for local development. If needed:

#### Option A: Self-Signed Certificate

```bash
# Generate self-signed certificate
openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
  -keyout ./ssl/mmi.key \
  -out ./ssl/mmi.crt \
  -subj "/CN=localhost"
```

Update `docker-compose.yml`:
```yaml
wordpress:
  ports:
    - "8080:80"
    - "8443:443"
  volumes:
    - ./ssl:/etc/ssl/private
```

#### Option B: Use HTTP (Recommended for Local)

WordPress works fine on HTTP for local development.

### For Production (mmi.kpi.ua)

#### Prerequisites
- Domain pointed to server
- Server with public IP
- Port 80 and 443 open

#### Install Let's Encrypt (Certbot)

```bash
# Install Certbot
apt-get update
apt-get install certbot python3-certbot-apache

# Get certificate
certbot --apache -d mmi.kpi.ua -d www.mmi.kpi.ua

# Auto-renewal (runs twice daily)
systemctl enable certbot.timer
systemctl start certbot.timer
```

#### Force HTTPS in WordPress

Add to `wp-config.php`:
```php
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) 
    && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

define('FORCE_SSL_ADMIN', true);
```

#### Update URLs

```bash
# Update site URLs to HTTPS
wp option update home 'https://mmi.kpi.ua' --allow-root
wp option update siteurl 'https://mmi.kpi.ua' --allow-root
```

---

## Part 7: Performance Optimization

### Caching Plugin (Recommended)

```bash
# Install W3 Total Cache or WP Super Cache
docker exec -it mmi_app wp plugin install w3-total-cache --activate --allow-root
```

**Configure:**
1. Enable **Page Cache**
2. Enable **Object Cache** (if Redis available)
3. Enable **Browser Cache**
4. Minify CSS/JS (test first!)

### Image Optimization

```bash
# Install Smush or Imagify
docker exec -it mmi_app wp plugin install wp-smushit --activate --allow-root
```

**Configure:**
1. Enable **Automatic compression**
2. Set quality: 80-85%
3. **Bulk optimize** existing images

### Database Optimization

```bash
# Install WP-Optimize
docker exec -it mmi_app wp plugin install wp-optimize --activate --allow-root
```

**Weekly tasks:**
1. Clean post revisions
2. Remove spam comments
3. Optimize database tables

### PHP Configuration

Update `php.ini` (in Dockerfile or container):
```ini
memory_limit = 256M
upload_max_filesize = 64M
post_max_size = 64M
max_execution_time = 300
```

---

## Part 8: Final Security Checklist

### WordPress Core

- [ ] Update WordPress to latest version
- [ ] Remove unused themes
- [ ] Remove unused plugins
- [ ] Disable file editing: `define('DISALLOW_FILE_EDIT', true);`

### User Security

- [ ] Strong admin password
- [ ] Two-factor authentication enabled
- [ ] Remove default `admin` username
- [ ] Limit login attempts (Wordfence)

### File Permissions

```bash
# Set correct permissions
find wp-content -type d -exec chmod 755 {} \;
find wp-content -type f -exec chmod 644 {} \;
```

### wp-config.php Security

Add security keys (unique):
```php
define('AUTH_KEY',         'unique-key-here');
define('SECURE_AUTH_KEY',  'unique-key-here');
define('LOGGED_IN_KEY',    'unique-key-here');
define('NONCE_KEY',        'unique-key-here');
// ... more keys
```

Generate at: https://api.wordpress.org/secret-key/1.1/salt/

### Database Security

```sql
-- Change database prefix from wp_ to something unique
-- In wp-config.php:
$table_prefix = 'mmi_2024_';
```

### Hide WordPress Version

Add to `functions.php`:
```php
remove_action('wp_head', 'wp_generator');
```

---

## Part 9: Production Deployment Checklist

### Pre-Launch

- [ ] All content translated (UA/EN)
- [ ] Menus configured for both languages
- [ ] SSL certificate installed and working
- [ ] All plugins updated
- [ ] Wordfence scan passed (0 threats)
- [ ] Backup configured and tested
- [ ] Contact forms tested
- [ ] All links working (check with Broken Link Checker plugin)
- [ ] Mobile responsive tested
- [ ] Page load speed tested (GTmetrix, PageSpeed Insights)

### Post-Launch

- [ ] Submit sitemap to Google Search Console
- [ ] Configure Google Analytics
- [ ] Monitor error logs
- [ ] Review security alerts (Wordfence)
- [ ] Weekly backup verification
- [ ] Monthly security scan

---

## Part 10: Maintenance Schedule

### Daily
- Check for critical plugin updates
- Monitor uptime
- Review error logs

### Weekly
- Security scan (Wordfence)
- Update plugins/themes
- Check backup status
- Review analytics

### Monthly
- Full database optimization
- Review user accounts
- Update documentation
- Test disaster recovery

---

## Troubleshooting

### Polylang Issues

**Problem**: Content not showing in second language

**Solution:**
1. Check language is enabled
2. Verify CPT is registered with Polylang
3. Clear permalinks (Settings → Permalinks → Save)

### Wordfence Issues

**Problem**: Locked out of admin

**Solution:**
```bash
# Disable Wordfence temporarily
docker exec -it mmi_app wp plugin deactivate wordfence --allow-root
```

### Backup Issues

**Problem**: Backup fails / times out

**Solution:**
1. Increase PHP `max_execution_time`
2. Split backup (files separate from database)
3. Check disk space

---

## Resources

- **Polylang Docs**: https://polylang.pro/doc/
- **Wordfence Docs**: https://www.wordfence.com/help/
- **UpdraftPlus Docs**: https://updraftplus.com/support/
- **WordPress Security**: https://wordpress.org/support/article/hardening-wordpress/
- **Let's Encrypt**: https://letsencrypt.org/getting-started/

---

**Phase 5 Complete!** Your MMI Portal is now multilingual, secure, backed up, and production-ready! 🎉🔒🌍
