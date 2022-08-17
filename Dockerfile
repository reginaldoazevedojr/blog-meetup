FROM php:7.2-fpm

MAINTAINER reginaldoazevedojr

LABEL Description="Application test"

ENV ACCEPT_EULA=Y

RUN apt update && apt install -y git unzip

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/bin --filename=composer