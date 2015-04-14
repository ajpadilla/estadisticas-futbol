<h4>Información Básica</h4>
<div class="form-group">
	{{ Form::label('nombre', 'Nombre', ['class' => 'col-md-4 control-label']) }}	
	<div class="col-md-8">{{ Form::text('nombre', null, ['class' => 'form-control']) }}</div>
</div>
<div class="form-group">
	{{ Form::label('apodo', 'Apodo', ['class' => 'col-md-4 control-label']) }}	
	<div class="col-md-8">{{ Form::text('apodo', null, ['class' => 'form-control']) }}</div>
</div>
<div class="form-group">
	{{ Form::label('fecha_fundacion', 'Fecha de Fundación', ['class' => 'col-md-4 control-label']) }}	
	<div class="col-md-8">{{ Form::text('fecha_fundacion', null, ['class' => 'form-control']) }}</div>
</div>
<div class="form-group">
	{{ Form::label('tipo','Tipo',['class'=>'col-md-4 control-label']) }}
	<div class="col-md-8">
		{{ Form::select('tipo', ['Selección', 'Club'], null, ['class' => 'form-control chosen-select','data-placeholder' => 'Selecciona el tipo']) }}
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