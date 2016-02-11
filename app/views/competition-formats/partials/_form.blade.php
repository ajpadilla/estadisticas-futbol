<div id="add-competition-format-form-div" class="box border primary">
	<div class="box-title">
		<h4><i class="fa fa-plus-square"></i>Crear Formatos De Competencia</h4>
	</div>
	<div class="box-body" style="display: block;">
		<div class="row">
			<div class="col-md-12">

				<div class="divide-20"></div>
				<div class="box-body big">
					{{ Form::open(['route' => 'competitionFormats.store','class'=>'form-horizontal','role'=>'form',
					'method' => 'POST','files' => true,'id'=> 'new-competition-format-form']) }}
						<div class="row">
							<div class="form-group">
								{{ Form::label('name','Nombre',['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-6">
									{{ Form::text('name',null, ['class' => 'form-control','id' => 'name-competition-format']) }}
								</div>
							</div>
							
							<div class="form-group">
								{{ Form::label('groups','Grupos',['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-6">
									{{ Form::text('groups', 1, ['class' => 'form-control','placeholder' => 'Cantidad de grupos','id' => 'groups-competition-format']) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('clasificated_by_group','Clasificados Por Grupo',['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-6">
									{{ Form::text('clasificated_by_group',0, ['class' => 'form-control','placeholder' => 0,'id' => 'clasificated_by_group-competition-format']) }}
								</div>
							</div>
							<div class="form-group">
								{{--{{ Form::label('ida_vuelta', 'Ida Vuelta',['class'=>'col-sm-2 control-label']) }}--}}
								<div class="col-sm-6">
									<div class="checkbox">
										<label> 
											{{ Form::checkbox('local_away_game', '1', 0)}}
											<i></i> Partido de ida local	
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								{{--{{ Form::label('pre_clasificacion', 'Pre Clasificacion',['class'=>'col-sm-2 control-label']) }}--}}
								<div class="col-sm-6">
									<div class="checkbox">
										<label> 
											{{ Form::checkbox('local_away_game_final', '1', 0)}}
											<i></i> Último partido fuera de casa local
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								{{--{{ Form::label('pre_clasificacion', 'Pre Clasificacion',['class'=>'col-sm-2 control-label']) }}--}}
								<div class="col-sm-6">
									<div class="checkbox">
										<label> 
											{{ Form::checkbox('away_goal', '1', 0)}}
											<i></i> Gol fuera de casa
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								{{--{{ Form::label('pre_clasificacion', 'Pre Clasificacion',['class'=>'col-sm-2 control-label']) }}--}}
								<div class="col-sm-6">
									<div class="checkbox">
										<label> 
											{{ Form::checkbox('all_teams', '1', null)}}
											<i></i> Todos los equipos
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('teams_by_group','Equipos Por Grupo',['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-6">
									{{ Form::text('teams_by_group',0, ['class' => 'form-control','placeholder' => 0,'id' => 'teams_by_group-competition-format']) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('promotion','Promoción',['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-6">
									{{ Form::text('promotion',0, ['class' => 'form-control','placeholder' => 0,'id' => 'promotion-competition-format']) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('descent','Descenso',['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-6">
									{{ Form::text('descent',0, ['class' => 'form-control','placeholder' => 0,'id' => 'descent-competition-format']) }}
								</div>
							</div>
							
						</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>
