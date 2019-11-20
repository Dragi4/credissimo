#!/bin/sh
docker exec -it credissimo-php-fpm php artisan migrate
docker exec -it credissimo-php-fpm php artisan db:seed
docker exec -it credissimo-php-fpm php artisan interests:add