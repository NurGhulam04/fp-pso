#!/bin/bash

echo "Running Laravel pre-startup commands..."
php artisan session:table
php artisan migrate --force
echo "Laravel pre-startup commands finished. Starting Supervisor..."
/usr/bin/supervisord -n -c /etc/supervisor/supervisord.conf
