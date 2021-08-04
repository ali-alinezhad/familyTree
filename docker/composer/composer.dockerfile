FROM composer:2.1.1

RUN addgroup -g 1000 laravel && adduser -u 1000 -G laravel -g laravel -s /bin/sh -D laravel

WORKDIR /var/www/html
