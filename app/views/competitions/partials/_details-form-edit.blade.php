<h4>Otros datos</h4>
<div class="form-group">
	<div class="col-sm-6">
		<div class="checkbox">
			<label> 
				{{ Form::checkbox('international', '1', $competition->international,['id' => 'competition-international-edit'])}}
				<i></i> Internacional	
			</label>
		</div>
	</div>
</div>
<div class="form-group">
	{{ Form::label('tipo_competencia_id','Tipo De Competencía',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
	{{ Form::select('tipo_competencia_id',$competitionsType,$competition->tipo_competencia_id,['class' => 'form-control chosen-select','data-placeholder' => 'Escoge Tipo...','id'=> 'competitions-type-edit']) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('country_id','País',['class'=>'col-sm-2 control-label']) }}
	<div class="col-sm-6">
	{{ Form::select('country_id',$countries,$competition->country_id,['class' => 'form-control chosen-select','data-placeholder' => 'Escoge País...','id'=>'country-competition-edit']) }}
	</div>
</div>