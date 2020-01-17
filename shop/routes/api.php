<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\LoginController@login');

Route::middleware([])->group( function () {
    Route::resource('produtos', 'API\ProdutoController');
    Route::resource('pedidos', 'API\PedidoController');
});
Route::middleware(['auth:api'])->group( function () {
    Route::get('historico/produto/{id}', 'API\ProdutoController@historico');
});