# Phase 3: Telegram-to-News Integration - Complete Guide

## Overview

This guide walks you through setting up automatic news posting from your MMI Telegram channel to the WordPress portal using the WP Telegram plugin.

---

## Prerequisites

- WordPress installation running (Phase 1 ✅)
- Docker container `mmi_app` running
- Access to WordPress Admin panel
- Telegram account

---

## Part 1: Install WP Telegram Plugin

### Option A: Using WP-CLI (Recommended)

```bash
docker exec -it mmi_app bash /usr/local/bin/install-wptelegram.sh
```

### Option B: Manual Installation via WP Admin

1. Go to **Plugins → Add New**
2. Search for "WP Telegram"
3. Install **WP Telegram (Auto Post and Notifications)** by WP Socio
4. Click **Activate**

---

## Part 2: Create Telegram Bot

### Step 1: Start Conversation with BotFather

1. Open Telegram
2. Search for `@BotFather`
3. Start a conversation

### Step 2: Create New Bot

Send this command:
```
/newbot
```

### Step 3: Follow BotFather's Instructions

1. **Bot name**: Choose a display name
   ```
   MMI News Bot
   ```

2. **Bot username**: Must end with `bot`
   ```
   mmi_kpi_news_bot
   ```

### Step 4: Save Your Bot Token

BotFather will provide a token like:
```
123456789:ABCdefGHIjklMNOpqrsTUVwxyz
```

⚠️ **IMPORTANT**: Save this token securely. You'll need it for WordPress configuration.

---

## Part 3: Setup Telegram Channel

### Option A: Use Existing MMI Channel

If you already have an MMI Telegram channel, skip to **Part 4**.

### Option B: Create New Channel

1. Open Telegram
2. Click **New Channel**
3. Fill in details:
   - **Channel name**: `MMI КПІ - Новини`
   - **Description**: Official news channel for MMI department
4. Choose **Public Channel**
5. Set **channel link**: `@mmi_kpi_news` (or similar)
6. Click **Create**

---

## Part 4: Add Bot to Channel as Administrator

### Step 1: Open Your Channel

Navigate to your MMI Telegram channel.

### Step 2: Add Bot as Administrator

1. Click **Channel Settings** (⚙️)
2. Go to **Administrators**
3. Click **Add Administrator**
4. Search for your bot username (e.g., `@mmi_kpi_news_bot`)
5. Select the bot
6. Grant these permissions:
   - ✅ **Post messages**
   - ✅ **Edit messages of others**
   - ✅ **Delete messages of others**
7. Click **Save**

---

## Part 5: Get Channel Username/ID

### For Public Channels

Your channel username is the link after `t.me/`:
```
https://t.me/mmi_kpi_news
         ↓
Channel username: @mmi_kpi_news
```

### For Private Channels/Groups

1. Open Telegram and message `@MyChatInfoBot`
2. Forward any message from your channel to this bot
3. The bot will reply with the **Chat ID** (e.g., `-1001234567890`)
4. Save this Chat ID

---

## Part 6: Configure WP Telegram Plugin

### Step 1: Access Plugin Settings

1. Log in to WordPress Admin: `http://localhost:8080/wp-admin`
2. Go to **WP Telegram → Settings**

### Step 2: Basic Settings

1. **Bot Token**: Paste your bot token from BotFather
2. Click **Test Token** to verify
3. ✅ You should see "Success"

### Step 3: Configure "Post to Telegram" Module

#### A. Basic Settings

1. **Enable Module**: Toggle ON
2. **Chat ID/Username**: Enter your channel (e.g., `@mmi_kpi_news`)
3. **Send When**: Select **New posts**
4. **Post Types**: Check ☑️ **Posts** (for News category)

#### B. Message Settings

1. **Message Template**:
   ```
   🔔 <b>{post_title}</b>
   
   {post_excerpt}
   
   📖 Читати повністю: {post_url}
   ```

2. **Formatting**: Select **HTML**
3. **Featured Image**: Select **After Text**

#### C. Rules & Filters

1. **Categories**: Check ☑️ **News** (create this category if it doesn't exist)
2. **Send only when**: Category is **News**

#### D. Advanced Settings

1. **Post Edit**: Select **Send only new posts** (to avoid duplicates on updates)
2. **Delay in posting**: `0` minutes (instant posting)
3. **Enable Logs**: Toggle ON (for debugging)

### Step 4: Save Settings

Click **Save Changes** at the bottom.

---

## Part 7: Create "News" Category

### Step 1: Create Category

1. Go to **Posts → Categories**
2. Add new category:
   - **Name**: `Новини` (News in Ukrainian)
   - **Slug**: `news`
3. Click **Add New Category**

### Step 2: Configure Plugin to Use This Category

1. Return to **WP Telegram → Settings**
2. In **Post to Telegram** section
3. Under **Categories**, ensure **Новини** is selected
4. Save settings

---

## Part 8: Test Integration

### Test 1: Manual Post Test

1. Go to **Posts → Add New**
2. Create a test post:
   - **Title**: `Тестова новина з кафедри ММІ`
   - **Content**: Add some test content
   - **Category**: Select ☑️ **Новини**
   - **Featured Image**: Upload a test image
3. Click **Publish**
4. Check your Telegram channel
5. ✅ The post should appear within seconds!

### Test 2: Instant Send

1. Edit any existing post
2. In the sidebar, find **WP Telegram** metabox
3. Click **Send to Telegram** button
4. Check your channel

---

## Part 9: Featured Image Extraction

### Automatic Featured Image from Telegram

The WP Telegram plugin **automatically extracts** and sets the Featured Image when:

1. You create a post in WordPress with a featured image
2. The plugin sends it to Telegram
3. Settings have **Send Featured Image** enabled

### Reverse Direction (Telegram → WordPress)

⚠️ **Note**: The free version of WP Telegram sends posts **from WordPress to Telegram**, not the reverse.

For **Telegram → WordPress** automation (posts from Telegram channel automatically creating WP posts), you would need:

1. **WP Telegram Pro** (paid version), OR
2. Custom webhook integration using Telegram Bot API

#### Alternative: Manual Cross-posting

For the free version with your use case:
1. Create posts in **WordPress** with featured images
2. Add them to **News** category
3. They automatically post to **Telegram**

This is the standard news workflow:
```
WordPress Post (with image)
    ↓
News Category
    ↓
Auto-send to Telegram Channel
```

---

## Part 10: Troubleshooting

### Error: "Bad request: Chat ID not found"

**Solution:**
- Double-check your channel username/ID
- Ensure bot is added as administrator
- For public channels, use `@username` format
- For private channels, use numeric ID like `-1001234567890`

### Error: "Connection refused"

**Solution:**
- Enable **Proxy** module in plugin settings
- Your host might be blocking Telegram
- Use Google Script or Cloudflare Worker proxy

### Posts Not Sending

**Solution:**
1. Enable **Logs** in Advanced Settings
2. Try to publish a test post
3. Check logs at **WP Telegram → Bot API Log**
4. Look for error messages
5. Share logs in [@WPTelegramChat](https://t.me/WPTelegramChat) for support

### Featured Image Not Showing

**Solution:**
1. Verify featured image is set on the post
2. Check **Send Featured Image** is enabled
3. Try changing **Image Position** setting
4. Ensure image file is accessible (not blocked by firewall)

---

## Part 11: Advanced Configuration

### Custom Post Template

For academic-style announcements:

```html
🎓 <b>{post_title}</b>

📝 {post_excerpt}

👤 <i>Кафедра ММІ, КПІ ім. Ігоря Сікорського</i>

🔗 {post_url}

#MMI #КПІ #Новини
```

### Multiple Channels (Pro Feature)

To send different categories to different channels:
- **News** → Main channel
- **Events** → Events channel
- **Research** → Research channel

This requires [WP Telegram Pro](https://wptelegram.pro/).

### Notification for Admins

Enable **Private Notifications** module to receive email notifications on Telegram:
1. Enable module
2. Add your Chat ID
3. Enter your admin email

---

## Part 12: Maintenance

### Check Logs Regularly

- Go to **WP Telegram → Bot API Log**
- Look for errors or warnings
- Clear old logs periodically

### Update Plugin

- Plugin auto-updates to latest version
- Current stable: **v4.2.15** (Feb 2026)
- Check for updates: **Dashboard → Updates**

---

## Security Best Practices

1. ✅ **Never share your Bot Token** publicly
2. ✅ Keep the plugin **up to date**
3. ✅ Use **Private Channels** for sensitive content
4. ✅ Review **Bot API logs** for suspicious activity
5. ✅ Limit bot permissions to only what's needed

---

## Resources

- **Plugin Page**: https://wordpress.org/plugins/wptelegram/
- **Support Chat**: [@WPTelegramChat](https://t.me/WPTelegramChat)
- **BotFather**: [@BotFather](https://t.me/BotFather)
- **Official Docs**: https://wptelegram.pro/docs/
- **GitHub**: https://github.com/wpsocio/wp-projects

---

## Summary Checklist

- [ ] WP Telegram plugin installed and activated
- [ ] Telegram bot created via @BotFather
- [ ] Bot token saved securely
- [ ] MMI Telegram channel ready
- [ ] Bot added as channel administrator
- [ ] Channel username/ID obtained
- [ ] Plugin configured with bot token and channel
- [ ] "News" category created in WordPress
- [ ] Message template customized
- [ ] Featured image settings configured
- [ ] Test post published successfully
- [ ] Post appeared on Telegram channel
- [ ] Logs enabled for monitoring

---

**Phase 3 Complete!** Your WordPress site now automatically posts to Telegram! 🎉
