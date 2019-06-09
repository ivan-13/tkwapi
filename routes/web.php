<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/**
 * Routes for resource restaurant
 */
$router->get('v1/restaurant', 'RestaurantsController@index');
$router->get('v1/restaurant/{id}', 'RestaurantsController@get');