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
Route::get('paises', ['as' => 'paises.index', 'uses' => 'PaisController@index']);
Route::get('paises/nuevo', ['as' => 'paises.create', 'uses' => 'PaisController@create'] );
Route::post('paises/guardar', ['as' => 'paises.store', 'uses' => 'PaisController@store' ] );
Route::get('paises/ver/{id}', ['as' => 'paises.show', 'uses' => 'PaisController@show' ] );
Route::get('paises/editar/{id}',  ['as' => 'paises.edit','uses' => 'PaisController@edit' ] );
Route::post('paises/actualizar',  ['as' => 'paises.update','uses' => 'PaisController@update' ] );
Route::get('paises/eliminar',  ['as' => 'paises.delete-ajax','uses' => 'PaisController@destroy' ] );
Route::get('datos-pais',  ['as' => 'paises.data','uses' => 'PaisController@getData' ] );

Route::get('paises/api-ver/{id}',  ['as' => 'paises.api.show','uses' => 'PaisController@showApi' ] );
Route::get('paises/api-lista', array('as'=>'paises.api.lista', 'uses'=>'PaisController@listaApi'));
/*
********************************* RUTAS PARA POSICIONES ********************************
*/
Route::get('lista-posiciones',  ['as' => 'posiciones.lista','uses' => 'PosicionController@getAllValue' ] );