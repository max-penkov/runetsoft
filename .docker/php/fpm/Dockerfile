FROM php:7.3-fpm

ARG APCU_VERSION=5.1.18

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    libpq-dev \
    librabbitmq-dev \
    libmemcached-dev \
    libjpeg-dev \
    libfreetype6-dev \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql mbstring exif pcntl bcmath gd

#RUN apt-get install --no-install-recommends -y \
#    libzip-dev libpq-dev librabbitmq-dev libmemcached-dev zlib1g-dev git \
#    libjpeg-dev libpng-dev libfreetype6-dev \
#    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
#    && docker-php-ext-install pdo pdo_pgsql pgsql bcmath zip  opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/bin --filename=composer --quiet

ENV COMPOSER_ALLOW_SUPERUSER 1

WORKDIR /var/www
