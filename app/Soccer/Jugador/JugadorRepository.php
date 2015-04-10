<?php namespace soccer\Jugador;

use soccer\Jugador\Jugador;
use soccer\Base\BaseRepository;
/**
* 
*/
class JugadorRepository extends BaseRepository
{		
	public function getAll()
	{
		return Jugador::all();
	}	

	public function create($data = array())
	{
		$jugador = Jugador::create($data); 
		return $jugador;
	}

	public function update($data = array())
	{
		$jugador = $this->getById($data['jugador_id']); 
		$jugador->update($data);
	}
	public function getById($jugadorId)
	{
		return Jugador::findOrFail($jugadorId);
	}
}