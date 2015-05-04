<?php namespace soccer\Group;

use Eloquent;
use Carbon\Carbon;
/**
* 
*/

class Group extends Eloquent {
    /*
	********************* Relations ***********************
    */	
    public function teams()
    {
        return $this->belongsToMany('soccer\Equipo\Equipo');
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