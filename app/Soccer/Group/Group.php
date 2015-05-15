<?php namespace soccer\Group;

use Eloquent;
use Carbon\Carbon;
/**
* 
*/

class Group extends Eloquent {

    protected $table = 'groups';

    protected $numberTemas = 0;

    protected $fillable = ['name', 'competition_id'];

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

    /*public function getGamesAttribute()
    {
        $groupTeamsId =  $this->hasMany('soccer\GroupTeam\GroupTeam')->lists('id');
        return \soccer\Game\Game::select()
            ->whereIn('local_team_id', $groupTeamsId)
            ->orWhereIn('away_team_id', $groupTeamsId)
            ->get();
    }

    public function games()
    {
        $groupTeamsId =  $this->hasMany('soccer\GroupTeam\GroupTeam')->lists('id');
        return \soccer\Game\Game::select()
            ->whereIn('local_team_id', $groupTeamsId)
            ->orWhereIn('away_team_id', $groupTeamsId);
    }*/

    public function games()
    {
        return $this->hasMany('soccer\Game\Game');
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

    public function getTotalTeamsAttribute()
    {
        return $this->teams->count();
    }

    public function algo()
    {
        return false;
    }

    public function getIsFullAttribute()
    {
         return ($this->totalTeams >= $this->competition->tipoCompetencia->equipos_por_grupo);
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