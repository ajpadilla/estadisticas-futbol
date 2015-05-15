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

    public function country()
    {
        return $this->belongsTo('soccer\Pais\Pais');
    }

    public function groups()
    {
        return $this->hasMany('soccer\Group\Group');
    }

    /*public function teams()
    {
       return $this->hasManyThrough('soccer\GroupTeam\GroupTeam', 'soccer\Group\Group');
       //return $this->hasManyThrough('soccer\Group\Group', 'soccer\Equipo\Equipo', 'group_id', 'team_id');
       //return $this->hasManyThrough('soccer\Equipo\Equipo', 'soccer\Group\Group', 'group_team.team_id', 'group_team.group_id');
    }*/

    public function getTeamsAttribute()
    {        
        $teams = new \Illuminate\Database\Eloquent\Collection;
        foreach ($this->groups as $group) 
            foreach($group->teams as $team)
                $teams->add($team);
        return $teams;
       //return $this->hasManyThrough('soccer\GroupTeam\GroupTeam', 'soccer\Group\Group');
       //return $this->hasManyThrough('soccer\Group\Group', 'soccer\Equipo\Equipo', 'team_id', 'group_id');
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

    public function getIsCleanAttribute()
    {
        return $this->groups()->count() < 1;
    }

    public function getIsFullAttribute()
    {
         return ($this->hasGroups && $this->groups()->count() >= $this->tipoCompetencia->grupos);
    }

    public function getIsFullTeamsAttribute()
    {
        if(!$this->tipoCompetencia->isTournament) {
            $team = $this->groups()->first();        
            return (!$this->hasGroups && ($team && $team->count() >= $this->tipoCompetencia->equipos_por_grupo));
        }
        return false;
    }   

    public function getIsFullAllGroupsAttribute()
    {
        foreach ($this->groups as $group) 
            if(!$group->isFull)
                return false;
        return true;
    } 

    public function getIsFullAllGamesAttribute()
    {
        foreach ($this->groups as $group) 
            if(!$group->isFullGames)
                return false;
        return true;
    }   

    public function getTeamsByGroupAttribute()
    {
        return $this->tipoCompetencia->equipos_por_grupo;
    }  
}