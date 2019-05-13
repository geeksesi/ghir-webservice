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

/**
 * simple just for low level users ( means non admin users)
 * 
 * they just need :
 * - login
 * - set order
 * - show self order's
 * - show self position's  
 */

$router->post('/login', 'User@login');
$router->post('/{token}/order', 'Order@set');
$router->get('/{token}/order', 'Order@get');
$router->get('/{token}/order', 'Order@get');
$router->get('/{token}/position', 'Position@get');
