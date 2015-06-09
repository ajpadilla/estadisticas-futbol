<?php namespace soccer\Game\Fixture;

use soccer\Game\Fixture\Fixture;
use soccer\Base\BaseRepository;

/**
* 
*/
class FixtureRepository extends BaseRepository
{
	function __construct() {
		$this->columns = [
				'Equipo',
				//'Jugador',
				'Tiempo',
				'Tipo',
				'Observaciones',
				'Acciones'
		];

		$this->setModel(new Fixture);
		$this->setListAllRoute('');
	}

	public function get($id)
	{
		return $this->model->with('team','player','type')->findOrFail($id);
	}	

	/*
	*********************** DATATABLE SETTINGS ******************************
	*/			

	public function setDefaultActionColumn() {

		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a  class='edit-sanction' href='#edit-sanction-form' id='edit_sanction_".$model->id."' data-game-id='".$model->game_id."'>Editar</a><br />");
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