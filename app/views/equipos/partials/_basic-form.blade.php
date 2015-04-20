<h4>Información Básica</h4>
@if (!empty($equipo))
<div class="form-group" style="display:none">
	{{ Form::label('equipo_id', 'Id', ['class' => 'col-md-4 control-label']) }}	
	<div class="col-md-8">{{ Form::text('equipo_id', $equipo->id, ['class' => 'form-control','id' => 'equipo_id']) }}
	</div>
</div>
@else 
<div class="form-group" style="display:none">
	{{ Form::label('equipo_id', 'Id', ['class' => 'col-md-4 control-label']) }}	
	<div class="col-md-8">{{ Form::text('equipo_id',null, ['class' => 'form-control','id' => 'equipo_id']) }}
	</div>
</div>
@endif
<div class="form-group">
	{{ Form::label('nombre', 'Nombre', ['class' => 'col-md-4 control-label']) }}	
	<div class="col-md-8">{{ Form::text('nombre', null, ['class' => 'form-control','id' =>'nombre_equipo' ]) }}</div>
</div>
<div class="form-group">
	{{ Form::label('apodo', 'Apodo', ['class' => 'col-md-4 control-label']) }}	
	<div class="col-md-8">{{ Form::text('apodo', null, ['class' => 'form-control','id' => 'apodo']) }}</div>
</div>
<div class="form-group">
	{{ Form::label('fecha_fundacion', 'Fecha de Fundación', ['class' => 'col-md-4 control-label']) }}	
	<div class="col-md-8">{{ Form::text('fecha_fundacion', null, ['class' => 'form-control','id' => 'fecha_fundacion']) }}</div>
</div>
<div class="form-group">
	{{ Form::label('tipo','Tipo',['class'=>'col-md-4 control-label']) }}
	<div class="col-md-8">
		{{ Form::select('tipo', ['Selección', 'Club'], null, ['class' => 'form-control chosen-select','data-placeholder' => 'Selecciona el tipo','id'=> 'tipo_equipo']) }}
	</div>
</div>

<h4>Imágenes</h4>
<div class="form-group">
	{{ Form::label('bandera','Bandera',['class'=>'col-md-4 control-label']) }}
	<div class="col-md-8">{{ Form::file('bandera', ['class' => 'file-upload']) }}</div>
</div>
<div class="form-group">
	{{ Form::label('escudo','Escudo',['class'=>'col-md-4 control-label']) }}
	<div class="col-md-8">{{ Form::file('escudo', ['class' => 'file-upload']) }}</div>
</div>
<div class="form-group">
	{{ Form::label('foto','Foto',['class'=>'col-md-4 control-label']) }}
	<div class="col-md-8">{{ Form::file('foto', ['class' => 'file-upload']) }}</div>
</div>