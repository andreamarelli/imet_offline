ARG PHP_VERSION=7.4
FROM php:${PHP_VERSION}-fpm-alpine

WORKDIR /var/www/html

# Update
RUN apk update

# Retrieve last version of install-php-extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync

# Install required packages
RUN apk add --no-cache git

# Install PHP Extensions (Laravel requirements)
RUN install-php-extensions bcmath
# ALREADY in image: ctype fileinfo json mbstring openssl pdo tokenizer xml

# Install optional PHP Extensions
RUN install-php-extensions \
    exif \
    gd \
    imagick \
    pdo_pgsql \
    zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
