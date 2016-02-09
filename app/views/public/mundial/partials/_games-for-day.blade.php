@if(!empty($cups))
<div style="float: left;width:480px">
	<div style="width:480px;margin-left:15px">
		@foreach($cups as $cup)
			@if(count($cup->phasesWithGames) > 0)
			<a id="firstPhase" data-phase-id="{{ $cup->phases->first()->id }}" href=""></a>
			@foreach ($cup->phasesWithGames as $phase) 
				<a id="irfecha" href="{{ route('getGamesForPhase') }}" class="phasesWithGames" data-phase-id="{{ $phase->id }}" data-competition-id = "{{ $cup->id }}">{{ $phase->name }}</a>
				<a id="scoredGoalsUrl" href="{{ route('getScorersGoalsFormCompetition') }}"></a>
			@endforeach
			@endif
		@endforeach
	</div>
	<br>
	<div id="fixtureactual">
	<div style="width:100%; margin: auto; font-size: 1.2em; color: #c2e213; text-align: center;"><br>Partidos por fases<br><span style="color:white;font-size:9px">Click en las fase para ver los partidos de cada día</span></div>
		<div id="phaseForCompetition" style="background: #092b1d; height:50px">
			<div id="flechaatrno"></div>
			<div style="float: left; width:380px; font-size: 14px; color: #c2e213; text-align: center;">
				<br>
				<br>
				<!--<span class="datosequipo2b" style="font-weight: normal">
					(use las flechas para mirar otras fechas)
				</span>-->
			</div>
			<!--<div id="flechaad" class="2_1"></div>-->
		</div>
		<br>
		<table id="tableGamesForPhase" style="width:480px">
	
		</table>
		<br style="clear: both;">
	</div>
</div>
@endif