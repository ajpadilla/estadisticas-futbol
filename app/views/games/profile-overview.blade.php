<div class="row">

	<!-- /PROFILE STATICS -->
	<div class="row">
		{{--<button class="games pull-left btn btn-lg btn-primary" id="add-game" href="#" data-group-id="{{ $game->id }}">Inicia Partido</button>
		<button class="games pull-left btn btn-lg btn-primary" id="add-game" href="#" data-group-id="{{ $game->id }}">Fin 1er Tiempo</button>
		<button class="games pull-left btn btn-lg btn-primary" id="add-game" href="#" data-group-id="{{ $game->id }}">Inicia 2do Tiempo</button>
		<button class="games pull-left btn btn-lg btn-primary" id="add-game" href="#" data-group-id="{{ $game->id }}">Fin Partido</button>--}}		
		<div class="col-md-offset-1 col-md-10">
			<div class="box-border-inverse">
				<div class="box-title">
					<h4>Control de tiempo</h4>
				</div>
				<div class="box-body">
					<table class="table">
						<thead>
							<tr>
								@foreach ($fixtureTypes as $index => $fixtureType)
									<th>{{ $fixtureType }}</th>
								@endforeach
							</tr>
						</thead>
						<tbody>
							<tr>
								@foreach ($fixtureTypes as $index => $fixtureType)
									<td>
										<input type="checkbox" data-game-id="{{ $game->id }}" name="fixture-type" value="{{ $index }}">
									</td>
								@endforeach
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- PROFILE DETAILS -->
	<div class="row">
		<div class="col-md-1"></div>			
		<div class="col-md-7">
			<div class="row">
				<!-- PROFILE DETAILS -->
				<div class="col-md-12">
					<div id="contact-card" class="panel panel-default">
						{{-- <div class="panel-heading">
							<h2 class="panel-title">{{ $competition->apodo }}</h2>						
						</div> --}}				
						<div class="panel-body">
							<div id="card" class="row">
								<div class="col-md-4 headshot">
									<img class="img-responsive" src="{{-- $competition->imagen->url('medium') --}}">
								</div>
								<div class="col-md-8">
									<table class="table table-hover">
										<tbody>
											<tr>
												<td>Resultado</td>
												<td id="card-name"><strong>{{ $game->localGoals }} - {{ $game->awayGoals }}</strong></td>
											</tr>
											<tr>
												<td>Estatús</td>
												<td id="card-name"><strong>{{ $game->status }}</strong></td>
											</tr>										
											<tr>
												<td>Fecha</td>
												<td id="card-name"><strong>{{ $game->date }}</strong></td>
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
		</div>

		<!-- PROFILE STATICS -->
		<div class="col-md-3">
			<!-- BOX -->
			<div class="box border inverse">
				<div class="box-title">
					<h4><i class="fa fa-bars"></i>Timeline del partido</h4>
					<div class="tools">
						{{-- <a href="javascript:;" class="reload">
							<i class="fa fa-refresh"></i>
						</a>
						<a href="#box-config" data-toggle="modal" class="config">
							<i class="fa fa-cog"></i>
						</a>
						<a href="javascript:;" class="collapse">
							<i class="fa fa-chevron-up"></i>
						</a>
						<a href="javascript:;" class="remove">
							<i class="fa fa-times"></i>
						</a> --}}
					</div>
				</div>
				@if (!empty($fixtures))
				<div class="box-body big sparkline-stats">
					@foreach($fixtures as $fixture)
					<div class="sparkline-row">
						<span class="title">{{ $fixture }}</span>
					</div>
					@endforeach
				</div>
				@endif 
			</div>
			<!-- /BOX -->
			<!-- /SAMPLE -->
		</div>		
	
	</div>
	<!-- /PROFILE DETAILS -->
</div>