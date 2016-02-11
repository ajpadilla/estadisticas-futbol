<h4>Información Básica</h4>
<div class="form-group">
	{{ Form::label('nombre', 'Nombre', ['class' => 'col-md-2 control-label']) }}	
	<div class="col-md-6">{{ Form::text('nombre', null, ['class' => 'form-control', 'id'=>'name-competition-edit']) }}</div>
</div>
<div class="form-group">
	{{ Form::label('type','Tipo',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
		{{ Form::select('type',
			[   
				'primera' => 'primera',
				'b nacional' => 'b nacional',
				'b metro' => 'b metro',
				'federal a' => 'federal a',
				'primera c' => 'primera c',
				'primera d' => 'primera d',
				'federal b' => 'federal b',
				'copa mundial' => 'copa mundial',
				'eliminatorias copa mundial' => 'eliminatorias copa mundial',
				'copa america' => 'copa america',
				'copa libertadores' => 'copa libertadores',
				'champion L' => 'champion L',
				'copa argentina' => 'copa argentina',
				'sudamericana' => 'sudamericana',
				'mundial de clubes' => 'mundial de clubes'
			]
			,$competition->type,['class' => 'form-control chosen-select','data-placeholder' => 'Escoge Tipo...','id'=> 'type_competition']) }}
		</div>
	</div>
<div class="form-group">
	{{ Form::label('desde', 'Desde', ['class' => 'col-md-2 control-label']) }}	
	<div class="col-md-6">{{ Form::text('desde', $competition->From, ['class' => 'form-control datepicker', 'id'=>'from-competition-edit']) }}</div>
</div>
<div class="form-group">
	{{ Form::label('hasta', 'Hasta', ['class' => 'col-md-2 control-label']) }}	
	<div class="col-md-6">{{ Form::text('hasta', $competition->To, ['class' => 'form-control datepicker', 'id'=>'to-competition-edit']) }}</div>
</div>
<div class="form-group">
	{{ Form::file('imagen', ['class' => 'file-upload']) }}
</div> 