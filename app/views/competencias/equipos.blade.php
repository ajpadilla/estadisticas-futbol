@if ($competencia->tipoCompetencia->esTorneo) 
	@include('competencias.torneo')	
@else
	@include('competencias.liga')
@endif
@include('competencias.partials._add-grupo')
@include('grupos.partials._add-equipo')	