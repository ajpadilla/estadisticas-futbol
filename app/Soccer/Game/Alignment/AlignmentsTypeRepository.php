<?php namespace soccer\Game\Alignment;

use soccer\Game\Alignment\AlignmentType;
use soccer\Base\BaseRepository;
use Carbon\Carbon;
use Datatable;
use Illuminate\Database\Eloquent\Collection;

/**
* 
*/
class AlignmentsTypeRepository extends BaseRepository
{
	
	function __construct() {
		$this->columns = ['Nombre','Acciones'];

		$this->setModel(new AlignmentType);
		$this->setListAllRoute('alignmentsType.api.list');
	}


	/*
	*********************** DATATABLE SETTINGS ******************************
	*/			


	public function setDefaultActionColumn() {

		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a  class='edit-alignment-type' href='#edit-alignment-type-form' id='edit_alignment-type_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='delete-alignment-type' href='#' id='delete_alignment-type_".$model->id."'>Eliminar</a>");
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