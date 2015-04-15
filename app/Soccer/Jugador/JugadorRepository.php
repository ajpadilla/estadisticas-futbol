<?php namespace soccer\Jugador;

use soccer\Jugador\Jugador;
use soccer\Base\BaseRepository;
use Carbon\Carbon;
use Datatable;
use Illuminate\Database\Eloquent\Collection;
/**
* 
*/
class JugadorRepository extends BaseRepository
{		
	function __construct() {
		$this->columns = [
			'País',
			'Posición',
			'Nombre',
			'Edad',
			'Acciones'
		];
	}

	public function getAll()
	{
		return Jugador::all();
	}	

	public function create($data = array())
	{
		$fecha = $data['fecha_nacimiento'];
		$data['fecha_nacimiento'] = Carbon::createFromFormat('d-m-Y', $fecha)->format('Y-m-d');
		$jugador = Jugador::create($data); 
		return $jugador;
	}

	public function update($data = array())
	{
		$fecha = $data['fecha_nacimiento'];
		$data['fecha_nacimiento'] = Carbon::createFromFormat('d-m-Y', $fecha)->format('Y-m-d');
		$jugador = $this->getById($data['jugador_id']);
		$jugador->update($data);
	}

	public function delete($jugadorId)
	{
		$jugador = $this->getById($jugadorId); 
		$jugador->delete();
	}

	public function getById($jugadorId)
	{
		return Jugador::findOrFail($jugadorId);
	}

	public function getTableCollection(Collection $jugadores)
	{
		$collection = Datatable::collection($jugadores)
			->searchColumns('nombre')
			->orderColumns('nombre');

		$collection->addColumn('País', function($model)
		{
			 return $model->pais->nombre;
		});

		$collection->addColumn('Posición', function($model)
		{
			 return $model->posicion->abreviacion;
		});

		$collection->addColumn('Nombre', function($model)
		{
			 return $model->nombre;
		});

		$collection->addColumn('Edad', function($model)
		{
			 return $model->age;
		});

		$collection->addColumn('Acciones', function($model)
		{
			$links = "<a class='ver-jugador' href='#' id='ver_".$model->id."'>Ver</a>
					<br />";
			$links .= "<a  class='editar-jugador' href='#new-player-form' id='editar_".$model->id."'>Editar</a>
					<br />
					<a class='eliminar-jugador' href='#' id='eliminar_".$model->id."'>Eliminar</a>";

			return $links;
		});
	
		return $collection->make();	
	}

	public function getAllTable($route = 'jugadores.api.lista', $params = array())
	{
		return Datatable::table()
		->addColumn($this->columns)
		->setUrl(route($route, $params))
		->noScript();	
	}
}