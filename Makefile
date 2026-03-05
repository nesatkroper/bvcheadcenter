# Makefile for Laravel Docker setup

CONTAINER_NAME=cleartoo-app

help: ## Show this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

up: ## Start the containers in background
	docker-compose up -d

down: ## Stop the containers
	docker-compose down

restart: down up ## Restart the containers

build: ## Build the containers
	-docker ps -a --filter "name=$(CONTAINER_NAME)" --format "{{.ID}}" | xargs -r docker rm -f
	docker-compose down --remove-orphans 2>/dev/null || true
	docker-compose up -d --build

install: build ## Initial setup: build, install composer dependencies, and generate key
	docker exec -it $(CONTAINER_NAME) composer install
	docker exec -it $(CONTAINER_NAME) php artisan key:generate --ansi
	docker exec -it $(CONTAINER_NAME) php artisan storage:link
	@echo "Setup complete! Navigate to http://cleartoo.site:8080"

composer-install: ## Run composer install inside the container
	docker exec -it $(CONTAINER_NAME) composer install

bash: ## Access the app container bash
	docker exec -it $(CONTAINER_NAME) bash

logs: ## Show container logs
	docker-compose logs -f

migrate: ## Run database migrations
	docker exec -it $(CONTAINER_NAME) php artisan migrate

seed: ## Run database seeds
	docker exec -it $(CONTAINER_NAME) php artisan db:seed

clear: ## Clear Laravel cache
	docker exec -it $(CONTAINER_NAME) php artisan optimize:clear
