<?php namespace soccer\Group;

use soccer\Group\Group;
use soccer\Base\BaseRepository;
use soccer\Equipo\EquipoRepository;
use soccer\Competition\CompetitionRepository;
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

	public function updateTeams($data = array())
	{
		$group = $this->get($data['group_id']);

		if(!empty($data['teams_ids']))
			$group->teams()->sync($data['teams_ids'], false);		
		return $group;
	}

	public function addTeams($id, $teams = null)
	{
		$group = $this->get($id);
		if($group) {
			$competition = $group->competition;
			if($group->totalMissingTeams < count($teams))
				$teams = array_slice($teams, 0, $group->totalMissingTeams);

			$unavailableTeams = array();
			foreach ($teams as $index => $team) 
				if($this->teamExistInGroup($index, $team))
					$unavailableTeams[] = $index;
			
			foreach ($unavailableTeams as $team) 
				unset($teams[$team]);

			$group->attach($teams);
		}
		return $group;
	}

	public function teamExistInGroup($id, $team)
	{
		$group = $this->get($id);
		return $group->teams()->whereTeamId($team)->first();
	}	

	public function getAvailableTeams($competitionId)
	{
		$competitionRepository = new CompetitionRepository;
		$equipoRepository = new EquipoRepository;
		$competition = $competitionRepository->get($competitionId);
		$teamsToGroup = $competition->teams;
		$teamsToCompetition = $equipoRepository->getTeamsByCompetition($teamsToGroup->lists('team_id'), $competition);
		return $teamsToCompetition;
	}

	public function gameAlreadyExists($id, $localTeam, $awayTeam)
	{
		$group = $this->get($id);
		return $group->games()->whereLocalTeamId($localTeam)->whereAwayTeamId($awayTeam)->count();
	}

	public function getTeamsWithoutFullGames($id)
	{
		$group = $this->get($id);
		if(!$group->isFullGames)
		{
			$unavailableTeams = array();
			$teams = $group->teams;
			for ($i=0; $i < count($teams); $i++) { 
				$allLocalGames = true;
				$allAwayGames = true;
				$localTeam = $teams[$i];
				for ($j=0; $j < count($teams); $j++) { 
					if($j != $i) {
						$awayTeam = $teams[$j];
						$allLocalGames = $this->gameAlreadyExists($id, $localTeam->id, $awayTeam->id); 
						$allAwayGames = $this->gameAlreadyExists($id, $awayTeam->id, $localTeam->id);

						if(!$allLocalGames || !$allAwayGames)
							break;
					}
				}
				if($allLocalGames || $allAwayGames)
					$unavailableTeams[] = $i;
			}
			foreach ($unavailableTeams as $index) 
				unset($teams[$index]);
			return $teams;
		}
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

	public function setBodyTableSettings()
	{
		/*
		$this->collection->searchColumns('Equipo', 'JJ', 'JG', 'JP', 'JE', 'GF', 'GC', 'DG', 'PTS');
		$this->collection->orderColumns('Equipo', 'JJ', 'JG', 'JP', 'JE', 'GF', 'GC', 'DG', 'PTS');

		$this->collection->addColumn('Equipo', function($model)
		{
			 return $model->nombre;
		});

		$this->collection->addColumn('JJ', function($model)
		{
			 return $model->nombre;
		});

		$this->collection->addColumn('JG', function($model)
		{
			 return $model->nombre;
		});		

		$this->collection->addColumn('JP', function($model)
		{
			 return $model->nombre;
		});

		$this->collection->addColumn('JE', function($model)
		{
			 return $model->nombre;
		});
		
		$this->collection->addColumn('GF', function($model)
		{
			 return $model->nombre;
		});
		
		$this->collection->addColumn('GC', function($model)
		{
			 return $model->nombre;
		});

		$this->collection->addColumn('DG', function($model)
		{
			 return $model->nombre;
		});

		$this->collection->addColumn('PTS', function($model)
		{
			 return $model->nombre;
		});
		*/
	}	

	private function setTableGroupContent($id, EquipoRepository $teamRepository)
	{
		$teamRepository->collection->searchColumns('Pos', 'Equipo', 'JJ', 'JG', 'JP', 'JE', 'GF', 'GC', 'DG', 'PTS');
		$teamRepository->collection->orderColumns('Pos', 'Equipo', 'JJ', 'JG', 'JP', 'JE', 'GF', 'GC', 'DG', 'PTS');

		$teamRepository->collection->addColumn('Pos', function($model) use ($teamRepository, $id)
		{
			return $teamRepository->getPositionForTeamInGroup($model->id, $id);
		});

		$teamRepository->collection->addColumn('Equipo', function($model)
		{
			return $model->nombre;
		});

		$teamRepository->collection->addColumn('JJ', function($model) use ($teamRepository, $id)
		{
			return $teamRepository->getPlayedGamesByGroup($model->id, $id);
		});

		$teamRepository->collection->addColumn('JG', function($model) use ($teamRepository, $id)
		{
			return $teamRepository->getWinGamesByGroup($model->id, $id);
		});		

		$teamRepository->collection->addColumn('JP', function($model) use ($teamRepository, $id)
		{
			return $teamRepository->getLostGamesByGroup($model->id, $id);
		});

		$teamRepository->collection->addColumn('JE', function($model) use ($teamRepository, $id)
		{
			return $teamRepository->getTieGamesByGroup($model->id, $id);
		});
		
		$teamRepository->collection->addColumn('GF', function($model) use ($teamRepository, $id)
		{
			return $teamRepository->getScoredGoalsByGroup($model->id, $id);
		});
		
		$teamRepository->collection->addColumn('GC', function($model) use ($teamRepository, $id)
		{
			return $teamRepository->getAgainstGoalsByGroup($model->id, $id);
		});

		$teamRepository->collection->addColumn('DG', function($model) use ($teamRepository, $id)
		{
			return $teamRepository->getGoalsDifferenceByGroup($model->id, $id);
		});

		$teamRepository->collection->addColumn('PTS', function($model) use ($teamRepository, $id)
		{
			return $teamRepository->getPointsByGroup($model->id, $id);
		});
	}	

	public function getDefaultTableForGroupTeams($id)
	{
		$teamRepository = new EquipoRepository;
		$teams = $teamRepository->getSortByPointsByGroup($id);
		if($teams) {
			$teamRepository->setDatatableCollection($teams);
			$this->setTableGroupContent($id, $teamRepository);
			$teamRepository->addColumnToCollection('Acciones', function($model) use ($teamRepository)
			{
				$teamRepository->cleanActionColumn();
				$teamRepository->addActionColumn("<a class='show-team' href='" . route('equipos.show', $model->id) . "' id='show-team'>Ver</a><br />");
				return implode(" ", $teamRepository->getActionColumn());
			});
			return $teamRepository->getTableCollectionForRender();
		}
		return null;
	}	
}