#!/usr/bin/env bash

if [ ! -z "$WWWUSER" ]; then
    usermod -u $WWWUSER api
fi

if [ ! -d /.composer ]; then
    mkdir /.composer
fi

service php8.2-fpm restart

chmod -R ugo+rw /var/www/api/storage


