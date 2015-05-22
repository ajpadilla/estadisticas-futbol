<?php namespace soccer\Game;

use soccer\Game\Game;
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
				'Estadio',
				'Arbitro Principal',
				'Arbitro de Linea',
				'Estatus',
				'Agregar Fixtures',
				'Acciones'
			];

		$this->setModel(new Game);
		$this->setListAllRoute('games.api.list');
	}	

	public function availableTeams($id)
	{
		return $this->get($id)->games;
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
			$this->addActionColumn("<a  class='details-game' href='#details-game-form' id='edit_game_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='delete-game' href='#' id='delete_game_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{		
		$this->collection->searchColumns('Fecha', 'Local', 'Visitante', 'Estadio', 'Estatus');
		$this->collection->orderColumns('Fecha', 'Local', 'Visitante', 'Estadio', 'Estatus');

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

		$this->collection->addColumn('Estadio', function($model)
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
		});

		$this->collection->addColumn('Estatus', function($model)
		{
			 return $model->status;
		});	
	}	

	public function getGoalsTable($id)
	{		
		$goalRepository = new GoalRepository;		
		return $goalRepository->getAllTable('games.api.goals', [$id]);
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
		return $changeRepository->getAllTable('games.api.changes', [$id]);
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
		return $sanctionRepository->getAllTable('games.api.sanctions', [$id]);
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
}