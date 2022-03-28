<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->get('/', function(){
    return "Hallo selamat datang di Lumen";
});

// router untuk post produk
$router->post('/produk', 'ProdukController@create');

// router untuk get all produk
$router->get('/produk', 'ProdukController@index');

// router untuk get produk berdasarkan id
$router->get('/produk/{id}', 'ProdukController@show');

// router untuk update produk
$router->put('/produk/{id}', 'ProdukController@update');

// router untuk delete produk
$router->delete('/produk/{id}', 'ProdukController@delete');

// router untuk register user
$router->post('/user/register', 'UserControlller@register');

// router show alluser
$router->get('/user', 'UserControlller@showUser');