<?php namespace soccer\Competencia;

use Eloquent;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Carbon\Carbon;
/**
* 
*/

class Competencia extends Eloquent implements StaplerableInterface{
	use EloquentTrait;

	protected $fillable = [];

 	public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('imagen', [
            'styles' => [
                'medium' => '150x250',
                'small' => '50x100',
                'thumb' => '50x30'
            ]
        ]);

        parent::__construct($attributes);
    }

    /*
	********************* Relations ***********************
    */	
    public function tipoCompetencia()
    {
    	return $this->belongsTo('soccer\TipoCompetencia\TipoCompetencia');
    }

    /*
    ********************* Custom Methods ***********************
    */       
}