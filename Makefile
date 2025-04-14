DOCKER_COMPOSE ?= docker compose
DOCKER_USER ?= "$(shell id -u):$(shell id -g)"
ENV ?= "dev"

setup:
	@echo "Setting up project..."
	@make docker.up
	@make backend.setup
	@make frontend.setup

docker.up:
	@echo "Starting docker..."
	@docker compose up -d

docker.stop:
	@echo "Stopping docker..."
	@docker compose stop

docker.down:
	@echo "Stopping and removing docker..."
	@docker compose down

backend.setup:
	@echo "Setting up backend..."
	@docker compose exec php composer install
	@docker compose exec php php bin/console doctrine:database:create --if-not-exists
	@docker compose exec php php bin/console doctrine:migrations:migrate -n
	@docker compose exec php php bin/console sylius:fixtures:load -n

frontend.setup:
	@echo "Setting up frontend..."
	@docker compose exec frontend npm install
	@docker compose exec frontend npm run build

frontend.build:
	@echo "Building frontend..."
	@docker compose exec frontend npm run build

php-shell:
	@ENV=$(ENV) DOCKER_USER=$(DOCKER_USER) $(DOCKER_COMPOSE) exec php sh

node-shell:
	@ENV=$(ENV) DOCKER_USER=$(DOCKER_USER) $(DOCKER_COMPOSE) run --rm -i nodejs sh

