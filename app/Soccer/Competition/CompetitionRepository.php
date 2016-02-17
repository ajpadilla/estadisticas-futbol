<?php namespace soccer\Competition;

use soccer\Base\BaseRepository;
use soccer\Competition\Phase\PhaseRepository;
use soccer\Group\GroupRepository;
use soccer\Game\GameRepository;
use soccer\Competition\Competition;
use soccer\Equipo\EquipoRepository;
use Illuminate\Database\Eloquent\Collection;
use Carbon\Carbon;
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
		foreach ($teams as $team) 
		{

			$gamesPlayed = 0;
			$winGames = 0;
			$lostGames = 0;
			$tieGames = 0;
			$scoredGoals = 0;
			$againstGoals = 0;
			$goalsDiff = 0;
			$points = 0;

			$localGames = $teamRepository->getLocalGamesByCompetition($team->id, $competition->from, $competition->to);
			$awayGames = $teamRepository->getAwayGamesByCompetition($team->id, $competition->from, $competition->to);
			$winGames = $teamRepository->getWinGamesByCompetition($team->id, $localGames, $awayGames, $competition->from, $competition->to);
			$lostGames = $teamRepository->getLostGamesByCompetition($team->id, $localGames, $awayGames, $competition->from, $competition->to);
			$tieGames = $teamRepository->getTieGamesByCompetition($team->id, $localGames, $awayGames, $competition->from, $competition->to);
			$scoredGoals = $teamRepository->getScoredGoalsByCompetition($team->id, $localGames, $awayGames, $competition->from, $competition->to);
			$againstGoals = $teamRepository->getAgainstGoalsByCompetition($team->id, $localGames, $awayGames, $competition->from, $competition->to);
			//$gamesPlayed = $teamRepository->getPlayedGamesByCompetition($team->id, $competition->from, $competition->to);
			$gamesPlayed = (count($localGames) + count($awayGames));

			$teamFixtures = array(
				'id' => $team->id,
				'team' => $team,
				'img' => $team->escudo->url('thumb'),
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

	public function getNameForCompetitionAndPhase($phaseId, $competitionId)
	{
		$competition = $this->get($competitionId);
		$phaseRepository = new PhaseRepository;
		$phase = $phaseRepository->get($phaseId);
		$info = array(
			'competition' => $competition->nombre,
			'phase' => $phase->name
		);
		return $info;
	}

	public function getGamesForPhase($phaseId)
	{
		$gamesFixtures = array();
		$gameRepository = new GameRepository;
		$phaseRepository = new PhaseRepository;
		$phase = $phaseRepository->get($phaseId);
		if ($phase->hasAssociateGroups && $phase->hasGames) 
		{
			foreach ($phase->groupsWithGames as $indexGroup => $group) 
			{
				if($group->hasGames)
				{
					foreach ($group->games as $indexGame => $game) {
						$fixturesLocalGoals = $gameRepository->getGoalsFixtures($game->id, $game->localTeam->id);
						$fixturesAwayGoals = $gameRepository->getGoalsFixtures($game->id, $game->awayTeam->id);
						$date = Carbon::parse($game->date);
						$dateObject = Carbon::parse($game->date);
						$gameFixtures = array(
							'group_id' => $group->id,
							'game' => $game,
							'localTeam' => $game->localTeam,
							'awayTeam' => $game->awayTeam,
							'localGoals' => $game->localGoals,
							'awayGoals' => $game->awayGoals,
							'date' => $date->formatLocalized('%A %d %B %Y'),
							'dateObject' => $date, 
							'time' => $game->time,
							'fixturesLocalGoals' => $fixturesLocalGoals,
							'fixturesAwayGoals' => $fixturesAwayGoals,
							'imgLocalTeam' => $game->localTeam->escudo->url('thumb'),
							'imgAwayTeam' =>  $game->awayTeam->escudo->url('thumb')
						);

						$gamesFixtures[$indexGroup][$indexGame]['game'] = $gameFixtures;
					}
				}
			}
			return $gamesFixtures;
		}
	}

	public function statsPhase($phaseId)
	{
		$statistics = array(
			'totalGames' => 0,
			'totalsGolas' => 0,
			'totalGoalsLocal' => 0,
			'totalGoalsAway' => 0,
			'winGamesLocal' => 0,
			'winGamesAway' => 0,
			'tieGames' => 0,
			'average' => 0
		);
		$gameRepository = new GameRepository;
		$phaseRepository = new PhaseRepository;
		$phase = $phaseRepository->get($phaseId);

		if ($phase->hasAssociateGroups && $phase->hasGames)
		{
			foreach ($phase->groupsWithGames as $group) 
			{
				if($group->hasGames)
				{
					$statistics['totalGames'] += $group->totalGames;
					foreach ($group->games as $game) 
					{
						$statistics['totalsGolas'] += $game->goals()->count(); 
						$statistics['totalGoalsLocal'] += $game->localGoals;
						$statistics['totalGoalsAway'] += $game->awayGoals;
						$statistics['winGamesLocal'] += ($game->localGoals > $game->awayGoals ? 1 : 0);
						$statistics['winGamesAway'] += ($game->localGoals < $game->awayGoals ? 1 : 0);
						$statistics['tieGames'] += ($game->localGoals == $game->awayGoals ? 1 : 0);
					}
				}
			}
			$statistics['average'] = ($statistics['totalsGolas'] / $statistics['totalGames']);
		}
		return $statistics;
	}

	public function scorersInCompetition($id)
	{
		$competition = $this->get($id);
		$goalsCollection = new Collection;
		$idsPlayers = array();
		$scoredGoals = array();
		if($competition->hasGames) 
		{
			foreach ($competition->phasesWithGames as $phase) {
				if($phase->hasAssociateGroups && $phase->hasGames) {
					foreach ($phase->groupsWithGames as $group){
						if($group->hasGames){
							foreach ($group->games as $game) {
								foreach ($game->goals as $goal) {

									if(!in_array($goal->player_id, $idsPlayers))
										$idsPlayers[] = $goal->player_id;
									$goalsCollection->add($goal);
								}
							}
						} 
					}
				}
			}
		}

		$goalsCollection->sort(function($a, $b){
			$a = $a->player_id;
			$b = $b->player_id;

			if($a === $b){
				return 0;
			}

			return ($a > $b) ? 1 : -1;
		});

		usort($idsPlayers, function($a, $b) {
			if ($a == $b) {
				return 0;
			}
			return ($a > $b) ? 1 : -1;
		});

		foreach ($idsPlayers as $key => $value) 
		{
			$totalsGoals = $goalsCollection->filter(function($goal) use ($value){
				if ($goal->player_id == $value) return true;
			})->count();
			
			$goal = $goalsCollection->filter(function($goal) use ($value){
				if ($goal->player_id == $value) return true;
			})->first();

			$scoredGoals[] = array('totalsGoals' => $totalsGoals , 'team' => $goal->team, 'img' => $goal->team->escudo->url('thumb'), 'player' => $goal->player);
		}

		usort($scoredGoals, function($a, $b) {
			return $a['totalsGoals'] <= $b['totalsGoals'];
		});

		/*foreach ($scoredGoals as $key => $value) {
			echo $key." ".$value['totalsGoals']."</br>";
			echo $key." ".$value['team']->nombre."</br>";
			echo $key." ".$value['player']->nombre."</br>";
		}*/

		return $scoredGoals;
	}

	public function getPostTeamsForGruop($id)
	{
		$groupRepository = new GroupRepository;
		return $groupRepository->getOrderedFixturesArrayByGroup($id);
	}

	public function getGamesForTypePhase($type, $startCompetition, $endCompetition)
	{
		$infoGames = [];
		$phaseRepository = new PhaseRepository;
		$phase = $phaseRepository->getModel()->whereType($type)
											 ->where('from','>=', $startCompetition)
											 ->where('to','<=', $endCompetition)->first();

		if(!empty($phase))
			return $infoGames = ['games' => $this->getGamesForPhase($phase->id),'media' => $phase->mediaGamesPlayed];
		return false;
	}

	public function getCompetitionsForCurrentAverage($id)
	{
		$competition = $this->get($id);

		$competitions = $this->getModel()
		->whereType($competition->type)
		->orderBy('desde', 'desc')
		->orderBy('hasta', 'desc') 
		->where('desde','<=', $competition->desde)
		->where('hasta','<=', $competition->hasta)
		->take(6)
		->get();

		return $competitions;
	}

	public function getAverage(Collection $competitions, Competition $currentCompetition)
	{
		$teams = new Collection;
		$featuresForTeamsCompetition = [];
		
		foreach ($competitions as $competition) 
		{
			if($competition->hasPhases) 
			{
				$firstPhase = $competition->phases->first();
				$featuresForTeamsCompetition[] = $this->getOrderedFixturesArrayByCompetition($competition, $firstPhase->teams);
				$datesForCompetitions[] = $competition->year;
			}else{
				$featuresForTeamsCompetition[] = null;
			}

		}
		if($currentCompetition->hasPhases) 
		{
			$firstPhaseForCurrentCompetition = $currentCompetition->phases->first();

			foreach ($firstPhaseForCurrentCompetition->teams as $currentTeamForCompetition) 
			{
				$totalPoints = 0;
				$totalGamesPlayed = 0;
				$average = 0;
				$averageForCompetition = [];

				$dateCurrent = $currentCompetition->year;


				//Average total de los (6) ultimos torneos competidos
				foreach ($featuresForTeamsCompetition as $teams) 
				{
					if (!empty($teams)) 
					{
						foreach ($teams as $team) 
						{
							if($currentTeamForCompetition->id == $team['id'])
							{
								$totalPoints += $team['points'];
								$var = $team['points'];
								$totalGamesPlayed += $team['gamesPlayed'];
								break;
							}
						}
						$averageForCompetition[] = $team['points'];
					}else{
						$averageForCompetition[] = 0;
					}
					
				}
				if($totalGamesPlayed > 0)
					$average = ($totalPoints / $totalGamesPlayed);

				$averageForTeams[] = array(
						'dateCurrent' => $dateCurrent,
						'average' => number_format($average, 3),
						'totalPoints'=> $totalPoints,
						'gamesPlayed' => $totalGamesPlayed, 
						'team' => $currentTeamForCompetition, 
						'averageForCompetition' => array_reverse($averageForCompetition, true)
				);
			}

			usort($averageForTeams, function($a, $b) {
	    		return $a['average'] <= $b['average'];
			});

			$i = 1;

			$orderedAverageForTeams = array();
			foreach ($averageForTeams as $index => $fixture) {
				$fixture['pos'] = $i;
				unset($averageForTeams[$index]);
				$orderedAverageForTeams[$i] = $fixture;
				$i++;
			}
			unset($averageForTeams);
			return $orderedAverageForTeams;
		}
	}
}