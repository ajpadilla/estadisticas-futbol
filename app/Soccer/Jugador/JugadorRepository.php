<?php namespace soccer\Jugador;

use soccer\Jugador\Jugador;
/**
* 
*/
class JugadorRepository extends BaseRepository
{		
	public function getAll()
	{
		return Jugador::all();
	}	
}