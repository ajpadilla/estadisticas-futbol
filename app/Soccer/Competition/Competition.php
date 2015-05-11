<?php namespace soccer\Competition;

use Eloquent;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Carbon\Carbon;
/**
* 
*/

class Competition extends Eloquent implements StaplerableInterface{
	use EloquentTrait;

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
        return $this->hasMany('soccer\Group\Group');
    }

    public function teams()
    {
       //return $this->hasManyThrough('soccer\GroupTeam\GroupTeam', 'soccer\Group\Group');
       return $this->hasManyThrough('soccer\Group\Group', 'soccer\Equipo\Equipo', 'team_id', 'group_id');
    }

    public function game()
    {
       return $this->belongsTo('soccer\Game\Game');
    }            

    /*
    ********************* Custom Methods ***********************
    */  

    public function getHasGroupsAttribute()
    {
        return $this->tipoCompetencia->grupos > 0;
    }

    public function getIsLeagueAttribute()
    {
        return $this->tipoCompetencia->grupos <= 1;
    }

    public function getIsClean()
    {
        return $this->groups()->count() < 1;
    }

    public function getIsFullGroupsAttribute()
    {
         return ($this->hasGroups && $this->groups()->count() >= $this->tipoCompetencia->grupos);
    }

    public function getIsFullTeamsAttribute()
    {
        $teams = $this->groups()->first();        
        return (!$this->hasGroups && ($teams && $teams->count() >= $this->tipoCompetencia->equipos_por_grupo));
    }    
}