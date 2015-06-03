<?php namespace soccer\Game\Sanction;

use Eloquent;
use Carbon\Carbon;

class SanctionType extends Eloquent {
    protected $fillable = ['name'];

    /*
	********************* Relations ***********************
    */	

    public function sanctions()
    {
       return $this->hasMany('soccer\Game\Sanction\Sanction', 'type_id');
    }   

    /*
    ********************* Custom Methods ***********************
    */  
}