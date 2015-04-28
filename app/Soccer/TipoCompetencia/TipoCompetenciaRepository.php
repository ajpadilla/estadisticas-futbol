<?php namespace soccer\TipoCompetencia;

use soccer\Base\BaseRepository;
use soccer\TipoCompetencia\TipoCompetencia;
/**
* 
*/
class TipoCompetenciaRepository extends BaseRepository
{		
	
	function __construct() {
		$this->columns = [
			'Nombre',
			'# Grupos',
			'# Fases Eliminatorias',
			'¿Ida y Vuelta?',
			'¿Pre Clasificación?',
			'# Equipos por grupo',
			'# Ascensos',
			'# Descensos',
			'# Clasificados',
			'Acciones'
		];

		$this->setModel(new TipoCompetencia);
		$this->setListAllRoute('tipos-competencia.api.lista');
	}
    
    /*
	********************* Datatable Methods ***********************
    */
	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			//$this->addActionColumn("<a class='ver-tipo-competencia' href='" . route('tipo-competencias.show', $model->id) . "'>Ver</a><br />");
			$this->addActionColumn("<a  class='editar-tipo-competencia' href='#new-team-form' id='editar_tipo-competencia_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='eliminar-tipo-competencia' href='#' id='eliminar_tipo-competencia_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Nombre');
		$this->collection->orderColumns('Nombre', '# Grupos', '# Fases Eliminatorias', '¿Ida y Vuelta?', '¿Pre Clasificación?', '# Equipos por grupo', '# Ascensos', '# Descensos', '# Clasificados');

		$this->collection->addColumn('Nombre', function($model)
		{
			 return $model->nombre;
		});

		$this->collection->addColumn('# Grupos', function($model)
		{
			 return $model->grupos;
		});


		$this->collection->addColumn('# Fases Eliminatorias', function($model)
		{
			 return $model->fases_eliminatorias;
		});

		$this->collection->addColumn('¿Ida y Vuelta?', function($model)
		{
			 return $model->ida_vuelta;
		});

		$this->collection->addColumn('¿Pre Clasificación?', function($model)
		{
			 return $model->pre_clasificacion;
		});

		$this->collection->addColumn('# Equipos por grupo', function($model)
		{
			 return $model->equipos_por_grupo;
		});

		$this->collection->addColumn('# Ascensos', function($model)
		{
			 return $model->ascensos;
		});	

		$this->collection->addColumn('# Descensos', function($model)
		{
			 return $model->descensos;
		});		

		$this->collection->addColumn('# Clasificados', function($model)
		{
			 return $model->clasificados_por_grupo;
		});				
	}		
}