FROM php:8.2-cli AS build

WORKDIR /app

RUN apt-get update && apt-get install -y \
    unzip curl git libzip-dev libonig-dev libsqlite3-dev \
    libxml2-dev zlib1g-dev libicu-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql pdo_sqlite mbstring zip exif pcntl bcmath opcache intl gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /app

RUN composer install --no-dev --optimize-autoloader

FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libzip-dev libonig-dev libsqlite3-dev libxml2-dev \
    zlib1g-dev libicu-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql pdo_sqlite mbstring zip exif pcntl bcmath opcache intl gd

RUN a2enmod rewrite
RUN sed -i 's|/var/www/html|/app/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|/var/www|/app|g' /etc/apache2/apache2.conf \
    && echo "ServerName localhost" >> /etc/apache2/apache2.conf

WORKDIR /app
COPY --from=build /app /app

RUN mkdir -p database && touch database/database.sqlite
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 10000
CMD ["/usr/local/bin/docker-entrypoint.sh"]
