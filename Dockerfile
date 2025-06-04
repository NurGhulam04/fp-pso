# ========================
# Frontend Build Layer
# ========================
FROM node:18 as frontend

WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install
COPY . .
RUN npm run prod

# ========================
# PHP + Laravel + Nginx Layer
# ========================
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    nginx supervisor bash\
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql mbstring zip \
    && rm /etc/nginx/sites-enabled/default

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

# ==================================
# Tambahkan baris ini untuk membersihkan cache Laravel
# Tambahkan setelah composer install dan copy kode sumber
# ==================================
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan view:clear \
    && php artisan route:clear \
    && php artisan optimize:clear

# Copy default environment (kamu bisa ubah sesuai kebutuhan)
# Make sure your .env has correct database connection string for Azure MySQL
COPY .env .env.example
RUN cp .env.example .env

# Generate Laravel key
RUN php artisan key:generate

# Set correct permissions
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

# Copy Nginx config
COPY nginx.conf /etc/nginx/sites-available/default.conf
RUN ln -s /etc/nginx/sites-available/default.conf /etc/nginx/sites-enabled/default.conf

# Copy Supervisor config (to run both Nginx and PHP-FPM)
COPY supervisor.conf /etc/supervisor/conf.d/supervisor.conf

# Expose port (Azure will map external traffic to this port)
EXPOSE 80

# Salin skrip startup.sh dan jadikan executable
COPY startup.sh /usr/local/bin/startup.sh
RUN chmod +x /usr/local/bin/startup.sh

# Expose port
EXPOSE 8000

# Gunakan startup.sh sebagai entry point utama
CMD ["/usr/local/bin/startup.sh"]
