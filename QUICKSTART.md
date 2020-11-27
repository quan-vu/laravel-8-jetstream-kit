# Laravel 8 Starter

Step 1: Install libraries with composer

```shell
composer install
```

Step 2: Install Vue

```shell
yarn install && yarn dev
```

Step 3: Run migration database

```shell
php artisan migrate
# php artisan migrate:refresh --seed
php artisan storage:link
php artisan serve
```


## Admin Dashboard

Login

```
admin@laravel8.com / Admin@123
```

## Testing

Use Laravel testing

```shell
# Run unit test only
make test-unit

# Run feature test only
make test-feature

# Run all test
make test
```

Use PHPUnit testing

```shell
# Run unit test only
make phpunit-uinit

# Run feature test only
make phpunit-feature

# Run all test
make phpunit
```

## Reference

- https://jetstream.laravel.com/1.x/installation.html

