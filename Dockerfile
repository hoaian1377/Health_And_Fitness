FROM php:8.2-fpm

# Cài các extension Laravel cần
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev

RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Cài Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy source code vào container
WORKDIR /var/www
COPY . .

# Cài dependencies
RUN composer install --optimize-autoloader --no-dev

# Expose port
EXPOSE 8000

# Chạy Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000