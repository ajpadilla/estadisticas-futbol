<?php namespace soccer\CompetitionFormats;

use soccer\Base\BaseRepository;
use soccer\CompetitionFormats\CompetitionFormat;
/**
* 
*/
class CompetitionFormatRepository extends BaseRepository
{

	function __construct() {
		$this->columns = [
			'Nombre',
			'# Grupos',
			'# Clasificados por grupo',
			'¿Partido de ida local?',
			'¿Último partido fuera de casa local?',
			'¿Gol fuera de casa?',
			'# Equipos por grupo',
			'# Promoción',
			'# Descensos',
			'Acciones'
		];
		$this->setModel(new CompetitionFormat);
		$this->setListAllRoute('competitionFormats.api.list');
	}

	 /*
	********************* Datatable Methods ***********************
    */
	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a  class='edit-type-competition' href='#new-type-of-competition-form' id='edit_type-competition_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='delete-type-competition' href='#' id='delete_type-competition_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Nombre');
		$this->collection->orderColumns('Nombre', '# Grupos', '# Clasificados por grupo', '¿Partido de ida local?', '¿Último partido fuera de casa local?','¿Gol fuera de casa?','# Equipos por grupo', '# Promoción', '# Descensos');

		$this->collection->addColumn('Nombre', function($model)
		{
			 return $model->name;
		});

		$this->collection->addColumn('# Grupos', function($model)
		{
			 return $model->groups;
		});


		$this->collection->addColumn('#  Clasificados por grupo', function($model)
		{
			 return $model->clasificated_by_group;
		});

		$this->collection->addColumn('¿Partido de ida local?', function($model)
		{
			 return $model->local_away_game;
		});

		$this->collection->addColumn('¿Último partido fuera de casa local?', function($model)
		{
			 return $model->local_away_game_final;
		});


		$this->collection->addColumn('¿Gol fuera de casa?', function($model)
		{
			 return $model->away_goal;
		});

		$this->collection->addColumn('# Equipos por grupo', function($model)
		{
			 return $model->teams_by_group;
		});

		$this->collection->addColumn('# Promoción', function($model)
		{
			 return $model->promotion;
		});	

		$this->collection->addColumn('# Descensos', function($model)
		{
			 return $model->descent;
		});		

	}		

}