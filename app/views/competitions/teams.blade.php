@if ($competition->tipoCompetencia->isTournament) 
	@if (!$competition->isFullGroups) 
		<div class="row">
			<div class="col-md-2 col-md-offset-10">
				<button class="pull-right btn btn-lg btn-primary" id="add-group" href="#">Agregar grupo</button>
			</div>
			<div id="add-group-to-competition" class="hidden">
				@include('groups.new')
			</div>
		</div>
		<br />
	@endif
@endif
<div class="row">
	@if ($competition->hasGroups)
		@include('groups.partials._tables')
	@else
		<div class="col-md-12"><h1>Competencia sin grupos y/o equipos!</h1></div>
	@endif
</div>	