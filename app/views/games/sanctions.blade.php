<div class="row">
	<div class="col-md-12">
		<div class="box border green">
			<div class="box-title">
				<h4><i class="fa fa-bars"></i>Sanciones realizadas en el partido</h4>
			</div>
			<div class="box-body big">
				<div class="row">
					<div class="col-md-2 col-md-offset-10">
						<button class="add-new-sanction pull-right btn btn-lg btn-primary" id="add-sanction-{{ $game->id }}" href="#add-sanction-form">Agregar Sanción</button>
					</div>
				</div>
				<br>			
				<div class="row">
					<div class="col-md-12">
						<?php $table = $sanctionsTable; ?>
						@include('partials._index-table')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="add-sanction-to-game" class="hidden">
	@include('games.add-sanction')
</div>
<div id="edit-sanction-to-game" class="hidden">
	@include('games.edit-sanction')
</div>
@include('games.edit-sanction-tpl')
