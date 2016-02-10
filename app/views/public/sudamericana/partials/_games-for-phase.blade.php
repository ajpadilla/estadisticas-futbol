@if(!empty($sudamericanaCups))
	@foreach($sudamericanaCups as $sudamericanaCup)
		@if($sudamericanaCup->hasPhases)
			@foreach ($sudamericanaCup->phasesByOrder as $phase)
				@if($phase->type != 'fase de grupos')
				<?php $gamesToPhase  = $competitionRepository->getGamesForPhase($phase->id); ?>
				<span class="verdegrande">{{$phase->name }}</span>
				<br>
				@foreach($gamesToPhase as $index => $groups)
                	@foreach($groups as $index2 => $games)
                        @foreach($games as $index2 => $game)
							<table style="width:420px;" id="fixturein">
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
									<tr style="background: white; font-size:10px;display: none" id="gole_35_137">
										<td colspan="3" id="g1_35_137"></td><td colspan="3" id="g2_35_137"></td>
									</tr>
								</tbody>
							</table>
							<div style="clear: both;"></div>
						@endforeach
					@endforeach
				@endforeach
				@endif
			@endforeach
		@endif
	@endforeach
@endif