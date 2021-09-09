.SILENT:

include .env

#=============VARIABLES================
php_container = ${APP_NAME}__php-fpm
db_container = ${APP_NAME}__db
#======================================

#=====MAIN_COMMAND=====================

.PHONY: init
init: down-clear up_docker app-init ps info

.PHONY: up
up: up_docker info

.PHONY: info
info: ps info_domen

.PHONY: rebuild
rebuild: down build up_docker info

.PHONY: up_docker
up_docker:
	docker-compose up -d

.PHONY: down
down:
	docker-compose down --remove-orphans

# флаг -v удаляет все volume (очищает все данные)
.PHONY: down-clear
down-clear:
	docker-compose down -v --remove-orphans

.PHONY: build
build:
	docker-compose build

.PHONY: ps
ps:
	docker-compose ps

.PHONY: cp-env
cp-env:
	cp .env.example .env

#=======COMMAND_FOR_APP================

app-init: composer-install project-init perm

composer-install:
	docker-compose run --rm php-fpm composer install

project-init:
	docker-compose run --rm php-fpm php artisan key:generate
	docker-compose run --rm php-fpm php artisan migrate
	docker-compose run --rm php-fpm php artisan db:seed
	docker-compose run --rm php-fpm php artisan passport:keys
	docker-compose run --rm php-fpm php artisan cmd:init
	docker-compose run --rm php-fpm composer ide

.PHONY: perm
perm:
	sudo chmod 777 -R storage

#=======INTO_CONTAINER=================

php_bash:
	docker exec -it $(php_container) bash

db_bash:
	docker exec -it $(db_container) sh
#=======FOR_TEST=================

.PHONY: test
test: test_init test_run

.PHONY: test_init
test_init:
	docker-compose run --rm php-fpm php artisan key:generate --env=testing -n
	docker-compose run --rm php-fpm php artisan migrate -n --env=testing -n
	#docker-compose run --rm php-fpm php artisan db:seed --class="Database\Seeders\DatabaseTestSeeder" --env=testing -n
	docker-compose run --rm php-fpm php artisan cmd:init -n --env=testing -n

.PHONY: test_refresh_db
test_refresh_db:
	docker-compose run --rm php-fpm php artisan migrate:fresh --seed -n --env=testing -n
	docker-compose run --rm php-fpm php artisan cmd:init -n --env=testing -n

.PHONY: test_run
test_run:
	docker-compose run --rm php-fpm ./vendor/bin/phpunit

#=======INFO===========================

.PHONY: info_domen
info_domen:
	echo '---------------------------------';
	echo '----------DEV--------------------';
	echo ${APP_URL};
	echo '---------------------------------';

.DEFAULT_GOAL := init
