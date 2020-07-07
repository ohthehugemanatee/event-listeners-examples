FROM composer:latest as composer
COPY . /app
WORKDIR /app
RUN composer install

FROM php:latest
COPY --from=composer /app /app