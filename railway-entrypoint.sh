#!/bin/sh
set -e

# Railway sets PORT dynamically; the WordPress Apache image listens on 80 by default.
if [ -n "${PORT}" ]; then
	sed -i "s/^Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
	for vhost in /etc/apache2/sites-enabled/000-default.conf /etc/apache2/sites-available/000-default.conf; do
		if [ -f "${vhost}" ]; then
			sed -i "s/<VirtualHost \\*:80>/<VirtualHost *:${PORT}>/" "${vhost}"
		fi
	done
fi

# Avoid "More than one MPM loaded" on some PHP 8.4 + Apache setups (common on Railway).
if command -v a2dismod >/dev/null 2>&1; then
	a2dismod mpm_event 2>/dev/null || true
	a2dismod mpm_worker 2>/dev/null || true
	a2enmod mpm_prefork 2>/dev/null || true
fi

exec docker-entrypoint.sh "$@"
