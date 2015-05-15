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

Route::get('test', function() {
	$gr = new soccer\Group\GroupRepository();
	$group = $gr->get(2);
	//dd($group->games()->whereLocalTeamId(3)->first());
	//return $gr->gameAlreadyExists(2, 4, 5);
	//dd($gr->getTeamsWithoutFullGames(2)->toArray());
	$team = $gr->getTeamsWithoutFullGames(2)->first();
	$competition = $group->competition->first();
	//dd($competition->teams->toArray());
	//dd($team->toArray());
	dd($team->competitions->toArray());
});

Route::get('/', [
	//'before' => 'auth',
	'as' => 'pages.home',
	'uses' => 'PageController@index'
]);

/*
********************************* RUTAS PARA JUGADORES ********************************
*/

Route::get('jugadores', ['as' => 'players.index', 'uses' => 'PlayerController@index']);

Route::get('jugadores/nuevo', ['as' => 'players.create', 'uses' => 'PlayerController@create'] );
Route::post('jugadores/guardar', ['as' => 'players.store', 'uses' => 'PlayerController@store' ] );
Route::get('jugadores/ver/{id}', ['as' => 'players.show', 'uses' => 'PlayerController@show' ] );
Route::get('jugadores/editar/{id}',  ['as' => 'players.edit','uses' => 'PlayerController@edit' ] );
Route::post('jugadores/actualizar/{id}',  ['as' => 'players.update','uses' => 'PlayerController@update' ] );
Route::get('jugadores/eliminar/{id}',  ['as' => 'players.destroy','uses' => 'PlayerController@destroy' ] );


Route::get('jugadores/api-eliminar',  ['as' => 'players.api.delete','uses' => 'PlayerController@destroyApi' ] );
Route::get('jugadores/api-lista', array('as'=>'players.api.list', 'uses'=>'PlayerController@listApi'));
Route::get('jugadores/api-equipos/{id}', array('as'=>'players.api.teams', 'uses'=>'PlayerController@teamsApi'));
Route::get('jugadores/api-cambiar-equipo/{id}', array('as'=>'players.api.change-team', 'uses'=>'PlayerController@changeTeamApi'));
Route::get('jugadores/api-ver',  ['as' => 'players.api.show','uses' => 'PlayerController@showApi' ] );
Route::get('jugadores/api-seleccionar-lista',  ['as' => 'players.api.select.list','uses' => 'PlayerController@getAllValue' ] );
Route::post('jugadores/api-actualizar',  ['as' => 'players.api.update','uses' => 'PlayerController@updateApi' ] );
Route::post('jugadores/api-add-equipo',  ['as' => 'players.api.add.team','uses' => 'PlayerController@addTeamApi' ] );
Route::post('jugadores/api-existe',  ['as' => 'players.api.exist','uses' => 'PlayerController@existApi'] );

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
Route::get('equipos/api-ver',  ['as' => 'equipos.api.show','uses' => 'EquipoController@showApi' ] );
Route::get('equipos/api-seleccionar-lista',  ['as' => 'equipos.api.select.list','uses' => 'EquipoController@getAllValue' ] );
Route::get('equipos/api-verificar-jugador',  ['as' => 'equipos.api.verificar-jugador','uses' => 'EquipoController@confirmExistsPlayerTeam' ] );
Route::post('equipos/api-existe-numero',  ['as' => 'equipos.api.existe.numero','uses' => 'EquipoController@existeNumeroApi' ] );
Route::post('equipos/api-existe',  ['as' => 'equipos.api.existe','uses' => 'EquipoController@existeApi'] );
Route::post('equipos/api-add-jugador',  ['as' => 'equipos.api.add.jugador','uses' => 'EquipoController@addJugadorApi' ] );

/*
********************************* RUTAS PARA PAISES ********************************
*/

Route::get('paises/api-seleccionar-lista',  ['as' => 'paises.api.select.list','uses' => 'PaisController@getAllValue' ] );
Route::get('paises', ['as' => 'paises.index', 'uses' => 'PaisController@index']);
Route::get('paises/nuevo', ['as' => 'paises.create', 'uses' => 'PaisController@create'] );
Route::post('paises/guardar', ['as' => 'paises.store', 'uses' => 'PaisController@store' ] );
Route::get('paises/ver/{id}', ['as' => 'paises.show', 'uses' => 'PaisController@show' ] );
Route::get('paises/editar/{id}',  ['as' => 'paises.edit','uses' => 'PaisController@edit' ] );
Route::post('paises/actualizar',  ['as' => 'paises.update','uses' => 'PaisController@update' ] );
Route::get('paises/eliminar',  ['as' => 'paises.delete-ajax','uses' => 'PaisController@destroy' ] );

Route::get('paises/api-ver',  ['as' => 'paises.api.show','uses' => 'PaisController@showApi' ] );
Route::get('paises/api-lista', array('as'=>'paises.api.lista', 'uses'=>'PaisController@listaApi'));

/*
********************************* RUTAS PARA POSICIONES ********************************
*/

Route::get('posiciones', ['as' => 'posiciones.index', 'uses' => 'PosicionController@index']);
Route::post('posiciones/guardar', ['as' => 'posiciones.store', 'uses' => 'PosicionController@store' ] );

Route::get('posiciones/api-ver',  ['as' => 'posiciones.api.show','uses' => 'PosicionController@showApi' ] );
Route::post('posiciones/api-actualizar',  ['as' => 'posiciones.api.update','uses' => 'PosicionController@updateApi' ] );
Route::get('posiciones/api-seleccionar-lista',  ['as' => 'posiciones.api.select.list','uses' => 'PosicionController@getAllValue' ] );
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
Route::get('tipos-competencia/api-ver',  ['as' => 'tipos-competencia.api.show','uses' => 'TipoCompetenciaController@showApi' ] );
Route::get('tipos-competencia/api-seleccionar-lista',  ['as' => 'tipos-competencia.api.select.list','uses' => 'TipoCompetenciaController@getAllValue' ] );
/*
********************************* RUTAS PARA COMPETENCIAS ********************************
*/
Route::get('competencias', ['as' => 'competencias.index', 'uses' => 'CompetitionController@index']);
Route::get('competencias/nuevo', ['as' => 'competencias.create', 'uses' => 'CompetitionController@create'] );
Route::post('competencias/guardar', ['as' => 'competencias.store', 'uses' => 'CompetitionController@store' ] );
Route::get('competencias/ver/{id}', ['as' => 'competitions.show', 'uses' => 'CompetitionController@show' ] );
Route::get('competencias/editar/{id}',  ['as' => 'competencias.edit','uses' => 'CompetitionController@edit' ] );
Route::post('competencias/actualizar/{id}',  ['as' => 'competencias.update','uses' => 'CompetitionController@update' ] );
Route::get('competencias/eliminar/{id}',  ['as' => 'competencias.delete','uses' => 'CompetitionController@destroy' ] );
Route::get('competencias/ver/{id}', ['as' => 'competencias.show', 'uses' => 'CompetitionController@show' ] );

Route::get('competencias/api-eliminar',  ['as' => 'competencias.api.eliminar','uses' => 'CompetitionController@destroyApi' ] );
Route::get('competencias/api-lista', array('as'=>'competitions.api.list', 'uses'=>'CompetitionController@listApi'));
Route::post('competencias/api-actualizar',  ['as' => 'competencias.api.update','uses' => 'CompetitionController@updateApi' ] );
//Route::get('competencias/api-jugadores/{id}', array('as'=>'competencias.api.jugadores', 'uses'=>'CompetitionController@jugadoresApi'));
//Route::get('competencias/api-ver',  ['as' => 'competencias.data','uses' => 'CompetitionController@showApi' ] );
//Route::post('competencias/api-agregar-equipo/{id}/{teamId}',  ['as' => 'competitions.api.add.team','uses' => 'CompetitionController@addTeamApi' ] );
Route::post('competencias/api-agregar-grupo',  ['as' => 'competitions.api.add.group','uses' => 'CompetitionController@addGroupApi' ] );
Route::get('competencias/api-seleccionar-lista',  ['as' => 'competitions.api.select.list','uses' => 'CompetitionController@getAllValue' ] );

Route::get('prueba-ruta/{id}',  ['as' => 'prueba','uses' => 'PlayerController@prueba' ] );
Route::get('selctAjax',  ['as' => 'selctAjax','uses' => 'PlayerController@selctAjax' ] );
Route::get('filterAjax',  ['as' => 'filterAjax.api','uses' => 'PlayerController@filter' ] );

/*
********************************* RUTAS PARA GRUPOS ********************************
*/
Route::post('grupos/api-agregar-equipo', ['as' => 'groups.api.add.team', 'uses' => 'GroupController@addTeamApi']);
Route::post('grupos/api-agregar-juego', ['as' => 'groups.api.add.game', 'uses' => 'GroupController@addGameApi']);
Route::get('grupos/api-lista-grupo/{id}', ['as' => 'groups.api.list.group', 'uses' => 'GroupController@listGroupApi']);
Route::get('grupos/api-equipos-disponibles/{id}', ['as' => 'groups.api.available.teams', 'uses' => 'GroupController@getAvailableTeams']);
