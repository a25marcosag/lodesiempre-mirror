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
    && docker-php-ext-install pdo_mysql pdo_sqlite mbstring zip exif pcntl bcmath opcache

RUN a2enmod rewrite

WORKDIR /app
COPY . /app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN php -d memory_limit=-1 /usr/local/bin/composer install --no-dev --optimize-autoloader

EXPOSE 10000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
