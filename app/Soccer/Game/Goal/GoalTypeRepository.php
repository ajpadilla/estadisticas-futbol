<?php namespace soccer\Game\Goal;

use soccer\Game\Goal\GoalType;
use soccer\Base\BaseRepository;
use Carbon\Carbon;
use Datatable;
use Illuminate\Database\Eloquent\Collection;


/**
* 
*/
class GoalTypeRepository extends BaseRepository
{
	
	function __construct() {
		$this->columns = ['Nombre', 'Acciones'];

		$this->setModel(new GoalType);
		$this->setListAllRoute('goal-types.api.list');
	}
	
/*
	*********************** DATATABLE SETTINGS ******************************
*/			


	public function setDefaultActionColumn() {

		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a  class='edit-goal-type' href='#edit-goal-type-form' id='edit_goal-type_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='delete-goal-type' href='#' id='delete_goal-type_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{		
		$this->collection->searchColumns('Nombre');
		$this->collection->orderColumns('Nombre');

		$this->collection->addColumn('Nombre', function($model)
		{
			 return $model->name;
		});
	}	

}