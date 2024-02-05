setup:
	@make build
	@make up
	@make composer-update
	@storage-permission
build:
	docker-compose build --no-cache --force-rm
stop:
	docker-compose stop
up:
	docker-compose up -d
composer-update:
	docker exec laravel-docker bash -c "composer update"
storage-permission:
	docker exec laravel-docker bash -c "chmod 755 storage/ -R"
data:
	docker exec laravel-docker bash -c "php artisan migrate:fresh --seed"