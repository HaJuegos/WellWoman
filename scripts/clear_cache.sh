#!/bin/bash

cd ..

php artisan config:clear && php artisan route:clear && php artisan view:clear && php artisan event:clear && php artisan cache:clear && php artisan optimize:clear

php artisan config:cache
