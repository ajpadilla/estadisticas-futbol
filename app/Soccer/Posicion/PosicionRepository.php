<?php namespace soccer\Posicion;

use soccer\Posicion\Posicion;
use soccer\Base\BaseRepository;
/**
* 
*/
class PosicionRepository extends BaseRepository
{	

	function __construct() {
		$this->columns = [
			'Nombre',
			'Abreviación',
			'Acciones'
		];
		$this->setModel(new Posicion);
		$this->setListAllRoute('posiciones.api.lista');
	}	

	public function listAll()
	{
		return Posicion::select()->lists('nombre', 'id');
	}

	public function update($data = array())
	{
		$posicion = $this->get($data['position_id']); 
		$posicion->update($data);
		return $posicion;
	}



	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			//$this->addActionColumn("<a class='ver-jugador' href='" . route('players.show', $model->id) . "' id='ver_jugador'>Ver</a><br />");
			$this->addActionColumn("<a  class='edit-position' href='#new-position-form' id='edit_position_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='delete-position' href='#' id='delete_position_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Nombre', 'Abreviación');
		$this->collection->orderColumns('Nombre', 'Abreviación');

		$this->collection->addColumn('Nombre', function($model)
		{
			 return $model->nombre;
		});

		$this->collection->addColumn('Abreviación', function($model)
		{
			 return $model->abreviacion;
		});
	}
}