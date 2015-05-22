<?php namespace soccer\Game\Alignment;

use soccer\Game\FixtureBaseModel;

class Alignment extends FixtureBaseModel {
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