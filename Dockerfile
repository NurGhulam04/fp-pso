FROM node:18 as frontend

# Set working directory for frontend build
WORKDIR /app

# Copy only the files needed for npm install & run
COPY package.json package-lock.json ./
RUN npm install

# Copy rest of the files and run build
COPY . .
RUN npm run prod

# ========================
# PHP + Laravel Layer
# ========================
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy Laravel source code
COPY . .

# Copy built frontend from previous stage
COPY --from=frontend /app/public ./public

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Copy default environment (kamu bisa ubah sesuai kebutuhan)
COPY .env .env

# Generate Laravel key
RUN php artisan key:generate

# Set correct permissions
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Expose port
EXPOSE 9000

CMD ["php-fpm"]
