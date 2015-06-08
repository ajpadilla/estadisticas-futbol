<?php namespace soccer\Game\Fixture;

use soccer\Game\FixtureBaseModel;

class Fixture extends FixtureBaseModel {
    protected $fillable = ['description', 'minute','second','type_id','game_id'];

    /*
	********************* Relations ***********************
    */  

    public function type()
    {
       return $this->belongsTo('soccer\Game\Fixture\FixtureType', 'type_id');
    }  
    /*
    ********************* Custom Methods ***********************
    */  
}