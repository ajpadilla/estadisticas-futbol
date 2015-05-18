<?php namespace soccer\Competition\CompetitionFormat;

use soccer\Base\BaseRepository;
use soccer\Competition\CompetitionFormat\CompetitionFormat;
/**
* 
*/
class CompetitionFormatRepository extends BaseRepository
{		
	
	function __construct() {
		$this->columns = [
			'Nombre',
			'# Grupos',
			'¿Ida y Vuelta?',
			'¿Final Ida y Vuelta?',
			'¿Gol Visitante?',
			'# Equipos por grupo',
			'# Ascensos',
			'# Descensos',
			'# Clasificados',
			'Acciones'
		];

		$this->setModel(new CompetitionFormat);
		$this->setListAllRoute('tipos-competencia.api.lista');
	}

	public function update($data = array())
	{
		if(empty($data['local_away_game'])){
			$data['local_away_game'] = 0;
		}

		if (empty($data['local_away_game_final'])) {
			$data['local_away_game_final'] = 0;
		}

		if (empty($data['away_goal'])) {
			$data['away_goal'] = 0;
		}		

		$competitionFormat = $this->get($data['competition_format_id']);
		$competitionFormat->update($data);
		return $competitionFormat;
	}

    /*
	********************* Datatable Methods ***********************
    */
	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a class='show-competitions-format' href='#' id=''>Competencias</a><br />");
			$this->addActionColumn("<a  class='edit-competition-format' href='#new-type-of-competition-form' id='edit_competition-format_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='delete-competition-format' href='#' id='delete_competition-format_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Nombre');
		$this->collection->orderColumns('Nombre', '# Grupos', '¿Ida y Vuelta?', '¿Final Ida y Vuelta?', '¿Gol Visitante?', '# Equipos por grupo', '# Ascensos', '# Descensos', '# Clasificados');

		$this->collection->addColumn('Nombre', function($model)
		{
			 return $model->name;
		});

		$this->collection->addColumn('# Grupos', function($model)
		{
			 return $model->groups;
		});

		$this->collection->addColumn('¿Ida y Vuelta?', function($model)
		{
			 return $model->local_away_game;
		});

		$this->collection->addColumn('¿Final Ida y Vuelta?', function($model)
		{
			 return $model->local_away_game_final;
		});		

		$this->collection->addColumn('¿Gol Visitante?', function($model)
		{
			 return $model->away_goal;
		});

		$this->collection->addColumn('# Equipos por grupo', function($model)
		{
			 return $model->teams_by_group;
		});

		$this->collection->addColumn('# Ascensos', function($model)
		{
			 return $model->promotion;
		});	

		$this->collection->addColumn('# Descensos', function($model)
		{
			 return $model->descent;
		});		

		$this->collection->addColumn('# Clasificados', function($model)
		{
			 return $model->clasificated_by_group;
		});				
	}		
}