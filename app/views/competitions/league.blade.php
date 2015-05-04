@if (!$competition->isFullTeams) 
	<div class="row">
		<div class="col-md-2 col-md-offset-10">
			<button class="pull-right btn btn-lg btn-primary" id="add-team" href="{{ route('competitions.api.add.team', $competition->id) }}">Agregar equipo</button>
		</div>
	</div>
@endif
<div class="row">
	<div class="col-md-12">		
		<div class="box border green">
			<div class="box-title">
				<h4><i class="fa fa-bars"></i>Lista de equipos</h4>
			</div>
			<div class="box-body big">
				<div class="row">
					<div class="col-md-12">
						@include('groups.partials._index-table')
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>