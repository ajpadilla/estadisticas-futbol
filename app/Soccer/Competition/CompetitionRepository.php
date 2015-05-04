<?php namespace soccer\Competition;

use soccer\Base\BaseRepository;
use soccer\Competition\Competition;
/**
* 
*/
class CompetitionRepository extends BaseRepository
{		
	
	function __construct() {
		$this->columns = [
			'Nombre',
			'Inicia',
			'Finaliza',
			'Tipo de competencia',
			'Acciones'
		];

		$this->setModel(new Competition);
		$this->setListAllRoute('competitions.api.list');
	}
    /*
	********************* Methods ***********************
    */
    	

	public function create($data = array())
	{
		$competition = $this->getModel->create($data); 
		return $competition;
	}

    /*
	********************* Datatable Methods ***********************
    */
	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a class='show-competition' href='" . route('competitions.show', $model->id) . "'>Ver</a><br />");
			$this->addActionColumn("<a class='delete-competition' href='#' id='delete_competition_".$model->id."'>Eliminar</a>");
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
			 return $model->tipoCompetition->nombre;
		});
	}		
}