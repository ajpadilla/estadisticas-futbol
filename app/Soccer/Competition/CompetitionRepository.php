<?php namespace soccer\Competition;

use soccer\Base\BaseRepository;
use soccer\Competition\Phase\PhaseRepository;
use soccer\Group\GroupRepository;
use soccer\Game\GameRepository;
use soccer\Competition\Competition;
use soccer\Equipo\EquipoRepository;
use Illuminate\Database\Eloquent\Collection;
/**
* 
*/
class CompetitionRepository extends BaseRepository
{		
	
	protected $teams;

	function __construct() {
		$this->columns = [
			'Nombre',
			'Inicia',
			'Finaliza',
			'Acciones'
		];

		$this->setModel(new Competition);
		$this->setListAllRoute('competitions.api.list');
		$this->teams = new Collection;
	}
    /*
	********************* Methods ***********************
    */
    	

	public function create($data = array())
	{
		if (empty($data['pais_id'])) {
			$data['pais_id'] = NULL;
		}
		$competition = $this->model->create($data); 

		if($competition->isLeague) {
			$groupRepository = new GroupRepository;
			$groupRepository->create(['name' => $competition->nombre, 'competition_id' => $competition->id]);
		}
		return $competition;
	}

	public function update($data = array())
	{
		if (empty($data['country_id']))
			$data['country_id'] = NULL;

		if (empty($data['international']))
			$data['international'] = 0;

		$competition = $this->get($data['competition_id']);
		$competition->update($data);
		return $competition;
	}


	public function addGroup($id, $group, $teams = null)
	{
		$competition = $this->get($id);
		$groupRepository = new GroupRepository;
		$group['competition_id'] = $competition->id;
		$group = $groupRepository->create($group);			
		
		/*if(!$teams && isset($group['teams_ids'])) {
			$teams = $group['teams_ids'];
		}*/

		/*if($group) {
			if($competition->teamsByGroup < count($teams))
				$teams = array_slice($teams, 0, $competition->teamsByGroup);
			$group->attach($teams);
		}*/
		return $group;
	}

	public function getCurrentPhase($id)
	{
		if($this->isEmpty($id)) {
			$competition = $this->get($id);
			foreach ($competition->phases as $phase)
				if($phase->isCurrent)
					return $phase;
			return $competition->phases()->orderBy('from', 'DESC')->first();
		}
		return false;
	}

	public function isEmpty($id)
	{
		$competition = $this->get($id);
		return !$competition->phases->count();
	}

	public function lastPhase($id)
	{
		if(!$this->isEmpty($id)) {
			$competition = $this->get($id);
			return $competition->phases()->orderBy('from', 'DESC')->first();
		}
		return false;
	}

	public function winner($id)
	{
		$competition = $this->get($id);
		if($competition && !$this->isEmpty($id) && $competition->finished) {
			$competition = $this->get($id);
			if ($lasPhase = $competition->phases()->whereLast(true)->first()) {
				$phaseRepo = new PhaseRepository;
				return $phaseRepo->winner($lasPhase->id);
			}
		}
		return false;
	}

    public function playingCompetitions()
	{
		return Competition::playing()->has('phases.groups')->get();
	}	

    /*
	********************* Datatable Methods ***********************
    */
	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a class='show-competition' href='" . route('competitions.show', $model->id) . "'>Ver</a><br />");
			$this->addActionColumn("<a class='delete-competition' href='#' id='delete_competition_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Nombre', 'Inicia', 'Finaliza');
		$this->collection->orderColumns('Nombre', 'Inicia', 'Finaliza');

		$this->collection->addColumn('Nombre', function($model)
		{
			 return $model->nombre;
		});

		$this->collection->addColumn('Inicia', function($model)
		{
			 return $model->from;
		});

		$this->collection->addColumn('Finaliza', function($model)
		{
			 return $model->to;
		});

		/*$this->collection->addColumn('Tipo de competencia', function($model)
		{
			 return $model->tipoCompetencia->nombre;
		});*/
	}		

	//Obtiene los equipos para una competencia( competencia-phases-groups-equipos-fixture)
	public function getGroupTables($id)
	{		
		$competition = $this->get($id);
		$tables = array();		
		if(!$competition->isClean) {
			$groupRepository = new GroupRepository;			
			$orderColumn = [$groupRepository->getColumnCount() - 2, $groupRepository->getColumnCount() - 3, $groupRepository->getColumnCount() - 5, $groupRepository->getColumnCount() - 4];
			$orderColumn = $groupRepository->getColumnCount() - 2;
			foreach ($competition->phases as $phase) {
				if($phase->hasAssociateGroups) {
					$tables[$phase->id]['name'] = $phase->name;
					foreach ($phase->groups as $group) 
						$tables[$phase->id]['tables'][] = $groupRepository->getAllTable('groups.api.list.group', [$group->id], $orderColumn, 'desc', $group->id);
				}
			}
		}
		return $tables;
	}

	public function getGamesTables($id)
	{		
		$competition = $this->get($id);
		$tables = array();		
		if($competition->hasGames) {
			$gameRepository = new GameRepository;			
			$orderColumn = $gameRepository->getColumnCount() - 1;
			foreach ($competition->phasesWithGames as $phase) {
				if($phase->hasAssociateGroups && $phase->hasGames) {
					$tables[$phase->id]['name'] = $phase->name;
					foreach ($phase->groupsWithGames as $group) 
						if($group->hasGames) 
							$tables[$phase->id]['tables'][] = $gameRepository->getAllTable('groups.api.list.games', [$group->id], $orderColumn, 'desc', 'game-' . $group->id);
				}
			}
		}
		return $tables;
	}	

	public function positionsTeamsForTournament($id)
	{
		$competition = $this->get($id);
		$groupsFixtures = array();
		if($competition->hasPhases) 
		{
			$indexGroup = 1;
			$firstPhase = $competition->phases->first();
			foreach ($firstPhase->groups as $group) {
				$groupsFixtures[$indexGroup] = $this->getOrderedFixturesArrayByCompetition($competition, $group->teams);
				$indexGroup++;
			}
			return $groupsFixtures;
		}
	}

	public function getOrderedFixturesArrayByCompetition(Competition $competition, $teams)
	{
		$competition = $competition;
		$fixtures = array();
		$teamRepository = new EquipoRepository;
		foreach ($teams as $team) {
			$localGames = $teamRepository->getLocalGamesByCompetition($team->id, $competition->from, $competition->to);
			$awayGames = $teamRepository->getAwayGamesByCompetition($team->id, $competition->from, $competition->to);
			$winGames = $teamRepository->getWinGamesByCompetition($team->id, $localGames, $awayGames, $competition->from, $competition->to);
			$lostGames = $teamRepository->getLostGamesByCompetition($team->id, $localGames, $awayGames, $competition->from, $competition->to);
			$tieGames = $teamRepository->getTieGamesByCompetition($team->id, $localGames, $awayGames, $competition->from, $competition->to);
			$scoredGoals = $teamRepository->getScoredGoalsByCompetition($team->id, $localGames, $awayGames, $competition->from, $competition->to);
			$againstGoals = $teamRepository->getAgainstGoalsByCompetition($team->id, $localGames, $awayGames, $competition->from, $competition->to);
			$gamesPlayed = $teamRepository->getPlayedGamesByCompetition($team->id, $competition->from, $competition->to);

			$teamFixtures = array(
				'id' => $team->id,
				'team' => $team,
				'pos' => 0,
				'gamesPlayed' => $gamesPlayed,
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
    		return $a['points'] <= $b['points'];
		});

		$i = 1;

		$orderedFixtures = array();
		foreach ($fixtures as $index => $fixture) {
			$fixture['pos'] = $i;
			unset($fixtures[$index]);
			$orderedFixtures[$i] = $fixture;
			$i++;
		}
		unset($fixtures);
		return $orderedFixtures;
	}

	public function getGamesForPhase($phaseId)
	{
		$gamesFixtures = array();
		$gameRepository = new GameRepository;
		$phaseRepository = new PhaseRepository;
		$phase = $phaseRepository->get($phaseId);
		if ($phase->hasAssociateGroups && $phase->hasGames) {
			foreach ($phase->groupsWithGames as $indexGroup => $group) {
				if($group->hasGames){
					foreach ($group->games as $indexGame => $game) {
						$fixturesLocalGoals = $gameRepository->getGoalsFixtures($game->id, $game->localTeam->id);
						$fixturesAwayGoals = $gameRepository->getGoalsFixtures($game->id, $game->awayTeam->id);
						$gameFixtures = array(
							'game' => $game,
							'localTeam' => $game->localTeam,
							'awayTeam' => $game->awayTeam,
							'localGoals' => $game->localGoals,
							'awayGoals' => $game->awayGoals,
							'date' => $game->date,
							'time' => $game->time,
							'fixturesLocalGoals' => $fixturesLocalGoals,
							'fixturesAwayGoals' => $fixturesAwayGoals
						);
						$gamesFixtures[$indexGroup][$indexGame]['game'] = $gameFixtures;
					}
				}
			}
			return $gamesFixtures;
		}
	}
}