<?php namespace soccer\Competition;

use Eloquent;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Carbon\Carbon;
use \DB;
use soccer\Game\Game;
/**
*
*/

class Competition extends Eloquent implements StaplerableInterface{
	use EloquentTrait;

	protected $fillable = ['nombre','type','imagen','desde','hasta','international','competition_format_id','country_id'];

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

    public function getDates()
    {
        /* substitute your list of fields you want to be auto-converted to timestamps here: */
        return array('created_at', 'updated_at', 'desde', 'hasta');
    }

    /*
	********************* Relations ***********************
    */

    public function country()
    {
        return $this->belongsTo('soccer\Pais\Pais');
    }

    public function competitionFormat()
    {
        return $this->belongsTo('soccer\CompetitionFormats\CompetitionFormat');
    }    

    public function phases()
    {
        return $this->hasMany('soccer\Competition\Phase\Phase');
                    /*->orderBy('from', 'ASC')
                    ->orderBy('id', 'ASC');*/
    }

    public function groups()
    {
        return $this->hasManyThrough('soccer\Group\Group', 'soccer\Competition\Phase\Phase');
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

    public function games()
    {
        $games = new \Illuminate\Database\Eloquent\Collection;
        foreach ($this->groups as $group)
            foreach($group->games as $game)
                $games->add($game);
        return $games;
    }

    /*
    ********************* Custom Methods ***********************
    */

    public function getTodayGamesAttribute()
    {
        /*$games = new \Illuminate\Database\Eloquent\Collection;
        foreach ($this->groups as $group)
            $todayGames = $group
            foreach($group->games as $game)
                $games->add($game);
        return $games;

        JOIN groups gr ON (g.group_id = gr.id)
        JOIN phases p ON (gr.phase_id = p.id)
        JOIN competition c ON (p.competition_id = c.id)*/

        return DB::table('games')
        ->select('*')
        ->join('groups', 'games.group_id', '=', 'groups.id')
        ->join('phases', 'groups.phase_id', '=', 'phases.id')
        ->join('competitions', 'phases.competition_id', '=', 'competitions.id')
        ->where('competitions.id', '=', $this->id)
        //->whereRaw('DATE_FORMAT(games.date, "%Y-%m-%d") = ' . Carbon::now()->format('Y-m-d'))
        ->whereRaw('DATE_FORMAT(games.date, "%Y-%m-%d") = ?', [Carbon::now()->format('Y-m-d')])
        ->select('games.*')
        ->get();        
    }

    public function getTodayGames($daye)
    {
        /*$games = new \Illuminate\Database\Eloquent\Collection;
        foreach ($this->groups as $group)
            $todayGames = $group
            foreach($group->games as $game)
                $games->add($game);
        return $games;

        JOIN groups gr ON (g.group_id = gr.id)
        JOIN phases p ON (gr.phase_id = p.id)
        JOIN competition c ON (p.competition_id = c.id)*/

        return DB::table('games')
        ->select('*')
        ->join('groups', 'games.group_id', '=', 'groups.id')
        ->join('phases', 'groups.phase_id', '=', 'phases.id')
        ->join('competitions', 'phases.competition_id', '=', 'competitions.id')
        ->where('competitions.id', '=', $this->id)
        //->whereRaw('DATE_FORMAT(games.date, "%Y-%m-%d") = ' . Carbon::now()->format('Y-m-d'))
        ->whereRaw('DATE_FORMAT(games.date, "%Y-%m-%d") = ?', [$daye])
        ->select('games.*')
        ->get();        
    }


    public function getHasGamesAttribute()
    {
        return $this->groups()->with('games')->count() > 0;
    }

    public function getHasTodayGamesAttribute()
    {
        return DB::table('games')
        ->select('*')
        ->join('groups', 'games.group_id', '=', 'groups.id')
        ->join('phases', 'groups.phase_id', '=', 'phases.id')
        ->join('competitions', 'phases.competition_id', '=', 'competitions.id')
        ->where('competitions.id', '=', $this->id)
        //->whereRaw('DATE_FORMAT(games.date, "%Y-%m-%d") = ' . Carbon::now()->format('Y-m-d'))
        ->whereRaw('DATE_FORMAT(games.date, "%Y-%m-%d") = ?', [Carbon::now()->format('Y-m-d')])
        ->count() > 0;
    }    

     public function getHasTodayGames($date)
    {
        return DB::table('games')
        ->select('*')
        ->join('groups', 'games.group_id', '=', 'groups.id')
        ->join('phases', 'groups.phase_id', '=', 'phases.id')
        ->join('competitions', 'phases.competition_id', '=', 'competitions.id')
        ->where('competitions.id', '=', $this->id)
        //->whereRaw('DATE_FORMAT(games.date, "%Y-%m-%d") = ' . Carbon::now()->format('Y-m-d'))
        ->whereRaw('DATE_FORMAT(games.date, "%Y-%m-%d") = ?', [$date])
        ->count() > 0;
    } 

    public function getPhasesWithGamesAttribute()
    {
        return $this->phases()->has('games')->get();
    }

    public function getFinishedAttribute()
    {
        return $this->hasta->diffInDays(null, false) > 0;
    }

    public function getPhasesByOrderAttribute()
    {
        return $this->phases()
        ->orderBy('from', 'desc')
        ->orderBy('to', 'desc')
        ->get();
    }

    public function getHasPhasesAttribute()
    {
        return $this->phases->count() > 0;
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

    public function getFromAttribute()
    {
        return $this->desde->format('Y-m-d');
    }

    public function getToAttribute()
    {
        return $this->hasta->format('Y-m-d');
    }

    public function getYearAttribute()
    {
        return Carbon::parse($this->desde)->year;
    }

    public function getYearEndAttribute()
    {
        return Carbon::parse($this->hasta)->year;
    }

    public function getFormatFromAttribute()
    {
        return Carbon::parse($this->desde)->formatLocalized('%A %d %B %Y');
    }

    public function getFormatToAttribute()
    {
        return Carbon::parse($this->hasta)->formatLocalized('%A %d %B %Y');
    }

    /*
    ********************* Scopes ***********************
    */    
    public function scopePlaying($query)
    {
        return $query->where('desde', '<=', Carbon::now()->addMinutes(60)->format('Y-m-d h:i:00'))
                     ->where('hasta', '>=', Carbon::now()->addMinutes(60)->format('Y-m-d h:i:00'));
    }    

    public function makeGameObject($id)
    {
        return Game::find($id);
    }
}