<?php namespace soccer\Player;

use soccer\Player\Player;
use soccer\Equipo\Equipo;
use soccer\Base\BaseRepository;
use soccer\Equipo\EquipoRepository;
use Carbon\Carbon;
use Datatable;
use Illuminate\Support\Facades\File;
/**
* 
*/
class PlayerRepository extends BaseRepository
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
		$this->setModel(new Player);
		$this->setListAllRoute('players.api.list');
	}

	public function filterListName($nombre ='')
	{
		return $this->model->where('nombre', 'LIKE', '%' . $nombre . '%')->get(['id','nombre']);
	}

	public function create($data = array())
	{
		$jugador = $this->model->create($data); 

		if(!empty($data['posiciones_id']))
			$jugador->posiciones()->attach($data['posiciones_id']);

		if(!empty($data['posicion_id']))
			$jugador->posiciones()->sync([$data['posicion_id'] => ['principal' => 1]], false);

		return $jugador;
	}

	public function update($data = array())
	{

		$jugador = $this->get($data['jugador_id']);
		$jugador->update($data);

		if(!empty($data['posiciones_id']))
			$jugador->posiciones()->sync($data['posiciones_id']);

		if(!empty($data['posicion_id']))
			$jugador->posiciones()->sync([$data['posicion_id'] => ['principal' => 1]], false);

		return $jugador;
	}

	public function getEquipos($id)
	{
		return $this->get($id)->equipos;
	}	

	public function getClubes($id)
	{
		//return $this->get($id)->equipos()->whereTipo('club')->get();
		return $this->get($id)->equipos()->clubes()->get();
	}

	public function addEquipo($id, $equipo = array())
	{
		try {
			extract($equipo);
			$equipoRepository = new EquipoRepository;
			$equipo = $equipoRepository->get($equipo_id);
			$jugador = $this->get($id);
			$jugador->equipos()->attach($equipo->id, ['numero' => $numero, 'fecha_inicio' => $desde, 'fecha_fin' => $hasta]);
			return true;
		} catch(Exception $e) {
			return false;
		}
	}

	/*
	*********************** DATATABLE SETTINGS ******************************
	*/		

	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Acciones', function($model)
		{
			$this->cleanActionColumn();
			$this->addActionColumn("<a class='show-player' href='" . route('players.show', $model->id) . "' id='ver_jugador'>Ver</a><br />");
			//$this->addActionColumn("<a  class='edit-player' href='#new-player-form' id='edit_player_".$model->id."'>Editar</a><br />");
			$this->addActionColumn("<a class='delete-player' href='#' id='delete_player_".$model->id."'>Eliminar</a>");
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
			$equipo = $model->equipoActual;	
			if($equipo)				
				return "<a href='" . route('equipos.show', $equipo->id) . "''>" . $equipo->nombre . "</a>";
			return '<p>Sin Club</p>';

		});		

		$this->collection->addColumn('Posición', function($model)
		{
			if(count($model->getPosicionActual()) > 0)
				return $model->getPosicionActual()->abreviacion;
		});

		$this->collection->addColumn('Edad', function($model)
		{
			 return $model->age;
		});
	}

	public function getEquiposTable($id)
	{
		$equipoRepository = new EquipoRepository;		
		$equipoRepository->columns = [
			'Nombre',
			'País',
			'Fecha Inicio',
			'Fecha Fin',
			'Número',
			'Acciones'
		];

		return $equipoRepository->getAllTable('players.api.teams', [$id]);
	}

	private function setTableTeamContent(EquipoRepository $equipoRepository)
	{
		$equipoRepository->collection->searchColumns('País', 'Nombre', 'Fecha Inicio', 'Fecha Fin', 'Número');
		$equipoRepository->collection->orderColumns('País', 'Nombre', 'Fecha Inicio', 'Fecha Fin', 'Número');

		$equipoRepository->collection->addColumn('Nombre', function($model)
		{
			 return $model->nombre;
		});

		$equipoRepository->collection->addColumn('País', function($model)
		{
			 return $model->pais->nombre;
		});

		$equipoRepository->collection->addColumn('Fecha Inicio', function($model)
		{
			 return $model->pivot->fecha_inicio;
		});

		$equipoRepository->collection->addColumn('Fecha Fin', function($model)
		{
			 return $model->fechaFin;
		});		

		$equipoRepository->collection->addColumn('Número', function($model)
		{
			 return $model->pivot->numero;
		});
	}

	public function getTableForTeams($id)
	{
		$equipos = $this->getClubes($id);
		$equipoRepository = new EquipoRepository;
		$equipoRepository->setDatatableCollection($equipos);
		$this->setTableTeamContent($equipoRepository);
		$equipoRepository->addColumnToCollection('Acciones', function($model) use ($equipoRepository)
		{
			$equipoRepository->cleanActionColumn();
			$equipoRepository->addActionColumn("<a class='ver-equipo' href='" . route('equipos.show', $model->id) . "' id='ver_".$model->id."'>Ver</a><br />");
			//$equipoRepository->addActionColumn("<a  class='editar-equipo' href='#new-equipo-form' id='editar_".$model->id."'>Sacar</a><br />");
			//$equipoRepository->addActionColumn("<a  class='editar-equipo' href='#new-equipo-form' id='estadisticas_".$model->id."'>Estadísticas</a><br />");
			//$equipoRepository->addActionColumn("<a class='eliminar-jugador' href='" . route('equipos.api.eliminar', $model->id) . "' id='eliminar-jugador'>Eliminar</a><br />");
			//$equipoRepository->addActionColumn("<a class='cambiar-equipo' href='" . route('equipos.api.cambiar-equipo', $model->id) . "' id='eliminar-jugador'>Cambiar</a>");
			return implode(" ", $equipoRepository->getActionColumn());
		});
		return $equipoRepository->getTableCollectionForRender();
	}		

	public function deleteImageDirectory($id){
		$jugador = $this->get($id);
		if (File::exists(public_path().$jugador->foto->url())) {
			$ruta = explode("/", $jugador->foto->url());
			$directorio = public_path().'/system/soccer/Player/Player/fotos/000/000/'.$ruta[8];
			$jugador->foto->delete();
			File::deleteDirectory($directorio, false);
		}
	}
}