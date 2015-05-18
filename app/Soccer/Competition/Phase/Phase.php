<?php namespace soccer\Phase\Phase;

use Eloquent;
use Carbon\Carbon;
/**
* 
*/

class Phase extends Eloquent {

	protected $fillable = ['nombre', 'local_away_game', 'from', 'to', 'competencia_id'];

    /*
	********************* Relations ***********************
    */	
    public function competition()
    {
    	return $this->belongsTo('soccer\Competition\Competition');
    }

    public function country()
    {
        if ($competition = $this->competition) {
            return $category->belongsTo('soccer\Pais\Pais');
        return null;
    }

    public function groups()
    {
        return $this->hasMany('soccer\Group\Group');
    }

    public function getTeamsAttribute()
    {     
        $teams = new \Illuminate\Database\Eloquent\Collection;
        foreach ($this->groups as $group) 
            foreach($group->teams as $team)
                $teams->add($team);
        return $teams;
    }   

    public function game()
    {
       return $this->belongsTo('soccer\Game\Game');
    }            

    /*
    ********************* Custom Methods ***********************
    */  

    public function getHasGroupsAttribute()
    {
        return $this->tipoCompetencia->grupos > 0;
    }

    public function getIsLeagueAttribute()
    {
        return $this->tipoCompetencia->grupos <= 1;
    }

    public function getIsCleanAttribute()
    {
        return $this->groups()->count() < 1;
    }

    public function getIsFullAttribute()
    {
         return ($this->hasGroups && $this->groups()->count() >= $this->tipoCompetencia->grupos);
    }

    public function getIsFullTeamsAttribute()
    {
        if(!$this->tipoCompetencia->isTournament) {
            $team = $this->groups()->first();        
            return (!$this->hasGroups && ($team && $team->count() >= $this->tipoCompetencia->equipos_por_grupo));
        }
        return false;
    }   

    public function getIsFullAllGroupsAttribute()
    {
        foreach ($this->groups as $group) 
            if(!$group->isFull)
                return false;
        return true;
    } 

    public function getIsFullAllGamesAttribute()
    {
        foreach ($this->groups as $group) 
            if(!$group->isFullGames)
                return false;
        return true;
    }   

    public function getTeamsByGroupAttribute()
    {
        return $this->tipoCompetencia->equipos_por_grupo;
    }  
}