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
	$gR = new soccer\Game\GameRepository;
	dd($gR->getFixtures(6)->toArray());
});

Route::get('prueba-ruta/{id}',  ['as' => 'prueba','uses' => 'PlayerController@prueba' ] );
Route::get('selctAjax',  ['as' => 'selctAjax','uses' => 'PlayerController@selctAjax' ] );
Route::get('filterAjax',  ['as' => 'filterAjax.api','uses' => 'PlayerController@filter' ] );

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
Route::post('competencias/api-agregar-fase',  ['as' => 'competitions.api.add.phase','uses' => 'CompetitionController@addPhaseApi' ] );
Route::get('competencias/api-seleccionar-lista',  ['as' => 'competitions.api.select.list','uses' => 'CompetitionController@getAllValue' ] );
Route::get('competencias/api-equipos-disponibles/{id}', ['as' => 'competitions.api.available.teams', 'uses' => 'CompetitionController@getAvailableTeams']);

/*
********************************* RUTAS PARA FASES ********************************
*/
Route::get('fases/api-eliminar', ['as' => 'phases.api.delete', 'uses' => 'PhaseController@destroyApi']);
Route::post('fases/api-agregar-grupo',  ['as' => 'phases.api.add.group','uses' => 'PhaseController@addGroupApi' ] );
Route::get('fases/api-equipos-disponibles-grupo/{id}', ['as' => 'phases.api.teams.availables.group', 'uses' => 'PhaseController@getAvailableTeams']);
Route::post('fases/api-actualizar',  ['as' => 'phases.api.update','uses' => 'PhaseController@updateApi' ] );
Route::get('fases/api-ver', ['as'=>'phases.api.show', 'uses'=>'PhaseController@showApi']);

/*
********************************* PATH FOR GROUPS ********************************
*/
Route::get('grupos/api-eliminar', ['as' => 'groups.api.delete', 'uses' => 'GroupController@destroyApi']);
Route::post('grupos/api-agregar-equipo', ['as' => 'groups.api.add.team', 'uses' => 'GroupController@addTeamApi']);
Route::post('grupos/api-agregar-juego', ['as' => 'groups.api.add.game', 'uses' => 'GroupController@addGameApi']);
Route::get('grupos/api-lista-juegos/{id}', ['as' => 'groups.api.list.games', 'uses' => 'GroupController@listGameApi']);
Route::get('grupos/api-existe-juego/{id}/{localTeam}/{awayTeam}', ['as' => 'groups.api.exist.game', 'uses' => 'GroupController@existGameApi']);
Route::get('grupos/api-lista-grupo/{id}', ['as' => 'groups.api.list.group', 'uses' => 'GroupController@listGroupApi']);
Route::get('grupos/api-equipos-disponibles-juego/{id}', ['as' => 'groups.api.teams.availables.game', 'uses' => 'GroupController@getAvailableTeamsForGame']);
Route::get('grupos/api-sacar-equipo/{id}/{teamId}', ['as' => 'groups.api.remove.team', 'uses' => 'GroupController@removeTeamApi']);
Route::get('grupos/api-ver', ['as'=>'groups.api.show', 'uses'=>'GroupController@showApi']);
Route::post('grupos/api-actualizar',  ['as' => 'groups.api.update','uses' => 'GroupController@updateApi' ] );

/*
********************************* GAME FOR GROUPS ********************************
*/

Route::get('juegos/ver/{id}', ['as' => 'games.show', 'uses' => 'GameController@show' ] );
Route::post('juegos/api-agregar-alineacion', ['as' => 'games.api.add.alignment', 'uses' => 'GameController@addAlignmentApi']);
Route::post('juegos/api-agregar-cambio', ['as' => 'games.api.add.change', 'uses' => 'GameController@addChangeApi']);
Route::post('juegos/api-agregar-gol', ['as' => 'games.api.add.goal', 'uses' => 'GameController@addGoalApi']);
Route::post('juegos/api-agregar-sancion', ['as' => 'games.api.add.sanction', 'uses' => 'GameController@addSantionApi']);

Route::get('juegos/api-equipos-disponibles-juego/{id}', ['as' => 'games.api.teams.availables.game', 'uses' => 'GameController@getAvailableTeams']);
Route::get('juegos/api-jugadores-disponible-equipo/{id}/{teamId}', ['as' => 'games.api.available.players.team', 'uses' => 'GameController@getAvailablePlayersForTeam']);

Route::get('juegos/api-goles/{id}', array('as'=>'games.api.goals', 'uses'=>'GameController@goalsApi'));
Route::get('juegos/api-cambios/{id}', array('as'=>'games.api.changes', 'uses'=>'GameController@changesApi'));
Route::get('juegos/api-sanciones/{id}', array('as'=>'games.api.sanctions', 'uses'=>'GameController@sanctionsApi'));
Route::get('juegos/api-alineaciones/{id}/{teamId}', array('as'=>'games.api.alignments', 'uses'=>'GameController@alignmentsApi'));
Route::get('juegos/api-eliminar-gol', array('as'=>'games.api.delete.goal', 'uses'=>'GameController@destroyGoalApi'));
Route::get('juegos/api-eliminar-sancion', array('as'=>'games.api.delete.sanction', 'uses'=>'GameController@destroySanctionApi'));
Route::get('juegos/api-eliminar-cambio', array('as'=>'games.api.delete.change', 'uses'=>'GameController@destroyChangeApi'));
Route::get('juegos/api-ver', ['as'=>'games.api.show', 'uses'=>'GameController@showApi']);
Route::post('juegos/api-actualizar',  ['as' => 'games.api.update','uses' => 'GameController@updateApi' ] );
Route::get('juegos/api-fixture-list/{id}', array('as'=>'games.api.fixtures', 'uses'=>'GameController@getFixturesApi'));

/*
********************************* GAME TYPE ********************************
*/
Route::get('tipo-juegos/api-seleccionar-lista',  ['as' => 'game-types.api.select.list','uses' => 'GameTypeController@getAllValue' ] );

/*
********************************* GOALS FOR GAMES ********************************
*/

Route::get('goles/api-ver', array('as'=>'goals.api.show', 'uses'=>'GoalController@showApi'));
Route::post('goles/api-actualizar', array('as'=>'goals.api.update', 'uses'=>'GoalController@updateApi'));


/*
********************************* SANCTIONS FOR GAMES ********************************
*/

Route::get('sanciones/api-ver', array('as'=>'sanctions.api.show', 'uses'=>'SanctionController@showApi'));
Route::post('sanciones/api-actualizar', array('as'=>'sanctions.api.update', 'uses'=>'SanctionController@updateApi'));

/*
********************************* CHANGE FOR GAMES ********************************
*/

Route::get('cambios/api-ver', array('as'=>'changes.api.show', 'uses'=>'ChangeController@showApi'));
Route::post('cambios/api-actualizar', array('as'=>'changes.api.update', 'uses'=>'ChangeController@updateApi'));

/*
********************************* ALIGMENT FOR GAMES ********************************
*/

Route::get('alineaciones/api-ver', array('as'=>'alignments.api.show', 'uses'=>'AlignmentController@showApi'));
Route::post('alineaciones/api-actualizar', array('as'=>'alignments.api.update', 'uses'=>'AlignmentController@updateApi'));
Route::get('alineaciones/api-eliminar', array('as'=>'alignments.api.delete', 'uses'=>'AlignmentController@destroyApi'));
/*
********************************* ALIGMENT TYPE FOR GAMES ********************************
*/
Route::get('tipos-alineaciones', ['as' => 'alignmentsType.index', 'uses' => 'AlignmentsTypeController@index']);
Route::get('tipos-alineaciones/api-seleccionar-lista', array('as'=>'alignmentsType.api.select.list', 'uses'=>'AlignmentsTypeController@getAllValue'));
Route::post('tipos-alineaciones/guardar', ['as' => 'alignmentsType.store', 'uses' => 'AlignmentsTypeController@store' ] );
Route::get('tipos-alineaciones/api-lista', array('as'=>'alignmentsType.api.list', 'uses'=>'AlignmentsTypeController@listApi'));
Route::get('tipos-alineaciones/api-ver', array('as'=>'alignmentsType.api.show', 'uses'=>'AlignmentsTypeController@showApi'));
Route::post('tipos-alineacione/api-actualizar',  ['as' => 'alignmentsType.api.update','uses' => 'AlignmentsTypeController@updateApi' ] );
Route::get('tipos-alineacione/api-eliminar', array('as'=>'alignmentsType.api.delete', 'uses'=>'AlignmentsTypeController@destroyApi'));

/*
********************************* SANCTIONS TYPES FOR GAMES ********************************
*/
Route::get('tipos-sanciones', ['as' => 'sanction-types.index', 'uses' => 'SanctionTypesController@index']);
Route::get('tipo-sanciones/api-seleccionar-lista',  ['as' => 'sanction-types.api.select.list','uses' => 'SanctionTypesController@getAllValue' ] );
Route::post('tipos-sanciones/guardar', ['as' => 'sanction-types.store', 'uses' => 'SanctionTypesController@store' ] );
Route::get('tipos-sanciones/api-lista', array('as'=>'sanction-types.api.list', 'uses'=>'SanctionTypesController@listApi'));
Route::get('tipos-sanciones/api-ver', array('as'=>'sanction-types.api.show', 'uses'=>'SanctionTypesController@showApi'));
Route::post('tipos-sanciones/api-actualizar',  ['as' => 'sanction-types.api.update','uses' => 'SanctionTypesController@updateApi' ] );
Route::get('tipos-sanciones/api-eliminar', array('as'=>'sanction-types.api.delete', 'uses'=>'SanctionTypesController@destroyApi'));

/*
********************************* GOALS TYPES FOR GAMES ********************************
*/
Route::get('tipo-goles', ['as' => 'goal-types.index', 'uses' => 'GoalTypeController@index']);
Route::get('tipo-goles/api-seleccionar-lista',  ['as' => 'goal-types.api.select.list','uses' => 'GoalTypeController@getAllValue' ] );
Route::post('tipo-goles/guardar', ['as' => 'goal-types.store', 'uses' => 'GoalTypeController@store' ] );
Route::get('tipo-goles/api-lista', array('as'=>'goal-types.api.list', 'uses'=>'GoalTypeController@listApi'));
Route::get('tipo-goles/api-ver', array('as'=>'goal-types.api.show', 'uses'=>'GoalTypeController@showApi'));
Route::post('tipo-goles/api-actualizar',  ['as' => 'goal-types.api.update','uses' => 'GoalTypeController@updateApi' ] );


/*
********************************* Competition Formats ********************************
*/

Route::get('formatos-competicia', ['as' => 'competitionFormats.index', 'uses' => 'CompetitionFormatController@index']);
Route::get('formatos-competicia/nuevo', ['as' => 'competitionFormats.create', 'uses' => 'CompetitionFormatController@create'] );
Route::post('formatos-competicia/guardar', ['as' => 'competitionFormats.store', 'uses' => 'CompetitionFormatController@store' ] );
Route::get('formatos-competicia/ver/{id}', ['as' => 'competitionFormats.show', 'uses' => 'CompetitionFormatController@show' ] );
Route::get('formatos-competicia/editar/{id}',  ['as' => 'competitionFormats.edit','uses' => 'CompetitionFormatController@edit' ] );
Route::post('formatos-competicia/actualizar/{id}',  ['as' => 'competitionFormats.update','uses' => 'CompetitionFormatController@update' ] );
Route::get('formatos-competicia/eliminar/{id}',  ['as' => 'competitionFormats.destroy','uses' => 'CompetitionFormatController@destroy' ] );

Route::get('formatos-competicia/api-lista', array('as'=>'competitionFormats.api.list', 'uses'=>'CompetitionFormatController@listApi'));
Route::get('formatos-competicia/api-eliminar', array('as'=>'competitionFormats.api.delete', 'uses'=>'CompetitionFormatController@destroyApi'));
Route::get('formatos-competicia/api-ver', array('as'=>'competitionFormats.api.show', 'uses'=>'CompetitionFormatController@showApi'));
Route::post('formatos-competicia/api-actualizar',  ['as' => 'competitionFormats.api.update','uses' => 'CompetitionFormatController@updateApi' ] );
