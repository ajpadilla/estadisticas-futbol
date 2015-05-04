@if (!$competencia->equiposCompletos) 
	<div class="row">
		<div class="col-md-2 col-md-offset-10">
			<button class="pull-right btn btn-lg btn-primary" id="add-equipo" href="{{ route('competencias.api.add.equipo', $competencia->id) }}">Agregar equipo</button>
		</div>
	</div>
@endif
<div class="row">
	@if ($competencia->hasEquipos)
		@foreach ($competencia->equipos as $equipo) 
			<div class="col-md-12">		
				<div class="box border green">
					<div class="box-title">
						<h4><i class="fa fa-bars"></i>Grupo {{ $equipo->nombre }}</h4>
					</div>
					<div class="box-body big">
						<div class="row">
							<div class="col-md-12">
								@include('grupos.partials._index-table')
							</div>
						</div>
					</div>
				</div>
			</div>	
		@endforeach	
	@endif
</div>