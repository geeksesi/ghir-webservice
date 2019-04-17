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
$router->get('/get/buy/status',       'Buy@status');
$router->get('/get/buy/id',           'Buy@id');
$router->get('/get/buy/user',      'Buy@user');
$router->get('/get/buy/product',   'Buy@product');
$router->get('/get/buy/timestamp',      'Buy@timestamp');
$router->get('/get/buy/history',        'Buy@TimeStamp');
// Sell
$router->get('/get/sell', 'Sell@get');
$router->get('/get/user', 'User@get');
$router->get('/get/user/inventory', 'User@inventory_get');
$router->get('/get/product', 'Product@get');
$router->get('/get/product/price', 'Product@price_get');
$router->get('/get/transaction', 'Transaction@get');

// Set
$router->get('/set/sell', 'Sell@set');
$router->get('/set/buy', 'Buy@set');
$router->get('/set/user', 'User@set');
$router->get('/set/user/inventory', 'User@inventory_set');
$router->get('/set/product', 'Product@set');
$router->get('/set/product/price', 'Product@price_set');
$router->get('/set/transaction', 'Transaction@set');

// Update
$router->get('/update/sell', 'Sell@update');
$router->get('/update/buy', 'Buy@update');
$router->get('/update/user', 'User@update');
$router->get('/update/user/inventory', 'User@inventory_update');
$router->get('/update/product', 'Product@update');
$router->get('/update/product/price', 'Product@price_update');
$router->get('/update/transaction', 'Transaction@update');
