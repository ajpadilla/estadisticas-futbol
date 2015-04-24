<?php namespace soccer\Jugador;

use soccer\Jugador\Jugador;
use soccer\Equipo\Equipo;
use soccer\Base\BaseRepository;
use soccer\Equipo\EquipoRepository;
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
		$this->setModel(new Jugador);
		$this->setListAllRoute('jugadores.api.lista');
	}

	public function filterList($nombre ='')
	{
		$this->model->where('nombre', 'LIKE', '%' . $nombre . '%')->lists('nombre', 'id');
	}

	public function create($data = array())
	{
		$fechaNacimiento = $data['fecha_nacimiento'];
		$data['fecha_nacimiento'] = Carbon::createFromFormat('d-m-Y', $fechaNacimiento)->format('Y-m-d');
		$fechaInicio = Carbon::createFromFormat('d-m-Y', $data['fecha_inicio'])->format('Y-m-d');
		if(!empty($data['fecha_fin'])){
			$fechaFin = Carbon::createFromFormat('d-m-Y',  $data['fecha_fin'])->format('Y-m-d');
		}else{
			$fechaFin = null;
		}

		$jugador = $this->model->create($data); 
		$equipo = Equipo::find($data['equipo_id']);
		$jugador->equipos()->attach($data['equipo_id'],
			[
				'numero' => $data['numero'],
				'fecha_inicio' => $fechaInicio,
				'fecha_fin' => $fechaFin
			]
		);
		return $jugador;
	}

	public function update($data = array())
	{
		$fechaNacimiento = $data['fecha_nacimiento'];
		$data['fecha_nacimiento'] = Carbon::createFromFormat('d-m-Y', $fechaNacimiento)->format('Y-m-d');
		$fechaInicio = Carbon::createFromFormat('d-m-Y', $data['fecha_inicio'])->format('Y-m-d');
		if(!empty($data['fecha_fin'])){
			$fechaFin = Carbon::createFromFormat('d-m-Y',  $data['fecha_fin'])->format('Y-m-d');
		}else{
			$fechaFin = null;
		}

		$jugador = $this->get($data['jugador_id']);
		$jugador->update($data);

		if(count($jugador->equipos()->whereEquipoId($data['equipo_id'])->whereFechaInicio($fechaInicio)->first()) > 0)
		{
			$jugador->equipos()->sync([$data['equipo_id'] => 
				[
					'numero' => $data['numero'],
					'fecha_inicio' => $fechaInicio,
					'fecha_fin' => $fechaFin
				]
			]);
		}else{
			$jugador->equipos()->attach($data['equipo_id'],
				[
				'numero' => $data['numero'],
				'fecha_inicio' => $fechaInicio,
				'fecha_fin' => $fechaFin
				]
			);
		}

		return $jugador;
	}

	public function getEquipos($id)
	{
		return $this->getModel()->findOrFail($id)->equipos;
	}	

	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a class='ver-jugador' href='" . route('jugadores.show', $model->id) . "' id='ver_jugador'>Ver</a><br />");
			$this->addActionColumn("<a  class='editar-jugador' href='#new-player-form' id='editar_jugador_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='eliminar-jugador' href='#' id='eliminar_jugador_".$model->id."'>Eliminar</a>");
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
			$names = $model->getNameCurrentTeams();
			$links = '<select class="form-control m-b">';
			foreach ($names as $equipo) {
				$links .= '<option>'.$equipo.'</option>';
			}
			$links .='</select>';
			return $links;
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

	public function getEquiposTable($id)
	{
		$equipoRepository = new EquipoRepository;		
		return $equipoRepository->getAllTable('jugadores.api.equipos', [$id]);
	}

	public function getTableForTeams($id)
	{
		$equipos = $this->getEquipos($id);
		$equipoRepository = new EquipoRepository;
		$equipoRepository->setDatatableCollection($equipos);
		$equipoRepository->setBodyTableSettings();
		$equipoRepository->addColumnToCollection('Acciones', function($model)
		{
			$equipoRepository->cleanActionColumn();
			$equipoRepository->addActionColumn("<a class='ver-jugador' href='" . route('equipos.show', $model->id) . "' id='ver_jugador'>Ver</a><br />");
			$equipoRepository->addActionColumn("<a  class='editar-jugador' href='#new-player-form' id='editar_".$model->id."'>Editar</a><br />");
			$equipoRepository->addActionColumn("<a class='eliminar-jugador' href='" . route('equipos.api.eliminar', $model->id) . "' id='eliminar-jugador'>Eliminar</a><br />");
			$equipoRepository->addActionColumn("<a class='cambiar-equipo' href='" . route('equipos.api.cambiar-equipo', $model->id) . "' id='eliminar-jugador'>Cambiar</a>");
			return implode(" ", $equipoRepository->getActionColumn());
		});
		return $equipoRepository->getTableCollectionForRender();
	}		
}