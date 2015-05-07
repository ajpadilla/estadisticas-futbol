<div class="row">
	<div class="col-md-8">
		<div class="row">
			<!-- PROFILE DETAILS -->
			<div class="col-md-12">
				<div id="contact-card" class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">{{ $jugador->apodo }}</h2>
					</div>				
					<div class="panel-body">
						<div id="card" class="row">
							<div class="col-md-4 headshot">
								<img class="img-responsive" src="{{ $jugador->foto->url('medium') }}">
							</div>
							<div class="col-md-8">
								<table class="table table-hover">
									<tbody>
										<tr>
											<td>Club Actual</td>
											@if($jugador->equipoActual)
												<td id="card-name"><a href="{{ route('equipos.show', $jugador->equipoActual->id) }}"><strong>{{ $jugador->equipoActual->nombre }}</strong></a></td>
											@else
												<td id="card-name">Sin Club</td>
											@endif
										</tr>									
										<tr>
											<td>Edad</td>
											<td id="card-name"><strong>{{ $jugador->age }}</strong></td>
										</tr>
										<tr>
											<td>Fecha de Nacimienco</td>
											<td id="card-name"><strong>{{ $jugador->fecha_nacimiento }}</strong></td>
										</tr>
										<tr>
											<td>País</td>
											<td id="card-name"><strong>{{ $jugador->pais->nombre }}</strong></td>
										</tr>
										<tr>
											<td>Lugar de Nacimienco</td>
											<td id="card-name"><strong>{{ $jugador->lugar_nacimiento }}</strong></td>
										</tr>										
										<tr>
											<td>Altura</td>
											<td id="card-name"><strong>{{ $jugador->altura_show }}</strong></td>
										</tr>
										<tr>
											<td>Peso</td>
											<td id="card-name"><strong>{{ $jugador->peso_show }}</strong></td>
										</tr>
										<tr>
											<td>Posicion</td>
											<td id="card-name"><strong>{{ $jugador->getPosicionActual()->abreviacion }}</strong></td>
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
		@if($jugador->historia OR $jugador->facebook_url OR $jugador->twitter_url)
			<div class="row">
				<!-- PROFILE PIC -->
				<div class="col-md-12">
					<div class="list-group">
							<div class="list-group-item profile-details">
								{{-- <h2>Jennifer Doe</h2> --}}
								@if($jugador->historia)
									<p>{{ $jugador->historia }}</p>
									<p><a href="{{ $jugador->info_url }}">En Wikipedia.</a></p>
								@endif
								<ul class="list-inline">
									@if($jugador->facebook_url)
										<li><a href="{{ $jugador->facebook_url }}"><i class="fa fa-facebook fa-2x"></i></a></li>
									@endif
									@if($jugador->twitter_url)
										<li><a href="{{ $jugador->twitter_url }}"><i class="fa fa-twitter fa-2x"></i></a></li>
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
		<div class="box border inverse">
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
		</div>
		<!-- /BOX -->
		<!-- /SAMPLE -->
	</div>
	<!-- /PROFILE STATICS -->

	<!-- PROFILE DETAILS -->
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<!-- ROW 2 -->
			<div class="row">
				<div class="col-md-12">
					<div class="box border blue">
						<div class="box-title">
							<h4><i class="fa fa-columns"></i> <span class="hidden-inline-mobile">Profile Summary</span></h4>
						</div>
						<div class="box-body">
							<div class="tabbable">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#sales" data-toggle="tab"><i class="fa fa-signal"></i> <span class="hidden-inline-mobile">Sales Table</span></a></li>
									<li><a href="#feed" data-toggle="tab"><i class="fa fa-rss"></i> <span class="hidden-inline-mobile">Recent Activities</span></a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="sales">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th><i class="fa fa-user"></i> Client</th>
													<th class="hidden-xs"><i class="fa fa-quote-left"></i> Sales Item</th>
													<th><i class="fa fa-dollar"></i> Amount</th>
													<th><i class="fa fa-bars"></i> Status</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><a href="#">Fortune 500</a></td>
													<td class="hidden-xs">Gold Level Virtual Server</td>
													<td>$ 2310.23</td>
													<td><span class="label label-success label-sm">Paid</span></td>
												</tr>
												<tr>
													<td><a href="#">Cisco Inc.</a></td>
													<td class="hidden-xs">Platinum Level Virtual Server</td>
													<td>$ 5502.67</td>
													<td><span class="label label-warning label-sm">Pending</span></td>
												</tr>
												<tr>
													<td><a href="#">VMWare Ltd.</a></td>
													<td class="hidden-xs">Hardware Switch</td>
													<td>$ 3472.54</td>
													<td><span class="label label-success label-sm">Paid</span></td>
												</tr>
												<tr>
													<td><a href="#">Wall-Mart Stores</a></td>
													<td class="hidden-xs">Branding & Marketing</td>
													<td>$ 6653.25</td>
													<td><span class="label label-success label-sm">Paid</span></td>
												</tr>
												<tr>
													<td><a href="#">Exxon Mobil</a></td>
													<td class="hidden-xs">UX and UI Services</td>
													<td>$ 45645.45</td>
													<td><span class="label label-danger label-sm">Overdue</span></td>
												</tr>
												<tr>
													<td><a href="#">General Electric</a></td>
													<td class="hidden-xs">Web Designing</td>
													<td>$ 3432.11</td>
													<td><span class="label label-warning label-sm">Pending</span></td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="tab-pane" id="feed">
										<div class="scroller" data-height="250px" data-always-visible="1" data-rail-visible="1">
											<div class="feed-activity clearfix">
												<div>
													<i class="pull-left roundicon fa fa-check btn btn-info"></i>
													<a class="user" href="#"> John Doe </a>
													accepted your connection request.
													<br>
													<a href="#">View profile</a>
													
												</div>
												<div class="time">
													<i class="fa fa-clock-o"></i>
													5 hours ago
												</div>
											</div>
											<div class="feed-activity clearfix">
												<div>
													<i class="pull-left roundicon fa fa-picture-o btn btn-danger"></i>
													<a class="user" href="#"> Jack Doe </a>
													uploaded a new photo.
													<br>
													<a href="#">Take a look</a>
													
												</div>
												<div class="time">
													<i class="fa fa-clock-o"></i>
													5 hours ago
												</div>
											</div>
											<div class="feed-activity clearfix">
												<div>
													<i class="pull-left roundicon fa fa-edit btn btn-pink"></i>
													<a class="user" href="#"> Jess Doe </a>
													edited their skills.
													<br>
													<a href="#">Endorse them</a>
													
												</div>
												<div class="time">
													<i class="fa fa-clock-o"></i>
													5 hours ago
												</div>
											</div>
											<div class="feed-activity clearfix">
												<div>
													<i class="pull-left roundicon fa fa-bitcoin btn btn-yellow"></i>
													<a class="user" href="#"> Divine Doe </a>
													made a bitcoin payment.
													<br>
													<a href="#">Check your financials</a>
													
												</div>
												<div class="time">
													<i class="fa fa-clock-o"></i>
													6 hours ago
												</div>
											</div>
											<div class="feed-activity clearfix">
												<div>
													<i class="pull-left roundicon fa fa-dropbox btn btn-primary"></i>
													<a class="user" href="#"> Lisbon Doe </a>
													saved a new document to Dropbox.
													<br>
													<a href="#">Download</a>
													
												</div>
												<div class="time">
													<i class="fa fa-clock-o"></i>
													1 day ago
												</div>
											</div>
											<div class="feed-activity clearfix">
												<div>
													<i class="pull-left roundicon fa fa-pinterest btn btn-inverse"></i>
													<a class="user" href="#"> Bob Doe </a>
													pinned a new photo to Pinterest.
													<br>
													<a href="#">Take a look</a>
													
												</div>
												<div class="time">
													<i class="fa fa-clock-o"></i>
													2 days ago
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /ROW 2 -->
		</div>
		
	</div>
	<!-- /PROFILE DETAILS -->
</div>