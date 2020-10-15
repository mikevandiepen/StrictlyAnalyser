ARG version

# Loading the PHP version as declared in docker-compose.yaml.
FROM php:${version}-fpm

# Adding PHP Coverage to the PHP Runtime.
RUN pecl install -o -f pcov \
    && docker-php-ext-enable pcov

# Adding xDebug to the PHP Runtime.
RUN pecl install -o -f xdebug \
    && docker-php-ext-enable xdebug