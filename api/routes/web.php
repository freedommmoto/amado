<?php

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

header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/product', [
    'as' => 'product', 'uses' => 'MockController@getTest'
]);

$router->put('/product/{id}/update', [
    'as' => 'picture', 'uses' => 'ProductController@uploadImage'
]);

$router->post('/product/add', [
    'as' => 'picture', 'uses' => 'ProductController@uploadImage'
]);
