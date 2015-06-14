<div class="row">
	<div class="col-md-8">
		<div class="row">
			<!-- PROFILE DETAILS -->
			<div class="col-md-12">
				<div id="contact-card" class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">{{ $equipo->apodo }}</h2>						
					</div>				
					<div class="panel-body">
						<div id="card" class="row">
							<div class="col-md-4 headshot">
								<img class="img-responsive" src="{{ $equipo->foto->url('medium') }}">
							</div>
							<div class="col-md-8">
								<table class="table table-hover">
									<tbody>
											
										<tr>
											<td>Fecha de Fundación</td>
											<td id="card-name"><strong>{{ $equipo->fecha_fundacion }}</strong></td>
										</tr>
										<tr>
											<td>Edad</td>
											<td id="card-name"><strong>{{ $equipo->age }}</strong></td>
										</tr>
										<tr>
											<td>País</td>
											<td id="card-name"><strong>{{ $equipo->pais->nombre }}</strong></td>
										</tr>										
										<tr>
											<td>Ubicación</td>
											<td id="card-name"><strong>{{ $equipo->ubicacion }}</strong></td>
										</tr>										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /PROFILE DETAILS -->	
		</div>
		@if($equipo->historia OR $equipo->facebook_url OR $equipo->twitter_url)
			<div class="row">
				<!-- PROFILE PIC -->
				<div class="col-md-12">
					<div class="list-group">
						{{--<li class="list-group-item zero-padding">
							<img alt="" class="img-responsive" src="{{ $equipo->bandera->url('medium') }}">
						</li>--}}
						<div class="list-group-item profile-details">
							{{-- <h2>Jennifer Doe</h2> --}}
							@if($equipo->historia)
								<p>{{ $equipo->historia }}</p>
								<p><a href="{{ $equipo->info_url }}">En Wikipedia.</a></p>
							@endif
							<ul class="list-inline">
								@if($equipo->facebook_url)
									<li><a href="{{ $equipo->facebook_url }}"><i class="fa fa-facebook fa-2x"></i></a></li>
								@endif
								@if($equipo->twitter_url)
									<li><a href="{{ $equipo->twitter_url }}"><i class="fa fa-twitter fa-2x"></i></a></li>
								@endif
							</ul>
						</div>
					</div>
				</div>
				<!-- /PROFILE PIC -->
			</div>
		@endif
	</div>

	<!-- PROFILE STATICS -->
	<div class="col-md-4">
		<!-- BOX -->
		<!--<div class="box border inverse">
			<div class="box-title">
				<h4><i class="fa fa-bars"></i>Estadísticas</h4>
				{{--<div class="tools">
					<a href="#box-config" data-toggle="modal" class="config">
						<i class="fa fa-cog"></i>
					</a>
					<a href="javascript:;" class="reload">
						<i class="fa fa-refresh"></i>
					</a>
					<a href="javascript:;" class="collapse">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a href="javascript:;" class="remove">
						<i class="fa fa-times"></i>
					</a>
				</div>--}}
			</div>
			<div class="box-body big sparkline-stats">
				<div class="sparkline-row">
					<span class="title">Diferencia de Goles</span>
					<span class="value">7453</span>
					{{-- <div class="linechart linechart-lg">1:3,2.8:4,3:3,4:3.4,5:7.5,6:2.3,7:5.4</div> --}}
				</div>
				<div class="sparkline-row">
					<span class="title">Partidos Ganados</span>
					<span class="value"><i class="fa fa-usd"></i> 45,732</span>
					{{-- <span class="sparkline big" data-color="blue">16,6,23,14,12,10,15,4,19,18,4,24</span> --}}
				</div>
				<div class="sparkline-row">
					<span class="title">Partidos Perdidos</span>
					<span class="value"><i class="fa fa-usd"></i> 25,674</span>
					{{-- <span class="sparklinepie big">16,6,23</span> --}}
				</div>
			</div>
		</div>-->
		<!-- /BOX -->
		<!-- /SAMPLE -->
	</div>
	<!-- /PROFILE STATICS -->
</div>