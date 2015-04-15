<?php namespace soccer\Equipo;

use soccer\Equipo\Equipo;
use soccer\Base\BaseRepository;
use soccer\Jugador\JugadorRepository;
use Carbon\Carbon;
use Datatable;
use Illuminate\Database\Eloquent\Collection;
/**
* 
*/
class EquipoRepository extends BaseRepository
{		

	protected  $jugadorRepository;

	function __construct(JugadorRepository $jugadorRepository) {
		$this->columns = [
			'País',
			'Nombre',
			'Tipo',
			'Fecha Fundación',
			'Apodo',
			'Acciones'
		];

		$this->jugadorRepository = $jugadorRepository;
	}

	public function getAll()
	{
		return Equipo::all();
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

	public function get($id)
	{
		return Equipo::findOrFail($id);
	}

	public function getJugadores($id)
	{
		return Equipo::findOrFail($id)->jugadores;
	}

	public function getTableCollection(Collection $equipos)
	{
		$collection = Datatable::collection($equipos)
			->searchColumns('País', 'Nombre', 'Tipo', 'Fecha Fundación', 'Apodo')
			->orderColumns('País', 'Nombre', 'Tipo', 'Fecha Fundación', 'Apodo');

		$collection->addColumn('País', function($model)
		{
			 return $model->pais->nombre;
		});

		$collection->addColumn('Nombre', function($model)
		{
			 return $model->nombre;
		});

		$collection->addColumn('Tipo', function($model)
		{
			 return $model->tipo;
		});

		$collection->addColumn('Fecha Fundación', function($model)
		{
			 return $model->fecha_fundacion;
		});

		$collection->addColumn('Apodo', function($model)
		{
			 return $model->apodo;
		});

		$collection->addColumn('Acciones', function($model)
		{
			$links = "<a class='ver-jugador' href='" . route('equipos.show', $model->id) . "'>Ver</a>
					<br />";
			$links .= "<a  class='editar-jugador' href='#new-player-form' id='editar_".$model->id."'>Editar</a>
					<br />
					<a class='eliminar-jugador' href='#' id='eliminar_".$model->id."'>Eliminar</a>";

			return $links;
		});
	
		return $collection->make();	
	}

	public function getAllTable()
	{	
		return Datatable::table()
		->addColumn($this->columns)
		->setUrl(route('equipos.api.lista'))
		->noScript();
	}

	public function getJugadoresTable($id)
	{		
		return $this->jugadorRepository->getTable('equipos.api.jugadores', [$id]);
	}

}