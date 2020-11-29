FROM php:8.0-rc-cli

RUN pecl install xdebug && docker-php-ext-enable xdebug
