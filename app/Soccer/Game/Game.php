<?php namespace soccer\Game;

use Eloquent;
use Carbon\Carbon;

class Game extends Eloquent {

    protected $fillable = ['date', 'local_team_id', 'away_team_id','group_id','type_id', 'stadium', 'main_referee', 'line_referee'];

    public function getDates()
    {
        /* substitute your list of fields you want to be auto-converted to timestamps here: */
        return array('created_at', 'updated_at', 'date');
    }

    /*
	********************* Relations ***********************
    */	
    public function localTeam()
    {
        //return $this->belongsTo('soccer\GroupTeam\GroupTeam', 'local_team_id')->team;
        return $this->belongsTo('soccer\Equipo\Equipo', 'local_team_id');
    }

    public function awayTeam()
    {
        //return $this->belongsTo('soccer\GroupTeam\GroupTeam', 'away_team_id')->team;
        return $this->belongsTo('soccer\Equipo\Equipo', 'away_team_id');
    } 

    public function type()
    {
       return $this->belongsTo('soccer\Game\GameType\GameType', 'type_id');
    } 

    public function competition()
    {
       return $this->belongsTo('soccer\Competition\Competition');
    } 

    public function goals()
    {
        return $this->hasMany('soccer\Game\Goal\Goal');
    }

    public function changes()
    {
        return $this->hasMany('soccer\Game\Change\Change');
    }

    public function sanctions()
    {
        return $this->hasMany('soccer\Game\Sanction\Sanction');
    }        

    public function alignments()
    {
        return $this->hasMany('soccer\Game\Alignment\Alignment');
    }    

    /*
    ********************* Custom Methods ***********************
    */ 

    public function getTeamsAttribute()
     {
        $teams = new \Illuminate\Database\Eloquent\Collection;
        $teams->add($this->localTeam);
        $teams->add($this->awayTeam);
        return $teams;
     } 

    public function getHasGoalsAttribute()
    {
        return $this->goals->count() > 0;
    }    

    public function getLocalGoalsAttribute()
    {
        return $this->goals()->whereTeamId($this->local_team_id)->count();
    }

    public function getAwayGoalsAttribute()
    {
        return $this->goals()->whereTeamId($this->away_team_id)->count();
    }    

    public function getHasSanctionsAttribute()
    {
        return $this->sanctions->count() > 0;
    }

    public function getHasChangesAttribute()
    {
        return $this->changes->count() > 0;
    }

    public function setDateAttribute($value)
    {
         $this->attributes['date'] = $value . ':00';
    }

    public function getStatusAttribute()
    {
        return ($this->finished ? 'Finalizado' : 'Pendiente');
    }

    public function getDateOnlyAttribute()
    {
        return $this->date->format('d-m-Y');
    }

    public function getTimeAttribute($date)
    {
        return $this->date->format('h:i');
    }    

    public function getStadiumAttribute($value)
    {
        return ($value ? $value : '-');
    }

    public function getMainRefereeAttribute($value)
    {
        return ($value ? $value : '-');
    }    

    public function getLineRefereeAttribute($value)
    {
        return ($value ? $value : '-');
    }    

    public function getFinishedAttribute()
    {
        return $this->date->diffInMinutes(Carbon::now()->addMinutes(120)) < 0;
    }  
}