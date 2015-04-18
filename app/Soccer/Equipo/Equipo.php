<?php namespace soccer\Equipo;

use Eloquent;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Carbon\Carbon;
/**
* 
*/
class Equipo extends Eloquent implements StaplerableInterface{
	use EloquentTrait;

	protected $fillable = ['nombre', 'escudo','bandera','foto', 'tipo','fecha_fundacion','apodo','ubicacion','historia','info_url','pais_id'];

	 public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('foto', [
            'styles' => [
                'medium' => '300x300',
                'thumb' => '100x100'
            ]
        ]);

        $this->hasAttachedFile('escudo', [
            'styles' => [
                'medium' => '300x300',
                'thumb' => '100x100'
            ]
        ]);

        $this->hasAttachedFile('bandera', [
            'styles' => [
                'medium' => '300x300',
                'thumb' => '100x100'
            ]
        ]);

        parent::__construct($attributes);
    }

    /*
	********************* Relations ***********************
    */

	public function pais()
	{
		return $this->belongsTo('soccer\Pais\Pais');
	}

	public function jugadores()
	{
		return $this->belongsToMany('soccer\Jugador\Jugador', 'equipo_jugador')
					->withPivot('numero', 'fecha_inicio', 'fecha_fin')
					->withTimestamps();
	}

	/*
	***************** CUSTOM SETTINGS FOR ATTRIBUTES *************************
	*/

	public function getAgeAttribute()
	{
		//return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y');
		$fecha = explode("-", $this->fecha_fundacion);
		return Carbon::createFromDate($fecha[0], $fecha[1], $fecha[2])->age;
	}

	public function getNombreAttribute($value)
	{
		return ucfirst(strtolower($value));
	}

	public function getApodoAttribute($value)
	{
		return ucfirst(strtolower($value));
	}

	public function getTipoAttribute($value)
	{
		return ucfirst(strtolower($value));
	}
}