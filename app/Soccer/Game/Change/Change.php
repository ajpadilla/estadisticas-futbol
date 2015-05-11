<?php namespace soccer\Game\Change;

use Eloquent;
use Carbon\Carbon;

class Change extends Eloquent {
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