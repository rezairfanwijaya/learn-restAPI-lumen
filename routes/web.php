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
$router->get('/', function(){
    return "Hallo selamat datang di Lumen";
});

// router untuk post produk
$router->post('/produk', 'ProdukController@create');

// router untuk get produk
$router->get('/produk', 'ProdukController@index');

// router untuk update produk
$router->put('/produk/{id}', 'ProdukController@update');