#!/bin/sh

# Exit on error
set -e

# Create SQLite database if it doesn't exist
if [ "$DB_CONNECTION" = "sqlite" ]; then
    # Use DB_DATABASE env or default
    DB_PATH=${DB_DATABASE:-database/database.sqlite}
    
    # Extract directory path
    DB_DIR=$(dirname "$DB_PATH")
    
    if [ ! -d "$DB_DIR" ]; then
        echo "Creating database directory $DB_DIR"
        mkdir -p "$DB_DIR"
    fi

    if [ ! -f "$DB_PATH" ]; then
        echo "Creating SQLite database at $DB_PATH"
        touch "$DB_PATH"
    fi
    
    # Set permissions
    chown www-data:www-data "$DB_PATH"
    chown www-data:www-data "$DB_DIR"
fi

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Start the web server (provided by richarvey image)
echo "Starting Nginx and PHP-FPM..."
/usr/local/bin/start.sh
