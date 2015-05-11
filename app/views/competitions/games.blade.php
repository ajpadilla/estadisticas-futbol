<div class="row">
	@if ($competition->hasGames)
		@include('groups.games')
	@else
		<div class="col-md-12"><h1>Competencia sin partidos!</h1></div>
	@endif
</div>	