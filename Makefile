# Quick Laravel CLI with Makefile

# == Git repo ==
repo=my_awesome_repo
# === Artisan ====
p=8000
# ===== DB =======
db_username=user
db_password=password
db_name=laravel
db_file=my_db.sql
# === Server connection =====
port=8080
url=ssh@myip
# = Requirements =
file="requirements.txt"
# ================


help:		##Shows help
	@cat makefile | grep "##." | sed '2d;s/##//;s/://'


# ========== Laravel
serve:
	@php artisan serve --port $(p)

migrate:
	@php artisan migrate

rollback:	##Does a rollback
	@php artisan migrate:rollback

cache:
	@php artisan cache:clear
	@php artisan config:clear

seed-db:
	@composer dumpautoload
	@php artisan db:seed

seed-one:
	@php artisan db:seed --class=$$name

# ========== Composer
composer:
	@composer install

load:
	@composer dumpautoload

composer-require:
	@composer require $$name
	@make test

connect:		##Connects to server
	@ssh $(url) -p$(port)


db-sync:		##Gets database from server and syncs it with local. Requires db_username, db_password, db_name
	@echo "Downloading development DB, trying to connect to server"
	@scp -P $(port) $(url):$(db_file) .
	@echo "Populating local DB, this may take a while"
	@mysql -u $(db_username) --password=$(db_password) $(db_name) < $(db_file)


db-connect:	##Connects to local database
	@mysql -u $(db_username) -p$(db_password) $(db_name)


install:		##Installs dependencies from a given path (requirements.txt by default)
	@sudo apt-get install $(<$(file))


up:		install db-sync	##then installs composer, clones the repo and enables mcrypt
	@echo "Setting composer"
	@curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
	@echo "Cloning repo"
	@git clone $(repo)
	@echo "Enabling mcrypt"
	@sudo php5enmod mcrypt

# ========== Redis
redis-queue:
	@php artisan horizon


# ========== Testing
# Make sure to clear your configuration cache
# before running your tests!

# Create a test in the Feature directory...
feature-test:
	@php artisan make:test $$name

# Create a test in the Unit directory...

test-feature:
	@php artisan test --testsuite=Feature --stop-on-failure

test-unit:
	@php artisan test --testsuite=Unit --stop-on-failure

test:
	@php artisan test
	./vendor/bin/phpunit --coverage-html reports/coverage

test-create-unit:
	@php artisan make:test $$name --unit

test-create-feature:
	@php artisan make:test $$name

phpunit-coverage:
	@php artisan config:clear
	./vendor/bin/phpunit --coverage-html reports/coverage

phpunit-feature:
	@php artisan config:clear
	./vendor/bin/phpunit -c phpunit.xml --coverage-html reports/coverage $(phpunitOptions) --coverage-clover reports/clover.xml --log-junit reports/junit.xml

phpunit-unit:
	@php artisan config:clear
	./vendor/bin/phpunit -c phpunit.xml --coverage-html reports/coverage $(phpunitOptions) --coverage-clover reports/clover.xml --log-junit reports/junit.xml


phpunit:
	@make phpunit-unit
	@make phpunit-feature
	@make phpunit-coverage

# ========== Workflow
start:
	@make composer
	@make load
	@make serve

restart:
	@make cache
	@make composer
	@make load
	@make serve

clean:
	@rm -rf vendor
	@make composer
	@make cache
	@make load

.PHONY: help