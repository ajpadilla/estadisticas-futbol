<?php namespace soccer\Pais;

use Eloquent;

/**
* 
*/
class Pais extends Eloquent{

	protected $table = 'paises';

	protected $fillable = ['nombre', 'bandera'];

	public function equipos()
	{
		return $this->hasMany('soccer\Equipo\Equipo');
	}

	public function jugadores()
	{
		return $this->hasMany('soccer\Jugador\Jugador');
	}	

	/*
	***************** CUSTOM SETTINGS FOR ATTRIBUTES *************************
	*/
	public function getNombreAttribute($value)
	{
		return ucfirst(strtolower($value));
	}	

	public function getCodeAttribute($value)
	{
		return strtolower($value);
	}

}