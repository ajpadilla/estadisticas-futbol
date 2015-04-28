<?php namespace soccer\TipoCompetencia;

use Eloquent;

class TipoCompetencia extends Eloquent {
	protected $fillable = [];

    /*
	********************* Relations ***********************
    */	
    public function competencias()
    {
    	return $this->hasMany('soccer\Competencia\Competencia');
    }	

    /*
	********************* Custom Methods ***********************
    */	    
    public function getEsLigaAttribute()
    {
    	return $this->grupos == 1;
    }

    public function getEsTorneoAttribute()
    {
    	return $this->grupos > 1;
    }
}