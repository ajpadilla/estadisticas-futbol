<?php namespace soccer\Game\Alignment;

use soccer\Game\Alignment\Alignment;
use soccer\Base\BaseRepository;


/**
* 
*/
class AlignmentRepository extends BaseRepository
{
	function __construct() {
		$this->columns = [
				'Jugador',
				'Posición',
				'Tipo',
				'Observaciones',
				'Acciones'
		];

		$this->setModel(new Alignment);
		$this->setListAllRoute('alignments.api.list');
	}

	/*
	*********************** DATATABLE SETTINGS ******************************
	*/			

	public function setDefaultActionColumn() {

		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a  class='edit-alignment' href='#edit-alignment-form' id='edit_alignment_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='delete-alignment' href='#' id='delete_alignment_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{		
		$this->collection->searchColumns('Jugador', 'Posición', 'Tipo', 'Observaciones');
		$this->collection->orderColumns('Jugador', 'Posición', 'Tipo', 'Observaciones');

		$this->collection->addColumn('Jugador', function($model)
		{
			 return $model->player->nombre;
		});

		$this->collection->addColumn('Posición', function($model)
		{
			 return $model->position->nombre;
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