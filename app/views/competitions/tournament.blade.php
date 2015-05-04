@if (!$competition->isFullGroups) 
	<div class="row">
		<div class="col-md-2 col-md-offset-10">
			<button class="pull-right btn btn-lg btn-primary" id="add-group" href="{{ route('competitions.api.add.group', $competition->id) }}">Agregar grupo</button>
		</div>
	</div>
@endif
<div class="row">
	@if ($competition->hasGroups)
		@foreach ($competition->groups as $group) 
			<div class="col-md-6">		
				<div class="box border green">
					<div class="box-title">
						<h4><i class="fa fa-bars"></i>Grupo {{ $group->name }}</h4>
					</div>
					<div class="box-body big">
						@if (!$group->isFullTeams)
							<div class="row">
								<div class="col-md-2 col-md-offset-10">
									<button class="pull-right btn btn-lg btn-primary" id="add-team-to-group" href="{{ route('groups.api.add.team', $group->id) }}">Agregar equipo</button>
								</div>
							</div>					
							<br />
						@endif
						<div class="row">
							<div class="col-md-12">
								@include('groups.partials._index-table')
							</div>
						</div>
					</div>
				</div>
			</div>	
		@endforeach	
	@endif
</div>