@if(!empty($sudamericanaCups))
@foreach($sudamericanaCups as $sudamericanaCup)
<div style="width: 980px;margin:auto">
	<!--<div id="infoequipo">LLAVES</div>-->
	<div id="fixture">
		<div style="width: 980px;margin:auto">
			@if($sudamericanaCup->hasPhases)
			@foreach ($sudamericanaCup->phasesByOrder as $phase)
			@if($phase->type != 'repechaje')
			<?php $gamesForPhase = $gamesForPhases[$phase->id]; ?>
			<span class="verdegrande">{{ $phase->name }}</span>
			<br>
			<div style="width:420px;float: left">
				<?php $countGames = 0; ?>
				@foreach($phase->groups as $group)
				@if(!empty($gamesForPhase))
				@foreach($gamesForPhase as $groups)
				@foreach($groups as $games)
				@foreach($games as $game)
				@if($game['group_id'] == $group->id)
				@if(($countGames+1)<= $phase->mediaGamesPlayed)
				<table id="fixturein2">
					<tbody>
						<tr style="background:#092B1D;text-align: center">
							<td colspan="6">
								<span class="horariopartido"> {{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}</span>
							</td>
						</tr> 
						<tr style="background: #e5e5e5">
							<td class="finaliza" id="ti_35_137">Final</td>
							<td style="width: 35%;">
								<img src="{{$game['imgLocalTeam'] }}" width="18px">
								<span class="datoequipo"> {{ $game['localTeam']->nombre }}</span>
							</td>
							<td class="resu" id="r1_35_137">{{$game['localGoals'] }}</td>
							<td class="resu" id="r2_35_137">{{ $game['awayGoals'] }} </td>
							<td style="width: 35%;">
								<img src="{{$game['imgAwayTeam'] }}" width="18px"><span class="datoequipo">{{ $game['awayTeam']->nombre }}</span>
							</td>
						</tr>
						<tr style="background: white; font-size:10px;" id="gole_1_329">
							@if ($game['fixturesLocalGoals'])
							<td colspan="3" id="g1_1_329">{{ $game['fixturesLocalGoals'] }}</td>
							@else
							<td colspan="3" id="g1_1_329"></td>
							@endif
							@if ($game['fixturesAwayGoals'])
							<td colspan="3" id="g2_1_329">{{ $game['fixturesAwayGoals'] }}</td>
							@else
							<td colspan="3" id="g1_1_329"></td>
							@endif
						</tr>
					</tbody>
				</table>
				<table>
					<tbody>
						<tr style="background: none"><td colspan="5"><br></td></tr>
					</tbody>
				</table>
				@endif
				<?php $countGames++ ?>
				@endif
				@endforeach
				@endforeach
				@endforeach
				@endif
				@endforeach
			</div>

			<div style="width:420px;float: right;">
				<?php $countGames = 0; ?>
				@foreach($phase->groups as $group)
				@if(!empty($gamesForPhase))
				@foreach($gamesForPhase as $groups)
				@foreach($groups as $games)
				@foreach($games as $game)
				@if($game['group_id'] == $group->id)
				@if(($countGames+1) > $phase->mediaGamesPlayed)
				<table id="fixturein2">
					<tbody>
						<tbody>
							<tr style="background:#092B1D;text-align: center">
								<td colspan="6">
									<span class="horariopartido"> {{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}</span>
								</td>
							</tr> 
							<tr style="background: #e5e5e5">
								<td class="finaliza" id="ti_35_137">Final</td>
								<td style="width: 35%;">
									<img src="{{$game['imgLocalTeam'] }}" width="18px">
									<span class="datoequipo"> {{ $game['localTeam']->nombre }}</span>
								</td>
								<td class="resu" id="r1_35_137">{{$game['localGoals'] }}</td>
								<td class="resu" id="r2_35_137">{{ $game['awayGoals'] }} </td>
								<td style="width: 35%;">
									<img src="{{$game['imgAwayTeam'] }}" width="18px"><span class="datoequipo">{{ $game['awayTeam']->nombre }}</span>
								</td>
							</tr>
							<tr style="background: white; font-size:10px;" id="gole_35_137">
								@if ($game['fixturesLocalGoals'])
								<td colspan="3" id="g1_1_329">{{ $game['fixturesLocalGoals'] }}</td>
								@else
								<td colspan="3" id="g1_1_329"></td>
								@endif
								@if ($game['fixturesAwayGoals'])
								<td colspan="3" id="g2_1_329">{{ $game['fixturesAwayGoals'] }}</td>
								@else
								<td colspan="3" id="g1_1_329"></td>
								@endif
							</tr>
						</tbody>
				</table>
				<table>
					<tbody>
						<tr style="background: none"><td colspan="5"><br></td></tr>
					</tbody>
				</table>
				@endif
				<?php $countGames++ ?>
				@endif
				@endforeach
				@endforeach
				@endforeach
				@endif
				@endforeach
			</div>

			<div style="clear: both;"></div>
			<br>
			<br>
			@endif
			@endforeach
			@endif
		</div>
	</div>
</div>
@endforeach
@endif