# tkwapi

[Lumen](https://lumen.laravel.com/) based restaurants api application
## Prerequisites:
1. PHP
 + version >= 7.1.3
 + OpenSSL Extension
 + PDO Extension
 + Mbstring Extension

2. Composer installed globally
## Installation
Installation works and has been tested on both Linux and Windows platforms
1. Clone this repo locally
2. Within your local repo run:
    ```
    composer install
    ```
3. Create mysql DB
4. Copy `.env.example` file to `.env` and fill in correct DB info
5. Run the following command from root of the repo to create the `restaurants` table in the mysql DB

    ```
    php artisan migrate
    ```
6. If migration in the last step succeeded, run the following command from root of the repo to import csv file containg data:
    ```
    php artisan import:delimited -F storage/app/restaurant.fld  -i 1 storage/app/restaurants.csv restaurants
    ```
    To verfiy that restaurants table was created and CSV imported to it, we can run the following test written to check if one of the restaurants from CSV is found in the DB: 
    ```
    vendor/bin/phpunit --filter=CsvImportTest
    ```

### Running the application locally 

To run locally use the built-in PHP development server:
```php
php -S localhost:8000 -t public
```
*If port 8000 is in use, you can specify some other available port

### Running PHPUnit tests
Tests are located in the ```/tests``` folder and you can run them all via following command: 
```
vendor/bin/phpunit
```

## Fetching the data
If all of the installation steps were successfull, tests passed and application is running you can fetch the data by sending GET requests to the following endpoint:  

```
http://localhost:8000/v1/restaurant
```
Response contains the JSON with all of the restaurants sorted by open state (opened on top), popularity (high to low) and name alphabetically.

It is also possible to use following sort and filter options:
* open (define open state of the returned list of restaurants)
* sort (by multiple available attributes)
* s (for searching by name) 

Following are examples of requests with above mentioned sort and filter options:

1. Fetch open restaurants only: 
    ```
    GET /v1/restaurant?open=2
    ```
    where fetched restaurants would still have the default sorting by popularity and name

2. Fetch restaurants sorted by some other attribute(s):
    ```
    GET /v1/restaurant?sort=bestMatch
    ```
    where fetched restaurants would be sorted by ```bestMatch```(*) attribute, ascending. If it is necessary to get response with descending sorting, then all it takes is to place a dash (-) before the attribute name, like so: 
    ```
    GET /v1/restaurant?sort=-bestMatch
    ```
    which returns restaurants sorted by ```bestMatch```(*) attribute, descending. 

    ```/v1/restaurant``` endpoint also supports combination of sorting attributes, comma separated: 
    ```
    GET /v1/restaurant?sort=-bestMatch,averageProductPrice
    ```
    which returns restaurants sorted by ```bestMatch``` high to low, and ```averageProductPrice``` low to high(*)(**)

    `*` Important notice: When using ```sort``` parameter, fetched restaurants would still be sorted by open state first (opened to closed), unless ```open``` attribute is explicitly sent as well 
    
    `**` Order of ```sort``` parameters matter, following two requests would return differently sorted lists:
    ```
    GET /v1/restaurant?sort=-bestMatch,averageProductPrice
    GET /v1/restaurant?sort=averageProductPrice,-bestMatch

    ```
    First request would sort results by ```bestMatch``` first, and then by ```averageProductPrice```, whereas second request would return vice-versa sorting

3. Fetch restaurants filtered by requested name:
    ```
    GET /v1/restaurant?s=pizza
    ```
    which returns list of restaurants that have "pizza" (case insensitive) within their name. Default sorting by open state and priority still applies here

4. Finally, it is possible to combine two, or even all of the three available filter and sort params: 
    ```
    GET /v1/restaurant?s=pizza&open=2&sort=-ratingAverage,averageProductPrice
    ```
    which returns list of ```open``` restaurants, with ```"pizza"``` in the restaurant name, sorted by ```ratingAverage``` high to low and ```averageProductPrice``` low to high