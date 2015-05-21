<div class="row">
	@if ($competition->hasGames)
		<div class="col-md-12 box-container ui-sortable">
			<!-- BOX -->
			<div class="box">
				<div class="box-title">
					<h4><i class="fa fa-bars"></i><span class="hidden-inline-mobile">Fases</span></h4>
				</div>
				<div class="box-body">
					<div class="tabbable header-tabs">
						@include('competitions.partials._phases-tabs')				
						@include('competitions.partials._phases-content-tab')
					</div>
				</div>
			</div>
			<!-- /BOX -->
		</div>
	@else
		<div class="col-md-12"><h1>Competencia sin partidos!</h1></div>
	@endif
</div>

<div id="add-goals-to-game" class="hidden">
	@include('games.add-goal')
</div>	
<div id="add-goals-to-game" class="hidden">
	@include('games.add-sanction')
</div>	
