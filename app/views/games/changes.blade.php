<div class="row">
	<div class="col-md-12">
		<div class="box border green">
			<div class="box-title">
				<h4><i class="fa fa-bars"></i>Cambios realizados en el partido</h4>
			</div>
			<div class="box-body big">
				<div class="row">
					<div class="col-md-2 col-md-offset-10">
						<button class="add-change pull-right btn btn-lg btn-primary" id="add-change-{{ $game->id }}" href="#add-change-form">Agregar Cambio</button>
					</div>
				</div>
				<br>			
				<div class="row">
					<div class="col-md-12">
						<?php $table = $changesTable; ?>
						<?php $scriptSection = 1 ?>
						@include('partials._index-table')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@if($game->hasChanges)	
	<div id="add-change-to-game" class="hidden">
		@include('games.add-change')
	</div>	
@endif
