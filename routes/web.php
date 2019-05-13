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
$router->get('/get/sell',                'Sell@get');
$router->get('/get/sell/id',             'Sell@id');
$router->get('/get/sell/user',           'Sell@user');
$router->get('/get/sell/timestamp',      'Sell@timestamp');

// Position 
$router->get('/get/position',           'Position@get');
$router->get('/get/position/id',        'Position@id');
$router->get('/get/position/type',        'Position@type');
$router->get('/get/position/user',      'Position@user');
$router->get('/get/position/timestamp', 'Position@timestamp');


// User
$router->get('/get/user',  'User@get');
$router->post('/get/user/auth',  'User@auth');

// Account
$router->get('/get/account', 'Account@get');



// Set
$router->post('/set/buy', 'Buy@set');
$router->post('/set/sell', 'Sell@set');
$router->post('/set/user', 'User@set');
$router->post('/set/position', 'Position@set');
$router->post('/set/account', 'Account@set');

// Update
$router->post('/update/sell', 'Sell@update');
$router->post('/update/buy', 'Buy@update');
$router->post('/update/user', 'User@update');
$router->post('/update/position', 'Position@update');
$router->post('/update/account', 'Account@update');
