<div class="row">
	<div class="col-md-12">
		<div class="box border green">
			<div class="box-title">
				<h4><i class="fa fa-bars"></i>Goles realizados en el partido</h4>
			</div>
			<div class="box-body big">
				<div class="row">
					<div class="col-md-2 col-md-offset-10">
						<button class="add-goal pull-right btn btn-lg btn-primary" id="add-goal-{{ $game->id }}" href="#add-goal-form">Agregar Gol</button>
					</div>
				</div>
				<br>			
				<div class="row">
					<div class="col-md-12">
						<?php $table = $goalsTable; ?>
						@include('partials._index-table')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="add-goals-to-game" class="hidden">
	@include('games.add-goal')
</div>	
 <div id="edit-goals-to-game" class="hidden">
	@include('games.edit-goal')
</div>	
@include('games.edit-goal-tpl')
