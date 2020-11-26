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


serve:		##Serves the environment into given port (8000 by default)
	@php artisan serve --port $(p)


composer:	## Composer install
	@composer install

load:		##Dumps the autoloader
	@composer dumpautoload

migrate:		##Runs migrations
	@php artisan migrate


rollback:	##Does a rollback
	@php artisan migrate:rollback


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


start:
	@make composer
	@make load
	@make serve

.PHONY: help