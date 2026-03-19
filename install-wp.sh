#!/bin/bash
# WordPress Installation Script for MMI Portal
# Installs WordPress with Ukrainian locale using WP-CLI

set -e

WP_URL="${WORDPRESS_URL:-http://localhost:8080}"
WP_ADMIN_USER="${WORDPRESS_ADMIN_USER:-admin}"
WP_ADMIN_PASS="${WORDPRESS_ADMIN_PASSWORD:-admin_password}"
WP_ADMIN_EMAIL="${WORDPRESS_ADMIN_EMAIL:-admin@mmi.kpi.ua}"

echo "Waiting for WordPress container to be ready..."
sleep 10

echo "Installing WordPress with Ukrainian locale..."
wp core install \
  --url="$WP_URL" \
  --title="MMI University Portal" \
  --admin_user="$WP_ADMIN_USER" \
  --admin_password="$WP_ADMIN_PASS" \
  --admin_email="$WP_ADMIN_EMAIL" \
  --locale="uk" \
  --allow-root

echo "Setting Ukrainian as default language..."
wp language core install uk --activate --allow-root

echo "WordPress installation complete!"
echo "Access your site at: $WP_URL"
echo "Admin panel: $WP_URL/wp-admin"
echo "Username: $WP_ADMIN_USER"
echo "Password: $WP_ADMIN_PASS"
