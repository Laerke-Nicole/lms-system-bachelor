FROM php:8.3-cli

# System dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    nodejs \
    npm \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy app
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Build frontend assets
RUN npm install
RUN npm run build

EXPOSE 10000

# IMPORTANT: run migrations AT START, not build
CMD php artisan config:clear \
 && php artisan cache:clear \
 && php artisan optimize:clear \
 && php artisan migrate --force \
 && php artisan db:seed --force \
 && php artisan serve --host=0.0.0.0 --port=10000
