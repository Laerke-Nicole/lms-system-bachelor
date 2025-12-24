FROM richarvey/nginx-php-fpm:3.1.6

# Copy application files
COPY . /var/www/html

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Install Node.js for asset building
RUN apk add --no-cache nodejs npm

# Install composer dependencies and regenerate autoload
RUN composer install --no-dev --optimize-autoloader --no-interaction --working-dir=/var/www/html && \
    composer dump-autoload --optimize --no-dev --working-dir=/var/www/html

# Build frontend assets
RUN cd /var/www/html && npm install && npm run build && rm -rf node_modules

# Create scripts directory and startup script
RUN mkdir -p /var/www/html/scripts && \
    echo '#!/bin/sh' > /var/www/html/scripts/00-laravel.sh && \
    echo 'echo "=== Laravel Startup Script ==="' >> /var/www/html/scripts/00-laravel.sh && \
    echo 'cd /var/www/html' >> /var/www/html/scripts/00-laravel.sh && \
    echo '' >> /var/www/html/scripts/00-laravel.sh && \
    echo 'echo "Step 1: Running migrations..."' >> /var/www/html/scripts/00-laravel.sh && \
    echo 'php artisan migrate --force || echo "Migration failed"' >> /var/www/html/scripts/00-laravel.sh && \
    echo '' >> /var/www/html/scripts/00-laravel.sh && \
    echo 'echo "Step 2: Running seeders..."' >> /var/www/html/scripts/00-laravel.sh && \
    echo 'php artisan db:seed --force || echo "Seeding failed (may already be seeded)"' >> /var/www/html/scripts/00-laravel.sh && \
    echo '' >> /var/www/html/scripts/00-laravel.sh && \
    echo 'echo "Step 3: Clearing all caches..."' >> /var/www/html/scripts/00-laravel.sh && \
    echo 'php artisan optimize:clear' >> /var/www/html/scripts/00-laravel.sh && \
    echo '' >> /var/www/html/scripts/00-laravel.sh && \
    echo 'echo "Step 4: Caching config only..."' >> /var/www/html/scripts/00-laravel.sh && \
    echo 'php artisan config:cache' >> /var/www/html/scripts/00-laravel.sh && \
    echo '' >> /var/www/html/scripts/00-laravel.sh && \
    echo 'echo "=== Laravel Ready! ==="' >> /var/www/html/scripts/00-laravel.sh && \
    chmod +x /var/www/html/scripts/00-laravel.sh
