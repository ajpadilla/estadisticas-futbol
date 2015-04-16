<?php namespace soccer\Jugador;

use soccer\Jugador\Jugador;
use soccer\Base\BaseRepository;
use Carbon\Carbon;
use Datatable;
/**
* 
*/
class JugadorRepository extends BaseRepository
{		
	function __construct() {
		$this->columns = [
			'Nombre',
			'País',
			'Equipo',
			'Posición',
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

	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a class='ver-jugador' href='#' id='ver_".$model->id."'>Ver</a><br />");
			$this->addActionColumn("<a  class='editar-jugador' href='#new-player-form' id='editar_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='eliminar-jugador' href='" . route('jugadores.api.eliminar', $model->id) . "' id='eliminar-jugador'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('Nombre', 'País', 'Posición', 'Equipo');
		$this->collection->orderColumns('Nombre', 'País', 'Posición', 'Equipo', 'Edad');

		$this->collection->addColumn('Nombre', function($model)
		{
			 return $model->nombre;
		});

		$this->collection->addColumn('País', function($model)
		{
			 return $model->pais->nombre;
		});

		$this->collection->addColumn('Equipo', function($model)
		{
			 return $model->equipo->nombre;
		});		

		$this->collection->addColumn('Posición', function($model)
		{
			 return $model->posicion->abreviacion;
		});

		$this->collection->addColumn('Edad', function($model)
		{
			 return $model->age;
		});
	}

	public function getAllTable($route = 'jugadores.api.lista', $params = array())
	{
		return Datatable::table()
		->addColumn($this->columns)
		->setUrl(route($route, $params))
		->noScript();	
	}
}