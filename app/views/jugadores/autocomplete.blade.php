@extends("layouts.main")

@section('title-modal')
Datos Jugador
@stop

@section("content")
<div id="new-player-form-view">
	<div class="col-md-8">
		<div class="input-group">
			<span class="input-group-addon">http://</span>
			{{ Form::text('completar', null, ['class' => 'form-control', 'placeholder'=>'','id'=>'select-autocomplete']) }}
		</div>
	</div>
</div>
@stop