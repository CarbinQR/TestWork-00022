init: docker-down-clear \
	docker-build docker-up \
	backend-composer-install backend-make-env backend-generate-key backend-generate-jwt-secret backend-migrations
up: docker-up
down: docker-down
restart: down up
lint: backend-lint
doc: backend-generate-api-doc

docker-up:
	docker compose up -d

docker-down:
	docker compose down --remove-orphans

docker-down-clear:
	docker compose down -v --remove-orphans

docker-build:
	docker compose build

backend-lint:
	docker compose run --rm backend-php-cli composer lint
	docker compose run --rm backend-php-cli composer php-cs-fixer fix -- --dry-run --diff

backend-cs-fixer:
	docker compose run --rm backend-php-cli composer php-cs-fixer fix

backend-composer-update:
	docker compose run --rm backend-php-cli composer update

backend-composer-install:
	docker compose run --rm backend-php-cli composer install

backend-migrations:
	docker compose run --rm backend-php-cli php artisan migrate --no-interaction

backend-make-env:
	docker compose run --rm backend-php-cli cp .env.example .env

backend-generate-key:
	docker compose run --rm backend-php-cli php artisan key:generate

backend-generate-jwt-secret:
	docker compose run --rm backend-php-cli php artisan jwt:secret

backend-generate-api-doc:
	docker compose run --rm backend-php-cli ./vendor/bin/openapi --format json app/Api/V1/Action -o public/docs/openapi.json
