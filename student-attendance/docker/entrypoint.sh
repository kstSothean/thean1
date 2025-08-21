#!/usr/bin/env bash
set -e

cd /var/www/html

if [ ! -f .env ]; then
  cp .env.example .env || true
fi

php -r "file_exists('.env') && strpos(file_get_contents('.env'),'APP_KEY=') !== false ?: exit(0);" || php artisan key:generate --force

php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

exec apache2-foreground
