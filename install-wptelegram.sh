#!/bin/bash
# Install and activate WP Telegram plugin using WP-CLI

set -e

echo "Installing WP Telegram plugin..."

# Install the plugin
wp plugin install wptelegram --activate --allow-root

echo "✅ WP Telegram plugin installed and activated!"
echo ""
echo "Next steps:"
echo "1. Create a Telegram Bot via @BotFather"
echo "2. Get the Bot Token"
echo "3. Create/use your Telegram channel"
echo "4. Add the bot as administrator to the channel"
echo "5. Configure the plugin in WP Admin → WP Telegram"
echo ""
echo "See docs/PHASE-3-GUIDE.md for detailed setup instructions."
