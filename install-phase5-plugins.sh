#!/bin/bash
# Install and configure plugins for Phase 5
# Polylang, Wordfence, UpdraftPlus

set -e

echo "==================================="
echo "Phase 5: Final Polish & Security"
echo "==================================="
echo ""

# Install Polylang
echo "📦 Installing Polylang..."
wp plugin install polylang --activate --allow-root
echo "✅ Polylang installed"
echo ""

# Install Wordfence Security
echo "🔒 Installing Wordfence Security..."
wp plugin install wordfence --activate --allow-root
echo "✅ Wordfence installed"
echo ""

# Install UpdraftPlus Backup
echo "💾 Installing UpdraftPlus Backup..."
wp plugin install updraftplus --activate --allow-root
echo "✅ UpdraftPlus installed"
echo ""

echo "==================================="
echo "✅ All Phase 5 plugins installed!"
echo "==================================="
echo ""
echo "Next steps:"
echo "1. Configure Polylang: WP Admin → Languages"
echo "   - Add Ukrainian (uk) as primary"
echo "   - Add English (en) as secondary"
echo ""
echo "2. Configure Wordfence: WP Admin → Wordfence"
echo "   - Run initial scan"
echo "   - Configure firewall rules"
echo ""
echo "3. Configure UpdraftPlus: WP Admin → Settings → UpdraftPlus Backups"
echo "   - Set backup schedule"
echo "   - Configure remote storage (optional)"
echo ""
echo "See docs/PHASE-5-GUIDE.md for detailed instructions."
