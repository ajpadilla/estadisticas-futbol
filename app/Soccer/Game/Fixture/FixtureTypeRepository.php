<?php namespace soccer\Game\Sanction;

use soccer\Game\Sanction\SanctionType;
use soccer\Base\BaseRepository;
use Carbon\Carbon;
use Datatable;
use Illuminate\Database\Eloquent\Collection;


/**
* 
*/
class SanctionTypeRepository extends BaseRepository
{
	
	function __construct() {
		$this->columns = ['Nombre', 'Acciones'];

		$this->setModel(new SanctionType);
		$this->setListAllRoute('sanction-types.api.list');
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