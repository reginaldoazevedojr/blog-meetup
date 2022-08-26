FROM php:7.2-fpm

MAINTAINER reginaldoazevedojr

LABEL Description="Application test"

ENV ACCEPT_EULA=Y

RUN apt update && apt install -y git unzip

RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

RUN apt-get -y update \
&& apt-get install -y libicu-dev \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/bin --filename=composer

RUN composer self-update --1

RUN composer install