@extends("layouts.main")

@section("page-title")
	{{--Datos {{ $equipo->nombre }} --}}
@stop

@section("page-description")
	Partido
@stop

@section('content')
	<div class="col-md-12">
		<!-- BOX -->
		<div class="box border">
			<div class="box-title">
				<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">{{ $game->localTeam->nombre }} vs {{ $game->awayTeam->nombre }}</span></h4>
			</div>
			<div class="box-body">
				<div class="tabbable header-tabs user-profile">
					<ul class="nav nav-tabs">
						<li>
							<a href="#pro_alignments" data-toggle="tab" id="game-alignments">
								<i class="fa fa-edit"></i> 
								<span class="hidden-inline-mobile"> Alineaciones</span>
							</a>
						</li>
						<li>
							<a href="#pro_sanctions" data-toggle="tab" id="game-sanctions">
								<i class="fa fa-edit"></i> 
								<span class="hidden-inline-mobile"> Sanciones</span>
							</a>
						</li>
						<li>
							<a href="#pro_goals" data-toggle="tab" id="game-goals">
								<i class="fa fa-edit"></i> 
								<span class="hidden-inline-mobile"> Goles</span>
							</a>
						</li>
						<li>
							<a href="#pro_changes" data-toggle="tab" id="game-changes">
								<i class="fa fa-edit"></i> 
								<span class="hidden-inline-mobile"> Cambios</span>
							</a>
						</li>						
						<li class="active">
							<a href="#pro_resume" data-toggle="tab" id="game-resume">
								<i class="fa fa-dot-circle-o"></i> 
								<span class="hidden-inline-mobile">Resumen</span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
					   <!-- OVERVIEW -->
					   <div class="tab-pane fade in active" id="pro_resume">
					   		@include('games.profile-overview')
					   </div>
					   <!-- /OVERVIEW -->
					   
					   <!-- EDIT ACCOUNT -->
					   <div class="tab-pane fade" id="pro_changes">
							@include('games.changes')
					   </div>
					   <!-- /EDIT ACCOUNT -->
					   
					   <!-- JUGADORES TAB -->
					   <div class="tab-pane fade" id="pro_goals">						  
					   		@include('games.goals')
					   </div>
					   <!-- /JUGADORES -->

					   <!-- PARTIDOS TAB -->
					   <div class="tab-pane fade" id="pro_changes">
							@include('games.changes')
					   </div>
					   <!-- /PARTIDOS -->			

   					   <!-- PARTIDOS TAB -->
					   <div class="tab-pane fade" id="pro_alignments">
							@include('games.alignments')
					   </div>
					   <!-- /PARTIDOS -->	
					</div>
				</div>
				<!-- /USER PROFILE -->
			</div>
		</div>
		<!-- /BOX -->					
	</div>
@stop	