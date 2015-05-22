<div class="row">
	<div class="col-md-12">
		<div class="box border green">
			<div class="box-title">
				<h4><i class="fa fa-bars"></i>Alineaciones para el juego</h4>
			</div>
			<div class="box-body big">
				<div class="row">
					<div class="col-md-2 col-md-offset-10">
						<button class="add-alignment pull-right btn btn-lg btn-primary" id="add-alignment-{{ $game->id }}" href="#add-alignment-form">Agregar alineación</button>
					</div>
				</div>
				<div class="separator"></div>			
				<div class="row">
					<div class="col-md-6">
						<div class="box">
							<div class="box-title">
								<h4><i class="fa fa-bars"></i>{{ $game->localTeam->nombre }}</h4>
							</div>
							<div class="box-body">
								<?php $table = $localAlignmentTable; ?>
								@include('partials._index-table')
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="box">
							<div class="box-title">
								<h4><i class="fa fa-bars"></i>{{ $game->awayTeam->nombre }}</h4>
							</div>
							<div class="box-body">
								<?php $table = $awayAlignmentTable; ?>
								@include('partials._index-table')
							</div>
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div>
</div>
<div id="add-alignment-to-game" class="hidden">
	@include('games.add-sanction')
</div>