phpstan:
	./vendor/bin/phpstan analyse

migrate:
	php artisan migrate

rollback:
	php artisan migrate:rollback
