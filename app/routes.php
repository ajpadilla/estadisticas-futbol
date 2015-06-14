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

Route::get('admin/test', function() {
	$gR = new soccer\Game\GameRepository;
	dd($gR->getFixtures(6, true)->toArray());
});

Route::get('admin/prueba-ruta/{id}',  ['as' => 'prueba','uses' => 'PlayerController@prueba' ] );
Route::get('admin/selctAjax',  ['as' => 'selctAjax','uses' => 'PlayerController@selctAjax' ] );
Route::get('admin/filterAjax',  ['as' => 'filterAjax.api','uses' => 'PlayerController@filter' ] );

Route::get('/', [
	//'before' => 'auth',
	'as' => 'pages.home',
	'uses' => 'PageController@adminIndex'
]);

/*
********************************* RUTAS PARA JUGADORES ********************************
*/

Route::get('admin/jugadores', ['as' => 'players.index', 'uses' => 'PlayerController@index']);
Route::get('admin/jugadores/nuevo', ['as' => 'players.create', 'uses' => 'PlayerController@create'] );
Route::post('admin/jugadores/guardar', ['as' => 'players.store', 'uses' => 'PlayerController@store' ] );
Route::get('admin/jugadores/ver/{id}', ['as' => 'players.show', 'uses' => 'PlayerController@show' ] );
Route::get('admin/jugadores/editar/{id}',  ['as' => 'players.edit','uses' => 'PlayerController@edit' ] );
Route::post('admin/jugadores/actualizar/{id}',  ['as' => 'players.update','uses' => 'PlayerController@update' ] );
Route::get('admin/jugadores/eliminar/{id}',  ['as' => 'players.destroy','uses' => 'PlayerController@destroy' ] );


Route::get('admin/jugadores/api-eliminar',  ['as' => 'players.api.delete','uses' => 'PlayerController@destroyApi' ] );
Route::get('admin/jugadores/api-lista', array('as'=>'players.api.list', 'uses'=>'PlayerController@listApi'));
Route::get('admin/jugadores/api-equipos/{id}', array('as'=>'players.api.teams', 'uses'=>'PlayerController@teamsApi'));
Route::get('admin/jugadores/api-cambiar-equipo/{id}', array('as'=>'players.api.change-team', 'uses'=>'PlayerController@changeTeamApi'));
Route::get('admin/jugadores/api-ver',  ['as' => 'players.api.show','uses' => 'PlayerController@showApi' ] );
Route::get('admin/jugadores/api-seleccionar-lista',  ['as' => 'players.api.select.list','uses' => 'PlayerController@getAllValue' ] );
Route::post('admin/jugadores/api-actualizar',  ['as' => 'players.api.update','uses' => 'PlayerController@updateApi' ] );
Route::post('admin/jugadores/api-add-equipo',  ['as' => 'players.api.add.team','uses' => 'PlayerController@addTeamApi' ] );
Route::post('admin/jugadores/api-disponible',  ['as' => 'players.api.available','uses' => 'PlayerController@availableApi'] );

/*
********************************* RUTAS PARA EQUIPOS ********************************
*/

Route::get('admin/equipos', ['as' => 'equipos.index', 'uses' => 'EquipoController@index']);
Route::get('admin/equipos/nuevo', ['as' => 'equipos.create', 'uses' => 'EquipoController@create'] );
Route::post('admin/equipos/guardar', ['as' => 'equipos.store', 'uses' => 'EquipoController@store' ] );
Route::get('admin/equipos/ver/{id}', ['as' => 'equipos.show', 'uses' => 'EquipoController@show' ] );
Route::get('admin/equipos/editar/{id}',  ['as' => 'equipos.edit','uses' => 'EquipoController@edit' ] );
Route::post('admin/equipos/actualizar/{id}',  ['as' => 'equipos.update','uses' => 'EquipoController@update' ] );
Route::get('admin/equipos/eliminar/{id}',  ['as' => 'equipos.delete','uses' => 'EquipoController@destroy' ] );

Route::get('admin/equipos/api-eliminar',  ['as' => 'equipos.api.eliminar','uses' => 'EquipoController@destroyApi' ] );
Route::get('admin/equipos/api-lista', array('as'=>'equipos.api.lista', 'uses'=>'EquipoController@listaApi'));
Route::post('admin/equipos/api-actualizar',  ['as' => 'equipos.api.update','uses' => 'EquipoController@updateApi' ] );
Route::get('admin/equipos/api-jugadores/{id}', array('as'=>'equipos.api.jugadores', 'uses'=>'EquipoController@jugadoresApi'));
Route::get('admin/equipos/api-ver',  ['as' => 'equipos.api.show','uses' => 'EquipoController@showApi' ] );
Route::get('admin/equipos/api-seleccionar-lista',  ['as' => 'equipos.api.select.list','uses' => 'EquipoController@getAllValue' ] );
Route::get('admin/equipos/api-verificar-jugador',  ['as' => 'equipos.api.verificar-jugador','uses' => 'EquipoController@confirmExistsPlayerTeam' ] );
Route::post('admin/equipos/api-existe-numero',  ['as' => 'equipos.api.number.exist','uses' => 'EquipoController@existeNumeroApi' ] );
Route::post('admin/equipos/api-add-jugador',  ['as' => 'equipos.api.add.jugador','uses' => 'EquipoController@addJugadorApi' ] );

/*
********************************* RUTAS PARA PAISES ********************************
*/

Route::get('admin/paises/api-seleccionar-lista',  ['as' => 'paises.api.select.list','uses' => 'PaisController@getAllValue' ] );
Route::get('admin/paises', ['as' => 'paises.index', 'uses' => 'PaisController@index']);
Route::get('admin/paises/nuevo', ['as' => 'paises.create', 'uses' => 'PaisController@create'] );
Route::post('admin/paises/guardar', ['as' => 'paises.store', 'uses' => 'PaisController@store' ] );
Route::get('admin/paises/ver/{id}', ['as' => 'paises.show', 'uses' => 'PaisController@show' ] );
Route::get('admin/paises/editar/{id}',  ['as' => 'paises.edit','uses' => 'PaisController@edit' ] );
Route::post('admin/paises/actualizar',  ['as' => 'paises.update','uses' => 'PaisController@update' ] );
Route::get('admin/paises/eliminar',  ['as' => 'paises.delete-ajax','uses' => 'PaisController@destroy' ] );

Route::get('admin/paises/api-ver',  ['as' => 'paises.api.show','uses' => 'PaisController@showApi' ] );
Route::get('admin/paises/api-lista', array('as'=>'paises.api.lista', 'uses'=>'PaisController@listaApi'));

/*
********************************* RUTAS PARA POSICIONES ********************************
*/

Route::get('admin/posiciones', ['as' => 'posiciones.index', 'uses' => 'PosicionController@index']);
Route::post('admin/posiciones/guardar', ['as' => 'posiciones.store', 'uses' => 'PosicionController@store' ] );

Route::get('admin/posiciones/api-ver',  ['as' => 'posiciones.api.show','uses' => 'PosicionController@showApi' ] );
Route::post('admin/posiciones/api-actualizar',  ['as' => 'posiciones.api.update','uses' => 'PosicionController@updateApi' ] );
Route::get('admin/posiciones/api-seleccionar-lista',  ['as' => 'posiciones.api.select.list','uses' => 'PosicionController@getAllValue' ] );
Route::get('admin/posiciones/api-lista',  ['as' => 'posiciones.api.lista','uses' => 'PosicionController@listaApi' ] );
Route::get('admin/posiciones/api-eliminar',  ['as' => 'posiciones.api.eliminar','uses' => 'PosicionController@destroyApi' ] );
/*
********************************* RUTAS PARA TIPOS DE COMPETENCIAS ********************************
*/
Route::get('admin/tipos-competencia', ['as' => 'tipos-competencia.index', 'uses' => 'TipoCompetenciaController@index']);
Route::get('admin/tipos-competencia/nuevo', ['as' => 'tipos-competencia.create', 'uses' => 'TipoCompetenciaController@create'] );
Route::post('admin/tipos-competencia/guardar', ['as' => 'tipos-competencia.store', 'uses' => 'TipoCompetenciaController@store' ] );
//Route::get('admin/tipos-competencia/ver/{id}', ['as' => 'tipos-competencia.show', 'uses' => 'TipoCompetenciaController@show' ] );
Route::get('admin/tipos-competencia/editar/{id}',  ['as' => 'tipos-competencia.edit','uses' => 'TipoCompetenciaController@edit' ] );
Route::post('admin/tipos-competencia/actualizar/{id}',  ['as' => 'tipos-competencia.update','uses' => 'TipoCompetenciaController@update' ] );
Route::get('admin/tipos-competencia/eliminar/{id}',  ['as' => 'tipos-competencia.delete','uses' => 'TipoCompetenciaController@destroy' ] );

Route::get('admin/tipos-competencia/api-eliminar',  ['as' => 'tipos-competencia.api.eliminar','uses' => 'TipoCompetenciaController@destroyApi' ] );
Route::get('admin/tipos-competencia/api-lista', array('as'=>'tipos-competencia.api.lista', 'uses'=>'TipoCompetenciaController@listaApi'));
Route::post('admin/tipos-competencia/api-actualizar',  ['as' => 'tipos-competencia.api.update','uses' => 'TipoCompetenciaController@updateApi' ] );
//Route::get('admin/tipos-competencia/api-jugadores/{id}', array('as'=>'tipos-competencia.api.jugadores', 'uses'=>'TipoCompetenciaController@jugadoresApi'));
Route::get('admin/tipos-competencia/api-ver',  ['as' => 'tipos-competencia.api.show','uses' => 'TipoCompetenciaController@showApi' ] );
Route::get('admin/tipos-competencia/api-seleccionar-lista',  ['as' => 'tipos-competencia.api.select.list','uses' => 'TipoCompetenciaController@getAllValue' ] );
/*
********************************* RUTAS PARA COMPETENCIAS ********************************
*/
Route::get('admin/competencias', ['as' => 'competencias.index', 'uses' => 'CompetitionController@index']);
Route::get('admin/competencias/nuevo', ['as' => 'competencias.create', 'uses' => 'CompetitionController@create'] );
Route::post('admin/competencias/guardar', ['as' => 'competencias.store', 'uses' => 'CompetitionController@store' ] );
Route::get('admin/competencias/ver/{id}', ['as' => 'competitions.show', 'uses' => 'CompetitionController@show' ] );
Route::get('admin/competencias/editar/{id}',  ['as' => 'competencias.edit','uses' => 'CompetitionController@edit' ] );
Route::post('admin/competencias/actualizar/{id}',  ['as' => 'competencias.update','uses' => 'CompetitionController@update' ] );
Route::get('admin/competencias/eliminar/{id}',  ['as' => 'competencias.delete','uses' => 'CompetitionController@destroy' ] );
Route::get('admin/competencias/ver/{id}', ['as' => 'competencias.show', 'uses' => 'CompetitionController@show' ] );

Route::get('admin/competencias/api-eliminar',  ['as' => 'competencias.api.eliminar','uses' => 'CompetitionController@destroyApi' ] );
Route::get('admin/competencias/api-lista', array('as'=>'competitions.api.list', 'uses'=>'CompetitionController@listApi'));
Route::post('admin/competencias/api-actualizar',  ['as' => 'competencias.api.update','uses' => 'CompetitionController@updateApi' ] );
//Route::get('admin/competencias/api-jugadores/{id}', array('as'=>'competencias.api.jugadores', 'uses'=>'CompetitionController@jugadoresApi'));
//Route::get('admin/competencias/api-ver',  ['as' => 'competencias.data','uses' => 'CompetitionController@showApi' ] );
//Route::post('admin/competencias/api-agregar-equipo/{id}/{teamId}',  ['as' => 'competitions.api.add.team','uses' => 'CompetitionController@addTeamApi' ] );
Route::post('admin/competencias/api-agregar-fase',  ['as' => 'competitions.api.add.phase','uses' => 'CompetitionController@addPhaseApi' ] );
Route::get('admin/competencias/api-seleccionar-lista',  ['as' => 'competitions.api.select.list','uses' => 'CompetitionController@getAllValue' ] );
Route::get('admin/competencias/api-equipos-disponibles/{id}', ['as' => 'competitions.api.available.teams', 'uses' => 'CompetitionController@getAvailableTeams']);

/*
********************************* RUTAS PARA FASES ********************************
*/
Route::get('admin/fases/api-eliminar', ['as' => 'phases.api.delete', 'uses' => 'PhaseController@destroyApi']);
Route::post('admin/fases/api-agregar-grupo',  ['as' => 'phases.api.add.group','uses' => 'PhaseController@addGroupApi' ] );
Route::get('admin/fases/api-equipos-disponibles-grupo/{id}', ['as' => 'phases.api.teams.availables.group', 'uses' => 'PhaseController@getAvailableTeams']);
Route::post('admin/fases/api-actualizar',  ['as' => 'phases.api.update','uses' => 'PhaseController@updateApi' ] );
Route::get('admin/fases/api-ver', ['as'=>'phases.api.show', 'uses'=>'PhaseController@showApi']);

/*
********************************* PATH FOR GROUPS ********************************
*/
Route::get('admin/grupos/api-eliminar', ['as' => 'groups.api.delete', 'uses' => 'GroupController@destroyApi']);
Route::post('admin/grupos/api-agregar-equipo', ['as' => 'groups.api.add.team', 'uses' => 'GroupController@addTeamApi']);
Route::post('admin/grupos/api-agregar-juego', ['as' => 'groups.api.add.game', 'uses' => 'GroupController@addGameApi']);
Route::get('admin/grupos/api-lista-juegos/{id}', ['as' => 'groups.api.list.games', 'uses' => 'GroupController@listGameApi']);
Route::get('admin/grupos/api-existe-juego/{id}/{localTeam}/{awayTeam}', ['as' => 'groups.api.exist.game', 'uses' => 'GroupController@existGameApi']);
Route::get('admin/grupos/api-lista-grupo/{id}', ['as' => 'groups.api.list.group', 'uses' => 'GroupController@listGroupApi']);
Route::get('admin/grupos/api-equipos-disponibles-juego/{id}', ['as' => 'groups.api.teams.availables.game', 'uses' => 'GroupController@getAvailableTeamsForGame']);
Route::get('admin/grupos/api-sacar-equipo/{id}/{teamId}', ['as' => 'groups.api.remove.team', 'uses' => 'GroupController@removeTeamApi']);
Route::get('admin/grupos/api-ver', ['as'=>'groups.api.show', 'uses'=>'GroupController@showApi']);
Route::post('admin/grupos/api-actualizar',  ['as' => 'groups.api.update','uses' => 'GroupController@updateApi' ] );

/*
********************************* GAME FOR GROUPS ********************************
*/

Route::get('admin/juegos/ver/{id}', ['as' => 'games.show', 'uses' => 'GameController@show' ] );
Route::post('admin/juegos/api-agregar-alineacion', ['as' => 'games.api.add.alignment', 'uses' => 'GameController@addAlignmentApi']);
Route::post('admin/juegos/api-agregar-cambio', ['as' => 'games.api.add.change', 'uses' => 'GameController@addChangeApi']);
Route::post('admin/juegos/api-agregar-gol', ['as' => 'games.api.add.goal', 'uses' => 'GameController@addGoalApi']);
Route::post('admin/juegos/api-agregar-sancion', ['as' => 'games.api.add.sanction', 'uses' => 'GameController@addSantionApi']);

Route::get('admin/juegos/api-equipos-disponibles-juego/{id}', ['as' => 'games.api.teams.availables.game', 'uses' => 'GameController@getAvailableTeams']);
Route::get('admin/juegos/api-jugadores-disponible-equipo/{id}/{teamId}', ['as' => 'games.api.available.players.team', 'uses' => 'GameController@getAvailablePlayersForTeam']);

Route::get('admin/juegos/api-goles/{id}', array('as'=>'games.api.goals', 'uses'=>'GameController@goalsApi'));
Route::get('admin/juegos/api-cambios/{id}', array('as'=>'games.api.changes', 'uses'=>'GameController@changesApi'));
Route::get('admin/juegos/api-sanciones/{id}', array('as'=>'games.api.sanctions', 'uses'=>'GameController@sanctionsApi'));
Route::get('admin/juegos/api-alineaciones/{id}/{teamId}', array('as'=>'games.api.alignments', 'uses'=>'GameController@alignmentsApi'));
Route::get('admin/juegos/api-eliminar-gol', array('as'=>'games.api.delete.goal', 'uses'=>'GameController@destroyGoalApi'));
Route::get('admin/juegos/api-eliminar-sancion', array('as'=>'games.api.delete.sanction', 'uses'=>'GameController@destroySanctionApi'));
Route::get('admin/juegos/api-eliminar-cambio', array('as'=>'games.api.delete.change', 'uses'=>'GameController@destroyChangeApi'));
Route::get('admin/juegos/api-ver', ['as'=>'games.api.show', 'uses'=>'GameController@showApi']);
Route::post('admin/juegos/api-actualizar',  ['as' => 'games.api.update','uses' => 'GameController@updateApi' ] );
Route::get('admin/juegos/api-fixture-list/{id}', array('as'=>'games.api.fixtures', 'uses'=>'GameController@getFixturesApi'));
Route::post('admin/juegos/api-registrar-estado-tiempo/{id}/{fixtureTypeId}', ['as'=>'games.api.register-time-status', 'uses'=>'GameController@registerTimeStatusApi']);

/*
********************************* GAME TYPE ********************************
*/
Route::get('admin/tipo-juegos/api-seleccionar-lista',  ['as' => 'game-types.api.select.list','uses' => 'GameTypeController@getAllValue' ] );

/*
********************************* GOALS FOR GAMES ********************************
*/

Route::get('admin/goles/api-ver', array('as'=>'goals.api.show', 'uses'=>'GoalController@showApi'));
Route::post('admin/goles/api-actualizar', array('as'=>'goals.api.update', 'uses'=>'GoalController@updateApi'));


/*
********************************* SANCTIONS FOR GAMES ********************************
*/

Route::get('admin/sanciones/api-ver', array('as'=>'sanctions.api.show', 'uses'=>'SanctionController@showApi'));
Route::post('admin/sanciones/api-actualizar', array('as'=>'sanctions.api.update', 'uses'=>'SanctionController@updateApi'));

/*
********************************* CHANGE FOR GAMES ********************************
*/

Route::get('admin/cambios/api-ver', array('as'=>'changes.api.show', 'uses'=>'ChangeController@showApi'));
Route::post('admin/cambios/api-actualizar', array('as'=>'changes.api.update', 'uses'=>'ChangeController@updateApi'));

/*
********************************* ALIGMENT FOR GAMES ********************************
*/

Route::get('admin/alineaciones/api-ver', array('as'=>'alignments.api.show', 'uses'=>'AlignmentController@showApi'));
Route::post('admin/alineaciones/api-actualizar', array('as'=>'alignments.api.update', 'uses'=>'AlignmentController@updateApi'));
Route::get('admin/alineaciones/api-eliminar', array('as'=>'alignments.api.delete', 'uses'=>'AlignmentController@destroyApi'));
/*
********************************* ALIGMENT TYPE FOR GAMES ********************************
*/
Route::get('admin/tipos-alineaciones', ['as' => 'alignmentsType.index', 'uses' => 'AlignmentsTypeController@index']);
Route::get('admin/tipos-alineaciones/api-seleccionar-lista', array('as'=>'alignmentsType.api.select.list', 'uses'=>'AlignmentsTypeController@getAllValue'));
Route::post('admin/tipos-alineaciones/guardar', ['as' => 'alignmentsType.store', 'uses' => 'AlignmentsTypeController@store' ] );
Route::get('admin/tipos-alineaciones/api-lista', array('as'=>'alignmentsType.api.list', 'uses'=>'AlignmentsTypeController@listApi'));
Route::get('admin/tipos-alineaciones/api-ver', array('as'=>'alignmentsType.api.show', 'uses'=>'AlignmentsTypeController@showApi'));
Route::post('admin/tipos-alineacione/api-actualizar',  ['as' => 'alignmentsType.api.update','uses' => 'AlignmentsTypeController@updateApi' ] );
Route::get('admin/tipos-alineacione/api-eliminar', array('as'=>'alignmentsType.api.delete', 'uses'=>'AlignmentsTypeController@destroyApi'));

/*
********************************* SANCTIONS TYPES FOR GAMES ********************************
*/
Route::get('admin/tipos-sanciones', ['as' => 'sanction-types.index', 'uses' => 'SanctionTypesController@index']);
Route::get('admin/tipo-sanciones/api-seleccionar-lista',  ['as' => 'sanction-types.api.select.list','uses' => 'SanctionTypesController@getAllValue' ] );
Route::post('admin/tipos-sanciones/guardar', ['as' => 'sanction-types.store', 'uses' => 'SanctionTypesController@store' ] );
Route::get('admin/tipos-sanciones/api-lista', array('as'=>'sanction-types.api.list', 'uses'=>'SanctionTypesController@listApi'));
Route::get('admin/tipos-sanciones/api-ver', array('as'=>'sanction-types.api.show', 'uses'=>'SanctionTypesController@showApi'));
Route::post('admin/tipos-sanciones/api-actualizar',  ['as' => 'sanction-types.api.update','uses' => 'SanctionTypesController@updateApi' ] );
Route::get('admin/tipos-sanciones/api-eliminar', array('as'=>'sanction-types.api.delete', 'uses'=>'SanctionTypesController@destroyApi'));

/*
********************************* GOALS TYPES FOR GAMES ********************************
*/
Route::get('admin/tipo-goles', ['as' => 'goal-types.index', 'uses' => 'GoalTypeController@index']);
Route::get('admin/tipo-goles/api-seleccionar-lista',  ['as' => 'goal-types.api.select.list','uses' => 'GoalTypeController@getAllValue' ] );
Route::post('admin/tipo-goles/guardar', ['as' => 'goal-types.store', 'uses' => 'GoalTypeController@store' ] );
Route::get('admin/tipo-goles/api-lista', array('as'=>'goal-types.api.list', 'uses'=>'GoalTypeController@listApi'));
Route::get('admin/tipo-goles/api-ver', array('as'=>'goal-types.api.show', 'uses'=>'GoalTypeController@showApi'));
Route::post('admin/tipo-goles/api-actualizar',  ['as' => 'goal-types.api.update','uses' => 'GoalTypeController@updateApi' ] );
Route::get('admin/tipo-goles/api-eliminar', array('as'=>'goal-types.api.delete', 'uses'=>'GoalTypeController@destroyApi'));


/*
********************************* Competition Formats ********************************
*/

Route::get('admin/formatos-competicia', ['as' => 'competitionFormats.index', 'uses' => 'CompetitionFormatController@index']);
Route::get('admin/formatos-competicia/nuevo', ['as' => 'competitionFormats.create', 'uses' => 'CompetitionFormatController@create'] );
Route::post('admin/formatos-competicia/guardar', ['as' => 'competitionFormats.store', 'uses' => 'CompetitionFormatController@store' ] );
Route::get('admin/formatos-competicia/ver/{id}', ['as' => 'competitionFormats.show', 'uses' => 'CompetitionFormatController@show' ] );
Route::get('admin/formatos-competicia/editar/{id}',  ['as' => 'competitionFormats.edit','uses' => 'CompetitionFormatController@edit' ] );
Route::post('admin/formatos-competicia/actualizar/{id}',  ['as' => 'competitionFormats.update','uses' => 'CompetitionFormatController@update' ] );
Route::get('admin/formatos-competicia/eliminar/{id}',  ['as' => 'competitionFormats.destroy','uses' => 'CompetitionFormatController@destroy' ] );

Route::get('admin/formatos-competicia/api-lista', array('as'=>'competitionFormats.api.list', 'uses'=>'CompetitionFormatController@listApi'));
Route::get('admin/formatos-competicia/api-eliminar', array('as'=>'competitionFormats.api.delete', 'uses'=>'CompetitionFormatController@destroyApi'));
Route::get('admin/formatos-competicia/api-ver', array('as'=>'competitionFormats.api.show', 'uses'=>'CompetitionFormatController@showApi'));
Route::post('admin/formatos-competicia/api-actualizar',  ['as' => 'competitionFormats.api.update','uses' => 'CompetitionFormatController@updateApi' ] );

/*
********************************* Public page routes ********************************
*/
/*Route::get('admin/', [
	'as' => 'public.home',
	'uses' => 'PageController@index'
]);*/

