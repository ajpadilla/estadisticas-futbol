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
			{{ Form::select('autocomplete',['algo' => 'algo'],null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoger...','id'=>'autocomplete-select']) }}
			</div>
		</div>
	</div>
</div>
@stop