<?php namespace soccer\Group;

use soccer\Group\Group;
use soccer\Base\BaseRepository;
use Carbon\Carbon;
use Datatable;
use Illuminate\Database\Eloquent\Collection;

/**
* 
*/
class EquipoRepository extends BaseRepository
{		

	protected  $jugadorRepository;

	function __construct() {
		$this->columns = [
				'Equipo',
				'JJ',
				'JG',
				'JP',
				'JE',
				'GF',
				'GC',
				'DG',
				'PTS',
				'Acciones'
			];

		$this->setModel(new Group);
		$this->setListAllRoute('groups.api.lista');
	}	
	/*
	*********************** DATATABLE SETTINGS ******************************
	*/		

	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a class='ver-equipo' href='" . route('equipos.show', $model->id) . "'>Ver</a><br />");
			$this->addActionColumn("<a  class='editar-equipo' href='#new-team-form' id='editar_equipo_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='eliminar-equipo' href='#' id='eliminar_equipo_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{
		/*
		$this->collection->searchColumns('Equipo', 'JJ', 'JG', 'JP', 'JE', 'GF', 'GC', 'DG', 'PTS');
		$this->collection->orderColumns('Equipo', 'JJ', 'JG', 'JP', 'JE', 'GF', 'GC', 'DG', 'PTS');

		$this->collection->addColumn('Equipo', function($model)
		{
			 return $model->nombre;
		});

		$this->collection->addColumn('JJ', function($model)
		{
			 return $model->nombre;
		});

		$this->collection->addColumn('JG', function($model)
		{
			 return $model->nombre;
		});		

		$this->collection->addColumn('JP', function($model)
		{
			 return $model->nombre;
		});

		$this->collection->addColumn('JE', function($model)
		{
			 return $model->nombre;
		});
		
		$this->collection->addColumn('GF', function($model)
		{
			 return $model->nombre;
		});
		
		$this->collection->addColumn('GC', function($model)
		{
			 return $model->nombre;
		});

		$this->collection->addColumn('DG', function($model)
		{
			 return $model->nombre;
		});

		$this->collection->addColumn('PTS', function($model)
		{
			 return $model->nombre;
		});
		*/
	}	

	private function setTableGroupContent($id, EquipoRepository $equipoRepository)
	{
		$equipoRepository->collection->searchColumns('Equipo', 'JJ', 'JG', 'JP', 'JE', 'GF', 'GC', 'DG', 'PTS');
		$equipoRepository->collection->orderColumns('Equipo', 'JJ', 'JG', 'JP', 'JE', 'GF', 'GC', 'DG', 'PTS');

		$equipoRepository->collection->addColumn('Equipo', function($model)
		{
			 return $model->nombre;
		});

		$equipoRepository->collection->addColumn('JJ', function($model)
		{
			 return $model->nombre;
		});

		$equipoRepository->collection->addColumn('JG', function($model)
		{
			 return $model->nombre;
		});		

		$equipoRepository->collection->addColumn('JP', function($model)
		{
			 return $model->nombre;
		});

		$equipoRepository->collection->addColumn('JE', function($model)
		{
			 return $model->nombre;
		});
		
		$equipoRepository->collection->addColumn('GF', function($model)
		{
			 return $model->nombre;
		});
		
		$equipoRepository->collection->addColumn('GC', function($model)
		{
			 return $model->nombre;
		});

		$equipoRepository->collection->addColumn('DG', function($model)
		{
			 return $model->nombre;
		});

		$equipoRepository->collection->addColumn('PTS', function($model)
		{
			 return $model->nombre;
		});
	}	

	public function getDefaultTableForGroupTeams($id)
	{
		$teams = $this->get($id)->teams;
		if($teams) {
			$equipoRepository = new EquipoRepository;
			$equipoRepository->setDatatableCollection($teams);
			$this->setTableGroupContent($id, $equipoRepository);
			$equipoRepository->addColumnToCollection('Acciones', function($model) use ($equipoRepository)
			{
				$equipoRepository->cleanActionColumn();
				$equipoRepository->addActionColumn("<a class='show-team' href='" . route('equipos.show', $model->id) . "' id='show-team'>Ver</a><br />");
				return implode(" ", $equipoRepository->getActionColumn());
			});
			return $equipoRepository->getTableCollectionForRender();
		}
		return null;
	}	
}