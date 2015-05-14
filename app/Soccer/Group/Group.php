<?php namespace soccer\Group;

use Eloquent;
use Carbon\Carbon;
/**
* 
*/

class Group extends Eloquent {

    protected $table = 'groups';

    protected $fillable = ['name', 'competition_id'];

    /*
	********************* Relations ***********************
    */	
    public function teams()
    {
        return $this->belongsToMany('soccer\Equipo\Equipo', 'group_team', 'group_id', 'team_id');
        //return $this->hasMany('soccer\GroupTeam\GroupTeam')->with('soccer\Equipo\Equipo');
    }

    public function games()
    {
        return $this->hasMany('soccer\GroupTeam\GroupTeam')->games;
    }

    public function competition()
    {
        return $this->belongsTo('soccer\Competition\Competition');
    }

    /*
    ********************* Custom Methods ***********************
    */  

    public function getHasTeamsAttribute()
    {
        return $this->teams->counts() > 0;
    }

    public function totalTeams()
    {
        return $this->teams->count();
    }

    public function getIsFullAttribute()
    {
         return ($this->totalTeams >= $this->competition->tipoCompetencia->equipos_por_grupo);
    }

    public function getIsEmptyAttribute()
    {
         return ($this->totalTeams <= 0);
    }    
}