# tkwapi

[Lumen](https://lumen.laravel.com/) based restaurants api application
## Prerequisites:
1. PHP
 + version >= 7.1.3
 + OpenSSL Extension
 + PDO Extension
 + Mbstring Extension

2. Composer
## Installation
1. Clone this repo locally
2. Within your local repo run:
    ```
    composer update
    ```
3. Create mysql DB
4. Copy `.env.example` file to `.env` and fill in correct DB info
5. Run the following two commands from root of the repo to create the `restaurants` table in the mysql DB

    ```
    php artisan make:migration create_restaurants_table

    php artisan migrate
    ```
6. Run the following command from root of the repo to import csv file containg data:
    ```
    php artisan import:delimited -F storage/app/restaurant.fld  -i 1 storage/app/restaurants.csv restaurants
    ```
    To verfiy that restaurants table was created and CSV imported to it, we can run the following test: 
    ```
    vendor/bin/phpunit --filter=CsvImportTest
    ```

### Running the application locally 

To run locally use the built-in PHP development server:
```php
php -S localhost:8000 -t public
```