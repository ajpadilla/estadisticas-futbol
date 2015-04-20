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
		$this->setModel(new Equipo);
		$this->setListAllRoute('equipos.api.lista');
	}	

	public function listForType($type='club')
	{
		return $this->model->select()->whereTipo($type)->lists('nombre', 'id');
	}


	public function create($data = array())
	{
		$fecha = $data['fecha_fundacion'];
		$data['fecha_fundacion'] = Carbon::createFromFormat('d-m-Y', $fecha)->format('Y-m-d');
		$equipo = $this->model->create($data); 

		if (!is_null($data['jugadores']))
		$equipo->jugadores()->attach($data['jugadores'],
			[
				'numero' => 0,
				'fecha_inicio' => '',
				'fecha_fin' => ''
			]
		);

		return $equipo;
	}

	public function update($data = array())
	{
		$fecha = $data['fecha_fundacion'];
		$data['fecha_fundacion'] = Carbon::createFromFormat('d-m-Y', $fecha)->format('Y-m-d');
		$equipo = $this->get($data['equipo_id']);
		$equipo->update($data);

		if (!is_null($data['jugadores']))
		$equipo->jugadores()->attach($data['jugadores'],
			[
				'numero' => 0,
				'fecha_inicio' => null,
				'fecha_fin' => null
			]
		);

		return $equipo;
	}

	public function getJugadores($id)
	{
		return $this->getModel()->findOrFail($id)->jugadores;
	}

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
			$this->jugadorRepository->addActionColumn("<a class='ver-jugador' href='" . route('jugadores.show', $model->id) . "' id='ver_jugador'>Ver</a><br />");
			$this->jugadorRepository->addActionColumn("<a  class='editar-jugador' href='#new-player-form' id='editar_".$model->id."'>Editar</a><br />");
			$this->jugadorRepository->addActionColumn("<a class='eliminar-jugador' href='" . route('jugadores.api.eliminar', $model->id) . "' id='eliminar-jugador'>Eliminar</a><br />");
			$this->jugadorRepository->addActionColumn("<a class='cambiar-equipo' href='" . route('jugadores.api.cambiar-equipo', $model->id) . "' id='eliminar-jugador'>Cambiar</a>");
			return implode(" ", $this->jugadorRepository->getActionColumn());
		});
		return $this->jugadorRepository->getTableCollectionForRender();
	}	

}