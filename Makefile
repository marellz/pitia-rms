up:
	docker-compose up -d

setup:
	cp .env.example .env

rebuild:
	docker-compose up --build

down: 
	docker-compose down

prod-build:
	docker-compose --file docker-compose.prod.yml up --force-recreate --build


config-cache:
	docker exec -ti pitia-api php artisan config:cache

key-generate:
	docker exec -ti pitia-api php artisan key-generate

migrate:
	docker exec -ti pitia-api php artisan migrate

migrate-fresh:
	docker exec -ti pitia-api php artisan migrate:fresh

migrate-seed:
	docker exec -ti pitia-api php artisan migrate:fresh --seed

db-seed:
	docker exec -ti pitia-api php artisan db:seed

api-update: key-generate config-cache migrate