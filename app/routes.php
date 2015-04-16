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

/*
********************************* RUTAS PARA JUGADORES ********************************
*/

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

/*
********************************* RUTAS PARA EQUIPOS ********************************
*/

Route::get('equipos', ['as' => 'equipos.index', 'uses' => 'EquipoController@index']);
Route::get('equipos/nuevo', ['as' => 'equipos.create', 'uses' => 'EquipoController@create'] );
Route::post('equipos/guardar', ['as' => 'equipos.store', 'uses' => 'EquipoController@store' ] );
Route::get('equipos/ver/{id}', ['as' => 'equipos.show', 'uses' => 'EquipoController@show' ] );
Route::get('equipos/editar/{id}',  ['as' => 'equipos.edit','uses' => 'EquipoController@edit' ] );
Route::post('equipos/actualizar',  ['as' => 'equipos.update','uses' => 'EquipoController@update' ] );
Route::get('equipos/eliminar/{id}',  ['as' => 'equipos.delete','uses' => 'EquipoController@destroy' ] );

Route::get('equipos/api-ver/{id}',  ['as' => 'equipos.api.show','uses' => 'EquipoController@showApi' ] );
Route::get('equipos/api-lista', array('as'=>'equipos.api.lista', 'uses'=>'EquipoController@listaApi'));


/*
********************************* RUTAS PARA PAISES ********************************
*/
Route::get('lista-paises',  ['as' => 'paises.lista','uses' => 'PaisController@getAllValue' ] );
/*
********************************* RUTAS PARA POSICIONES ********************************
*/
Route::get('lista-posiciones',  ['as' => 'posiciones.lista','uses' => 'PosicionController@getAllValue' ] );