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
Route::post('modificar-jugador',  ['as' => 'jugadores.update','uses' => 'JugadorController@update' ] );


Route::get('jugadores/api-eliminar/{id}',  ['as' => 'jugadores.api.eliminar','uses' => 'JugadorController@destroyApi' ] );
Route::get('jugadores/api-lista', array('as'=>'jugadores.api.lista', 'uses'=>'JugadorController@listaApi'));
Route::get('jugadores/api-cambiar-equipo/{id}', array('as'=>'jugadores.api.cambiar-equipo', 'uses'=>'JugadorController@cambiarEquipoApi'));
Route::get('jugadores/api-ver/{id}',  ['as' => 'jugadores.data','uses' => 'JugadorController@showApi' ] );

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

Route::get('equipos/api-eliminar/{id}',  ['as' => 'equipos.api.eliminar','uses' => 'EquipoController@destroyApi' ] );
Route::get('equipos/api-lista', array('as'=>'equipos.api.lista', 'uses'=>'EquipoController@listaApi'));
Route::get('equipos/api-jugadores/{id}', array('as'=>'equipos.api.jugadores', 'uses'=>'EquipoController@jugadoresApi'));


/*
********************************* RUTAS PARA PAISES ********************************
*/

Route::get('lista-paises',  ['as' => 'paises.lista','uses' => 'PaisController@getAllValue' ] );

/*
********************************* RUTAS PARA POSICIONES ********************************
*/

Route::get('lista-posiciones',  ['as' => 'posiciones.lista','uses' => 'PosicionController@getAllValue' ] );