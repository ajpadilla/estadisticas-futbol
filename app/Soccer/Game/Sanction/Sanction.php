<?php namespace soccer\Game\Sanction;

use Eloquent;
use Carbon\Carbon;

class Sanction extends Eloquent {
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
       return $this->belongsTo('soccer\Game\Sanction\SanctionType', 'type_id');
    }  
    /*
    ********************* Custom Methods ***********************
    */  
}