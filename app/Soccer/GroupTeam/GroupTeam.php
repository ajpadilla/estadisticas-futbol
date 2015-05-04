<?php namespace soccer\GroupTeam;

use Eloquent;
use Carbon\Carbon;
/**
* 
*/

class GroupTeam extends Eloquent {

    protected $table = 'group_team';
    /*
	********************* Relations ***********************
    */	
    public function team()
    {
        return $this->belongsTo('soccer\Equipo\Equipo', 'team_id');
    }

    public function group()
    {
        return $this->belongsTo('soccer\Group\Group');
    }    

    public function games()
    {
        return $this->hasMany('soccer\Game\Game');
    }

    /*
    ********************* Custom Methods ***********************
    */  

    public function getHasGroupsAttribute()
    {
        return $this->tipoGroup->groups > 1;
    }

    public function getIsFullGroupsAttribute()
    {
         return ($this->hasGroups && $this->groups()->count() >= $this->tipoGroup->grupos);
    }
}