<div id="player-form-div" class="box border primary">
	<div class="box-title">
		<h4><i class="fa fa-plus-square"></i>@yield('title-modal')</h4>
		<div class="tools">
			<a href="javascript:;" class="reload">
				<i class="fa fa-refresh"></i>
			</a>
			<a href="javascript:;" class="collapse">
				<i class="fa fa-chevron-up"></i>
			</a>
		</div>
	</div>
	<div class="box-body" style="display: block;">
		<div class="row">
			<div class="col-md-12">

				<div class="divide-20"></div>
				<div class="box-body big">
					{{ Form::open(['route' => 'players.store','class'=>'form-horizontal','role'=>'form',
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
												@include('jugadores.partials._basic-form')
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
												@include('jugadores.partials._details-form')
											</div>
										</div>
									</div>
								</div>	
							</div>		
						</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>

