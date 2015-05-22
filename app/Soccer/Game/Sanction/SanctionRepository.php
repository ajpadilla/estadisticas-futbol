<?php namespace soccer\Game\Sanction;

use soccer\Game\Sanction\Sanction;
use soccer\Base\BaseRepository;


/**
* 
*/
class SanctionRepository extends BaseRepository
{
	function __construct() {
		$this->columns = [
				'Equipo',
				'Jugador',
				'Tiempo',
				'Tipo',
				'Observaciones',
				'Acciones'
		];

		$this->setModel(new Sanction);
		$this->setListAllRoute('sanctions.api.list');
	}

	/*
	*********************** DATATABLE SETTINGS ******************************
	*/			

	public function setDefaultActionColumn() {

		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a  class='edit-sanction' href='#edit-sanction-form' id='edit_sanction_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='delete-sanction' href='#' id='delete_sanction_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{		
		$this->collection->searchColumns('Equipo', 'Jugador', 'Tiempo', 'Tipo');
		$this->collection->orderColumns('Equipo', 'Jugador', 'Tiempo', 'Tipo', 'Observaciones');

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