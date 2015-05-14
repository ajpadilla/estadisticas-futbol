<?php namespace soccer\TipoCompetencia;

use Eloquent;

class TipoCompetencia extends Eloquent {
	protected $fillable = [ 'nombre','grupos','fases_eliminatorias','ida_vuelta',
                            'pre_clasificacion','equipos_por_grupo','ascenso','descenso',
                            'clasificados_por_grupo'
                          ];

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
    public function getIsLeagueAttribute()
    {
    	return $this->grupos == 1;
    }

    public function getIsTournamentAttribute()
    {
    	return $this->grupos > 1;
    }

    public function getIdaVueltaAttribute($value)
    {
        return ($value ? 'Si' : 'No');
    }

    public function getPreClasificacionAttribute($value)
    {
        return ($value ? 'Si' : 'No');
    }  

    public function getAscensoAttribute($value)
    {
        return ($value ? $value : 'No');
    }

    public function getDescensoAttribute($value)
    {
        return ($value ? $value : 'No');
    }    

    public function getFasesEliminatoriasAttribute($value)
    {
        return ($value ? $value : 'No');
    }    

    public function getGruposAttribute($value)
    {
        return ($value ? $value : 'No');
    }    

    public function getClasificadosPorGrupoAttribute($value)
    {
        return ($value ? $value : 'No');
    }

    public function getTotalGamesByGroupAttribute()
    {
        $totalGames = 0;
        for ($i=$this->equipos_por_grupo-1; $i > 0 ; $i--)  
            $totalGames += $i;                                    
        return ($this->ida_vuelta ? $totalGames * 2 : $totalGames);       
    }    

    public function getTotalCompetitionGames()
    {
           
    }
}
/*
a,b,c,d
6
8 grupos: 32 equipos, 48 partidos (Sin ida y vuelta)

Fases eliminatorias 4: 8vos, 4tos, semi, final
Clasificados por grupo en fase de grupos 2: 32 / 2 ($totalTeams / $clasificados_por_grupo)
Eliminación directa, fases:
$totalClasificados / 2, hasta que quede 1.

Si el torneo tiene más de 1 fase eliminatoria, entonces se pueden crear más grupos de los inicialmente planteados.

*/