<?php namespace soccer\Game\Alignment;

use Eloquent;
use Carbon\Carbon;

class Alignment extends Eloquent {
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
       return $this->belongsTo('soccer\Game\Alignment\AlignmentType', 'type_id');
    }  
    /*
    ********************* Custom Methods ***********************
    */  
}