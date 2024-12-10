#!/bin/bash

cd ..

echo "Instalacion de composer iniciada..."
composer install

echo "Instalacion de los NPM iniciada..."
npm i

echo "Cambiando key del .env"
php artisan key:generate

echo "Verificando y descomentando las extensiones de PostgreSQL en php.ini"
PHP_INI_FILE="C:/xampp/php/php.ini"

if grep -q ";extension=pdo_pgsql" "$PHP_INI_FILE"; then
    echo "Descomentando extension=pdo_pgsql"
    sed -i 's/;extension=pdo_pgsql/extension=pdo_pgsql/' "$PHP_INI_FILE"
fi

if grep -q ";extension=pgsql" "$PHP_INI_FILE"; then
    echo "Descomentando extension=pgsql"
    sed -i 's/;extension=pgsql/extension=pgsql/' "$PHP_INI_FILE"
fi

echo "Verificando el estado de Apache..."
if tasklist | findstr /i "httpd.exe" > /dev/null; then
    echo "Apache está corriendo. Reiniciando..."
    C:/xampp/apache/bin/httpd.exe -k restart
else
    echo "Apache no está corriendo. Iniciando..."
    C:/xampp/apache/bin/httpd.exe -k start
fi

echo "Limpiando cache antes que nada."
npm run clear_cache

echo "Se ha terminado, pulsa cualquier tecla para continuar."
