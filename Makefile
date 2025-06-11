up:
\tdocker-compose up -d --build

down:
\tdocker-compose down

test:
\tdocker-compose run --rm app composer install && docker-compose run --rm app ./vendor/bin/phpunit

bash:
\tdocker-compose run --rm app bash
