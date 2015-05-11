<?php namespace soccer\Game;

use Eloquent;
use Carbon\Carbon;

class Game extends Eloquent {
    /*
	********************* Relations ***********************
    */	
    public function localTeam()
    {
        return $this->belongsTo('soccer\GroupTeam\GroupTeam', 'local_team_id')->team;
    }

    public function awayTeam()
    {
        return $this->belongsTo('soccer\GroupTeam\GroupTeam', 'away_team_id')->team;
    } 

    public function type()
    {
       return $this->belongsTo('soccer\Game\GameType', 'type_id');
    } 

    public function competition()
    {
       return $this->belongsTo('soccer\Competition\Competition');
    } 

    /*
    ********************* Custom Methods ***********************
    */  
}