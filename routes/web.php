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
// Home
$router->get('/', 'Home@home');

// Get
// Buy
$router->get('/get/buy',                'Buy@get');
$router->get('/get/buy/id',             'Buy@id');
$router->get('/get/buy/user',           'Buy@user');
$router->get('/get/buy/timestamp',      'Buy@timestamp');

// Sell
$router->get('/get/sell', 'Sell@get');
$router->get('/get/user', 'User@get');
$router->get('/get/user/inventory', 'User@inventory_get');
$router->get('/get/product', 'Product@get');
$router->get('/get/product/price', 'Product@price_get');
$router->get('/get/transaction', 'Transaction@get');

// Set
$router->post('/set/buy', 'Buy@set');
$router->post('/set/sell', 'Sell@set');
$router->post('/set/user', 'User@set');
$router->post('/set/user/inventory', 'User@inventory_set');
$router->post('/set/product', 'Product@set');
$router->post('/set/product/price', 'Product@price_set');
$router->post('/set/transaction', 'Transaction@set');

// Update
$router->post('/update/sell', 'Sell@update');
$router->post('/update/buy', 'Buy@update');
$router->post('/update/user', 'User@update');
$router->post('/update/user/inventory', 'User@inventory_update');
$router->post('/update/product', 'Product@update');
$router->post('/update/product/price', 'Product@price_update');
$router->post('/update/transaction', 'Transaction@update');
