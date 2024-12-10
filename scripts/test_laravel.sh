#!/bin/bash

npm run clear_cache
npm run build
php artisan serve

echo "Proceso completado exitosamente."
