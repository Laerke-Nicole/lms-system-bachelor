FROM php:8.3-cli

# Install system dependencies
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

# Install PHP dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies & build assets
COPY package.json package-lock.json ./
RUN npm install
RUN npm run build

# Copy the rest of the app
COPY . .

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000
