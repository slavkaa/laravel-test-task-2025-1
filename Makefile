PHP_SERVICE=php-service

.PHONY: setup build up down restart logs

up:
	docker compose up -d

build:
	docker compose up -d --build
	docker exec $(PHP_SERVICE) sh -c "composer i"

setup: build fix-permissions migrate cache-warm-up check-code

migrate:
	docker exec $(PHP_SERVICE) sh -c "php artisan migrate"

fix-permissions:
	docker exec $(PHP_SERVICE) sh -c "chown -R www-data:www-data /var/www/html"
	docker exec $(PHP_SERVICE) sh -c "chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache"

cache-clear:
	docker exec $(PHP_SERVICE) sh -c "php artisan config:clear && php artisan cache:clear && php artisan route:clear && php artisan view:clear"

cache-warm-up:
	docker exec $(PHP_SERVICE) sh -c "php artisan config:cache && php artisan route:cache && php artisan view:cache"

ccl:
	docker exec $(PHP_SERVICE) sh -c "php artisan config:clear && php artisan cache:clear && php artisan route:clear && php artisan view:clear"

cc: cache-clear cache-warm-up fix-permissions

check-code:
	docker exec $(PHP_SERVICE) sh -c "vendor/bin/phpstan analyse --memory-limit=1G"

exec-app:
	docker exec -it $(PHP_SERVICE) sh

exec-nginx:
	docker exec -it nginx-service sh

exec-php: exec-app

down:
	docker compose down --remove-orphans

down-hard:
	docker compose down  --volumes --remove-orphans

rebuild: cache-clear down-hard setup

restart: cache-clear down up cache-warm-up

restart-nginx:
	docker restart nginx-service
	make cc

logs:
	docker compose logs -f