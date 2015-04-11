<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', [
	//'before' => 'auth',
	'as' => 'pages.home',
	'uses' => 'PageController@index'
]);

/* Ruta para jugadores*/

Route::get('jugadores', [
	'as' => 'jugadores.index', 
	'uses' => 'JugadorController@index'
]);

Route::get('crear-jugador', ['as' => 'jugadores.create', 'uses' => 'JugadorController@create'] );
Route::post('agregar-jugador', ['as' => 'jugadores.store', 'uses' => 'JugadorController@store' ] );
Route::get('ver-jugador', ['as' => 'jugadores.show', 'uses' => 'JugadorController@show' ] );
Route::get('editar-jugador',  ['as' => 'jugadores.edit','uses' => 'JugadorController@edit' ] );
Route::get('eliminar-jugador',  ['as' => 'jugadores.delete-ajax','uses' => 'JugadorController@destroy' ] );
Route::post('modificar-jugador',  ['as' => 'jugadores.update','uses' => 'JugadorController@update' ] );
Route::get('datos-jugador',  ['as' => 'jugadores.data','uses' => 'JugadorController@getData' ] );


Route::get('api/jugadores', array('as'=>'api.jugadores', 'uses'=>'JugadorController@listadoJugadores'));

/*Rutas para paises*/
Route::get('lista-paises',  ['as' => 'paises.lista','uses' => 'PaisController@getAllValue' ] );

/*Rutas para posiciones*/
Route::get('lista-posiciones',  ['as' => 'posiciones.lista','uses' => 'PosicionController@getAllValue' ] );