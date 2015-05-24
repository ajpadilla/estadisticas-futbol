<?php namespace soccer\Game\Sanction;

use soccer\Game\FixtureBaseModel;

class Sanction extends FixtureBaseModel {
    protected $fillable = ['observations', 'minute','second','type_id','game_id','team_id','player_id'];

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
       return $this->belongsTo('soccer\Game\Sanction\SanctionType', 'type_id');
    }  
    /*
    ********************* Custom Methods ***********************
    */  
}