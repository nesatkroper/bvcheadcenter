# Makefile for Laravel Docker setup

CONTAINER_NAME=cleartoo-app
DB_CONTAINER=cleartoo-db
DB_ROOT_PASS=Root_Secure_2026

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

install: build wait-db db-restore composer-install ## Full setup: build, wait for DB, restore SQL, then install composer (production)
	docker exec -it $(CONTAINER_NAME) php artisan key:generate --ansi
	docker exec -it $(CONTAINER_NAME) php artisan storage:link
	docker exec -it $(CONTAINER_NAME) php artisan optimize:clear
	@echo "Setup complete! Navigate to http://cleartoo.site:8080"

fresh: ## Tear down everything including volumes and reinstall from scratch
	docker-compose down --volumes --remove-orphans 2>/dev/null || true
	-docker ps -a --filter "name=$(CONTAINER_NAME)" --format "{{.ID}}" | xargs -r docker rm -f
	@$(MAKE) install

wait-db: ## Wait for MySQL to be ready (uses healthcheck)
	@echo "Waiting for MySQL to be ready..."
	@until docker exec $(DB_CONTAINER) mysql -uroot -p$(DB_ROOT_PASS) -e "SELECT 1" > /dev/null 2>&1; do \
		sleep 2; \
	done
	@echo "MySQL is ready!"

db-restore: ## Restore the database from cleartoo.sql
	@echo "Restoring database from cleartoo.sql..."
	docker exec -i $(DB_CONTAINER) mysql -uroot -p$(DB_ROOT_PASS) cleartoo < cleartoo.sql
	@echo "Database restoration complete!"

composer-install: ## Run composer install (production: no-dev + optimized autoloader)
	docker exec -it $(CONTAINER_NAME) composer install --no-dev --optimize-autoloader --no-interaction

composer-dev: ## Run composer install with dev dependencies (for local development)
	docker exec -it $(CONTAINER_NAME) composer install --optimize-autoloader

bash: ## Access the app container bash
	docker exec -it $(CONTAINER_NAME) bash

db-bash: ## Access the database container bash
	docker exec -it $(DB_CONTAINER) bash

logs: ## Show container logs
	docker-compose logs -f

migrate: ## Run database migrations (only for new migrations after SQL restore)
	docker exec -it $(CONTAINER_NAME) php artisan migrate --force

seed: ## Run database seeds
	docker exec -it $(CONTAINER_NAME) php artisan db:seed

clear: ## Clear Laravel cache
	docker exec -it $(CONTAINER_NAME) php artisan optimize:clear

cache: ## Cache config, routes and views for production
	docker exec -it $(CONTAINER_NAME) php artisan config:cache
	docker exec -it $(CONTAINER_NAME) php artisan route:cache
	docker exec -it $(CONTAINER_NAME) php artisan view:cache
