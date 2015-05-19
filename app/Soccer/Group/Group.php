<?php namespace soccer\Group;

use Eloquent;
use Carbon\Carbon;
/**
* 
*/

class Group extends Eloquent {

    protected $table = 'groups';

    protected $fillable = ['name', 'phase_id'];

    /*
	********************* Relations ***********************
    */	
    public function teams()
    {
        return $this->belongsToMany('soccer\Equipo\Equipo', 'group_team', 'group_id', 'team_id')
                    ->withPivot('active')
                    ->withTimestamps();
    }

    public function groupTeams()
    {
        return $this->hasMany('soccer\GroupTeam\GroupTeam');
    }

    public function games()
    {
        return $this->hasMany('soccer\Game\Game');
    }    

    public function phase()
    {
        return $this->belongsTo('soccer\Competition\Phase\Phase');
    }

    public function competition()
    {
        if ($phase = $this->phase) 
            return $phase->belongsTo('soccer\Competition\Competition');
        return null;
        //return $this->phase->competition;
    }    

    /*
    ********************* Custom Methods ***********************
    */  

    public function getHasTeamsAttribute()
    {
        return $this->teams->counts() > 0;
    }

    public function getTotalTeamsAttribute()
    {
        return $this->teams->count();
    }


    public function getTotalMissingTeamsAttribute()
    {
        return $this->phase->teamsByGroup - $this->totalTeams;
    }

    public function getIsFullAttribute()
    {
         return ($this->totalTeams >= $this->phase->teamsByGroup);
    }

    public function getIsEmptyAttribute()
    {
         return ($this->totalTeams <= 0);
    }    

    public function getIsFullGamesAttribute()
    {
        //$teamsByGroup = $this->competition->tipoCompetencia->equipos_por_grupo;
        $totalTeams = $this->totalTeams;
        if($totalTeams) 
        {
            $totalGames = 0;
            for ($i=$totalTeams-1; $i > 0 ; $i--)  
                $totalGames += $i;                                    
            return $totalGames <= $this->totalGames;
        }
        return false;
    }

    public function getTotalGamesPAttribute()
    {
        return $this->games->count();
    }
}