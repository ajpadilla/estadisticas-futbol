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

	//protected $fillable = ['nombre', 'fecha_nacimiento','foto','altura', 'abreviacion','posicion_id','pais_id'];

	 public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('foto', [
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
		return $this->belongsToMany('soccer\Jugador\Jugador', 'equipo_jugador', 'equipo_id', 'jugador_id')
					->withPivot('numero', 'fecha_inicio', 'fecha_fin')
					->withTimestamps();
	}

	public function getAgeAttribute()
	{
		//return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y');
		$fecha = explode("-", $this->fecha_fundacion);
		return Carbon::createFromDate($fecha[0], $fecha[1], $fecha[2])->age;
	}
}