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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('lugares', ['uses' => 'LugaresController@index']);
    $router->get('lugares/{id}', ['uses' => 'LugaresController@show']);
    $router->post('lugares', ['uses' => 'LugaresController@store']);
    $router->put('lugares/{id}', ['uses' => 'LugaresController@update']);
    $router->delete('lugares{id}', ['uses' => 'LugaresController@destroy']);
});