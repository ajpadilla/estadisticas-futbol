<?php namespace soccer\CompetitionFormats;

use Eloquent;
use Carbon\Carbon;
/**
* 
*/

class CompetitionFormat extends Eloquent {
	protected $fillable = ['name', 'groups', 'clasificated_by_group' ,'local_away_game','local_away_game_final' ,'away_goal','teams_by_group' ,'promotion' ,'descent'  ,
     ];
}