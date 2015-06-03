<?php namespace soccer\Game\Goal;

use Eloquent;
use Carbon\Carbon;

class GoalType extends Eloquent {
    protected $fillable = ['name'];

    /*
	********************* Relations ***********************
    */	

    public function game()
    {
       return $this->hasMany('soccer\Game\Goal\Goal', 'type_id');
    }   

    /*
    ********************* Custom Methods ***********************
    */  
}