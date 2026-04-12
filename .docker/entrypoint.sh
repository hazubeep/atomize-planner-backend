#!/bin/sh

# Exit on error
set -e

# Support for SQLite
if [ "$DB_CONNECTION" = "sqlite" ]; then
    DB_DATABASE=${DB_DATABASE:-database/database.sqlite}
    if [ ! -f "$DB_DATABASE" ]; then
        echo "Creating SQLite database at $DB_DATABASE"
        touch "$DB_DATABASE"
        chown www-data:www-data "$DB_DATABASE"
    fi
fi

# Wait for database to be ready (if using MySQL/MariaDB)
if [ "$DB_CONNECTION" = "mysql" ] || [ "$DB_CONNECTION" = "mariadb" ]; then
    echo "Waiting for database..."
    while ! nc -z $DB_HOST ${DB_PORT:-3306}; do
      sleep 1
    done
    echo "Database is ready!"
fi

# Run migrations if in production or explicitly requested
if [ "$APP_ENV" = "production" ] || [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "Running migrations..."
    php artisan migrate --force
fi

# Start PHP-FPM
exec php-fpm
