<?php namespace soccer\Game\Change;

use soccer\Game\Change\Change;
use soccer\Base\BaseRepository;
use Carbon\Carbon;
use Datatable;
use Illuminate\Database\Eloquent\Collection;


/**
* 
*/
class ChangeRepository extends BaseRepository
{
	function __construct() {
		$this->columns = [
				'Equipo',
				'Sale',
				'Entra',
				'Tiempo',
				'Observaciones',
				'Acciones'
		];

		$this->setModel(new Goal);
		$this->setListAllRoute('changes.api.list');
	}

	/*
	*********************** DATATABLE SETTINGS ******************************
	*/			

	public function setDefaultActionColumn() {

		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a  class='edit-change' href='#edit-change-form' id='edit_change_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='delete-change' href='#' id='delete_change_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{		
		$this->collection->searchColumns('Equipo', 'Sale', 'Entra', 'Tiempo', );
		$this->collection->orderColumns('Equipo', 'Sale', 'Entra', 'Tiempo', 'Observaciones');

		$this->collection->addColumn('Equipo', function($model)
		{
			 return $model->team->nombre;
		});

		$this->collection->addColumn('Sale', function($model)
		{
			 return $model->player_out->nombre;
		});

		$this->collection->addColumn('Entra', function($model)
		{
			 return $model->player_in->nombre;
		});

		$this->collection->addColumn('Tiempo', function($model)
		{
			 return $model->time;
		});			

		$this->collection->addColumn('Observaciones', function($model)
		{
			 return $model->observations;
		});
	}	
}