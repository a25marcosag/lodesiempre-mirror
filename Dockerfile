FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    unzip \
    curl \
    git \
    libzip-dev \
    libonig-dev \
    libsqlite3-dev \
    default-mysql-client \
    libxml2-dev \
    zlib1g-dev \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql pdo_sqlite mbstring zip exif pcntl bcmath opcache intl gd

RUN a2enmod rewrite

WORKDIR /app
COPY . /app

RUN chown -R www-data:www-data /app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 10000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
