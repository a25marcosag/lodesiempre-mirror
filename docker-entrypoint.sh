#!/bin/bash
set -e

chown -R www-data:www-data /app

php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan migrate:fresh --force --seed

exec apache2-foreground
