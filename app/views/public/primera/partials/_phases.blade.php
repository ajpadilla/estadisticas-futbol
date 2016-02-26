@if(!empty($competitions))
<div style="float: left;width:480px">
	<div style="width:480px;margin-left:15px">
		@foreach($competitions as $competition)
			@if($competition->hasPhases)
				<a id="firstPhase" data-phase-id="{{ $competition->phases->first()->id }}" href=""></a>
				@foreach ($competition->phasesWithGames as $phase) 
					<a id="irfecha" href="{{ route('getGamesForPhase') }}" class="phasesWithGames" data-phase-id="{{ $phase->id }}">{{ $phase->name }}</a>
					<a id="scoredGoalsUrl" href="{{ route('getScorersGoalsFormCompetition') }}"></a>
				@endforeach
			@endif
		@endforeach
	</div>
	<br>
	<div id="fixtureactual">
		<div id="phaseForCompetition" style="background: #092b1d; height:50px">
			<div id="flechaatrno"></div>
			<div style="float: left; width:380px; font-size: 14px; color: #c2e213; text-align: center;">
				<br>
				<br>
			</div>
		</div>
		<br>
		<table id="tableGamesForPhase" style="width:480px">
			
		</table>
		<br style="clear: both;">
		<div id="statsPhase" style="text-align: center; color: white; font-weight: normal; font-size:11px; background: #092b1d">
	        <strong>Estadisticas Fecha</strong>:<br> <strong>0</strong> goles en <strong>0</strong> partidos (0 de media)<br>Goles locales: <strong>0</strong> - Goles visitantes: <strong>0</strong> <br>Vict. locales: <strong>0</strong>  - Vict. visitantes: <strong>0</strong> - Empates: <strong>0</strong><br>
        </div>
	</div>
</div>
@endif