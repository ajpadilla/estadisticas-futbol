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

    protected $table = 'competencias';

	protected $fillable = ['nombre','imagen','desde','hasta','internacional','tipo_competencia_id','pais_id'];

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

    public function pais()
    {
        return $this->belongsTo('soccer\Pais\Pais');
    }

    public function groups()
    {
        return $this->belongsTo('soccer\Grupo\Grupo');
    }

    /*
    ********************* Custom Methods ***********************
    */  

    public function getHasGroupsAttribute()
    {
        return $this->tipoCompetencia->groups > 1;
    }

    public function getIsFullGroupsAttribute()
    {
         return ($this->hasGroups && $this->groups()->count() >= $this->tipoCompetencia->grupos);
    }
}