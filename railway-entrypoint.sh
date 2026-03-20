#!/bin/sh
set -e

# Railway sets PORT and may use a read-only root; never patch /etc/apache2 in-place (sed -i can fail and exit before Apache starts).

APACHE_EXTRA=""

if [ -n "${PORT}" ]; then
	RAILWAY_APACHE_CONF="/tmp/railway-apache-extra.conf"
	{
		echo "Listen ${PORT}"
		echo "<VirtualHost *:${PORT}>"
		echo "	ServerAdmin webmaster@localhost"
		echo "	DocumentRoot /var/www/html"
		echo "	<Directory /var/www/html>"
		echo "		Options FollowSymLinks"
		echo "		AllowOverride All"
		echo "		Require all granted"
		echo "	</Directory>"
		# Literal ${APACHE_LOG_DIR} for Apache (not shell-expanded here).
		echo '	ErrorLog ${APACHE_LOG_DIR}/error.log'
		echo '	CustomLog ${APACHE_LOG_DIR}/access.log combined'
		echo "</VirtualHost>"
	} >"$RAILWAY_APACHE_CONF"
fi

# MPM cleanup (best-effort; /etc may be read-only on some hosts).
if command -v a2dismod >/dev/null 2>&1; then
	a2dismod mpm_event 2>/dev/null || true
	a2dismod mpm_worker 2>/dev/null || true
	a2enmod mpm_prefork 2>/dev/null || true
fi

if [ -n "${PORT}" ]; then
	# -C must receive a single directive string: "Include /path"
	exec docker-entrypoint.sh apache2-foreground -C "Include ${RAILWAY_APACHE_CONF}"
fi

exec docker-entrypoint.sh "$@"
