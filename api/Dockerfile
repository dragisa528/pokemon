FROM php:8.2-fpm

ARG WWWGROUP
ARG WWWUSER

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/api/

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

# Add user for laravel application
RUN groupadd -g $WWWGROUP api
RUN useradd -u $WWWUSER -ms /bin/bash -g api api

RUN usermod -a -G www-data api

# Copy existing application directory contents
COPY . /var/www/api

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/api

# Change current user to api
USER api

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]