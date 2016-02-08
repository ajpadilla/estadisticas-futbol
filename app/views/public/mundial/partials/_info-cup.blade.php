<span class="verdegrande">

	<div style="padding-top: 10px;">
		{{ $cups->links() }}
	</div>
		@foreach($cups as $cup)
		<div>
			<div style="width: 280px;float: left">
			<img src="{{ $cup->imagen->url('medium') }}">
		</div>

		<div style="width: 300px;float: left;font-size:12px">
			<br>
			Partido Inaugural: {{ $cup->formatFrom }}<br>
			Partido Final:  {{ $cup->formatTo }}<br>
			Equipos participantes: 32 selecciones<br>
		</div>
		@endforeach
	</div>
	<div style="clear: both;"></div>
</span>