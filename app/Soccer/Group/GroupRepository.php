<?php namespace soccer\Group;

use soccer\Group\Group;
use soccer\Base\BaseRepository;
use soccer\Equipo\EquipoRepository;
use soccer\Competition\CompetitionRepository;
use soccer\Game\GameRepository;
use Carbon\Carbon;
use Datatable;
use Illuminate\Database\Eloquent\Collection;

/**
* 
*/
class GroupRepository extends BaseRepository
{		

	function __construct() {
		$this->columns = [
				'Pos',
				'Equipo',
				'JJ',
				'JG',
				'JP',
				'JE',
				'GF',
				'GC',
				'DG',
				'PTS',
				'Acciones'
			];

		$this->setModel(new Group);
		$this->setListAllRoute('groups.api.lista');
	}	

	/**
	*********************** Methods******************************
	*/

	public function get($id)
	{
		return $this->model->with('teams')->findOrFail($id);
	}

	public function create($data = array())
	{		
		$group = $this->model->create($data); 
		if($group) {
			$teams = ( isset($data['teams_ids']) ? $data['teams_ids'] : array() );
			if(!empty($teams)) {
				if($group->competition->teamsByGroup < count($teams))
					$teams = array_slice($teams, 0, $group->competition->teamsByGroup);
				$group->teams()->attach($teams);
			}
		}		
		return $group;
	}

	
	public function update($data = array())
	{		
		$group = $this->get($data['group_id']);
		$group->update($data); 
		
		if($group) {
			$teams = ( isset($data['teams_ids']) ? $data['teams_ids'] : array() );
			if(!empty($teams)) {
				if($group->competition->teamsByGroup < count($teams))
					$teams = array_slice($teams, 0, $group->competition->teamsByGroup);
				$group->teams()->sync($teams);
			}
		}		
		return $group;
	}


	public function addTeams($id, $teams = null)
	{		
		$group = $this->get($id);				
		if($group && !empty($teams)) {
			if($group->totalMissingTeams < count($teams))
				$teams = array_slice($teams, 0, $group->totalMissingTeams);
			
			$unavailableTeams = array();
			foreach ($teams as $index => $team) 
				if($this->teamExistInGroup($group->id, $team))
					$unavailableTeams[] = $index;

			foreach ($unavailableTeams as $team) 
				unset($teams[$team]);
			
			if(!empty($teams))
				$group->teams()->attach($teams);
			else
				$group = false;
		} else {
			$group = false;
		}
		return $group;
	}

	public function addGame($id, $game)
	{
		$group = $this->get($id);
		if($group && !empty($game)) {
			if(!$group->isFullGames && !$this->gameAlreadyExists($group->id, $game['local_team_id'], $game['away_team_id']))
			{
				$gameRepository = new GameRepository;
				$game = $gameRepository->create($game);
				return $game;
			}
		}
	}

	public function teamExistInGroup($id, $team)
	{
		$group = $this->get($id);
		return $group->teams()->whereTeamId($team)->first();
	}	
	public function getAvailableTeams($id, $forList = true)
	{
		$teams = false;
		$group = $this->get($id);
		if($group) {
			$competition = $group->competition;
			$equipoRepository = new EquipoRepository;
			if($competition->international) 
				$teams = $equipoRepository->getAll($group->teams->lists('id'));
			else
				$teams = $equipoRepository->getByCountry($competition->country, $group->teams->lists('id'));
		}	
		if(!empty($teams) && $forList) {
			$listTeams = array();
			foreach ($teams as $team) 
				$listTeams[] = array('id' => $team->id, 'name' => $team->nombre);
			$teams = $listTeams;
		}
		return $teams;
	}


	public function gameAlreadyExists($id, $localTeam, $awayTeam)
	{
		$group = $this->get($id);
		return $group->games()->whereLocalTeamId($localTeam)->whereAwayTeamId($awayTeam)->count();
	}

	public function getTeamsWithoutFullGames($id)
	{
		$group = $this->get($id);
		if($group && !$group->isFullGames) {
			$availableTeams = new Collection();
			$teams  =  $group->teams;
			$teams2 =  $teams;

			foreach ($teams as $key => $team) {
				foreach ($teams2 as $key2 => $team2) {
					if ($team->id != $team2->id) {
						$localGameExists = $this->gameAlreadyExists($id, $team->id, $team2->id);
						$awayGameExists  = $this->gameAlreadyExists($id, $team2->id, $team->id);

						if (!$localGameExists || !$awayGameExists) {
							$availableTeams->add($team);
							break;
						}
					}
				}
			}
			//dd($availableTeams->lists('nombre'));
			return $availableTeams;
		}
		return false;
	}

	public function getGames($id)
	{
		$group = $this->get($id);
		//dd($group->games->toArray());
		return $group->games;
	}

	public function removeTeam($id, $teamId)
	{
		$group = $this->get($id);
		if($group && $group->hasTeams)
			return $group->teams()->detach($teamId);
		return false;
	}	

	/*
	*********************** DATATABLE SETTINGS ******************************
	*/		

	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a class='ver-equipo' href='" . route('equipos.show', $model->id) . "'>Ver</a><br />");
			$this->addActionColumn("<a  class='editar-equipo' href='#new-team-form' id='editar_equipo_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='eliminar-equipo' href='#' id='eliminar_equipo_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	// Obtiene los fixtures de cada equipo para cada grupo 
	public function getOrderedFixturesArrayByGroup($id)
	{
		$fixtures = array();
		$teamRepository = new EquipoRepository;
		foreach ($teamRepository->getSortByPointsByGroup($id) as $team) 
		{
			$localGames = $teamRepository->getLocalGamesByGroup($team->id, $id);
			$awayGames = $teamRepository->getAwayGamesByGroup($team->id, $id);
			$winGames = $teamRepository->getWinGamesByGroup($team->id, $id, $localGames, $awayGames);
			$lostGames = $teamRepository->getLostGamesByGroup($team->id, $id, $localGames, $awayGames);
			$tieGames = $teamRepository->getTieGamesByGroup($team->id, $id, $localGames, $awayGames);
			$scoredGoals = $teamRepository->getScoredGoalsByGroup($team->id, $id);
			$againstGoals = $teamRepository->getAgainstGoalsByGroup($team->id, $id, $localGames, $awayGames);

			$teamFixtures = array(
				'id' => $team->id,
				'team' => $team,
				'pos' => 0,
				//'gamesPlayed' => $teamRepository->getPlayedGamesByGroup($team->id, $id),
				'gamesPlayed' => (count($localGames) + count($awayGames)),
				'winGames' => $winGames,
				'lostGames' => $lostGames,
				'tieGames' => $tieGames,
				'scoredGoals' => $scoredGoals,
				'againstGoals' => $againstGoals,
				'goalsDiff' => $scoredGoals - $againstGoals,
				'points' => ($winGames * 3) + $tieGames
			);
			$fixtures[$team->id] = $teamFixtures;
		}

		usort($fixtures, function($a, $b) {
			if($a['points'] == $b['points']){
    			return $a['goalsDiff'] <= $b['goalsDiff'];
    		}else{
    			return $a['points'] <= $b['points'];
    		}

    		//return $a['points'] <= $b['points'];
		});

		$i = 1;

		$orderedFixtures = array();
		foreach ($fixtures as $index => $fixture) {
			$fixture['pos'] = $i;
			unset($fixtures[$index]);
			$orderedFixtures[$fixture['id']] = $fixture;
			$i++;
		}
		unset($fixtures);
		return $orderedFixtures;
	}

	private function setTableGroupContent($id, EquipoRepository $teamRepository)
	{
		$teamRepository->collection->searchColumns('Pos', 'Equipo', 'JJ', 'JG', 'JP', 'JE', 'GF', 'GC', 'DG', 'PTS');
		$teamRepository->collection->orderColumns('Pos', 'Equipo', 'JJ', 'JG', 'JP', 'JE', 'GF', 'GC', 'DG', 'PTS');

		$fixtures = $this->getOrderedFixturesArrayByGroup($id);

		$teamRepository->collection->addColumn('Pos', function($model) use ($teamRepository, $id, $fixtures)
		{
			return $fixtures[$model->id]['pos'];
			//return $teamRepository->getPositionForTeamInGroup($model->id, $id);
		});

		$teamRepository->collection->addColumn('Equipo', function($model)
		{
			return $model->nombre;
		});

		$teamRepository->collection->addColumn('JJ', function($model) use ($teamRepository, $id, $fixtures)
		{
			return $fixtures[$model->id]['gamesPlayed'];
			//return $teamRepository->getPlayedGamesByGroup($model->id, $id);
		});

		$teamRepository->collection->addColumn('JG', function($model) use ($teamRepository, $id, $fixtures)
		{
			return $fixtures[$model->id]['winGames'];
			//$winGames = $teamRepository->getWinGamesByGroup($model->id, $id);
			//return $winGames;
		});		

		$teamRepository->collection->addColumn('JP', function($model) use ($teamRepository, $id, $fixtures)
		{
			return $fixtures[$model->id]['lostGames'];
			//return $teamRepository->getLostGamesByGroup($model->id, $id);
		});

		$teamRepository->collection->addColumn('JE', function($model) use ($teamRepository, $id, $fixtures)
		{
			return $fixtures[$model->id]['tieGames'];
			//$tieGames = $teamRepository->getTieGamesByGroup($model->id, $id);
			//return $tieGames;
		});
		
		$teamRepository->collection->addColumn('GF', function($model) use ($teamRepository, $id, $fixtures)
		{
			return $fixtures[$model->id]['scoredGoals'];
			//$scoredGoals = $teamRepository->getScoredGoalsByGroup($model->id, $id);
			//return $scoredGoals;
		});
		
		$teamRepository->collection->addColumn('GC', function($model) use ($teamRepository, $id, $fixtures)
		{
			return $fixtures[$model->id]['againstGoals'];
			//$againstGoals = $teamRepository->getAgainstGoalsByGroup($model->id, $id);
			//return $againstGoals;
		});

		$teamRepository->collection->addColumn('DG', function($model) use ($teamRepository, $id, $fixtures)
		{
			return $fixtures[$model->id]['goalsDiff'];
		});

		$teamRepository->collection->addColumn('PTS', function($model) use ($teamRepository, $id, $fixtures)
		{
			return $fixtures[$model->id]['points'];
		});
	}	

	public function getDefaultTableForGroupTeams($id)
	{
		$teamRepository = new EquipoRepository;
		//retorna los equipos por de un grupo de una phase, el metodo se encuentra en EquipoRepository
		$teams = $teamRepository->getSortByPointsByGroup($id);
		if($teams) {
			//crea un collection para el datatable
			$teamRepository->setDatatableCollection($teams);
			// obtiene los fixtures por cada equipo de cada grupo, pasandole el id del grupo
			$this->setTableGroupContent($id, $teamRepository);
			$teamRepository->addColumnToCollection('Acciones', function($model) use ($teamRepository, $id) 
			{
				$teamRepository->cleanActionColumn();
				$teamRepository->addActionColumn("<a class='show-team' href='" . route('equipos.show', $model->id) . "' id='show-team'>Ver</a><br />");
				$teamRepository->addActionColumn("<a class='remove-from-group' href='" . route('groups.api.remove.team', [$id, $model->id]) . "' id='delete_teamToGroup_".$model->id."' data-group-id='".$id."'>Sacar</a><br />");
				return implode(" ", $teamRepository->getActionColumn());
			});
			return $teamRepository->getTableCollectionForRender();
		}
		return null;
	}	

	public function getDefaultTableForGroupGames($id)
	{
		$games = $this->getGames($id);
		if($games) {
			$gameRepository = new GameRepository;
			$gameRepository->setDatatableCollection($games);
			$gameRepository->setDefaultTableSettings();
			return $gameRepository->getTableCollectionForRender();
		}
		return null;
	}	

	public function getTableForGroupTeams($idGroup)
	{
		$teamRepository = new EquipoRepository;
		$teams = $teamRepository->getSortByPointsByGroup($idGroup);
		$fixtures = $this->getOrderedFixturesArrayByGroup($id);

	}
}