<h4>Información Básica</h4>
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
		{{ Form::text('nombre',null, ['class' => 'form-control','id' => 'nombre_jugador_edit']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('fecha_nacimiento','Fecha de nacimiento',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
		{{ Form::text('fecha_nacimiento',null, ['class' => 'form-control datepicker','placeholder'=>'','id' =>'fecha_nacimiento_edit']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('lugar_nacimiento', 'Lugar de nacimiento', ['class' => 'col-md-2 control-label']) }}	
	<div class="col-md-8">{{ Form::textarea('lugar_nacimiento', null, ['class' => 'form-control', 'rows' => 8, 'cols' => 32,'id'=>'lugar_nacimiento_jugador_edit']) }}</div>
</div>

<div class="form-group">
	{{ Form::label('altura','Altura',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
		{{ Form::text('altura',null, ['class' => 'form-control','id' => 'altura_edit']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('peso','Peso',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
		{{ Form::text('peso',null, ['class' => 'form-control','id' => 'peso_jugador_edit']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('apodo','Apodo',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
		{{ Form::text('apodo',null, ['class' => 'form-control','id' => 'apodo_jugador_edit']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('posiciones_id[]','Posiciones',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
		{{ Form::select('posiciones_id[]',array(),null,['class' => 'form-control chosen-select posiciones-jugador','data-placeholder' => 'Escoge Posición...','id'=> 'posiciones_id_jugador_edit','multiple'=> true]) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('posicion_id','Posición Actual',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
		{{ Form::select('posicion_id',array(),null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoge Posición...','id'=> 'posicion_id_jugador_edit']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('pais_id','País',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
		{{ Form::select('pais_id',array(),null,['class' => 'form-control chosen-select pais-jugador','data-placeholder' => 'Escoge País...','id'=>'pais_id_jugador_edit']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::file('foto', ['class' => 'file-upload']) }}
</div> 
