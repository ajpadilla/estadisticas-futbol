<?php namespace soccer\Posicion;

use Eloquent;

/**
* 
*/
class Posicion extends Eloquent{

	protected $table = 'posiciones';

	protected $fillable = ['nombre', 'abreviacion'];

}