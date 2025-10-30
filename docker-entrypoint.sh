#!/bin/bash
set -e

mkdir -p /app/database
touch /app/database/database.sqlite
chown -R www-data:www-data /app

sed -i "s/DB_CONNECTION=.*/DB_CONNECTION=sqlite/g" /app/.env
sed -i "s/DB_DATABASE=.*/DB_DATABASE=\/app\/database\/database.sqlite/g" /app/.env

php artisan config:clear
php artisan cache:clear
php artisan migrate --force

php artisan serve --host=0.0.0.0 --port=10000
