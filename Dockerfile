FROM php:8.2-apache

RUN apt update \
    && apt install -y zip libzip-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

RUN a2enmod rewrite

RUN sed -ri -e 's!:80>!:8080>!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!Listen 80!Listen 8080!g' /etc/apache2/ports.conf \
    && sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY --chown=www-data . /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader

WORKDIR /var/www/html

EXPOSE 8080