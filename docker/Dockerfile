FROM php:7.4-cli

ARG LARAVEL_VERSION=7.3.0
ENV LARAVEL_VERSION=${LARAVEL_VERSION}

ARG GITHUB_OAUTH=2643f960f952fead3acc73a8990eea0f35db002b
ENV GITHUB_OAUTH=${GITHUB_OAUTH}

RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get install -y libzip-dev g++ make cmake unzip git \
    && apt-get autoclean -y \
    && apt-get clean -y

RUN docker-php-ext-install zip

ENV COMPOSER_HOME /composer
ENV PATH ./vendor/bin:/composer/vendor/bin:$PATH
ENV COMPOSER_ALLOW_SUPERUSER 1

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer config --global --auth --unset github-oauth.github.com \
    && composer config --global --auth github-oauth.github.com ${GITHUB_OAUTH} \
    && composer global require "squizlabs/php_codesniffer=*" \
    && composer global require laravel/installer

WORKDIR /opt/game

RUN composer create-project --prefer-dist laravel/laravel . "${LARAVEL_VERSION}"

COPY composer.json composer.json
COPY composer.lock composer.lock

COPY packages packages
COPY config config
COPY phpunit.xml phpunit.xml

RUN composer install
