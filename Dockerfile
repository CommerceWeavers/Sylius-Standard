FROM dunglas/frankenphp:1.3-php8.3-alpine AS frankenphp

ADD .docker/frankenphp/Caddyfile /etc/caddy/
ADD .docker/frankenphp/php.ini "$PHP_INI_DIR/"
#ADD .docker/frankenphp/xdebug.ini "$PHP_INI_DIR/conf.d/"

RUN install-php-extensions ast exif gd intl pdo pdo_mysql pdo_pgsql soap zip xsl ftp redis
#RUN install-php-extensions xdebug

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1
ENV COMPOSER_HOME=/.composer

RUN mkdir /.composer

ENV PATH="${PATH}:/root/.composer/vendor/bin"

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

FROM node:lts AS frontend

RUN apt update && apt install git

RUN mkdir -p /app

WORKDIR /app

ENTRYPOINT ["tail"]
CMD ["-f","/dev/null"]
