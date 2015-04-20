<?php namespace soccer\Jugador;

use soccer\Jugador\Jugador;
use soccer\Equipo\Equipo;
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
		$this->setModel(new Jugador);
		$this->setListAllRoute('jugadores.api.lista');
	}

	public function filterList($nombre ='')
	{
		$this->model->where('nombre', 'LIKE', '%' . $nombre . '%')->lists('nombre', 'id');
	}

	public function create($data = array())
	{
		$fecha = $data['fecha_nacimiento'];
		$data['fecha_nacimiento'] = Carbon::createFromFormat('d-m-Y', $fecha)->format('Y-m-d');
		$jugador = $this->model->create($data); 
		$equipo = Equipo::find($data['equipo_id']);
		$jugador->equipos()->save($equipo,
			[
				'numero' => $data['numero'],
				'fecha_inicio' => $data['fecha_inicio'],
				'fecha_fin' => $data['fecha_fin']
			]
		);
		return $jugador;
	}

	public function update($data = array())
	{
		$fecha = $data['fecha_nacimiento'];
		$data['fecha_nacimiento'] = Carbon::createFromFormat('d-m-Y', $fecha)->format('Y-m-d');
		$jugador = $this->get($data['jugador_id']);
		$jugador->update($data);
		$equipo = Equipo::find($data['equipo_id']);
		$jugador->equipos()->save($equipo,
			[
				'numero' => $data['numero'],
				'fecha_inicio' => $data['fecha_inicio'],
				'fecha_fin' => $data['fecha_fin']
			]
		);
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
}