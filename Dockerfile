# Stage 1: Build PHP dependencies
FROM php:8.3-fpm-alpine as php-deps

WORKDIR /var/www/html

# Install system dependencies
RUN apk add --no-cache \
    zip \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    icu-dev \
    sqlite-dev \
    linux-headers

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    pdo_mysql \
    pdo_sqlite \
    zip \
    gd \
    mbstring \
    intl \
    bcmath \
    opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy composer files and install
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# Stage 2: Build Node.js assets
FROM node:22-alpine as node-assets

WORKDIR /app

COPY package.json package-lock.json* ./
RUN npm install

COPY . .
RUN npm run build

# Stage 3: Final Production Image
FROM php:8.3-fpm-alpine

WORKDIR /var/www/html

# Install runtime system dependencies
RUN apk add --no-cache \
    zip \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    icu-dev \
    sqlite

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    pdo_mysql \
    pdo_sqlite \
    zip \
    gd \
    mbstring \
    intl \
    bcmath \
    opcache

# Copy application files
COPY . .

# Copy vendor from php-deps
COPY --from=php-deps /var/www/html/vendor ./vendor

# Copy built assets from node-assets
COPY --from=node-assets /app/public/build ./public/build

# Finalize composer (run scripts and optimize autoloader)
COPY --from=php-deps /usr/bin/composer /usr/bin/composer
RUN composer dump-autoload --optimize --no-dev

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copy entrypoint script
COPY .docker/entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]

# Expose port 9000
EXPOSE 9000

CMD ["php-fpm"]
