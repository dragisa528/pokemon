FROM php:8.2-fpm

ARG GROUPID
ARG USERID

# We will delete and recreate the user/group completely of the base OS
# This will enable us have control over what user ID and group ID 
# We recreate the www-data in the base OS with our own known group ID and User ID
# We use -l flag with useradd this is important to prevent issue where a 
# high UID value will generate huge log files and freeze your system!
# RUN \
# if [ $USERID -ne 0 ] && [ $GROUPID -ne 0 ]; then \
#     userdel -f www-data &&\
#     groupdel -f www-data \
#     # if getent group www-data ; then groupdel www-data; fi &&\
#     # groupadd -g $GROUPID www-data &&\
#     # useradd -l -u $USERID -g www-data www-data &&\
#     # install -d -m 0755 -o www-data -g www-data /home/www-data &&\
    # chown --changes --silent --no-dereference --recursive \
    #       --from=33:33 $USERID:$GROUPID \
    #     /home/www-data \
    #     /.composer \
    #     /var/run/php-fpm \
    #     /var/lib/php/sessions \
# fi;
# set working directory
WORKDIR /var/www/api

RUN userdel -f www-data
RUN groupadd -g $GROUPID www-data
RUN useradd -l -u $USERID -g www-data www-data
RUN install -d -m 0755 -o www-data -g www-data /home/www-data
RUN chown --changes --silent --no-dereference --recursive --from=33:33 $USERID:$GROUPID /home/www-data /var/www/api

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

# RUN groupadd --force -g ${GROUPID} api
# RUN useradd -ms /bin/bash --no-user-group -g ${GROUPID} -u ${USERID} api

COPY start-container /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/start-container


USER www-data

COPY --chown=api:www-data composer.lock composer.json /var/www/api/
COPY --chown=api:www-data . /var/www/api

# Expose port 9000 and start php-fpm server
EXPOSE 9000

CMD ["start-container"]