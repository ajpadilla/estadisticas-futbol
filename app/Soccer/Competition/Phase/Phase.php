<?php namespace soccer\Competition\Phase;

use Eloquent;
use Carbon\Carbon;
/**
* 
*/

class Phase extends Eloquent {

	protected $fillable = ['name', 'from', 'to', 'competition_id', 'format_id'];

    public function getDates()
    {
        /* substitute your list of fields you want to be auto-converted to timestamps here: */
        return array('created_at', 'updated_at', 'from', 'to');
    }

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
        if ($competition = $this->competition) 
            return $category->belongsTo('soccer\Country\Country');
        return null;
    }

    public function groups()
    {
        return $this->hasMany('soccer\Group\Group');
    }

    public function games()
    {
        return $this->hasManyThrough('soccer\Game\Game', 'soccer\Group\Group');
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

    public function getHasGamesAttribute()
    {
        return $this->games->count() > 0;
    }    

    public function getGroupsWithGamesAttribute()
    {
        return $this->groups()->has('games')->get();
    }

    public function getIsCurrentAttribute()
    {
        return $this->from->diffInDays(null, false) > 0 && $this->to->diffInDays(null, false) < 0;
    }

    public function getIsFirstAttribute()
    {
        return $this->competition->phases()->orderBy('from', 'ASC')->first()->id == $this->id;
    }

    public function getHasGroupsAttribute()
    {
        return $this->format->groups > 0;
    }

    public function getIsLeagueAttribute()
    {
        return $this->format->groups <= 1;
    }

    public function getEmptyAttribute()
    {
        return $this->groups()->count() < 1;
    }

    public function getHasAssociateGroupsAttribute()
    {
        return !$this->empty;
    }    

    public function getTwoMoreGroupsAttribute()
    {
        return $this->groups()->count() > 1;
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