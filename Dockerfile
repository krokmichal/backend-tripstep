FROM php:8.2-cli

# Instalacja zależności systemowych
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    && docker-php-ext-install pdo_mysql zip

# Instalacja Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Ustaw katalog roboczy
WORKDIR /var/www

# Skopiuj pliki do kontenera
COPY . .

# Instalacja zależności PHP
RUN composer install --no-dev --optimize-autoloader

# Domyślny port do nasłuchu
EXPOSE 8000

# Komenda startowa
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000

