@if($gamesForLiguillas)
	<?php $countGames = 0; ?>
	@foreach($gamesForLiguillas as $liguilla)
		@if ($liguilla['final'])
			<div id="infoequipo">{{ $liguilla['liguilla']->nombre }} FINAL</div>
			@foreach ($liguilla['final']['games'] as $groups)
				@foreach ($groups as $games)
					@foreach ($games as $game)
					@if(($countGames + 1) <= $liguilla['final']['media'])
						<table style="width:480px;float: left; margin-right: 10px" id="fixturein">
							<tbody>
								<tr style="background:#092B1D;text-align: center">
								<td colspan="6"><span class="horariopartido"> {{ $game['dateObject']->toFormattedDateString() }}  {{ $game['time'] }}</span></td>
								</tr>
								<tr style="background: #e5e5e5">
									<!--<td class="finaliza" id="ti_1_329">Final</td>-->
									<td style="width: 32%;"><img src="{{ $game['localTeam']->escudo->url('tumb') }}" width="18px"><span class="datoequipo">
			                                        <span class="datoequipo"> {{ $game['localTeam']->nombre }}</span></td>
									<td class="resu" id="r1_1_329">{{$game['localGoals'] }}</td>
									<td class="resu" id="r2_1_329">{{ $game['awayGoals'] }}</td>
									<td style="width: 32%;">
										<img src="{{ $game['awayTeam']->escudo->url('tumb') }}" width="18px"><span class="datoequipo">{{ $game['awayTeam']->nombre }}</span>
									</td>
									<!--<td style="width: 5%;">
										<div id="vivo" onclick="mirar2('329','24sueltos');">Video<br><img src="images/tv.png"></div>
									</td>-->
								</tr>
								<!--<tr id="video" class="329" style="display: none"></tr>-->
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
					@else
						<table style="width:480px;float: left; margin-right: 10px" id="fixturein">
							<tbody>
								<tr style="background:#092B1D;text-align: center">
								<td colspan="6"><span class="horariopartido"> {{ $game['dateObject']->toFormattedDateString() }}  {{ $game['time'] }}</span></td>
								</tr>
								<tr style="background: #e5e5e5">
									<!--<td class="finaliza" id="ti_1_329">Final</td>-->
									<td style="width: 32%;"><img src="{{ $game['localTeam']->escudo->url('tumb') }}" width="18px"><span class="datoequipo">
			                                        <span class="datoequipo"> {{ $game['localTeam']->nombre }}</span></td>
									<td class="resu" id="r1_1_329">{{$game['localGoals'] }}</td>
									<td class="resu" id="r2_1_329">{{ $game['awayGoals'] }}</td>
									<td style="width: 32%;">
										<img src="{{ $game['awayTeam']->escudo->url('tumb') }}" width="18px"><span class="datoequipo">{{ $game['awayTeam']->nombre }}</span>
									</td>
									<!--<td style="width: 5%;">
										<div id="vivo" onclick="mirar2('329','24sueltos');">Video<br><img src="images/tv.png"></div>
									</td>-->
								</tr>
								<!--<tr id="video" class="329" style="display: none"></tr>-->
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
					@endif

					<?php $countGames++; ?>
					@endforeach
				@endforeach
			@endforeach
			<table style="width:490px;float: right;" id="fixturein"></table>
			<div style="clear: both;"></div>
			<br>
		@endif
		@if ($liguilla['semifinal'])
			<div id="infoequipo">{{ $liguilla['liguilla']->nombre }} SEMIFINAL</div>
			@foreach ($liguilla['semifinal']['games'] as $groups)
				@foreach ($groups as $games)
					@foreach ($games as $game)
					@if(($countGames + 1) <= $liguilla['semifinal']['media'])
						<table style="width:480px;float: left; margin-right: 10px" id="fixturein">
							<tbody>
								<tr style="background:#092B1D;text-align: center">
								<td colspan="6"><span class="horariopartido"> {{ $game['dateObject']->toFormattedDateString() }}  {{ $game['time'] }}</span></td>
								</tr>
								<tr style="background: #e5e5e5">
									<!--<td class="finaliza" id="ti_1_329">Final</td>-->
									<td style="width: 32%;"><img src="{{ $game['localTeam']->escudo->url('tumb') }}" width="18px"><span class="datoequipo">
			                                        <span class="datoequipo"> {{ $game['localTeam']->nombre }}</span></td>
									<td class="resu" id="r1_1_329">{{$game['localGoals'] }}</td>
									<td class="resu" id="r2_1_329">{{ $game['awayGoals'] }}</td>
									<td style="width: 32%;">
										<img src="{{ $game['awayTeam']->escudo->url('tumb') }}" width="18px"><span class="datoequipo">{{ $game['awayTeam']->nombre }}</span>
									</td>
									<!--<td style="width: 5%;">
										<div id="vivo" onclick="mirar2('329','24sueltos');">Video<br><img src="images/tv.png"></div>
									</td>-->
								</tr>
								<!--<tr id="video" class="329" style="display: none"></tr>-->
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
					@else
						<table style="width:480px;float: left; margin-right: 10px" id="fixturein">
							<tbody>
								<tr style="background:#092B1D;text-align: center">
								<td colspan="6"><span class="horariopartido"> {{ $game['dateObject']->toFormattedDateString() }}  {{ $game['time'] }}</span></td>
								</tr>
								<tr style="background: #e5e5e5">
									<!--<td class="finaliza" id="ti_1_329">Final</td>-->
									<td style="width: 32%;"><img src="{{ $game['localTeam']->escudo->url('tumb') }}" width="18px"><span class="datoequipo">
			                                        <span class="datoequipo"> {{ $game['localTeam']->nombre }}</span></td>
									<td class="resu" id="r1_1_329">{{$game['localGoals'] }}</td>
									<td class="resu" id="r2_1_329">{{ $game['awayGoals'] }}</td>
									<td style="width: 32%;">
										<img src="{{ $game['awayTeam']->escudo->url('tumb') }}" width="18px"><span class="datoequipo">{{ $game['awayTeam']->nombre }}</span>
									</td>
									<!--<td style="width: 5%;">
										<div id="vivo" onclick="mirar2('329','24sueltos');">Video<br><img src="images/tv.png"></div>
									</td>-->
								</tr>
								<!--<tr id="video" class="329" style="display: none"></tr>-->
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
					@endif
					<?php $countGames++; ?>
					@endforeach
				@endforeach
			@endforeach
			<table style="width:490px;float: right;" id="fixturein"></table>
			<div style="clear: both;"></div>
			<br>
		@endif
	@endforeach
@endif