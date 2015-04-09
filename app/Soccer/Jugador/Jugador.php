<?php namespace soccer\Jugador;

use Eloquent;

/**
* 
*/
class Jugador extends Eloquent{

	protected $table = 'jugadores';

	public function pais()
	{
		return $this->belongsTo('soccer\Pais\Pais');
	}

	public function posicion()
	{
		return $this->belongsTo('soccer\Posicion\Posicion');
	}
}