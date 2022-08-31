<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'tesapi'], function () use ($router) {
    $router->post('/api/register', 'AuthController@register');
    $router->post('/api/login', 'AuthController@login');
    $router->post('/api/logout', 'AuthController@logout');
});

$router->group(['prefix' => 'testapi', 'middleware' => 'auth'], function () use ($router) {
    $router->get('/api', 'ProductController@index');
    $router->get('/api/{id}', 'ProductController@detail');
    $router->post('/api/create', 'ProductController@store');
    $router->put('/api/update/{id}', 'ProductController@update');
    $router->delete('/api/delete', 'ProductController@destroy');
});
