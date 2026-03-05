# Makefile for Laravel Docker setup

CONTAINER_NAME=cleartoo-app
DB_CONTAINER=cleartoo-db
DB_ROOT_PASS=Root_Secure_2026

# Auto-detect compose command (V2 plugin vs V1 standalone)
DOCKER_COMPOSE := $(shell docker compose version > /dev/null 2>&1 && echo "docker compose" || echo "docker-compose")

help: ## Show this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

up: ## Start the containers in background
	$(DOCKER_COMPOSE) up -d

down: ## Stop the containers
	$(DOCKER_COMPOSE) down

restart: down up ## Restart the containers

build: ## Build the containers
	-docker ps -a --filter "name=$(CONTAINER_NAME)" --format "{{.ID}}" | xargs -r docker rm -f
	$(DOCKER_COMPOSE) down --remove-orphans 2>/dev/null || true
	$(DOCKER_COMPOSE) up -d --build

install: build wait-db composer-install ## Full setup: build, wait for DB, then install composer (use make db-restore manually once)
	docker exec cleartoo-app mkdir -p /var/www/resources/views /var/www/storage/framework/cache /var/www/storage/framework/sessions /var/www/storage/framework/views /var/www/storage/logs
	docker exec cleartoo-app chown -R www-data:www-data /var/www
	docker exec cleartoo-app chmod -R 777 /var/www/storage /var/www/bootstrap/cache
	docker exec cleartoo-app rm -f bootstrap/cache/config.php bootstrap/cache/routes.php bootstrap/cache/packages.php bootstrap/cache/services.php
	docker exec cleartoo-app php artisan storage:link --force 2>/dev/null || true
	docker exec cleartoo-app php artisan optimize:clear
	@echo "Setup complete! Navigate to http://cleartoo.site"

fresh: ## Tear down everything including volumes and reinstall from scratch
	$(DOCKER_COMPOSE) down --volumes --remove-orphans 2>/dev/null || true
	-docker ps -a --filter "name=$(CONTAINER_NAME)" --format "{{.ID}}" | xargs -r docker rm -f
	@$(MAKE) install

wait-db: ## Wait for MySQL to be ready (uses healthcheck)
	@echo "Waiting for MySQL to be ready..."
	@until docker exec $(DB_CONTAINER) mysql -uroot -p$(DB_ROOT_PASS) -e "SELECT 1" > /dev/null 2>&1; do \
		sleep 2; \
	done
	@echo "MySQL is ready!"

db-restore: ## Restore the database from bvcheadcenter_db.sql
	@echo "Restoring database from bvcheadcenter_db.sql..."
	docker exec -i $(DB_CONTAINER) mysql -uroot -p$(DB_ROOT_PASS) cleartoo < bvcheadcenter_db.sql
	@echo "Database restoration complete!"

db-backup: ## Create a backup of the live database
	@echo "Backing up database..."
	docker exec $(DB_CONTAINER) mysqldump -uroot -p$(DB_ROOT_PASS) cleartoo > backup_$(shell date +%Y_%m_%d_%H%M%S).sql
	@echo "Backup saved as backup_$(shell date +%Y_%m_%d_%H%M%S).sql"

composer-install: ## Run composer install (production: no-dev + optimized autoloader)
	docker exec $(CONTAINER_NAME) composer install --no-dev --optimize-autoloader --no-interaction

composer-dev: ## Run composer install with dev dependencies (for local development)
	docker exec $(CONTAINER_NAME) composer install --optimize-autoloader

bash: ## Access the app container bash
	docker exec -it $(CONTAINER_NAME) bash

db-bash: ## Access the database container bash
	docker exec -it $(DB_CONTAINER) bash

db-sql: ## Access the MySQL prompt directly
	docker exec -it $(DB_CONTAINER) mysql -u cleartoo -pAa32c2PFMzcwDd2r cleartoo

logs: ## Show container logs
	$(DOCKER_COMPOSE) logs -f

migrate: ## Run database migrations (only for new migrations after SQL restore)
	docker exec $(CONTAINER_NAME) php artisan migrate --force

seed: ## Run database seeds
	docker exec $(CONTAINER_NAME) php artisan db:seed

clear: ## Clear Laravel cache
	docker exec $(CONTAINER_NAME) php artisan optimize:clear

cache: ## Cache config, routes and views for production
	docker exec -it $(CONTAINER_NAME) php artisan config:cache
	docker exec -it $(CONTAINER_NAME) php artisan route:cache
	docker exec -it $(CONTAINER_NAME) php artisan view:cache
