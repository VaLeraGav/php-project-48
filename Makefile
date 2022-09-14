install:
	composer install

validate:
	composer validate

autoload:
	composer dump-autoload

test:
	composer exec --verbose phpunit tests

test-dox:
	./vendor/bin/phpunit tests --testdox

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin

