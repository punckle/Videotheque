install:
	docker-compose build
	docker-compose up -d

start:
	docker-compose up -d
	@echo "started on http://127.0.0.1:8744/"
	@echo "PMA on http://127.0.0.1:8084/"

console:
	docker exec -it www_videotheque bash

stop:
	docker-compose stop

wp-watch:
	node_modules/.bin/encore dev --watch

php-stan:
    vendor/bin/phpstan analyse src --memory-limit=-1