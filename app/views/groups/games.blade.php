@foreach ($competition->groups as $groupIndex => $group) 
	@if($competition->tipoCompetencia->isTournament)		
		<div class="col-md-6">
	@else
		<div class="col-md-12">
	@endif
		<div class="box border green">
			<div class="box-title">
				<h4><i class="fa fa-bars"></i>{{ $group->name }}</h4>
			</div>
			<div class="box-body big">
				@if (!$group->isFullGames)
					<div class="row">
						<div class="col-md-2 col-md-offset-10">
							<button class="pull-right btn btn-lg btn-primary" id="add-game" href="#">Agregar juego</button>
						</div>
						<div id="add-game-to-group" class="hidden">
							@include('groups.add-game')
						</div>								
					</div>					
					<br />
				@endif
				<div class="row">
					<div class="col-md-12">
						@include('partials._index-table')
					</div>
				</div>
			</div>
		</div>
	</div>	
@endforeach