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

$router->get('/set/sell', 'Set@sell');
$router->get('/set/buy', 'Set@buy');
$router->get('/set/user', 'Set@user');
$router->get('/set/product', 'Set@product');
$router->get('/set/product_price', 'Set@product_price');

$router->get('/update/sell', 'Update@sell');
$router->get('/update/buy', 'Update@buy');
$router->get('/update/user', 'Update@user');
$router->get('/update/product', 'Update@product');
$router->get('/update/product_price', 'Update@product_price');
