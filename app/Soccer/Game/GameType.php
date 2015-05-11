<?php namespace soccer\Game;

use Eloquent;
use Carbon\Carbon;

class GameType extends Eloquent {
    /*
	********************* Relations ***********************
    */	

    public function games()
    {
       return $this->hasMany('soccer\Game\Game', 'type_id');
    }   

    /*
    ********************* Custom Methods ***********************
    */  
}