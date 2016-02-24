afasdfasd
<div class="tab-content">
	@foreach ($competition->phasesWithGames as $phaseTableIndex => $phase)
	<div class="tab-pane" id="tab-{{ $phase->id }}">						
		<div class="row">
			@foreach ($phase->groupsWithGames as $groupTableIndex => $group) 
			@if($phase->twoMoreGroups)
			<div class="col-md-6">
				@else
				<div class="col-md-12">
					@endif
					<div class="box">
						<div class="box-title">
							<h4><i class="fa fa-bars"></i>{{ $group->name }} asfasdfa</h4>
						</div>
						<div class="box-body">
							@if (!$group->isFullGames)
							<div class="row">
								<div class="col-md-12">
									<button class="games pull-left btn btn-lg btn-primary" id="add-game" href="#" data-group-id="{{ $group->id }}">Agregar partido</button>
								</div>								
							</div>					
							<div class="separator"></div>
							@endif
							<div class="row">
								@if($group->hasGames)
								<div class="col-md-12">											
									<?php $table = $gamesTables[$phase->id]['tables'][$groupTableIndex]; ?>
									@include('partials._index-table')
								</div>
								@else
								<h3>No hay juegos registrados aún!</h3>
								@endif
							</div>											
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
		@endforeach	
	</div>

@section('scripts2')
	<script type="text/javascript">
	    jQuery(document).ready(function(){	    	
			@foreach($gamesTables as $phase)
				@foreach($phase['tables'] as $table)
					@if($scriptTableTemplate)
						{{ $table->script($scriptTableTemplate) }}
					@endif
				@endforeach
			@endforeach
	    });
	</script>	
@stop