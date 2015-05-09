<?php namespace soccer\Game\Alignment;

use Eloquent;
use Carbon\Carbon;

class AlignmentType extends Eloquent {
    /*
	********************* Relations ***********************
    */	

    public function alignments()
    {
       return $this->hasMany('soccer\Game\Alignment\Alignment', 'type_id');
    }   

    /*
    ********************* Custom Methods ***********************
    */  
}