<div class="row">
	<div class="col-md-12">
		<div class="box border green">
			<div class="box-title">
				<h4><i class="fa fa-bars"></i>Equipos</h4>
			</div>
			<div class="box-body big">
				<div class="row">
					<div class="col-md-2 col-md-offset-10">
						<button class="pull-right btn btn-lg btn-primary" id="add-equipo" href="{{ route('players.api.add.team') }}">Agregar equipo</button>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-12">
						@include('partials._index-table')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('jugadores.partials._add-equipo')