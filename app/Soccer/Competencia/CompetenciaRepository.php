<?php namespace soccer\Competencia;

use soccer\Base\BaseRepository;
use soccer\Competencia\Competencia;
/**
* 
*/
class CompetenciaRepository extends BaseRepository
{		
	
	function __construct() {
		$this->columns = [
			'Nombre',
			'Inicia',
			'Finaliza',
			'Tipo de competencia',
			'Acciones'
		];

		$this->setModel(new Competencia);
		$this->setListAllRoute('competencias.api.lista');
	}
    /*
	********************* Methods ***********************
    */
    	

	public function create($data = array())
	{
		$competencia = $this->model->create($data); 
		return $competencia;
	}



    /*
	********************* Datatable Methods ***********************
    */
	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a class='ver-competencia' href='" . route('competencias.show', $model->id) . "'>Ver</a><br />");
			$this->addActionColumn("<a  class='editar-competencia' href='#new-team-form' id='editar_competencia_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='eliminar-competencia' href='#' id='eliminar_competencia_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Nombre', 'Inicia', 'Finaliza', 'Tipo de competencia');
		$this->collection->orderColumns('Nombre', 'Inicia', 'Finaliza', 'Tipo de competencia');

		$this->collection->addColumn('Nombre', function($model)
		{
			 return $model->nombre;
		});

		$this->collection->addColumn('Inicia', function($model)
		{
			 return $model->desde;
		});

		$this->collection->addColumn('Finaliza', function($model)
		{
			 return $model->hasta;
		});

		$this->collection->addColumn('Tipo de competencia', function($model)
		{
			 return $model->tipoCompetencia->nombre;
		});
	}		
}