<div class="col-md-12 box-container ui-sortable">
	<!-- BOX -->
	<div class="box">
		<div class="box-title">
			<h4><i class="fa fa-bars"></i><span class="hidden-inline-mobile">Fases</span></h4>
		</div>
		<div class="box-body">
			<div class="tabbable header-tabs">
				<ul class="nav nav-tabs">
					@foreach ($competition->phases as $phaseTableIndex => $phase)
						<li id="li-phase-{{ $phase->id }}">
							<a href="#tab-phase-{{ $phase->id }}" data-toggle="tab"><span class="hidden-inline-mobile">{{ $phase->name }}</span></a>
						</li>
					@endforeach
				</ul>
				<div class="tab-content">
					@foreach ($competition->phases as $phaseTableIndex => $phase)
						<div class="tab-pane" id="tab-phase-{{ $phase->id }}">
							<div class="row">
								<div class="col-md-12">
									{{-- <button class="delete-phase pull-right btn btn-lg btn-primary" id="delete-phase" href="{{ URL::route('phases.api.edit', $phase->id) }}">Editar Fase</button> --}}	
									<button class="delete-phase pull-right btn btn-lg btn-primary" id="delete-phase" href="{{ URL::route('phases.api.delete', $phase->id) }}" data-phase-id="{{ $phase->id }}">Eliminar Fase</button>						
									@if(!$phase->isFull)
										<button class="group pull-right btn btn-lg btn-primary" id="add-group" data-phase-id="{{ $phase->id }}" href="#">Agregar grupo</button>
									@endif	
								</div>
							</div>
							<div class="separator"></div>
							<div class="row">
								@foreach ($phase->groups as $groupTableIndex => $group) 
										@if($phase->twoMoreGroups)
											<div id="div-group-{{ $group->id }}" class="col-md-6">
										@else
											<div class="col-md-12">
										@endif
											<div class="box">
												<div class="box-title">
													<h4><i class="fa fa-bars"></i>{{ $group->name }}</h4>
												</div>
												<div class="box-body">
													<div class="row">
														<div class="col-md-12">
															{{-- <button class="edit-group pull-right btn btn-lg btn-primary" id="edit-group" href="{{ URL::route('groups.api.edit', $group->id) }}">Editar Grupo</button> --}}
															<button class="delete-group pull-right btn btn-lg btn-primary" id="delete-group" href="{{ URL::route('groups.api.delete', $group->id) }}" data-group-id="{{ $group->id }}">Eliminar Grupo</button>	
															@if (!$group->isFullGames)
																<button class="games pull-right btn btn-lg btn-primary" id="add-game" href="#" data-group-id="{{ $group->id }}">Agregar partido</button>
															@endif
															@if (!$group->isFull)
																<button class="teams pull-right btn btn-lg btn-primary" id="add-team" href="{{ URL::route('groups.api.add.team') }}" competition-id="{{ $competition->id }}" data-group-id="{{ $group->id }}" data-phase-id="{{ $phase->id }}">Agregar equipo</button>
															@endif		
														</div>
													</div>
													<div class="separator"></div>					
													<div class="row">
														<div class="col-md-12">
															<?php $table = $tables[$phase->id]['tables'][$groupTableIndex]; ?>
															@include('partials._index-table')
														</div>
													</div>											
												</div>
											</div>
										</div>
								@endforeach
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<!-- /BOX -->
</div>

@section('scripts')
	<script type="text/javascript">
	    jQuery(document).ready(function(){	    	
			@foreach($tables as $phase)
				@foreach($phase['tables'] as $table)
					@if($scriptTableTemplate)
						{{ $table->script($scriptTableTemplate) }}
					@endif
				@endforeach
			@endforeach
	    });
	</script>	
@stop