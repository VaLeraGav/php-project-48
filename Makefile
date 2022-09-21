install:
	composer install

validate:
	composer validate

autoload:
	composer dump-autoload

gendiff:
	./bin/gendiff -h

test:
	composer exec --verbose phpunit tests

test-dox:
	./vendor/bin/phpunit tests --testdox

lint:
	composer exec --verbose phpcs -- --standard=PSR12 src bin

test-coverage:
	# composer exec --verbose phpunit tests -- --coverage-text
	composer exec -v phpunit tests -- --coverage-clover build/logs/clover.xml