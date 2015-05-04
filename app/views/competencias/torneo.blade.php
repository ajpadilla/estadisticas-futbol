@if (!$competencia->isFullGroups) 
	<div class="row">
		<div class="col-md-2 col-md-offset-10">
			<button class="pull-right btn btn-lg btn-primary" id="add-grupo" href="{{ route('competencias.api.add.grupo', $competencia->id) }}">Agregar grupo</button>
		</div>
	</div>
@endif
<div class="row">
	@if ($competencia->hasGroups)
		@foreach ($competencia->grupos as $grupo) 
			<div class="col-md-6">		
				<div class="box border green">
					<div class="box-title">
						<h4><i class="fa fa-bars"></i>Grupo {{ $grupo->nombre }}</h4>
					</div>
					<div class="box-body big">
						@if (!$grupo->equiposCompletos)
							<div class="row">
								<div class="col-md-2 col-md-offset-10">
									<button class="pull-right btn btn-lg btn-primary" id="add-equipo-to-grupo" href="{{ route('grupos.api.add.equipo', $grupo->id) }}">Agregar equipo</button>
								</div>
							</div>					
							<br />
						@endif
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