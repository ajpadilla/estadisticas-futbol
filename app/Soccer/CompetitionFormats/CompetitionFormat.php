<?php namespace soccer\CompetitionFormats;

use Eloquent;
use Carbon\Carbon;
/**
* 
*/

class CompetitionFormat extends Eloquent {
	protected $fillable = ['name', 'groups', 'clasificated_by_group' ,'local_away_game','local_away_game_final' ,'away_goal','all_teams','teams_by_group' ,'promotion' ,'descent'  ,
     ];

	/*
		********************* Relations ***********************
    */	
  	/*
   		********************* Custom Methods ***********************
  	*/
  	
  	public function getLocalAwayGameAttribute($value)
    {
        return ($value ? 'Si' : 'No');
    }

    public function getLocalAwayGameFinalAttribute($value)
    {
        return ($value ? 'Si' : 'No');
    }
    public function getAwayGoalAttribute($value)
    {
        return ($value ? 'Si' : 'No');
    }

    public function getAllTeamsAttribute($value)
    {
        return ($value ? 'Si' : 'No');
    }

    public function getIsLocalAwayGameAttribute()
    {
        return ($this->local_away_game == 'Si' ? true : false);
    }
    public function getIsLocalAwayGameFinalAttribute()
    {
        return ($this->local_away_game_final == 'Si' ? true : false);
    }
    public function getIsAwayGoalAttribute()
    {
        return ($this->away_goal_game == 'Si' ? true : false);
    }

}