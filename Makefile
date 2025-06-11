# Sobe os containers em segundo plano com build
up:
	docker compose up -d --build

# Derruba todos os containers
down:
	docker compose down

# Executa os testes PHPUnit
test:
	docker compose run --rm app vendor/bin/phpunit tests

# Acessa o bash do container app
bash:
	docker compose run --rm app bash

# Reconstrói a imagem (sem cache) e sobe os containers
rebuild:
	docker compose build --no-cache
	docker compose up -d
