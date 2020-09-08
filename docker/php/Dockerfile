ARG version

# Loading the PHP version as declared in docker-compose.yaml.
FROM php:${version}-fpm

# Adding PHP Coverage to the PHP Runtime.
RUN pecl install pcov \
    && docker-php-ext-enable pcov

# Adding xDebug to the PHP Runtime.
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Updating php.ini for development purpose.
RUN echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini