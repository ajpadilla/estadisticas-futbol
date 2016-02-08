<?php namespace soccer\Equipo;

use Eloquent;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Carbon\Carbon;
use soccer\Base\BaseModel;
/**
* 
*/
class Equipo extends Eloquent implements StaplerableInterface{
	use EloquentTrait;

	protected $fillable = ['nombre', 'escudo','foto', 'tipo','fecha_fundacion','apodo','ubicacion','historia','info_url',
	'facebook_url','twitter_url','pais_id'];

	 public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('foto', [
            'styles' => [
                'medium' => '150x250',
                'small' => '50x100',
                'thumb' => '50x30'
            ]
        ]);

        $this->hasAttachedFile('escudo', [
            'styles' => [
                'medium' => '150x250',
                'small' => '50x100',
                'thumb' => '50x30'
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
		return $this->belongsToMany('soccer\Player\Player', 'equipo_jugador')
					->withPivot('numero', 'fecha_inicio', 'fecha_fin')
					->withTimestamps();
	}

    public function groups()
    {
        return $this->belongsToMany('soccer\Group\Group', 'group_team', 'team_id', 'group_id')
        			->withPivot('active')
        			->withTimestamps();
        //return $this->hasMany('soccer\GroupTeam\GroupTeam')->with('soccer\Group\Group');
    }	

    public function getCompetitionsAttribute()
    {
    	//return $this->groups()->with('competition');
        $competitions = new \Illuminate\Database\Eloquent\Collection;
        foreach ($this->groups as $group) 
            $competitions->add($group->competition);
        return $competitions;    	
    }

    public function localGames()
    {
        return $this->hasMany('soccer\Game\Game', 'local_team_id');
    }    

    public function awayGames()
    {
        return $this->hasMany('soccer\Game\Game', 'away_team_id');
    }    

    public function localGoals()
    {
    	return $this->hasManyThrough('soccer\Game\Goal\Goal', 'soccer\Game\Game', 'local_team_id', 'game_id');
    }

    public function awayGoals()
    {
    	return $this->hasManyThrough('soccer\Game\Goal\Goal', 'soccer\Game\Game', 'away_team_id', 'game_id');
    }

	/*
	***************** CUSTOM SETTINGS FOR ATTRIBUTES *************************
	*/

	public function getHasPlayersAttribute()
    {
        return $this->jugadores->count() > 0;
    }

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

	public function jugadoresActualesList()
	{
		return $this->jugadores()->lists('equipo_jugador.jugador_id');
	}

	public function getEdadPromedioAttribute()
	{
		$tEdad = 0;
		foreach ($this->jugadoresActuales()->get() as $jugador) {
			$tEdad += $jugador->age;
		}
		return $tEdad / $this->jugadoresActuales()->count();
	}

	public function getFechaFinAttribute()
	{
		$fecha = $this->pivot->fecha_fin;
		if(!$fecha)
			return 'Presente';
		return $fecha;
	}

	public function getSubNameAttribute()
    {
        return substr($this->nombre, 0, 3);
    }

 	public function scopeJugadoresActuales($query)
    {
    	//dd($query);
        return $query->jugadores()->whereFechaFin(null);
    }	

	public function scopeClubes($query)
	{
		return $query->whereTipo('club');
	}    

	public function scopeSelecciones($query)
	{
		return $query->whereTipo('selección');
	}    	
}