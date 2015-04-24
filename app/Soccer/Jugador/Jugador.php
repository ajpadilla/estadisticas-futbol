<?php namespace soccer\Jugador;

use Eloquent;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Carbon\Carbon;
/**
* 
*/
class Jugador extends Eloquent implements StaplerableInterface{
	use EloquentTrait;

	protected $table = 'jugadores';

	protected $fillable = ['nombre', 'fecha_nacimiento','foto','altura','peso','apodo','posicion_id','pais_id'];

	 public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('foto', [
            'styles' => [
                'medium' => '300x300',
                'thumb' => '100x100'
            ]
        ]);

        parent::__construct($attributes);
    }

	public function pais()
	{
		return $this->belongsTo('soccer\Pais\Pais');
	}

	public function posicion()
	{
		return $this->belongsTo('soccer\Posicion\Posicion');
	}

	public function equipos()
	{
		return $this->belongsToMany('soccer\Equipo\Equipo', 'equipo_jugador')
					->withPivot('numero', 'fecha_inicio', 'fecha_fin')
					->withTimestamps();
	}

	public function getNameCurrentTeams()
	{
		$teamsNames = [];
		foreach ($this->equipos as $equipo) {
			$teamsNames[] = $equipo->nombre;
		}
		return $teamsNames;
	}

	public function getAgeAttribute()
	{
		//return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y');
		$fecha = explode("-", $this->fecha_nacimiento);
		return Carbon::createFromDate($fecha[0], $fecha[1], $fecha[2])->age;
	}

	public function getEquipoAttribute()
	{
		$fechaActual = $this->equipos()->max('fecha_inicio');
		return $this->equipos()->whereFechaInicio($fechaActual)->first();
	}

	public function getEquipoActualAttribute()
	{
		return $this->equipos()
			->whereFechaFin(null)
			->max('fecha_inicio')
			->first();
	}

	
}