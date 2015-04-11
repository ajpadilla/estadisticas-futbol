<?php namespace soccer\Posicion;

use soccer\Posicion\Posicion;
use soccer\Base\BaseRepository;
/**
* 
*/
class PosicionRepository extends BaseRepository
{		
	public function getAll()
	{
		return Posicion::all();
	}	

	public function listAll()
	{
		return Posicion::select()->lists('nombre', 'id');
	}
}