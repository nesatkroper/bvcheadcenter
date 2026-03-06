# Makefile for Laravel Docker setup

CONTAINER_NAME=cleartoo-app
DB_CONTAINER=cleartoo-db
DB_ROOT_PASS=Aa32c2PFMzcwDd2r

# Auto-detect compose command (V2 plugin vs V1 standalone)
DOCKER_COMPOSE := $(shell docker compose version > /dev/null 2>&1 && echo "docker compose" || echo "docker-compose")

backup: db-backup backup-files ## Backup everything (DB and Uploads)

restore: db-restore restore-files ## Restore everything (DB and Uploads)

backup-files: ## Create a backup of the 'public/uploads' folder
	@echo "Backing up uploads..."
	@FILENAME=uploads_backup_$(shell date +%Y_%m_%d_%H%M%S).tar.gz; \
	docker exec $(CONTAINER_NAME) tar -czf - public/uploads > $$FILENAME; \
	echo "Uploads backup saved as $$FILENAME"

restore-files: ## Restore the 'public/uploads' folder (usage: make restore-files FILE=filename.tar.gz)
	@if [ -z "$(FILE)" ]; then \
		echo "Error: Please specify the backup file, e.g., make restore-files FILE=uploads_backup_xxx.tar.gz"; \
		exit 1; \
	fi
	@echo "Restoring uploads from $(FILE)..."
	cat $(FILE) | docker exec -i $(CONTAINER_NAME) tar -xzf - -C /var/www
	docker exec $(CONTAINER_NAME) chown -R www-data:www-data /var/www/public/uploads
	@echo "Uploads restoration complete!"

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

install: up wait-db composer-install perm ## Full setup: start containers, wait for DB, install composer, and fix perms
	docker exec $(CONTAINER_NAME) rm -f bootstrap/cache/config.php bootstrap/cache/routes.php bootstrap/cache/packages.php bootstrap/cache/services.php
	docker exec $(CONTAINER_NAME) php artisan storage:link --force 2>/dev/null || true
	docker exec $(CONTAINER_NAME) php artisan optimize:clear
	@echo "Setup complete! Navigate to http://cleartoo.site"

upd: ## Fast update: clear cache and fix permissions (for small code changes)
	docker exec $(CONTAINER_NAME) php artisan optimize:clear
	@$(MAKE) perm
	@echo "Update complete!"

perm: ## Fix folder permissions for Laravel
	docker exec $(CONTAINER_NAME) mkdir -p resources/views storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs
	docker exec $(CONTAINER_NAME) chown -R www-data:www-data storage bootstrap/cache
	docker exec $(CONTAINER_NAME) chmod -R 775 storage bootstrap/cache

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

db-fix-slugs: ## Repair missing shop names and slugs in the database
	@echo "Repairing missing shop names and slugs..."
	docker exec $(DB_CONTAINER) mysql -uroot -p$(DB_ROOT_PASS) cleartoo -e "UPDATE shops SET name = 'Shop' WHERE name IS NULL; UPDATE shops SET slug = CONCAT('shop-', id) WHERE slug IS NULL OR slug = '';"
	@echo "Repair complete!"

db-bash: ## Access the database container bash
	docker exec -it $(DB_CONTAINER) bash

db-sql: ## Access the MySQL prompt directly (as root)
	docker exec -it $(DB_CONTAINER) mysql -u root -p$(DB_ROOT_PASS) cleartoo

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
