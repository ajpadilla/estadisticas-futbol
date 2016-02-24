<?php namespace soccer\Equipo;

use soccer\Equipo\Equipo;
use soccer\Game\Game;
use soccer\Base\BaseRepository;
use soccer\Player\PlayerRepository;
use soccer\Game\GameRepository;
use soccer\Group\GroupRepository;
use soccer\Competition\Competition;
use Carbon\Carbon;
use DB;
use Datatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
/**
*
*/
class EquipoRepository extends BaseRepository
{

	function __construct() {
		$this->columns = [
			'País',
			'Nombre',
			'Tipo',
			'Fecha Fundación',
			'Apodo',
			'Acciones'
		];

		$this->setModel(new Equipo);
		$this->setListAllRoute('equipos.api.lista');
	}

	public function listForType($type='club')
	{
		return $this->model->select()->whereTipo($type)->lists('nombre', 'id');
	}

	public function update($data = array())
	{
		$equipo = $this->get($data['equipo_id']);
		$equipo->update($data);
		return $equipo;
	}

	public function getJugadores($id)
	{
		return $this->get($id)->jugadores;
	}

	public function addJugador($id, $jugador = array())
	{
		try {
			extract($jugador);
			$playerRepository = new PlayerRepository;
			$jugador = $playerRepository->get($jugador_id);
			$equipo = $this->get($id);
			$equipo->jugadores()->attach($jugador->id, ['numero' => $numero, 'fecha_inicio' => $desde, 'fecha_fin' => $hasta]);
			return true;
		} catch(Exception $e) {
			return false;
		}
	}

	public function getTeamsByCompetition($idsTeamsSelected = array(), Competition $competition)
	{
		if($competition->internacional) {
			return $this->model->select()->whereNotIn('id',$idsTeamsSelected)->lists('nombre', 'id');
		}else{
			return $this->model->select()->whereNotIn('id',$idsTeamsSelected)->wherePaisId($competition->pais_id)->lists('nombre', 'id');
		}
	}

	public	function getByCountry($country, $exclude = null)
	{
		if($exclude) {
			return $country->teams()->clubes()->whereNotIn('id', $exclude)->get();
		}
		return $country->teams;
	}

	/*
	*********************** METHODS FOR GROUPS ******************************
	*/

	public function getLocalGamesByGroup($id, $groupId)
	{
		return Game::whereLocalTeamId($id)->whereGroupId($groupId)->get();
	}
	//Metodo el cual obtendra todos los juegos como local en toda la comepetencia
	public function getLocalGamesByCompetition($id, $competitionId)
	{
		/*return Game::whereLocalTeamId($id)
		->whereRaw('DATE_FORMAT(games.date, "%Y-%m-%d") >= ?', [$startDateCompetition])
		->whereRaw('DATE_FORMAT(games.date, "%Y-%m-%d") <= ?', [$endDateCompetition])
		->get();*/

		return Game::select('*')
		->whereLocalTeamId($id)
        ->join('groups', 'games.group_id', '=', 'groups.id')
        ->join('phases', 'groups.phase_id', '=', 'phases.id')
        ->join('competitions', 'phases.competition_id', '=', 'competitions.id')
        ->where('competitions.id', '=', $competitionId)
        ->select('games.*')
        ->get(); 

	}

	public function getAwayGamesByGroup($id, $groupId)
	{
		return Game::whereAwayTeamId($id)->whereGroupId($groupId)->get();
	}

	//Metodo el cual obtendra todos los juegos como visitante en toda la comepetencia
	public function getAwayGamesByCompetition($id, $competitionId)
	{
		/*return Game::whereAwayTeamId($id)
		->whereRaw('DATE_FORMAT(games.date, "%Y-%m-%d") >= ?', [$startDateCompetition])
		->whereRaw('DATE_FORMAT(games.date, "%Y-%m-%d") <= ?', [$endDateCompetition])
		->get();*/

		return Game::select('*')
		->whereAwayTeamId($id)
        ->join('groups', 'games.group_id', '=', 'groups.id')
        ->join('phases', 'groups.phase_id', '=', 'phases.id')
        ->join('competitions', 'phases.competition_id', '=', 'competitions.id')
        ->where('competitions.id', '=', $competitionId)
        ->select('games.*')
        ->get(); 
	}

	public function getSortByPointsByGroup($groupId, $type = 'DESC')
	{
		$groupRepository = new GroupRepository;
		$group = $groupRepository->get($groupId);
		$teams = $group->teams;
		/* Debo obtener los partidos para cada equipo dentro del grupo,
		 * al tener los partidos, calculo el estatus para ese equipo en ese partido,
		 * (perdió, ganó, empató), voy sumando los puntos por equipo en un array,
		 * cuya clave es el id del equipo
		*/
		return $teams;
	}

	public function getPlayedGamesByGroup($id, $groupId)
	{
		$query = Game::select();
		$query->where('games.local_team_id', '=', $id)
			  ->orWhere('games.away_team_id', '=', $id)
			  ->where('games.group_id', '=', $groupId)
			  ->where('games.date', '<', Carbon::now()->addMinutes(120)->format('Y-m-d h:i:00'));
		return $query->count();
	}

	public function getPlayedGamesByCompetition($id, $startDateCompetition, $endDateCompetition)
	{
		$query = Game::select();
		$query->where('games.local_team_id', '=', $id)
			  ->orWhere('games.away_team_id', '=', $id)
			  ->whereRaw('DATE_FORMAT(games.date, "%Y-%m-%d") >= ?', [$startDateCompetition])
			  ->whereRaw('DATE_FORMAT(games.date, "%Y-%m-%d") <= ?', [$endDateCompetition]);
		return $query->count();
	}

	public function getWinGamesByGroup($id, $groupId, $localGames = null, $awayGames = null)
	{
		$winGames = 0;

		$localGames = ($localGames ? $localGames : $this->getLocalGamesByGroup($id, $groupId));
		foreach ($localGames as $game)
			$winGames += ($game->localGoals > $game->awayGoals ? 1 : 0);

		$awayGames = ($awayGames ? $awayGames : $this->getAwayGamesByGroup($id, $groupId));
		foreach ($awayGames as $game)
				$winGames += ($game->localGoals < $game->awayGoals ? 1 : 0);

		return $winGames;
	}

	public function getWinGamesByCompetition($id, $localGames = null, $awayGames = null, $startDateCompetition, $endDateCompetition)
	{
		$winGames = 0;

		$localGames = ($localGames ? $localGames : $this->getLocalGamesByCompetition($id, $startDateCompetition, $endDateCompetition));
		foreach ($localGames as $game)
			$winGames += ($game->localGoals > $game->awayGoals ? 1 : 0);

		$awayGames = ($awayGames ? $awayGames : $this->getAwayGamesByCompetition($id, $startDateCompetition, $endDateCompetition));
		foreach ($awayGames as $game)
				$winGames += ($game->localGoals < $game->awayGoals ? 1 : 0);

		return $winGames;
	}

	public function getLostGamesByGroup($id, $groupId, $localGames = null, $awayGames = null)
	{
		$lostGames = 0;

		$localGames = ($localGames ? $localGames : $this->getLocalGamesByGroup($id, $groupId));
		foreach ($localGames as $game)
			$lostGames += ($game->localGoals < $game->awayGoals ? 1 : 0);

		$awayGames = ($awayGames ? $awayGames : $this->getAwayGamesByGroup($id, $groupId));
		foreach ($awayGames as $game)
			$lostGames += ($game->localGoals > $game->awayGoals ? 1 : 0);

		return $lostGames;
	}


	public function getLostGamesByCompetition($id, $localGames = null, $awayGames = null, $startDateCompetition, $endDateCompetition)
	{
		$lostGames = 0;

		$localGames = ($localGames ? $localGames : $this->getLocalGamesByCompetition($id, $startDateCompetition, $endDateCompetition));
		foreach ($localGames as $game)
			$lostGames += ($game->localGoals < $game->awayGoals ? 1 : 0);

		$awayGames = ($awayGames ? $awayGames : $this->getAwayGamesByCompetition($id, $startDateCompetition, $endDateCompetition));
		foreach ($awayGames as $game)
			$lostGames += ($game->localGoals > $game->awayGoals ? 1 : 0);

		return $lostGames;
	}

	public function getTieGamesByGroup($id, $groupId, $localGames = null, $awayGames = null)
	{
		$tieGames = 0;

		$localGames = ($localGames ? $localGames : $this->getLocalGamesByGroup($id, $groupId));
		foreach ($localGames as $game)
			$tieGames += ($game->localGoals == $game->awayGoals ? 1 : 0);

		$awayGames = ($awayGames ? $awayGames : $this->getAwayGamesByGroup($id, $groupId));
		foreach ($awayGames as $game)
			$tieGames += ($game->localGoals == $game->awayGoals ? 1 : 0);

		return $tieGames;
	}

	public function getTieGamesByCompetition($id, $localGames = null, $awayGames = null, $startDateCompetition, $endDateCompetition)
	{
		$tieGames = 0;

		$localGames = ($localGames ? $localGames : $this->getLocalGamesByCompetition($id, $startDateCompetition, $endDateCompetition));
		foreach ($localGames as $game)
			$tieGames += ($game->localGoals == $game->awayGoals ? 1 : 0);

		$awayGames = ($awayGames ? $awayGames : $this->getAwayGamesByCompetition($id, $startDateCompetition, $endDateCompetition));
		foreach ($awayGames as $game)
			$tieGames += ($game->localGoals == $game->awayGoals ? 1 : 0);

		return $tieGames;
	}

	public function getScoredGoalsByGroup($id, $groupId)
	{
		$goals = 0;
		$team = $this->get($id);
		$goals += $team->localGoals()->whereGroupId($groupId)->whereTeamId($id)->count();
		$goals += $team->awayGoals()->whereGroupId($groupId)->whereTeamId($id)->count();

		return $goals;
	}

	public function getScoredGoalsByCompetition($id, $localGames = null, $awayGames = null, $startDateCompetition, $endDateCompetition)
	{
		$goals = 0;

		$localGames = ($localGames ? $localGames : $this->getLocalGamesByCompetition($id, $startDateCompetition, $endDateCompetition));
		foreach ($localGames as $game)
			$goals += $game->localGoals;

		$awayGames = ($awayGames ? $awayGames : $this->getAwayGamesByCompetition($id, $startDateCompetition, $endDateCompetition));
		foreach ($awayGames as $game)
			$goals += $game->awayGoals;

		return $goals;
	}

	public function getAgainstGoalsByGroup($id, $groupId, $localGames = null, $awayGames = null)
	{
		$goals = 0;

		$localGames = ($localGames ? $localGames : $this->getLocalGamesByGroup($id, $groupId));
		foreach ($localGames as $game)
			$goals += $game->awayGoals;

		$awayGames = ($awayGames ? $awayGames : $this->getAwayGamesByGroup($id, $groupId));
		foreach ($awayGames as $game)
			$goals += $game->localGoals;

		return $goals;
	}

	public function getAgainstGoalsByCompetition($id, $localGames = null, $awayGames = null, $startDateCompetition, $endDateCompetition)
	{
		$goals = 0;

		$localGames = ($localGames ? $localGames : $this->getLocalGamesByCompetition($id, $startDateCompetition, $endDateCompetition));
		foreach ($localGames as $game)
			$goals += $game->awayGoals;

		$awayGames = ($awayGames ? $awayGames : $this->getAwayGamesByCompetition($id, $startDateCompetition, $endDateCompetition));
		foreach ($awayGames as $game)
			$goals += $game->localGoals;

		return $goals;
	}

	public function getGoalsDifferenceByGroup($id, $groupId)
	{
		return $this->getScoredGoalsByGroup($id, $groupId) - $this->getAgainstGoalsByGroup($id, $groupId);
	}

	public function getPointsByGroup($id, $groupId)
	{
		return ($this->getWinGamesByGroup($id, $groupId) * 2) + $this->getTieGamesByGroup($id, $groupId);
	}

	public function getPositionForTeamInGroup($id, $groupId)
	{
		return 0;
	}

	/*
	*********************** DATATABLE SETTINGS ******************************
	*/

	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a class='show-team' href='" . route('equipos.show', $model->id) . "'>Ver</a><br />");
			$this->addActionColumn("<a  class='edit-team' href='#new-team-form' id='edit_team_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='delete-team' href='#' id='delete_team_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('País', 'Nombre', 'Tipo', 'Fecha Fundación', 'Apodo');
		$this->collection->orderColumns('País', 'Nombre', 'Tipo', 'Fecha Fundación', 'Apodo');

		$this->collection->addColumn('País', function($model)
		{
			 return $model->pais->nombre;
		});

		$this->collection->addColumn('Nombre', function($model)
		{
			 return $model->nombre;
		});

		$this->collection->addColumn('Tipo', function($model)
		{
			 return $model->tipo;
		});

		$this->collection->addColumn('Fecha Fundación', function($model)
		{
			 return $model->fecha_fundacion;
		});

		$this->collection->addColumn('Apodo', function($model)
		{
			 return $model->apodo;
		});
	}

	public function getJugadoresTable($id)
	{
		$playerRepository = new PlayerRepository;
		$playerRepository->columns = [
			'Nombre',
			'País',
			'Fecha Inicio',
			'Fecha Fin',
			'Número',
			'Acciones'
		];
		return $playerRepository->getAllTable('equipos.api.jugadores', [$id]);
	}

	private function setTablePlayerContent(PlayerRepository $playerRepository)
	{
		$playerRepository->collection->searchColumns('País', 'Nombre', 'Fecha Inicio', 'Fecha Fin', 'Número');
		$playerRepository->collection->orderColumns('País', 'Nombre', 'Fecha Inicio', 'Fecha Fin', 'Número');

		$playerRepository->collection->addColumn('Nombre', function($model)
		{
			 return $model->nombre;
		});

		$playerRepository->collection->addColumn('País', function($model)
		{
			 return $model->pais->nombre;
		});

		$playerRepository->collection->addColumn('Fecha Inicio', function($model)
		{
			 return $model->pivot->fecha_inicio;
		});

		$playerRepository->collection->addColumn('Fecha Fin', function($model)
		{
			 return $model->pivot->fecha_fin;
		});

		$playerRepository->collection->addColumn('Número', function($model)
		{
			 return $model->pivot->numero;
		});
	}

	public function getTableForPlayers($id)
	{
		$players = $this->getJugadores($id);
		$playerRepository = new PlayerRepository;
		$playerRepository->setDatatableCollection($players);
		$this->setTablePlayerContent($playerRepository);
		$playerRepository->addColumnToCollection('Acciones', function($model) use ($playerRepository, $id)
		{
			$playerRepository->cleanActionColumn();
			$playerRepository->addActionColumn("<a class='ver-jugador' href='" . route('players.show', $model->id) . "' id='ver_jugador'>Ver</a><br />");
			//$playerRepository->addActionColumn("<a  class='editar-jugador' href='#new-player-form' id='editar_".$model->id."'>Editar</a><br />");
			//$playerRepository->addActionColumn("<a class='eliminar-jugador' href='" . route('players.api.delete', $model->id) . "' id='eliminar-jugador'>Eliminar</a><br />");
			//$playerRepository->addActionColumn("<a class='cambiar-equipo' href='" . route('players.api.change-team', $model->id) . "' id='eliminar-jugador'>Cambiar</a>");
			$playerRepository->addActionColumn("<a  class='remove-player-team' href='" . route('teams.api.remove.player', [$id, $model->id]) . "' id='remove_player-team_".$model->id."'>Sacar</a><br />");
			//$playerRepository->addActionColumn("<a  class='editar-jugador' href='#new-jugador-form' id='estadisticas_".$model->id."'>Estadísticas</a><br />");
			return implode(" ", $playerRepository->getActionColumn());
		});
		return $playerRepository->getTableCollectionForRender();
	}

	public function existsPlayerTeam($data = array())
	{
		if ($this->existsPlayer($data) == 0){
			return FALSE;
		}else{
			if ($this->exitNumberPlayer($data)) {
				return FALSE;
			}else{
				return TRUE;
			}
		}

	}

	public function removePlayer($id, $playerId){
		$team = $this->get($id);
		if($team && $team->hasPlayers)
			return $team->jugadores()->detach($playerId);
		return false;
	}

	public function existsPlayer($data = array())
	{
		$equipo = $this->get($data['equipo_id']);
		return $equipo->whereHas('jugadores', function($q) use ($data){
    		$q->where('jugador_id', '=', $data['jugador_id']);
		})->count();
	}

	public function exitNumberPlayer($data = array())
	{
		$equipo = $this->get($data['equipo_id']);
		return $equipo->whereHas('jugadores', function($q) use ($data)
		{
    		$q->where('jugador_id', '!=', $data['jugador_id'])
    			->where('numero', '=', $data['numero']);
		})->count();
	}

	public function existeNumero($id, $numero, $from, $to)
	{
		return (
				$this->get($id)
					 ->jugadores()
					 ->whereNumero($numero)
					 ->whereRaw("
							(
							    (
							        '$from' BETWEEN fecha_inicio AND fecha_fin or 
								 	'$to' BETWEEN fecha_inicio AND fecha_fin
							    ) or 
							 	( '$from' >= fecha_inicio AND (fecha_fin IS NULL OR fecha_fin = '0000-00-00') )
							)
					 	")
					 ->count() ? true : false);
	}

	public function deleteImageDirectory($id)
	{
		$equipo = $this->get($id);
		if (File::exists(public_path().$equipo->foto->url())) {
			$ruta = explode("/", $equipo->foto->url());
			$directorio = public_path().'/system/soccer/Equipo/Equipo/fotos/000/000/'.$ruta[8];
			$equipo->foto->delete();
			File::deleteDirectory($directorio, false);
		}
		if (File::exists(public_path().$equipo->escudo->url())) {
			$ruta = explode("/", $equipo->escudo->url());
			$directorio = public_path().'/system/soccer/Equipo/Equipo/escudos/000/000/'.$ruta[8];
			$equipo->escudo->delete();
			File::deleteDirectory($directorio, false);
		}
	}
}