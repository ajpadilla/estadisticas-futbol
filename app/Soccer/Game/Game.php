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

    /*
    ********************* Custom Methods ***********************
    */  

    public function setDateAttribute($value)
    {
         $this->attributes['date'] = $value . ':00';
    }

    public function getStatusAttribute()
    {
        //return ($this->finished ? 'Finalizado' : 'Pendiente');
        return 'Finalizado';
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
}