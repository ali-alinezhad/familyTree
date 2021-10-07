up:
	docker-compose up -d
down:
	docker-compose down
stop:
	docker-compose stop
exec-php:
	docker-compose exec php sh
exec-composer:
	docker-compose run --rm composer sh
composer-install:
	docker-compose run --rm composer sh -c "composer install --ignore-platform-reqs"
composer-update:
	docker-compose run --rm composer sh -c "composer update --ignore-platform-reqs"
migrate: up
	docker-compose exec php sh -c "php artisan migrate"
init:
	mkdir -p data/mysql
provision: init composer-install migrate
