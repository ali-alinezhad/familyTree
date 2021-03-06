FROM php:7.4.20-fpm-alpine3.13

RUN addgroup -g 1000 laravel && adduser -u 1000 -G laravel -g laravel -s /bin/sh -D laravel

RUN mkdir -p /var/www/html

RUN chown laravel:laravel /var/www/html

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql
