FROM php:8.2-fpm-bullseye

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# PHP extensions
RUN apt-get update && apt-get install -y libpq-dev libpng-dev git zip unzip libzip-dev \
    && docker-php-ext-install pdo pdo_mysql bcmath pdo_pgsql gd zip

RUN apt-get install -y libxml2-dev
RUN docker-php-ext-install xml
RUN apt-get install -y graphviz


# Composer
RUN apt-get install -y curl
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

# Supervisor
RUN apt-get install -y supervisor
#ADD docker/application/config/supervisor/supervisord.conf /etc/supervisord.conf
ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c",  "/var/www/docker/application/config/supervisord.conf"]


RUN pecl install xdebug-3.2.2
RUN docker-php-ext-enable xdebug

RUN docker-php-ext-install opcache

ARG XDEBUG_MODE=off
ARG XDEBUG_START_WITH_REQUEST=no

RUN if [ "${XDEBUG_MODE}" != "off" ] ; then echo "xdebug.mode=${XDEBUG_MODE}" >> $PHP_INI_DIR/php.ini; fi
RUN if [ "${XDEBUG_START_WITH_REQUEST}" != "no" ] ; then echo "xdebug.start_with_request=${XDEBUG_START_WITH_REQUEST}" >> $PHP_INI_DIR/php.ini; fi
RUN echo "xdebug.output_dir='storage/profiling'" >> $PHP_INI_DIR/php.ini

WORKDIR /var/www
