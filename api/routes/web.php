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

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->get('/', function () use ($router) {
        return $router->app->version();
    });

    $router->get('/product/test', [
        'as' => 'product', 'uses' => 'MockController@getTest'
    ]);

    $router->get('/product/all', [
        'as' => 'productAll', 'uses' => 'ProductController@getAll'
    ]);

    $router->put('/product/{id}/update', [
        'as' => 'picture', 'uses' => 'ProductController@uploadImage'
    ]);

    $router->post('/order/new', [
        'as' => 'newOrder', 'uses' => 'OrderController@newOrder'
    ]);

    $router->post('/login', [
        'as' => 'userLogin', 'uses' => 'AuthController@login'
    ]);

    $router->group(['middleware' => 'auth:api'], function ($router) {

        $router->post('/product/add', [
            'as' => 'picture', 'uses' => 'ProductController@add'
        ]);

        $router->post('/user/profile', [
            'as' => 'auth', 'uses' => 'UserController@profile'
        ]);
    });


});
