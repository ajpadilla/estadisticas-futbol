<?php namespace soccer\Competition\CompetitionFormat;

use Eloquent;
use Carbon\Carbon;
/**
* 
*/

class CompetitionFormat extends Eloquent {

	protected $fillable = [
                            'name', 
                            'groups', 
                            'clasificated_by_group', 
                            'local_away_game', 
                            'local_away_game_final', 
                            'away_goal', 
                            'teams_by_group', 
                            'promotion', 
                            'descent'];

    /*
	********************* Relations ***********************
    */	
    public function phases()
    {
    	return $this->hasMany('soccer\Competition\Phase\Phase');
    }  

    public function competitions()
    {
        return $this->belongsToMany('soccer\Competition\Competition', 'phases')
                    ->withPivot('name', 'from', 'to')
                    ->withTimestamps();
    }

    public function groups()
    {
        return $this->hasManyThrough('soccer\Group\Group', 'soccer\Competition\Phase\Phase');
    }
}