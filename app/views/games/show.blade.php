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
							<a href="#pro_players" data-toggle="tab">
								<i class="fa fa-question"></i> 
								<span class="hidden-inline-mobile"> Jugadores</span>
							</a>
						</li>
						<li>
							<a href="#pro_games" data-toggle="tab">
								<i class="fa fa-question"></i> 
								<span class="hidden-inline-mobile"> Partidos</span>
							</a>
						</li>
						<li>
							<a href="#pro_edit" data-toggle="tab" id="editar-equipo">
								<i class="fa fa-edit"></i> 
								<span class="hidden-inline-mobile"> Editar Cuenta</span>
							</a>
						</li>
						<li class="active">
							<a href="#pro_details" data-toggle="tab">
								<i class="fa fa-dot-circle-o"></i> 
								<span class="hidden-inline-mobile">Detalles</span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
					   <!-- OVERVIEW -->
					   <div class="tab-pane fade in active" id="pro_details">
					   		@include('equipos.profile-overview')
					   </div>
					   <!-- /OVERVIEW -->
					   
					   <!-- EDIT ACCOUNT -->
					   <div class="tab-pane fade" id="pro_edit">
							@include('equipos.edit')
					   </div>
					   <!-- /EDIT ACCOUNT -->
					   
					   <!-- JUGADORES TAB -->
					   <div class="tab-pane fade" id="pro_players">						  
					   		@include('equipos.jugadores')
					   </div>
					   <!-- /JUGADORES -->

					   <!-- PARTIDOS TAB -->
					   {{-- <div class="tab-pane fade" id="pro_games">
						  <!-- FAQ -->
							<div class="row">
								
							</div>
					   </div> --}}
					   <!-- /PARTIDOS -->					   
					</div>
				</div>
				<!-- /USER PROFILE -->
			</div>
		</div>
		<!-- /BOX -->					
	</div>
@stop	