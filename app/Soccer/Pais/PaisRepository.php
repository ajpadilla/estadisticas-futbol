<?php namespace soccer\Pais;

use soccer\Pais\Pais;
use soccer\Base\BaseRepository;
/**
* 
*/
class PaisRepository extends BaseRepository
{		
	public function getAll()
	{
		return Pais::all();
	}	

	public function listAll()
	{
		return Pais::select()->lists('nombre', 'id');
	}

	public function getById($paisId)
	{
		return Pais::findOrFail($paisId);
	}

	public function create($data = array())
	{
		$pais = Pais::create($data); 
		return $pais;
	}
}