<?php namespace soccer\Game\Goal;

use soccer\Game\Goal\Goal;
use soccer\Base\BaseRepository;

/**
* 
*/
class GoalRepository extends BaseRepository
{
	
	function __construct() {
		$this->columns = [
				'Equipo',
				'Jugador',
				'Tiempo',
				'Asistencia',
				'Tipo',
				'Observaciones',
				'Acciones'
		];

		$this->setModel(new Goal);
		$this->setListAllRoute('goals.api.list');
	}

	/*
	*********************** DATATABLE SETTINGS ******************************
	*/			

	public function setDefaultActionColumn() {

		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a  class='edit-goal' href='#edit-goal-form' id='edit_goal_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='delete-goal' href='#' id='delete_goal_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{		
		$this->collection->searchColumns('Equipo', 'Jugador', 'Tiempo', 'Asistencia', 'Tipo');
		$this->collection->orderColumns('Equipo', 'Jugador', 'Tiempo', 'Asistencia', 'Tipo', 'Observaciones');

		$this->collection->addColumn('Equipo', function($model)
		{
			 return $model->team->nombre;
		});

		$this->collection->addColumn('Jugador', function($model)
		{
			 return $model->player->nombre;
		});

		$this->collection->addColumn('Tiempo', function($model)
		{
			 return $model->time;
		});		

		$this->collection->addColumn('Asistencia', function($model)
		{
			 return $model->assistance->nombre;
		});
		
		$this->collection->addColumn('Tipo', function($model)
		{
			 return $model->type->name;
		});		

		$this->collection->addColumn('Observaciones', function($model)
		{
			 return $model->observations;
		});
	}	
}