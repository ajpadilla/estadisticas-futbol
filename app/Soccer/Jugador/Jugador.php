<?php namespace soccer\Jugador;

use Eloquent;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

/**
* 
*/
class Jugador extends Eloquent implements StaplerableInterface{
	use EloquentTrait;
	
	protected $table = 'jugadores';

	protected $fillable = ['nombre', 'fecha_nacimiento','foto','altura', 'abreviacion','posicion_id','pais_id'];

	 public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('foto', [
            'styles' => [
                'medium' => '300x300',
                'thumb' => '100x100'
            ]
        ]);

        parent::__construct($attributes);
    }

	public function pais()
	{
		return $this->belongsTo('soccer\Pais\Pais');
	}

	public function posicion()
	{
		return $this->belongsTo('soccer\Posicion\Posicion');
	}
}