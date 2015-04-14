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

	public function getAllForSelect()
	{
		return $this->getAll()->lists('nombre', 'id');
	}	

	public function listAll()
	{
		return Pais::select()->lists('nombre', 'id');

	}
}