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