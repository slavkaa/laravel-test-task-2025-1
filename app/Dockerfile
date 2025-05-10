FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    unzip \
    gnupg \
    git \
    libzip-dev \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libjpeg-dev \
    libfreetype6-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mysqli zip \
    && pecl install redis && docker-php-ext-enable redis

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD ["php-fpm"]