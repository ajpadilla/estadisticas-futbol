<?php namespace soccer\Game;

use soccer\Game\Game;
use soccer\Game\Goal\GoalRepository;
use soccer\Game\Change\ChangeRepository;
use soccer\Game\Sanction\SanctionRepository;
use soccer\Game\Alignment\AlignmentRepository;
use soccer\Base\BaseRepository;
use soccer\Equipo\EquipoRepository;
use Carbon\Carbon;
use Datatable;
use Illuminate\Database\Eloquent\Collection;

class GameRepository extends BaseRepository
{		

	function __construct() {
		$this->columns = [
				'Fecha',
				'Hora',
				'Local',
				'Visitante',
				'Resultado',
				'Estatus',
				'Agregar Fixtures',
				'Acciones'
			];

		$this->setModel(new Game);
		$this->setListAllRoute('games.api.list');
	}

	public function get($id)
	{
		return $this->model->with('type','group')->findOrFail($id);
	}	


	public function availableTeams($id)
	{
		return $this->get($id)->teams;
	}

	public function availablePlayersForGameTeam($id, $teamId)
	{
		$teamRepository = new EquipoRepository;
		$players = $teamRepository->get($teamId)->jugadores->lists('nombre', 'id');;
		return $players;
	}

	public function getGoals($id)
	{
		return $this->get($id)->goals;
	}

	public function getChanges($id)
	{
		return $this->get($id)->changes;
	}

	public function getSanctions($id)
	{
		return $this->get($id)->sanctions;
	}

	public function getAlignments($id, $teamId)
	{
		$game = $this->get($id);
		if($game) 
			return $game->alignments()->whereTeamId($teamId)->get();
		return new Collection;
	}

	public function getGoalsFixtures($id, $teamId)
	{
		$game = $this->get($id);
		$goals = $game->goals()->whereTeamId($teamId)->get();

		$fixturesCollection = new Collection;

		$orderFixtures = array();

		if($goals)
			foreach ($goals as $goal) 
				$orderFixtures[] = array('id' => $goal->id, 'time' => $goal->time, 'type' => 'goal');	

	
		usort($orderFixtures, function($a, $b) {
			return $a['time'] >= $b['time'];
		});

		foreach ($orderFixtures as $fixture) 
		{
			$goal = $goals->filter(function($goal) use ($fixture) {
				if ($goal->id == $fixture['id']) return true;
			})->first();
			$goal = '(' . $goal->time . ') ' . $goal->player->nombre;
			$fixturesCollection->add($goal);
		}

		return ($fixturesCollection->isEmpty() ? false : $fixturesCollection);
	}

	public function getFixtures($id, $formatedToView = false)
	{
		$game = $this->get($id);
		$changes = $game->changes;
		$sanctions = $game->sanctions;
		$goals = $game->goals;
		$fixtures = $game->fixtures;

		$fixturesCollection = new Collection;

		$orderFixtures = array();

		if($changes)
			foreach ($changes as $change) 
				$orderFixtures[] = array('id' => $change->id, 'time' => $change->time, 'type' => 'change');

		if($sanctions)
			foreach ($sanctions as $sanction) 
				$orderFixtures[] = array('id' => $sanction->id, 'time' => $sanction->time, 'type' => 'sanction');

		if($goals)
			foreach ($goals as $goal) 
				$orderFixtures[] = array('id' => $goal->id, 'time' => $goal->time, 'type' => 'goal');	

		if($fixtures)
			foreach ($fixtures as $fixture) 
				$orderFixtures[] = array('id' => $fixture->id, 'time' => $fixture->time, 'type' => 'status');

		usort($orderFixtures, function($a, $b) {
			return $a['time'] >= $b['time'];
		});

		foreach ($orderFixtures as $fixture) {
			if ($formatedToView) {										
				switch ($fixture['type']) {
					case 'change':
						$change = $changes->filter(function($change) use ($fixture) {
							if ($change->id == $fixture['id']) return true;
						})->first();
						$change = '(' . $change->time . ') entra (' . $change->player_in->nombre . ') sale (' . $change->player_out->nombre. ')';
						$fixturesCollection->add($change);
					break;

					case 'sanction':
						$sanction = $sanctions->filter(function($sanction) use ($fixture) {
							if ($sanction->id == $fixture['id']) return true;
						})->first();
						$sanction = '(' . $sanction->time . ') ' . $sanction->player->nombre . ', es sancionado  (' . $sanction->type->name. ')';
						$fixturesCollection->add($sanction);
					break;
					
					case 'goal':
						$goal = $goals->filter(function($goal) use ($fixture) {
							if ($goal->id == $fixture['id']) return true;
						})->first();
						$goal = '(' . $goal->time . ') ' . $goal->player->nombre . ', ha marcado un gol  (' . $goal->type->name. ')';
						$fixturesCollection->add($goal);
					break;

					case 'status':
						$fixtureObj = $fixtures->filter(function($fixtureObj) use ($fixture) {
							if ($fixtureObj->id == $fixture['id']) return true;
						})->first();
						$fixtureObj = '(' . $fixtureObj->time . ') ' . $fixtureObj->type->name;
						$fixturesCollection->add($fixtureObj);
					break;					
				}
			} else {
		 		switch ($fixture['type']) {
					case 'change':
						$fixturesCollection->add($changes->filter(function($change) use ($fixture) {
							if ($change->id == $fixture['id']) return true;
						})->first());
					break;

					case 'sanction':
						$fixturesCollection->add($sanctions->filter(function($sanction) use ($fixture) {
							if ($sanction->id == $fixture['id']) return true;
						})->first());
					break;
					
					case 'goal':
						$fixturesCollection->add($goals->filter(function($goal) use ($fixture) {
							if ($goal->id == $fixture['id']) return true;
						})->first());
					break;

					case 'fixture':
						$fixturesCollection->add($fixtures->filter(function($fixtureObj) use ($fixture) {
							if ($fixtureObj->id == $fixture['id']) return true;
						})->first());
					break;					
				}	
			}		
		}

		return ($fixturesCollection->isEmpty() ? false : $fixturesCollection);
	}
	/*
	*********************** DATATABLE SETTINGS ******************************
	*/			

	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Fixtures', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a class='add-alignment' href='#add-alignment-form' id='add-alignment-".$model->id."'>Alineación</a><br />");
			$this->addActionColumn("<a  class='add-change' href='#add-change-form' id='add-change-".$model->id."'>Cambios</a><br />");
			$this->addActionColumn("<a  class='add-goal' href='#add-goal-form' id='add-goal-".$model->id."'>Goles</a><br />");
			$this->addActionColumn("<a class='add-santion' href='#add-santion-form' id='add-santion-".$model->id."'>Sanciones</a>");
			return implode(" ", $this->getActionColumn());
		});

		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a class='show-game' href='" . route('games.show', $model->id) . "' id='show_game_".$model->id."'>Ver</a><br />");
			$this->addActionColumn("<a  class='edit-game' href='#edit-game-form' id='edit_game_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='delete-game' href='#' id='delete_game_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{		
		$this->collection->searchColumns('Fecha', 'Local', 'Visitante', 'Estatus');
		$this->collection->orderColumns('Fecha', 'Local', 'Visitante', 'Estatus');

		$this->collection->addColumn('Fecha', function($model)
		{
			 return $model->dateOnly;
		});

		$this->collection->addColumn('Hora', function($model)
		{
			 return $model->time;
		});

		$this->collection->addColumn('Local', function($model)
		{
			 return $model->localTeam->nombre;
		});		

		$this->collection->addColumn('Visitante', function($model)
		{
			 return $model->awayTeam->nombre;
		});

		$this->collection->addColumn('Resultado', function($model)
		{
			 return $model->localGoals . ' - ' . $model->awayGoals;
		});		

		/*$this->collection->addColumn('Estadio', function($model)
		{
			 return $model->stadium;
		});
		
		$this->collection->addColumn('Arbitro Principal', function($model)
		{
			 return $model->main_referee;
		});
		
		$this->collection->addColumn('Arbitro de Línea', function($model)
		{
			 return $model->line_referee;
		});*/

		$this->collection->addColumn('Estatus', function($model)
		{
			 return $model->status;
		});	
	}	

	public function getGoalsTable($id)
	{		
		$goalRepository = new GoalRepository;		
		return $goalRepository->getAllTable('games.api.goals', [$id], 3, 'asc', 'goals');
	}	

	public function getDefaultTableForGoals($id)
	{
		$goals = $this->getGoals($id);
		if($goals) {
			$goalRepository = new GoalRepository;
			$goalRepository->setDatatableCollection($goals);
			$goalRepository->setDefaultTableSettings();
			return $goalRepository->getTableCollectionForRender();
		}
		return null;
	}	

	public function getChangesTable($id)
	{		
		$changeRepository = new ChangeRepository;		
		return $changeRepository->getAllTable('games.api.changes', [$id], 4, 'asc', 'changes');
	}

	public function getDefaultTableForChanges($id)
	{
		$changes = $this->getChanges($id);
		if($changes) {
			$changeRepository = new ChangeRepository;
			$changeRepository->setDatatableCollection($changes);
			$changeRepository->setDefaultTableSettings();
			return $changeRepository->getTableCollectionForRender();
		}
		return null;
	}	

	public function getSanctionsTable($id)
	{		
		$sanctionRepository = new SanctionRepository;		
		return $sanctionRepository->getAllTable('games.api.sanctions', [$id], 3, 'asc', 'sanctions');
	}

	public function getDefaultTableForSanctions($id)
	{
		$sanctions = $this->getSanctions($id);
		if($sanctions) {
			$sanctionRepository = new SanctionRepository;
			$sanctionRepository->setDatatableCollection($sanctions);
			$sanctionRepository->setDefaultTableSettings();
			return $sanctionRepository->getTableCollectionForRender();
		}
		return null;
	}

	public function getLocalAlignmentsTable($id)
	{		
		$alignmentRepository = new AlignmentRepository;		
		$localTeamId = $this->get($id)->localTeam->id;
		return $alignmentRepository->getAllTable('games.api.alignments', [$id, $localTeamId], 3, 'asc', 'local-alignments');
	}

	public function getAwayAlignmentsTable($id)
	{		
		$alignmentRepository = new AlignmentRepository;		
		$awayTeamId = $this->get($id)->awayTeam->id;
		return $alignmentRepository->getAllTable('games.api.alignments', [$id, $awayTeamId], 3, 'asc', 'away-alignments');
	}

	public function getDefaultTableForAlignments($id, $teamId)
	{
		$alignments = $this->getAlignments($id, $teamId);
		if($alignments) {
			$alignmentRepository = new AlignmentRepository;
			$alignmentRepository->setDatatableCollection($alignments);
			$alignmentRepository->setDefaultTableSettings();
			return $alignmentRepository->getTableCollectionForRender();
		}
		return null;
	}	


}