@if ($competition->tipoCompetencia->isTournament) 
	@include('competitions.tournament')
@else
	@include('competitions.league')
@endif
@include('competitions.partials._add-group')
@include('groups.partials._add-team')	