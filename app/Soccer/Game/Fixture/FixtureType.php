<?php namespace soccer\Game\Fixture;

use Eloquent;
use Carbon\Carbon;

class FixtureType extends Eloquent {
    protected $fillable = ['name'];

    /*
	********************* Relations ***********************
    */	

    public function fixtures()
    {
       return $this->hasMany('soccer\Game\Fixture\Fixture', 'type_id');
    }   

    /*
    ********************* Custom Methods ***********************
    */  
}