<?php namespace soccer\Phase\Phase;

use Eloquent;
use Carbon\Carbon;
/**
* 
*/

class Phase extends Eloquent {

	protected $fillable = ['name', 'from', 'to', 'competition_id', 'format_id'];

    /*
	********************* Relations ***********************
    */	
    public function competition()
    {
    	return $this->belongsTo('soccer\Competition\Competition');
    }

    public function format()
    {
        return $this->belongsTo('soccer\Competition\CompetitionFormat\CompetitionFormat');
    }    

    public function country()
    {
        if ($competition = $this->competition) {
            return $category->belongsTo('soccer\Country\Country');
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

    /*
    ********************* Custom Methods ***********************
    */  

    public function getHasGroupsAttribute()
    {
        return $this->format->groups > 0;
    }

    public function getIsLeagueAttribute()
    {
        return $this->format->groups <= 1;
    }

    public function getIsCleanAttribute()
    {
        return $this->groups()->count() < 1;
    }

    public function getIsFullAttribute()
    {
         return ($this->hasGroups && $this->groups()->count() >= $this->format->groups);
    }

    public function getIsFullTeamsAttribute()
    {
        if(!$this->format->isTournament) {
            $team = $this->groups()->first();        
            return (!$this->hasGroups && ($team && $team->count() >= $this->format->teams_by_group));
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
        return $this->format->teams_by_group;
    }     
}