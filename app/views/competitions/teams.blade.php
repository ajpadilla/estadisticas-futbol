@if (!$competition->finished) 
	<div class="row">
		<div class="col-md-2">
			<button class="pull-left btn btn-lg btn-primary" id="add-group" data-competition-id="{{ $competition->id }}" href="#">Agregar fase</button>
		</div>
		<div id="add-phase-to-competition" class="hidden">
			@include('phases.new')
		</div>

	</div>
	<br />
@endif
<div class="row">
	@if ($competition->hasPhases)
		@include('groups.partials._tables')
	@else
		<div class="col-md-12"><h1>Competencia sin equipos!</h1></div>
	@endif
</div>	

@if(!$competition->isFullAllGroups)
	<div id="add-teams-to-group" class="hidden">
		@include('groups.add-team')
	</div>
@endif

@if(!$competition->isFullAllGroupsGames)
	<div id="add-game-to-group-div" class="hidden">
		@include('groups.add-game')
	</div>
@endif

<div id="add-group-to-phase" class="hidden">
	@include('groups.new')
</div>
