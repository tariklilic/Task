<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## How to Install

First after downloading this app you will need to run:

```sh
composer install
```


After installation you will need to add .env or edit .env.example to .env and add your database credentials


After that run the command to generate your jwt secret

```sh
php artisan jwt:secret 
```

Next, you will need to run migrations in exact order

```sh
php artisan migrate --path=/database/migrations/2023_04_14_155018_create_movies_table.php 
php artisan migrate --path=/database/migrations/2023_04_15_184136_create_users_table.php 
php artisan db:seed 
```

After that you will need to run migrations for other tables

```sh
php artisan migrate
```

Now that you have successfully created your laravel project and database you can start laravel server with

```sh
php artisan serve
```

In folder Postman-collection you have 4 collection that you can import into your postman in order to test the application



