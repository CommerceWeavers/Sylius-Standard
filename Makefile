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

shell:
	@echo "Accessing Sylius shell:"
	docker exec -it sylius-standard-php-1 /bin/sh

frontend-shell:
	@echo "Accessing Sylius shell:"
	docker exec -it sylius-standard-frontend-1 /bin/sh
