help: # Show help for each of the Makefile recipes
	@grep -E '^[a-zA-Z0-9 -]+:.*#'  Makefile | sort | while read -r l; do printf "\033[1;32m$$(echo $$l | cut -f 1 -d':')\033[00m:$$(echo $$l | cut -f 2- -d'#')\n"; done
setup: # Setup project and run
	@make build
	@make up
	@make composer-update
	@make storage-permission
	@make data
build: # Build the docker image
	docker compose build --no-cache --force-rm
stop: # Stop application
	docker compose stop
up: # Start application
	docker compose up -d
composer-update: # Update composer libs
	docker exec laravel-docker bash -c "composer update"
storage-permission:
	docker exec laravel-docker bash -c "chmod 777 storage/ -R"
data: # Run laravel migrations + seed
	docker exec laravel-docker bash -c "php artisan migrate:fresh --seed"