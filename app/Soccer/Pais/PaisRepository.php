<?php namespace soccer\Pais;

use soccer\Pais\Pais;
use soccer\Base\BaseRepository;
/**
* 
*/
class PaisRepository extends BaseRepository
{	
	function __construct() {
		$this->columns = [
			'Nombre',
			'Bandera',
			'Acciones'
		];	

		$this->setModel(new Pais);
		$this->setListAllRoute('paises.api.lista');
	}

	public function create($data = array())
	{
		$pais = Pais::create($data); 
		return $pais;
	}

	public function update($data = array())
	{
		$pais = $this->get($data['pais_id']);
		return $pais->update($data);
	}

	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a class='show-country' href='#' id='show_country_".$model->id."'>Ver</a><br />");
			$this->addActionColumn("<a  class='edit-country' href='#new-country-form' id='edit_country_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='delete-country' href='#' id='delete_country_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Nombre');
		$this->collection->orderColumns('Nombre');

		$this->collection->addColumn('nombre', function($model)
		{
			 return $model->nombre;
		});

		$this->collection->addColumn('bandera', function($model)
		{		
			return "<h2 class='text-center'><span class='label label-default'><span class='flag-icon flag-icon-" . $model->code . "'></span> " .  strtoupper($model->code) . "</span></h2>";
		});
	}	
}