<div class="col-md-12">
	<!-- BOX -->
	<div  id="team-form-div" class="box border primary col-md-12">
		<div class="box-title">
			<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">@yield('title-modal')</span></h4>
		</div>
		<div class="box-body">
			{{ Form::open(['route' => 'jugadores.store','class'=>'form-horizontal','role'=>'form',
			'method' => 'POST','files' => true,'id'=> 'player-form']) }}
			<div class="row">
				<div class="col-md-12">
					<div class="box border green">
						<div class="box-title">
							<h4><i class="fa fa-bars"></i>Información General</h4>
						</div>
						<div class="box-body big">
							<div class="row">
								<div class="col-md-12">
									@include('equipos.partials._basic-form')
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="box border green">
						<div class="box-title">
							<h4><i class="fa fa-bars"></i>Detalles</h4>
						</div>
						<div class="box-body big">
							<div class="row">
								<div class="col-md-12">
									@include('equipos.partials._details-form')
								</div>
							</div>
						</div>
					</div>	
				</div>		
			</div>
			{{ Form::close() }}
		</div>
	</div>
	<!-- /BOX -->					
</div>
