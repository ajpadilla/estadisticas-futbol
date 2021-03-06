<?php namespace soccer\Game;

use Eloquent;
use Carbon\Carbon;

class FixtureBaseModel extends Eloquent {
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

    /*
    ********************* Custom Methods ***********************
    */  

    public function getTimeAttribute()
    {
        $minute = ($this->minute < 10) ? '0' . $this->minute : $this->minute;
        $second = ($this->second < 10) ? '0' . $this->second : $this->second;
        return $minute . ':' . $second;
    }
}