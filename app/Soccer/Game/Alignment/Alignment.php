<?php namespace soccer\Game\Alignment;

use soccer\Game\FixtureBaseModel;

class Alignment extends FixtureBaseModel {

    protected $fillable = ['observations','game_id','team_id','player_id','position_id','type_id'];

    /*
	********************* Relations ***********************
    */	

    public function position()
    {
       return $this->belongsTo('soccer\Posicion\Posicion', 'position_id');
    }   

    public function type()
    {
       return $this->belongsTo('soccer\Game\Alignment\AlignmentType', 'type_id');
    }  
    /*
    ********************* Custom Methods ***********************
    */  
}