<?php namespace soccer\Game\Goal;

use Eloquent;
use Carbon\Carbon;

class Goal extends Eloquent {
    protected $fillable = ['observations', 'minute','second','type_id','game_id','team_id','player_id','assistance_id'];

    /*
	********************* Relations ***********************
    */	
    public function game()
    {
       return $this->belongsTo('soccer\Game\Game');
    }   

    public function team()
    {
        return $this->belongsTo('soccer\Equipo\Equipo', 'team_id');
    } 

    public function player()
    {
       return $this->belongsTo('soccer\Player\Player');
    }   

    public function type()
    {
       return $this->belongsTo('soccer\Game\Goal\GoalType', 'type_id');
    }  

    public function assistance()
    {
       return $this->belongsTo('soccer\Player\Player', 'assistance_id');
    }  

    /*
    ********************* Custom Methods ***********************
    */  
}