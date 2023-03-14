FROM php:8.2-fpm

ARG WWWGROUP
ARG WWWUSER

# Set working directory
WORKDIR /var/www/api

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    libzip-dev \
    unzip \
    git \
    curl \
    libonig-dev \
    supervisor 

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

USER wwwdata

COPY composer.lock composer.json /var/www/api/
COPY . /var/www/api

RUN chown -R www-data:www-data \
        /var/www/api/storage \
        /var/www/api/bootstrap/cache

# Assign writing permissions to logs and framework directories
RUN chmod 777 /var/www/api/storage/logs \
        /var/www/api/storage/framework/sessions \
        /var/www/api/storage/framework/views

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]