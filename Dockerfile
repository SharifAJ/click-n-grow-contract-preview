FROM node:22-bookworm-slim AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build

FROM php:8.3-cli-bookworm

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libcurl4-openssl-dev \
        libfreetype6-dev \
        libicu-dev \
        libjpeg62-turbo-dev \
        libonig-dev \
        libpng-dev \
        libsqlite3-dev \
        libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        bcmath \
        curl \
        exif \
        fileinfo \
        gd \
        intl \
        mbstring \
        pdo_mysql \
        pdo_sqlite \
        zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .
RUN composer install \
        --no-dev \
        --prefer-dist \
        --no-interaction \
        --no-progress \
        --optimize-autoloader

COPY --from=frontend /app/public/build ./public/build

RUN mkdir -p \
        database \
        storage/framework/cache/data \
        storage/framework/sessions \
        storage/framework/views \
        storage/logs \
        bootstrap/cache \
    && chmod -R ug+rwX storage bootstrap/cache database

EXPOSE 10000

CMD ["sh", "-c", "touch database/database.sqlite && php artisan migrate --force --no-interaction && if [ -n \"$REGISTRATION_DB_URL\" ] || { [ -n \"$REGISTRATION_DB_HOST\" ] && [ -n \"$REGISTRATION_DB_DATABASE\" ] && [ -n \"$REGISTRATION_DB_USERNAME\" ]; }; then php artisan migrate --database=expert_visits --path=database/migrations/expert_visits --force --no-interaction; else printf '%s\\n' 'Expert visit registration database is not configured; registration checkout remains unavailable.' >&2; fi && exec php artisan serve --host=0.0.0.0 --port=${PORT:-10000}"]
