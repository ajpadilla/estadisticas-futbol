<?php namespace soccer\Game;

use soccer\Game\Game;
use soccer\Base\BaseRepository;
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
			$this->addActionColumn("<a class='show-game' href='#show_game' id='show_game_".$model->id."'>Ver</a><br />");
			$this->addActionColumn("<a  class='edit-game' href='#edit-team-form' id='edit_game_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a  class='details-game' href='#details-team-form' id='edit_game_".$model->id."'>Editar</a><br />");
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
}