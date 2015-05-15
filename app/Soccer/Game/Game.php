<?php namespace soccer\Game;

use Eloquent;
use Carbon\Carbon;

class Game extends Eloquent {

    protected $fillable = ['date', 'local_team_id', 'away_team_id', 'type_id', 'stadium', 'main_referee', 'line_referee'];

    /*
	********************* Relations ***********************
    */	
    public function localTeam()
    {
        //return $this->belongsTo('soccer\GroupTeam\GroupTeam', 'local_team_id')->team;
        return $this->belongsTo('soccer\Equipo\Equipo', 'local_team_id');
    }

    public function awayTeam()
    {
        //return $this->belongsTo('soccer\GroupTeam\GroupTeam', 'away_team_id')->team;
        return $this->belongsTo('soccer\Equipo\Equipo', 'away_team_id');
    } 

    public function type()
    {
       return $this->belongsTo('soccer\Game\GameType\GameType', 'type_id');
    } 

    public function competition()
    {
       return $this->belongsTo('soccer\Competition\Competition');
    } 

    /*
    ********************* Custom Methods ***********************
    */  
}