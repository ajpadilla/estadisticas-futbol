<div class="row">
	<div class="col-md-8">
		<div class="row">
			<!-- PROFILE DETAILS -->
			<div class="col-md-12">
				<div id="contact-card" class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">{{ $player->apodo }}</h2>
					</div>				
					<div class="panel-body">
						<div id="card" class="row">
							<div class="col-md-4 headshot">
								<img class="img-responsive" src="{{ $player->foto->url('medium') }}">
							</div>
							<div class="col-md-8">
								<table class="table table-hover">
									<tbody>
										<tr>
											<td>Club Actual</td>
											@if($player->equipoActual)
												<td id="card-name"><a href="{{ route('equipos.show', $player->equipoActual->id) }}"><strong>{{ $player->equipoActual->nombre }}</strong></a></td>
											@else
												<td id="card-name">Sin Club</td>
											@endif
										</tr>									
										<tr>
											<td>Edad</td>
											<td id="card-name"><strong>{{ $player->age }}</strong></td>
										</tr>
										<tr>
											<td>Fecha de Nacimienco</td>
											<td id="card-name"><strong>{{ $player->fecha_nacimiento }}</strong></td>
										</tr>
										<tr>
											<td>País</td>
											<td id="card-name"><strong>{{ $player->pais->nombre }}</strong></td>
										</tr>
										<tr>
											<td>Lugar de Nacimienco</td>
											<td id="card-name"><strong>{{ $player->lugar_nacimiento }}</strong></td>
										</tr>										
										<tr>
											<td>Altura</td>
											<td id="card-name"><strong>{{ $player->altura_show }}</strong></td>
										</tr>
										<tr>
											<td>Peso</td>
											<td id="card-name"><strong>{{ $player->peso_show }}</strong></td>
										</tr>
										<tr>
											<td>Posicion</td>
											<td id="card-name"><strong>{{ $player->getPosicionActual()->abreviacion }}</strong></td>
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
		@if($player->historia OR $player->facebook_url OR $player->twitter_url)
			<div class="row">
				<!-- PROFILE PIC -->
				<div class="col-md-12">
					<div class="list-group">
							<div class="list-group-item profile-details">
								{{-- <h2>Jennifer Doe</h2> --}}
								@if($player->historia)
									<p>{{ $player->historia }}</p>
									<p><a href="{{ $player->info_url }}">En Wikipedia.</a></p>
								@endif
								<ul class="list-inline">
									@if($player->facebook_url)
										<li><a href="{{ $player->facebook_url }}"><i class="fa fa-facebook fa-2x"></i></a></li>
									@endif
									@if($player->twitter_url)
										<li><a href="{{ $player->twitter_url }}"><i class="fa fa-twitter fa-2x"></i></a></li>
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