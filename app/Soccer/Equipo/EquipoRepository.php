<?php namespace soccer\Equipo;

use soccer\Equipo\Equipo;
use soccer\Base\BaseRepository;
use Carbon\Carbon;
/**
* 
*/
class EquipoRepository extends BaseRepository
{		
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
}