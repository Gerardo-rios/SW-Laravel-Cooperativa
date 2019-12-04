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


$router->get('/hola', 'ControladorPrueba@index');


$router->group(['prefix'=>'cliente'], function($router){

	$router->get('', 'ControladorCliente@index');

	$router->get('/all', 'ControladorCliente@index');

	$router->get('/get/{cedula}', 'ControladorCliente@getCliente');

	$router->get('/obt/{apellido}', 'ControladorCliente@getClienteApe');

	$router->post('/create', 'ControladorCliente@createCliente');

	$router->put('/modi/{cedula}', 'ControladorCliente@putCliente');

});

$router->group(['prefix'=>'usuario'], function($router){

	$router->post('/logear', 'ControladorUser@login');

});

$router->group(['prefix'=>'transa'], function($router){

	$router->post('', 'ControladorTransa@transaccion');

});

$router->group(['prefix'=>'cuenta'], function($router){

	$router->get('', 'ControladorCuenta@index');

	$router->get('/get/{numero}', 'ControladorCuenta@getCuenta');

	$router->post('/create_to/{cedula}', 'ControladorCuenta@crearCuenta');
	
	$router->get('/cliente_cuentas/{cedula}', 'ControladorCuenta@cuentasCliente');

});


