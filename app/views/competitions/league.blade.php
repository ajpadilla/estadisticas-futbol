<div class="row">
		@foreach ($competition->groups as $groupTableIndex => $group) 
			<div class="col-md-12">		
				<div class="box border green">
					<div class="box-title">
						<h4><i class="fa fa-bars"></i>{{ $group->name }}</h4>
					</div>
					<div class="box-body big">
						@if (!$group->isFullTeams)
							<div class="row">
								<div class="col-md-2 col-md-offset-10">
									<button class="pull-right btn btn-lg btn-primary" id="add-team" href="#">Agregar equipo</button>
								</div>
								<div id="add-team-to-group" class="hidden">
									@include('groups.add-team')
								</div>								
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
</div>