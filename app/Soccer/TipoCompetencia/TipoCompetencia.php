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
    public function ligas()
    {
    	return 'Ligas';
    }

    public function torneos()
    {
    	return 'torneos';
    }
}