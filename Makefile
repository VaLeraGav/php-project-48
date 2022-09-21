install:
	composer install

validate:
	composer validate

test:
	composer exec --verbose phpunit tests

test-dox:
	./vendor/bin/phpunit tests --testdox

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin

test-coverage:
	composer exec -v phpunit tests -- --coverage-clover build/logs/clover.xml