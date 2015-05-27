<?php namespace soccer\Equipo;

use soccer\Equipo\Equipo;
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
		if($exclude)
			return $country->teams()->whereNotIn('id', $exclude)->get();
		return $country->teams;
	}

	public function  getAll($exclude = null)
	{
		if($exclude)
			return $this->getModel()->whereNotIn('id', $exclude)->get();
		return $this->getModel()->all();
	}

	/*
	*********************** METHODS FOR GROUPS ******************************
	*/		
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
		$gameRepository = new GameRepository;
		$query = $gameRepository->getModel()->select();
		$query->where('games.local_team_id', '=', $id)
			  ->orWhere('games.away_team_id', '=', $id)
			  ->where('games.group_id', '=', $groupId)
			  ->where('games.date', '<', Carbon::now()->addMinutes(120)->format('Y-m-d h:i:00'));
		return $query->count();	
	}

	public function getWinGamesByGroup($id, $groupId)
	{
		$winGames = 0;

		$team = $this->get($id);		
		$localGames = $team->localGames()->whereGroupId($groupId)->get();
		foreach ($localGames as $game) 
			$winGames += ($game->localGoals > $game->awayGoals ? 1 : 0);
		
		$awayGames = $team->awayGames()->whereGroupId($groupId)->get();
			foreach ($awayGames as $game) 
				$winGames += ($game->localGoals < $game->awayGoals ? 1 : 0);		

		return $winGames;
	}

	public function getLostGamesByGroup($id, $groupId)
	{
		$lostGames = 0;

		$team = $this->get($id);		
		$localGames = $team->localGames()->whereGroupId($groupId)->get();
		foreach ($localGames as $game) 
			$lostGames += ($game->localGoals < $game->awayGoals ? 1 : 0);
		
		$awayGames = $team->awayGames()->whereGroupId($groupId)->get();
			foreach ($awayGames as $game) 
				$lostGames += ($game->localGoals > $game->awayGoals ? 1 : 0);		

		return $lostGames;	
	}

	public function getTieGamesByGroup($id, $groupId)
	{
		$tieGames = 0;

		$team = $this->get($id);		
		$localGames = $team->localGames()->whereGroupId($groupId)->get();
		foreach ($localGames as $game) 
			$tieGames += ($game->localGoals == $game->awayGoals ? 1 : 0);
		
		$awayGames = $team->awayGames()->whereGroupId($groupId)->get();
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

	public function getAgainstGoalsByGroup($id, $groupId)
	{
		$goals = 0;

		$team = $this->get($id);		
		$localGames = $team->localGames()->whereGroupId($groupId)->get();
		foreach ($localGames as $game) 
			$goals += $game->awayGoals;
		
		$awayGames = $team->awayGames()->whereGroupId($groupId)->get();
			foreach ($awayGames as $game) 
				$goals += $game->localGoals;		

		return $goals;
	}

	public function getGoalsDifferenceByGroup($id, $groupId)
	{		
		return 0;		
	}

	public function getPointsByGroup($id, $groupId)
	{
		// Obtengo todos los partidos que ya se han jugado para este equipo en ese grupo 
		return 0;		
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
		$playerRepository->addColumnToCollection('Acciones', function($model) use ($playerRepository)
		{
			$playerRepository->cleanActionColumn();
			$playerRepository->addActionColumn("<a class='ver-jugador' href='" . route('players.show', $model->id) . "' id='ver_jugador'>Ver</a><br />");
			$playerRepository->addActionColumn("<a  class='editar-jugador' href='#new-player-form' id='editar_".$model->id."'>Editar</a><br />");
			$playerRepository->addActionColumn("<a class='eliminar-jugador' href='" . route('jugadores.api.eliminar', $model->id) . "' id='eliminar-jugador'>Eliminar</a><br />");
			$playerRepository->addActionColumn("<a class='cambiar-equipo' href='" . route('jugadores.api.cambiar-equipo', $model->id) . "' id='eliminar-jugador'>Cambiar</a>");
			$playerRepository->addActionColumn("<a  class='editar-jugador' href='#new-jugador-form' id='sacar_".$model->id."'>Sacar</a><br />");
			$playerRepository->addActionColumn("<a  class='editar-jugador' href='#new-jugador-form' id='estadisticas_".$model->id."'>Estadísticas</a><br />");			
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

	public function existeNumero($id, $numero)
	{
		return ($this->get($id)->jugadores()->whereNumero($numero)->whereFechaFin(null)->count() ? true : false);
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