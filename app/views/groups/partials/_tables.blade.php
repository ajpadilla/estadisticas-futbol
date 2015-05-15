@foreach ($competition->groups as $groupTableIndex => $group) 
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
				@if(!$group->isFullGames OR !$group->isFull)
					<div class="row">
						@if (!$group->isFullGames)
							<div class="col-md-2 col-md-offset-1">
								<button class="teams pull-right btn btn-lg btn-primary" id="add-game" href="#" data-group-id="{{ $group->id }}">Agregar partido</button>
							</div>								
						@endif
						@if (!$group->isFull)
							@if (!$group->isFullGames)
								<div class="col-md-2 col-md-offset-7">
							@else
								<div class="col-md-2 col-md-offset-10">
							@endif
								<button class="teams pull-right btn btn-lg btn-primary" id="add-team" href="{{ URL::route('groups.api.add.team') }}" data-group-id="{{ $group->id }}">Agregar equipo</button>
							</div>							
						@endif
					</div>					
					<br />
				@endif
				<div class="row">
					<div class="col-md-12">
						<?php $table = $table = $tables[$groupTableIndex]; ?>
						@include('partials._index-table')
					</div>
				</div>
			</div>
		</div>
	</div>	
@endforeach
@section('scripts')
	<script type="text/javascript">
	    jQuery(document).ready(function(){
			@foreach($tables as $table)
				@if($scriptTableTemplate)
					{{ $table->script($scriptTableTemplate) }}
				@endif
			@endforeach
	    });
	</script>	
@stop