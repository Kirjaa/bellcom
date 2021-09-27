FROM php:8.0.2-fpm-alpine3.13

USER root
WORKDIR /var/www/html

# Use the default development configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Copy composer
COPY --from=composer:2.0.8 /usr/bin/composer /usr/bin/composer

# Install required dependencies
RUN  \
    apk --update add \
        mc \
        git \
        nginx \
        supervisor \
        libzip-dev \
        libxml2-dev \
        mysql-client && \
    docker-php-ext-install -j$(nproc) \
        zip \
        xml \
        exif \
        bcmath \
        pdo_mysql

# Copy source code
COPY . .

# Install dependencies
# Create .env file
# Generate key
# Add write directory permissions
RUN composer install && \
    chmod -R 777 ./storage && \
    chmod -R 777 ./bootstrap/cache && \
    php artisan key:generate && \
    php artisan storage:link
	
# Copy supervisor config
COPY .docker/configs/supervisor/supervisord.conf /etc/supervisor/supervisord.conf

# Copy nginx configurations
RUN mkdir -p /run/nginx
COPY .docker/configs/nginx/nginx.conf /etc/nginx/nginx.conf
COPY .docker/configs/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf

# Start supervisor
ENTRYPOINT ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]