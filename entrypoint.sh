#!/bin/bash

php artisan migrate --force

exec php-fpm
