<div class="col-md-12">
	<!-- BOX -->
	<div  id="add-game-to-group-form-div" class="box border primary col-md-12">
		<div class="box-title">
			<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">@yield('title-modal')</span></h4>
		</div>
		<div class="box-body">
			{{ Form::open(['route' => ['groups.api.add.game'],'class'=>'form-horizontal','role'=>'form', 'method' => 'POST', 'id' => 'add-game-to-group-form']) }}
			
				<div class="form-group">
					{{ Form::label('date', 'Fecha y hora', ['class' => 'col-md-4 control-label']) }}	
					<div class="col-md-8">
						{{ Form::text('date', null, ['class' => 'form-control datepicker-time','id' => 'date']) }}
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('local_team_id','Local',['class'=>'col-md-2 control-label']) }}
					<div class="col-md-6">
						{{ Form::select('local_team_id', array(), null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoger Equipo...', 'id'=>'local-team-for-game']) }}
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('away_team_id','Visitante',['class'=>'col-md-2 control-label']) }}
					<div class="col-md-6">
						{{ Form::select('away_team_id', array(), null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoger Equipo...', 'id'=>'away-team-for-game']) }}
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('type_id','Tipo de juego',['class'=>'col-md-2 control-label']) }}
					<div class="col-md-6">
						{{ Form::select('type_id', $gameTypes, null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoger tipo...', 'id'=>'type_id']) }}
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('stadium','Estadio',['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-6">
						{{ Form::text('stadium', null, ['class' => 'form-control','id' => 'stadium']) }}
					</div>
				</div>		

				<div class="form-group">
					{{ Form::label('main_referee','Arbitro principal',['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-6">
						{{ Form::text('main_referee', null, ['class' => 'form-control','id' => 'main_referee']) }}
					</div>
				</div>							

				<div class="form-group">
					{{ Form::label('line_referee','Arbitro de linea',['class'=>'col-sm-2 control-label']) }}
					<div class="col-sm-6">
						{{ Form::text('line_referee', null, ['class' => 'form-control','id' => 'line_referee']) }}
					</div>
				</div>

			{{ Form::close() }}
		</div>
	</div>
	<!-- /BOX -->					
</div>
