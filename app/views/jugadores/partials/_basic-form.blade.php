
@if (!empty($jugador))
<div class="form-group" style="display: none;">
	{{ Form::label('jugador_id','Id',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
		{{ Form::text('jugador_id',$jugador->id, ['class' => 'form-control','id' => 'jugador_id']) }}
	</div>
</div>
@else 
<div class="form-group" style="display: none;">
	{{ Form::label('jugador_id','Id',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
		{{ Form::text('jugador_id',null, ['class' => 'form-control','id' => 'jugador_id']) }}
	</div>
</div>
@endif


<div class="form-group">
	{{ Form::label('nombre','Nombre',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
		{{ Form::text('nombre',null, ['class' => 'form-control','id' => 'nombre']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('fecha_nacimiento','Fecha de nacimiento',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
		{{ Form::text('fecha_nacimiento',null, ['class' => 'form-control','placeholder'=>'dd-mm-yy','id' =>'fecha_nacimiento']) }}
	</div>
</div>


<div class="form-group">
	{{ Form::label('altura','Altura',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
		{{ Form::text('altura',null, ['class' => 'form-control','id' => 'altura']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('peso','Peso',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
		{{ Form::text('peso',null, ['class' => 'form-control','id' => 'peso_jugador']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('apodo','Apodo',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
		{{ Form::text('apodo',null, ['class' => 'form-control','id' => 'apodo_jugador']) }}
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

						{{-- <div class="form-group">
							{{ Form::label('numero','Numero',['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('numero',null, ['class' => 'form-control','placeholder'=>'','id' =>'numero']) }}
							</div>
						</div> --}}

						 {{--<div class="form-group">
							{{ Form::label('fecha_inicio','Fecha de inicio',['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('fecha_inicio',null, ['class' => 'form-control','placeholder'=>'dd-mm-yy','id' =>'fecha_inicio']) }}
							</div>
						</div> --}}
						
						{{--<div class="form-group">
							{{ Form::label('fecha_fin','Fecha de fin',['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('fecha_fin',null, ['class' => 'form-control','placeholder'=>'dd-mm-yy','id' =>'fecha_fin']) }}
							</div>
						</div>--}}
						
						{{--<div class="form-group">
							{{ Form::label('equipo_id','Equipo',['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::select('equipo_id',array(),null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoge Equipo...','id'=> 'equipo_id_jugador']) }}
							</div>
						</div>--}}

						<div class="form-group">
							{{ Form::file('foto', ['class' => 'file-upload']) }}
						</div> 
