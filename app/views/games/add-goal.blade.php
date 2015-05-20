<div class="col-md-12">
	<!-- BOX -->
	<div  id="add-goals-to-game-form-div-box" class="box border primary col-md-12">
		<div class="box-title">
			<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">Agregar Goles</span></h4>
		</div>
		<div class="box-body">
			{{ Form::open(['route' => ['groups.api.add.team'], 'class' => 'form-horizontal', 'role' => 'form', 'id' => 'add-goals-to-game-form']) }}

			<div class="form-group">
				{{ Form::label('observations','Observación',['class'=>'col-sm-2 control-label']) }}
				<div class="col-sm-6">
					{{ Form::text('observations',null, ['class' => 'form-control datepicker','placeholder'=>'','id' =>'observations-game']) }}
				</div>
			</div>

			<div class="form-group">
			{{ Form::label('minuto','Minuto',['class'=>'col-sm-2 control-label']) }}
				<div class="col-sm-6">
				{{ Form::text('minuto',null, ['class' => 'form-control','id' => 'minute-game']) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('segundo','Segundo',['class'=>'col-sm-2 control-label']) }}
				<div class="col-sm-6">
					{{ Form::text('segundo',null, ['class' => 'form-control','id' => 'second-game']) }}
				</div>
			</div>
		
			<div class="form-group">
				{{ Form::label('type_id','Tipo de gol',['class'=>'col-md-2 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('type_id',[],null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoger Tipo...','id'=>'type-goal-for-games-id']) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('teams_id','Equipo',['class'=>'col-md-2 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('teams_id',[],null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoger Equipo...','id'=>'teams-for-games-id']) }}
				</div>
			</div>	

			<div class="form-group">
				{{ Form::label('player_id','Jugadores',['class'=>'col-md-2 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('player_id',[],null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoger Jugadores...','id'=>'player-for-game-id']) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('player_id','Asistencia',['class'=>'col-md-2 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('player_id',[],null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoger Jugadores...','id'=>'player-for-game-id']) }}
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
	<!-- /BOX -->					
</div>
