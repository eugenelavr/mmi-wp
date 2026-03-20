FROM wordpress:php8.4-apache

# The base image already ships gd, mysqli, zip, imagick, intl, etc.
# Do not run docker-php-ext-install again — it fails the build (extensions already compiled).

# Install WP-CLI
RUN curl -o /usr/local/bin/wp https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
	&& chmod +x /usr/local/bin/wp

# Copy WordPress installation scripts
COPY install-wp.sh /usr/local/bin/install-wp.sh
COPY install-wptelegram.sh /usr/local/bin/install-wptelegram.sh
COPY install-phase5-plugins.sh /usr/local/bin/install-phase5-plugins.sh
RUN chmod +x /usr/local/bin/install-wp.sh \
		/usr/local/bin/install-wptelegram.sh \
		/usr/local/bin/install-phase5-plugins.sh

# Railway: Apache must listen on $PORT; MPM fix for PHP 8.4 deployments
COPY railway-entrypoint.sh /usr/local/bin/railway-entrypoint.sh
RUN chmod +x /usr/local/bin/railway-entrypoint.sh
ENTRYPOINT ["railway-entrypoint.sh"]
CMD ["apache2-foreground"]
