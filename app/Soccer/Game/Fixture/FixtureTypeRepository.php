<?php namespace soccer\Game\Fixture;

use soccer\Game\Fixture\FixtureType;
use soccer\Base\BaseRepository;
use Carbon\Carbon;
use Datatable;
use Illuminate\Database\Eloquent\Collection;


/**
* 
*/
class FixtureTypeRepository extends BaseRepository
{
	
	function __construct() {
		$this->columns = ['Nombre', 'Acciones'];

		$this->setModel(new FixtureType);
		$this->setListAllRoute('');
	}

/*
	*********************** DATATABLE SETTINGS ******************************
*/			


	public function setDefaultActionColumn() {

		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a  class='edit-sanction-type' href='#edit-sanction-type-form' id='edit_sanction-type_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='delete-sanction-type' href='#' id='delete_sanction-type_".$model->id."'>Eliminar</a>");
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