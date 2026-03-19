#!/bin/bash
# WordPress Installation Script for MMI Portal
# Installs WordPress with Ukrainian locale using WP-CLI

set -e

echo "Waiting for WordPress container to be ready..."
sleep 10

echo "Installing WordPress with Ukrainian locale..."
wp core install \
  --url="http://localhost:8080" \
  --title="MMI University Portal" \
  --admin_user="admin" \
  --admin_password="admin_password" \
  --admin_email="admin@mmi.kpi.ua" \
  --locale="uk" \
  --allow-root

echo "Setting Ukrainian as default language..."
wp language core install uk --activate --allow-root

echo "WordPress installation complete!"
echo "Access your site at: http://localhost:8080"
echo "Admin panel: http://localhost:8080/wp-admin"
echo "Username: admin"
echo "Password: admin_password"
