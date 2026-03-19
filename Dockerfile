FROM wordpress:php8.3-apache

# Install WP-CLI
RUN curl -o /usr/local/bin/wp https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x /usr/local/bin/wp

# Install required PHP extensions (gd, mysqli, zip)
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli zip \
    && rm -rf /var/lib/apt/lists/*

# Copy WordPress installation scripts
COPY install-wp.sh /usr/local/bin/install-wp.sh
COPY install-wptelegram.sh /usr/local/bin/install-wptelegram.sh
RUN chmod +x /usr/local/bin/install-wp.sh /usr/local/bin/install-wptelegram.sh