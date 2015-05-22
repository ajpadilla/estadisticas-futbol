<?php namespace soccer\Game\Sanction;

use Eloquent;
use Carbon\Carbon;

class Sanction extends Eloquent {
    protected $fillable = ['observations', 'minute','second','type_id','game_id','team_id','player_id'];

    /*
	********************* Relations ***********************
    */  

    public function type()
    {
       return $this->belongsTo('soccer\Game\Sanction\SanctionType', 'type_id');
    }  
    /*
    ********************* Custom Methods ***********************
    */  
}