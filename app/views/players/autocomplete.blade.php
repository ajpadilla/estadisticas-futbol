@extends("layouts.main")

@section('title-modal')
Datos Jugador
@stop

@section("content")
<div id="new-player-form-view">
	<div class="col-md-8">
		<div class="input-group">
			<!--<span class="input-group-addon">http://</span>-->
			{{ Form::text('completar', null, ['class' => 'form-control', 'placeholder'=>'','id'=>'select-autocomplete']) }}
		</div>
		<div class="form-group">
			{{ Form::label('autocomplete','País',['class'=>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
			{{ Form::select('autocomplete',[],null,['class' => 'select2-container col-md-12 full-width-fix form-control','id'=>'autocomplete-select-1']) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('autocomplete','País',['class'=>'col-sm-2 control-label']) }}
			<div class="col-sm-6">
			{{ Form::select('autocomplete',[],null,['class' => 'select2-container col-md-12 full-width-fix form-control','id'=>'autocomplete-select-2']) }}
			</div>
		</div>

	</div>
</div>
@stop