@extends("layouts.main")

@section("page-title")
	Datos {{ $equipo->nombre }}
@stop

@section("page-description")
	Equipos
@stop

@section('content')
	<div class="col-md-12">
		<!-- BOX -->
		<div class="box border">
			<div class="box-title">
				<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">{{ $equipo->nombre }}</span></h4>
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
							<a href="#pro_edit" data-toggle="tab">
								<i class="fa fa-edit"></i> 
								<span class="hidden-inline-mobile"> Editar Cuenta</span>
							</a>
						</li>
						<li class="active">
							<a href="#pro_overview" data-toggle="tab">
								<i class="fa fa-dot-circle-o"></i> 
								<span class="hidden-inline-mobile">Detalles</span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
					   <!-- OVERVIEW -->
					   <div class="tab-pane fade in active" id="pro_overview">
						  <div class="row">
							<!-- PROFILE PIC -->
							<div class="col-md-8">
								<div class="list-group">
								  <li class="list-group-item zero-padding">
									{{-- <img alt="" class="img-responsive" src="{{ $equipo->foto }}"> --}}
								  </li>
								  <div class="list-group-item profile-details">
										{{-- <h2>Jennifer Doe</h2> --}}
										<p>{{ $equipo->historia }}</p>
										<p><a href="{{ $equipo->info_url }}">En Wikipedia.</a></p>
										<ul class="list-inline">
										   <li><i class="fa fa-facebook fa-2x"></i></li>
										   <li><i class="fa fa-twitter fa-2x"></i></li>
										</ul>
								 </div>
								</div>														
							</div>
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
							<!-- /PROFILE PIC -->
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
					   <div class="tab-pane fade" id="pro_games">
						  <!-- FAQ -->
							<div class="row">
								
							</div>
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