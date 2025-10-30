#!/bin/bash
set -e

mkdir -p /app/database
touch /app/database/database.sqlite
chown -R www-data:www-data /app

php artisan config:clear
php artisan cache:clear
php artisan migrate --force

php artisan serve --host=0.0.0.0 --port=10000
