<?php namespace soccer\Game\Sanction;

use Eloquent;
use Carbon\Carbon;

class SanctionType extends Eloquent {
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