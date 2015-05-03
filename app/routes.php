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

Route::get('jugadores/nuevo', ['as' => 'jugadores.create', 'uses' => 'JugadorController@create'] );
Route::post('jugadores/guardar', ['as' => 'jugadores.store', 'uses' => 'JugadorController@store' ] );
Route::get('jugadores/ver/{id}', ['as' => 'jugadores.show', 'uses' => 'JugadorController@show' ] );
Route::get('jugadores/editar/{id}',  ['as' => 'jugadores.edit','uses' => 'JugadorController@edit' ] );
Route::post('jugadores/actualizar/{id}',  ['as' => 'jugadores.update','uses' => 'JugadorController@update' ] );
Route::get('jugadores/eliminar/{id}',  ['as' => 'jugadores.destroy','uses' => 'JugadorController@destroy' ] );


Route::get('jugadores/api-eliminar',  ['as' => 'jugadores.api.eliminar','uses' => 'JugadorController@destroyApi' ] );
Route::get('jugadores/api-lista', array('as'=>'jugadores.api.lista', 'uses'=>'JugadorController@listaApi'));
Route::get('jugadores/api-equipos/{id}', array('as'=>'jugadores.api.equipos', 'uses'=>'JugadorController@equiposApi'));
Route::get('jugadores/api-cambiar-equipo/{id}', array('as'=>'jugadores.api.cambiar-equipo', 'uses'=>'JugadorController@cambiarEquipoApi'));
Route::get('jugadores/api-ver',  ['as' => 'jugadores.data','uses' => 'JugadorController@showApi' ] );
Route::get('jugadores/api-seleccionar',  ['as' => 'jugadores.seleccionar','uses' => 'JugadorController@getAllValue' ] );
Route::post('jugadores/api-actualizar',  ['as' => 'jugadores.api.update','uses' => 'JugadorController@updateApi' ] );
Route::post('jugadores/api-add-equipo',  ['as' => 'jugadores.api.add.equipo','uses' => 'JugadorController@addEquipoApi' ] );
Route::post('jugadores/api-existe',  ['as' => 'jugadores.api.existe','uses' => 'JugadorController@existeApi'] );

/*
********************************* RUTAS PARA EQUIPOS ********************************
*/

Route::get('equipos', ['as' => 'equipos.index', 'uses' => 'EquipoController@index']);
Route::get('equipos/nuevo', ['as' => 'equipos.create', 'uses' => 'EquipoController@create'] );
Route::post('equipos/guardar', ['as' => 'equipos.store', 'uses' => 'EquipoController@store' ] );
Route::get('equipos/ver/{id}', ['as' => 'equipos.show', 'uses' => 'EquipoController@show' ] );
Route::get('equipos/editar/{id}',  ['as' => 'equipos.edit','uses' => 'EquipoController@edit' ] );
Route::post('equipos/actualizar/{id}',  ['as' => 'equipos.update','uses' => 'EquipoController@update' ] );
Route::get('equipos/eliminar/{id}',  ['as' => 'equipos.delete','uses' => 'EquipoController@destroy' ] );

Route::get('equipos/api-eliminar',  ['as' => 'equipos.api.eliminar','uses' => 'EquipoController@destroyApi' ] );
Route::get('equipos/api-lista', array('as'=>'equipos.api.lista', 'uses'=>'EquipoController@listaApi'));
Route::post('equipos/api-actualizar',  ['as' => 'equipos.api.update','uses' => 'EquipoController@updateApi' ] );
Route::get('equipos/api-jugadores/{id}', array('as'=>'equipos.api.jugadores', 'uses'=>'EquipoController@jugadoresApi'));
Route::get('equipos/api-ver',  ['as' => 'equipos.data','uses' => 'EquipoController@showApi' ] );
Route::get('equipos/api-seleccionar',  ['as' => 'equipos.seleccionar','uses' => 'EquipoController@getAllValue' ] );
Route::get('equipos/api-verificar-jugador',  ['as' => 'equipos.api.verificar-jugador','uses' => 'EquipoController@confirmExistsPlayerTeam' ] );
Route::post('equipos/api-existe-numero',  ['as' => 'equipos.api.existe.numero','uses' => 'EquipoController@existeNumeroApi' ] );
Route::post('equipos/api-existe',  ['as' => 'equipos.api.existe','uses' => 'EquipoController@existeApi'] );
Route::post('equipos/api-add-jugador',  ['as' => 'equipos.api.add.jugador','uses' => 'EquipoController@addJugadorApi' ] );

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

Route::get('posiciones', ['as' => 'posiciones.index', 'uses' => 'PosicionController@index']);
Route::post('posiciones/guardar', ['as' => 'posiciones.store', 'uses' => 'PosicionController@store' ] );

Route::get('posiciones/api-ver',  ['as' => 'posiciones.data','uses' => 'PosicionController@showApi' ] );
Route::post('posiciones/api-actualizar',  ['as' => 'posiciones.api.update','uses' => 'PosicionController@updateApi' ] );
Route::get('posiciones/api-seleccionar',  ['as' => 'posiciones.seleccionar','uses' => 'PosicionController@getAllValue' ] );
Route::get('posiciones/api-lista',  ['as' => 'posiciones.api.lista','uses' => 'PosicionController@listaApi' ] );
Route::get('posiciones/api-eliminar',  ['as' => 'posiciones.api.eliminar','uses' => 'PosicionController@destroyApi' ] );
/*
********************************* RUTAS PARA TIPOS DE COMPETENCIAS ********************************
*/
Route::get('tipos-competencia', ['as' => 'tipos-competencia.index', 'uses' => 'TipoCompetenciaController@index']);
Route::get('tipos-competencia/nuevo', ['as' => 'tipos-competencia.create', 'uses' => 'TipoCompetenciaController@create'] );
Route::post('tipos-competencia/guardar', ['as' => 'tipos-competencia.store', 'uses' => 'TipoCompetenciaController@store' ] );
//Route::get('tipos-competencia/ver/{id}', ['as' => 'tipos-competencia.show', 'uses' => 'TipoCompetenciaController@show' ] );
Route::get('tipos-competencia/editar/{id}',  ['as' => 'tipos-competencia.edit','uses' => 'TipoCompetenciaController@edit' ] );
Route::post('tipos-competencia/actualizar/{id}',  ['as' => 'tipos-competencia.update','uses' => 'TipoCompetenciaController@update' ] );
Route::get('tipos-competencia/eliminar/{id}',  ['as' => 'tipos-competencia.delete','uses' => 'TipoCompetenciaController@destroy' ] );

Route::get('tipos-competencia/api-eliminar',  ['as' => 'tipos-competencia.api.eliminar','uses' => 'TipoCompetenciaController@destroyApi' ] );
Route::get('tipos-competencia/api-lista', array('as'=>'tipos-competencia.api.lista', 'uses'=>'TipoCompetenciaController@listaApi'));
Route::post('tipos-competencia/api-actualizar',  ['as' => 'tipos-competencia.api.update','uses' => 'TipoCompetenciaController@updateApi' ] );
//Route::get('tipos-competencia/api-jugadores/{id}', array('as'=>'tipos-competencia.api.jugadores', 'uses'=>'TipoCompetenciaController@jugadoresApi'));
Route::get('tipos-competencia/api-ver',  ['as' => 'tipos-competencia.data','uses' => 'TipoCompetenciaController@showApi' ] );
Route::get('tipos-competencia/seleccionar-lista',  ['as' => 'tipos-competencia.seleccionar.lista','uses' => 'TipoCompetenciaController@getAllValue' ] );
/*
********************************* RUTAS PARA COMPETENCIAS ********************************
*/
Route::get('competencias', ['as' => 'competencias.index', 'uses' => 'CompetenciaController@index']);
Route::get('competencias/nuevo', ['as' => 'competencias.create', 'uses' => 'CompetenciaController@create'] );
Route::post('competencias/guardar', ['as' => 'competencias.store', 'uses' => 'CompetenciaController@store' ] );
//Route::get('competencias/ver/{id}', ['as' => 'competencias.show', 'uses' => 'CompetenciaController@show' ] );
Route::get('competencias/editar/{id}',  ['as' => 'competencias.edit','uses' => 'CompetenciaController@edit' ] );
Route::post('competencias/actualizar/{id}',  ['as' => 'competencias.update','uses' => 'CompetenciaController@update' ] );
Route::get('competencias/eliminar/{id}',  ['as' => 'competencias.delete','uses' => 'CompetenciaController@destroy' ] );
Route::get('competencias/ver/{id}', ['as' => 'competencias.show', 'uses' => 'CompetenciaController@show' ] );

Route::get('competencias/api-eliminar',  ['as' => 'competencias.api.eliminar','uses' => 'CompetenciaController@destroyApi' ] );
Route::get('competencias/api-lista', array('as'=>'competencias.api.lista', 'uses'=>'CompetenciaController@listaApi'));
Route::post('competencias/api-actualizar',  ['as' => 'competencias.api.update','uses' => 'CompetenciaController@updateApi' ] );
//Route::get('competencias/api-jugadores/{id}', array('as'=>'competencias.api.jugadores', 'uses'=>'CompetenciaController@jugadoresApi'));
//Route::get('competencias/api-ver',  ['as' => 'competencias.data','uses' => 'CompetenciaController@showApi' ] );


Route::get('prueba-ruta/{id}',  ['as' => 'prueba','uses' => 'JugadorController@prueba' ] );
