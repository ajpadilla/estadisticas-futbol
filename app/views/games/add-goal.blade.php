<div class="col-md-12">
	<!-- BOX -->
	<div  id="add-goals-to-game-form-div-box" class="box border primary col-md-12">
		<div class="box-title">
			<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">Agregar Goles</span></h4>
		</div>
		<div class="box-body">
			{{ Form::open(['route' => ['games.api.add.goal'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'add-goals-to-game-form']) }}

			<div class="form-group">
				{{ Form::label('observations','Observación',['class'=>'col-sm-2 control-label']) }}
				<div class="col-sm-6">
					{{ Form::text('observations',null, ['class' => 'form-control','placeholder'=>'','id' =>'observations-game']) }}
				</div>
			</div>

			<div class="form-group">
			{{ Form::label('minute','Minuto',['class'=>'col-sm-2 control-label']) }}
				<div class="col-sm-6">
				{{ Form::text('minute',null, ['class' => 'form-control','id' => 'minute-game']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('second','Segundo',['class'=>'col-sm-2 control-label']) }}
				<div class="col-sm-6">
					{{ Form::text('second',null, ['class' => 'form-control','id' => 'second-game']) }}
				</div>
			</div>
		
			<div class="form-group">
				{{ Form::label('type_id','Tipo de gol',['class'=>'col-md-2 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('type_id',[],null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoger Tipo...','id'=>'goal-types-for-games-id']) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('team_id','Equipo',['class'=>'col-md-2 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('team_id',[],null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoger Equipo...','id'=>'teams-for-games-id']) }}
				</div>
			</div>	

			<div class="form-group">
				{{ Form::label('player_id','Jugador',['class'=>'col-md-2 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('player_id',[],null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoger Jugadores...','id'=>'player-for-game-id']) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('assistance_id','Asistencia',['class'=>'col-md-2 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('assistance_id',[],null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoger Jugadores...','id'=>'assistance-for-game-id']) }}
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
	<!-- /BOX -->					
</div>
