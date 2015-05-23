<?php namespace soccer\Game\Goal;

use soccer\Game\FixtureBaseModel;

class Goal extends FixtureBaseModel {
    protected $fillable = ['observations', 'minute','second','type_id','game_id','team_id','player_id','assistance_id'];

    /*
	********************* Relations ***********************
    */

    public function team()
    {
       return $this->belongsTo('soccer\Equipo\Equipo', 'team_id');
    }

    public function player()
    {
       return $this->belongsTo('soccer\Player\Player', 'player_id');
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