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
						@if($phase->isFirst)
							<li class="active">
						@else
							<li>
						@endif
							<a href="#tab--{{ $phase->id }}" data-toggle="tab"><span class="hidden-inline-mobile">{{ $phase->name }}</span></a>
						</li>
					@endforeach
				</ul>
				<div class="tab-content">
					@foreach ($competition->phases as $phaseTableIndex => $phase)
						<div class="tab-pane" id="tab--{{ $phase->id }}">
							@if(!$phase->isFull)
								<div class="row">
									<div class="col-md-2 col-md-offset-10">
										<button class="group pull-right btn btn-lg btn-primary" id="add-group" data-phase-id="{{ $phase->id }}" href="#">Agregar grupo</button>
									</div>
								</div>
								<div class="separator"></div>
							@endif							
							<div class="row">
								@foreach ($phase->groups as $groupTableIndex => $group) 
										@if($phase->twoMoreGroups)
											<div class="col-md-6">
										@else
											<div class="col-md-12">
										@endif
											<div class="box">
												<div class="box-title">
													<h4><i class="fa fa-bars"></i>{{ $group->name }}</h4>
												</div>
												<div class="box-body">
												@if(!$group->isFullGames OR !$group->isFull)
													<div class="row">
														@if (!$group->isFullGames)
															@if (!$group->isFull)
																<div class="col-md-6">
															@else
																<div class="col-md-12">
															@endif
																<button class="games pull-left btn btn-lg btn-primary" id="add-game" href="#" data-group-id="{{ $group->id }}">Agregar partido</button>
															</div>								
														@endif
														@if (!$group->isFull)
															@if (!$group->isFullGames)
																<div class="col-md-6">
															@else
																<div class="col-md-12">
															@endif
																<button class="teams pull-right btn btn-lg btn-primary" id="add-team" href="{{ URL::route('groups.api.add.team') }}" competition-id="{{ $competition->id }}" data-group-id="{{ $group->id }}" data-phase-id="{{ $phase->id }}">Agregar equipo</button>
															</div>							
														@endif
													</div>					
													<div class="separator"></div>									
												@endif
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