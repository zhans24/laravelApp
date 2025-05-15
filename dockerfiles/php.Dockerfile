FROM php:8.2-fpm-alpine

WORKDIR /var/www/laravel

RUN set -ex \
  && apk --no-cache add \
    postgresql-dev \
    nodejs \
    npm

RUN docker-php-ext-install pdo pdo_pgsql