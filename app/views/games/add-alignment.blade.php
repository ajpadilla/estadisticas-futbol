<div id="add-alignments-to-game-div-box" class="col-md-12 box-container ui-sortable">
	<!-- BOX -->
	<div class="box">
		<div class="box-title">
			<h4><i class="fa fa-bars"></i><span class="hidden-inline-mobile">Alineaciones</span></h4>
		</div>
		<div class="box-body">
			<div class="tabbable header-tabs">
				<ul class="nav nav-tabs">
					<li><a href="#tab-{{ $game->localTeam->id }}" data-toggle="tab"><span class="hidden-inline-mobile">{{ $game->localTeam->name }}</span></a></li>
					<li><a href="#tab-{{ $game->awayTeam->id }}" data-toggle="tab"><span class="hidden-inline-mobile">{{ $game->awayTeam->name }}</span></a></li>
				</ul>		
				<div class="tab-content">
					<?php $team = $game->localTeam; ?>
					<div class="tab-pane" id="tab-{{ $team->id }}">
						@include('games.partials._alignment-form')
					</div>
					<?php $team = $game->awayTeam; ?>
					<div class="tab-pane" id="tab-{{ $team->id }}">
						@include('games.partials._alignment-form')
					</div>							
				</div>						
			</div>
		</div>
	</div>
	<!-- /BOX -->
</div>