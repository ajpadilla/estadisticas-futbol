
@if (!empty($posicion))
<div class="form-group" style="display: none;">
	{{ Form::label('position_id','Id',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
		{{ Form::text('position_id',$posicion->id, ['class' => 'form-control','id' => 'position_id']) }}
	</div>
</div>
@else 
<div class="form-group" style="display: none;">
	{{ Form::label('position_id','Id',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
		{{ Form::text('position_id',null, ['class' => 'form-control','id' => 'position_id']) }}
	</div>
</div>
@endif


<div class="form-group">
	{{ Form::label('nombre','Nombre',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
		{{ Form::text('nombre',null, ['class' => 'form-control','id' => 'nombre_posicion']) }}
	</div>
</div>

<div class="form-group">
	{{ Form::label('abreviacion','Abreviación',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
		{{ Form::text('abreviacion',null, ['class' => 'form-control','id' => 'abreviacion_posicion']) }}
	</div>
</div>

