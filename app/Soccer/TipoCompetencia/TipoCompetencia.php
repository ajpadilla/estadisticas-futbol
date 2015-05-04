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
    public function getEsLigaAttribute()
    {
    	return $this->grupos == 1;
    }

    public function getEsTorneoAttribute()
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
}