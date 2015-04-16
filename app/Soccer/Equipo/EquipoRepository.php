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

	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a class='ver-jugador' href='" . route('equipos.show', $model->id) . "'>Ver</a><br />");
			$this->addActionColumn("<a  class='editar-jugador' href='#new-player-form' id='editar_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='eliminar-jugador' href='#' id='eliminar_".$model->id."'>Eliminar</a>");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('País', 'Nombre', 'Tipo', 'Fecha Fundación', 'Apodo');
		$this->collection->orderColumns('País', 'Nombre', 'Tipo', 'Fecha Fundación', 'Apodo');

		$this->collection->addColumn('País', function($model)
		{
			 return $model->pais->nombre;
		});

		$this->collection->addColumn('Nombre', function($model)
		{
			 return $model->nombre;
		});

		$this->collection->addColumn('Tipo', function($model)
		{
			 return $model->tipo;
		});

		$this->collection->addColumn('Fecha Fundación', function($model)
		{
			 return $model->fecha_fundacion;
		});

		$this->collection->addColumn('Apodo', function($model)
		{
			 return $model->apodo;
		});
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
		return $this->jugadorRepository->getAllTable('equipos.api.jugadores', [$id]);
	}

	public function getTableForPlayers($id)
	{
		$jugadores = $this->getJugadores($id);
		$this->jugadorRepository->setDatatableCollection($jugadores);
		$this->jugadorRepository->setBodyTableSettings();
		$this->jugadorRepository->addColumnToCollection('Acciones', function($model)
		{
			$this->jugadorRepository->cleanActionColumn();
			$this->jugadorRepository->addActionColumn("<a class='ver-jugador' href='#' id='ver_".$model->id."'>Ver</a><br />");
			$this->jugadorRepository->addActionColumn("<a  class='editar-jugador' href='#new-player-form' id='editar_".$model->id."'>Editar</a><br />");
			$this->jugadorRepository->addActionColumn("<a class='eliminar-jugador' href='" . route('jugadores.api.eliminar', $model->id) . "' id='eliminar-jugador'>Eliminar</a><br />");
			$this->jugadorRepository->addActionColumn("<a class='cambiar-equipo' href='" . route('jugadores.api.cambiar-equipo', $model->id) . "' id='eliminar-jugador'>Cambiar</a>");
			return implode(" ", $this->jugadorRepository->getActionColumn());
		});
		return $this->jugadorRepository->getTableCollectionForRender();
	}	

}