#!/usr/bin/env sh

_="$(dirname "$0")"

# $_/user_setup www-data
$_/composer

echo "==> Running migration"
php artisan migrate

echo "==> Generating key"
php artisan key:generate

echo "==> Cache config"
php artisan cache:clear
php artisan config:cache
php artisan view:clear

# Start php-fpm
echo "===> Initializing php-fpm"
php-fpm