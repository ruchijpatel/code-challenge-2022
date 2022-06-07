# Set master image
FROM php:8.1-fpm

ARG COMPOSER_MEMORY_LIMIT=-1

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/html/

# Set working directory
WORKDIR /var/www/html/laravel-docker-demo

# Install Additional dependencies
RUN apt-get update && apt-get clean \
    build-base shadow vim curl \
    php8.1 \
    php8.1-fpm \
    php8.1-common \
    php8.1-pdo \
    php8.1-pdo_mysql \
    php8.1-mysqli \
    php8.1-mcrypt \
    php8.1-mbstring \
    php8.1-xml \
    php8.1-openssl \
    php8.1-json \
    php8.1-phar \
    php8.1-zip \
    php8.1-gd \
    php8.1-dom \
    php8.1-session \
    php8.1-zlib

# Add and Enable PHP-PDO Extenstions
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-enable pdo_mysql

# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Remove Cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Add UID '1000' to www-data
RUN usermod -u 1000 www-data

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/html

# Change current user to www
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
