@if(!empty($cups))
<span class="verdegrande">
	<!--<div style="float: left;width:225px;color: white;font-size:12px">
		Anterior<br>
		<a href="transicion2014.php" style="font-size: 14px;">Torneo Transición 2014</a>
	</div>-->
	@foreach($cups as $cup)
		{{ $cups->links() }}
	@endforeach
	<div style="clear: both;"></div>

</span>
<span class="verdegrande">
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
		<a id="currentCompetitionId" href="" class="phasesWithGames" data-competition-id = "{{ $cup->id }}"></a>
		@endforeach
	</div>
	<div style="clear: both;"></div>
</span>
@endif