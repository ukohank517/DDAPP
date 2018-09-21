all:

rdb:
	php artisan migrate:refresh --seed
