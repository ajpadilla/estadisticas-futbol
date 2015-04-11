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
					{{ Form::open(['route' => 'jugadores.store','class'=>'form-horizontal','role'=>'form',
					'method' => 'POST','files' => true,'id'=> 'player-form']) }}
						
						<div class="form-group" style="display: none;">
							{{ Form::label('jugador_id','Id',['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('jugador_id',null, ['class' => 'form-control','id' => 'jugador_id']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('nombre','Nombre',['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('nombre',null, ['class' => 'form-control','id' => 'nombre']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('fecha_nacimiento','Fecha de nacimiento',['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('fecha_nacimiento',null, ['class' => 'form-control','id' => 'fecha_nacimiento']) }}
							</div>
						</div>
						
						
						<div class="form-group">
							{{ Form::label('altura','Altura',['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('altura',null, ['class' => 'form-control','id' => 'altura']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('abreviacion','Abreviacion',['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('abreviacion',null, ['class' => 'form-control','id' => 'abreviacion']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('posicion_id','Posición',['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('posicion_id',array(),null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoge Posición...','id'=> 'posicion_id']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('pais_id','País',['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('pais_id',array(),null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoge País...','id'=>'pais_id']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::file('foto', ['class' => 'file-upload']) }}
						</div>

					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>

