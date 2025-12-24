FROM php:8.3-apache

# Enable Apache rewrite
RUN a2enmod rewrite

# Install system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libzip-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_mysql zip

# Set Apache document root to Laravel public folder
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Update Apache config
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
 && sed -ri 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy app
COPY . /var/www/html

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP deps
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Build frontend
RUN npm install && npm run build && rm -rf node_modules

# Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
