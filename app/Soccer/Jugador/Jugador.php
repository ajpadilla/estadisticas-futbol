<?php namespace soccer\Jugador;

use Eloquent;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Carbon\Carbon;
use DB;
/**
* 
*/
class Jugador extends Eloquent implements StaplerableInterface{
	use EloquentTrait;

	protected $table = 'jugadores';

	protected $fillable = [ 'nombre', 'fecha_nacimiento','lugar_nacimiento','foto',
							'altura','peso','apodo','pais_id','historia',
							'info_url', 'facebook_url','twitter_url'
						   ];

	 public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('foto', [
            'styles' => [
                'medium' => '150x250',
                'small' => '50x100',
                'thumb' => '50x30'
            ]
        ]);

        parent::__construct($attributes);
    }

	public function pais()
	{
		return $this->belongsTo('soccer\Pais\Pais');
	}

	public function posiciones()
	{
		return $this->belongsToMany('soccer\Posicion\Posicion', 'jugador_posicion')
					->withPivot('principal')
					->withTimestamps();
	}

	public function equipos()
	{
		return $this->belongsToMany('soccer\Equipo\Equipo', 'equipo_jugador')
					->withPivot('numero', 'fecha_inicio', 'fecha_fin')
					->withTimestamps();
	}

	public function getAgeAttribute()
	{
		//return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y');
		$fecha = explode("-", $this->fecha_nacimiento);
		return Carbon::createFromDate($fecha[0], $fecha[1], $fecha[2])->age;
	}

	public function getUltimoEquipoAttribute()
	{
		$fecha = $this->equipos()->max('fecha_inicio');
		return $this->equipos()->clubes()->whereFechaInicio($fecha)->first();
	}

	public function getEquipoActualAttribute()
	{
		/*
		SELECT j.* FROM jugadores j JOIN equipo_jugador ej on (j.id=ej.jugador_id) 
		WHERE fecha_fin is null AND fecha_inicio = (SELECT MAX(fecha_inicio) 
		FROM equipo_jugador WHERE fecha_fin is null)
		*/
		$fecha = $this->equipos()->max('fecha_inicio');
		/*return $this->with(['equipos' => function($query) use ($fecha) {
			$query->whereFechaFin(null)->whereFechaInicio($fecha);
		}])->first();*/
		return $this->equipos()->clubes()->whereFechaFin(null)->whereFechaInicio($fecha)->first();
	}

	public function getAlturaShowAttribute()
	{
		return $this->altura . ' cm';
	}

	public function getPesoShowAttribute()
	{
		return $this->peso . ' kg';
	}

	public function getGolesAttribute()
	{
		return 0;
	}

	public function getGolesEquipoActualAttribute()
	{
		return 0;
	}

	public function getPosicionActual()
	{
		return $this->posiciones()->wherePrincipal(TRUE)->first();
	}	
}