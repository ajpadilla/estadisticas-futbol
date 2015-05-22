<?php namespace soccer\Game\Change;

use soccer\Game\FixtureBaseModel;

class Change extends FixtureBaseModel {
    protected $fillable = ['observations', 'minute','second','game_id','team_id','player_out_id','player_in_id'];

    /*
    ********************* Relations ***********************
    */

    public function playerOut()
    {
       return $this->belongsTo('soccer\Player\Player', 'player_out_id');
    }   

    public function playerIn()
    {
       return $this->belongsTo('soccer\Player\Player', 'player_in_id');
    }  

    /*
    ********************* Custom Methods ***********************
    */  
}