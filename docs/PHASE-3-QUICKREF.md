# Phase 3 Quick Reference

## Installation Command

```bash
docker exec -it mmi_app install-wptelegram.sh
```

## Bot Setup (5 min)

1. Open `@BotFather` in Telegram
2. Send: `/newbot`
3. Name: `MMI News Bot`
4. Username: `mmi_kpi_news_bot`
5. **Save the token!**

## Channel Setup (3 min)

1. Open your MMI channel
2. Settings → Administrators
3. Add your bot as admin
4. Give permissions: Post, Edit, Delete messages

## WordPress Config (5 min)

1. Go to: `WP Admin → WP Telegram → Settings`
2. Enter **Bot Token**
3. Click **Test Token**
4. Enter **Channel**: `@mmi_kpi_news`
5. Enable **Post to Telegram**
6. Select **Posts** type
7. Choose **News** category
8. Set template:
   ```
   🔔 <b>{post_title}</b>
   
   {post_excerpt}
   
   📖 {post_url}
   ```
9. Enable **Featured Image**
10. **Save Changes**

## Test (2 min)

1. Create new post
2. Add featured image
3. Select **News** category
4. Click **Publish**
5. Check Telegram channel ✅

## Troubleshooting

| Error | Fix |
|-------|-----|
| Chat ID not found | Check bot is admin, use `@username` format |
| Connection refused | Enable Proxy module in settings |
| Not sending | Enable logs, check Bot API Log |

## Resources

- Full guide: `docs/PHASE-3-GUIDE.md`
- Support: [@WPTelegramChat](https://t.me/WPTelegramChat)
- Plugin: https://wordpress.org/plugins/wptelegram/
