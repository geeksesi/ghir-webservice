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

$router->get('/', 'Home');

$router->get('/get/sell', 'Get@sell');
$router->get('/get/buy', 'Get@buy');
$router->get('/get/user', 'Get@user');
$router->get('/get/product', 'Get@product');

$router->post('/set/sell', 'Set@sell');
$router->post('/set/buy', 'Set@buy');
$router->post('/set/user', 'Set@user');
$router->post('/set/product', 'Set@product');
$router->post('/set/product_price', 'Set@product_price');

$router->post('/update/sell', 'Update@sell');
$router->post('/update/buy', 'Update@buy');
$router->post('/update/user', 'Update@user');
$router->post('/update/product', 'Update@product');
$router->post('/update/product_price', 'Update@product_price');
