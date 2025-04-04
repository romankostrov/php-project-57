PORT ?= 8000
start:
	PHP_CLI_SERVER_WORKERS=5 php -S 0.0.0.0:$(PORT) -t public

install:
	composer install
	cp -n .env.example .env
	php artisan key:gen --ansi
	php artisan migrate --force
	php artisan db:seed --force
	npm ci
	npm run build
	make ide-helper

install-prod:
	composer install
	cp -n .env.example .env
	php artisan key:gen --ansi
	php artisan migrate:fresh --seed --force
	npm ci
	npm run build

install-test:
	composer install
	cp -n .env.example.test .env
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate --force
	php artisan db:seed --force
	npm ci
	npm run build

test:
	php artisan test

test-coverage:
	XDEBUG_MODE=coverage php artisan test --coverage-clover build/logs/clover.xml

ide-helper:
	php artisan ide-helper:eloquent
	php artisan ide-helper:gen
	php artisan ide-helper:meta
	php artisan ide-helper:mod -n

