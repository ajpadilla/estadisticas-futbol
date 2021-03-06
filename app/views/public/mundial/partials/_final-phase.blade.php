@if(!empty($cups))
	@if($currentCup->hasGames)
		<!--<div id="infoequipo">FASE FINAL</div>-->
		<div id="fixture">
			<?php $countPhases = 0; ?>
			@foreach ($currentCup->phases as $IndexPhase => $phase)
			<?php $countGames = 0; ?>
			@if($countPhases > 0)
				@if($phase->type!='tercer lugar')
				<div id="columna">
					<span class="grupom">{{ $phase->name }}</span><br>
					<?php $gamesForPhase = $gamesForPhases[$phase->id]; ?>
					<?php $mediaGamesPlayed = $phase->mediaGamesPlayed; ?>
					@if(!empty($gamesForPhase))
					@foreach($gamesForPhase as $groups)
					@foreach($groups as $games)
					@foreach($games as $game)
					@if(($countGames+1) <= $mediaGamesPlayed)
					@if($countPhases == 1)
					<div id="partido">
						<span class="fecha">{{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}-{{ $game['game']->stadium }}</span><br>
						<div style="float: left;">
							<img src="{{ $game['imgLocalTeam'] }}" width="45px" height="45px">
						</div>
						<div class="cuadrores3">{{ $game['localGoals'] }} - {{ $game['awayGoals'] }}<br><span style="font-size:12px"></span></div>
						<div style="float: right;"><img src="{{ $game['imgAwayTeam'] }}" width="45px" height="45px"></div>
						<br style="clear: both;">
						<div style="float:left"><span style="font-size:10px;margin-left:5px"><strong>{{ $game['localTeam']->nombre }}</strong></span></div>
						<div style="float:right"><span style="font-size:10px;margin-right:5px"><strong>{{ $game['awayTeam']->nombre }}</strong></span></div>
					</div>
					@elseif($countPhases == 2)
					<div id="partidono" style="margin-top:4px">
					</div>
					<div id="partido" style="margin-top:2px; margin-bottom: 80px;">
						<span class="fecha">{{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}-{{ $game['game']->stadium }}</span><br>
						<div style="float: left;">
							<img src="{{ $game['imgLocalTeam'] }}" width="45px" height="45px">
						</div>
						<div class="cuadrores3">{{ $game['localGoals'] }} - {{ $game['awayGoals'] }}<br><span style="font-size:12px"></span></div>
						<div style="float: right;"><img src="{{ $game['imgAwayTeam'] }}" width="45px" height="45px"></div>
						<br style="clear: both;">
						<div style="float:left"><span style="font-size:10px;margin-left:5px"><strong>{{ $game['localTeam']->nombre }}</strong></span></div>
						<div style="float:right"><span style="font-size:10px;margin-right:5px"><strong>{{ $game['awayTeam']->nombre }}</strong></span></div>
					</div>
					@elseif($countPhases == 3)
					<div id="partidono" style="margin-top:4px">
					</div>
					<div id="partido" style="margin-top:130px;">
						<span class="fecha">{{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}-{{ $game['game']->stadium }}</span><br>
						<div style="float: left;">
							<img src="{{ $game['imgLocalTeam'] }}" width="45px" height="45px">
						</div>
						<div class="cuadrores3">{{ $game['localGoals'] }} - {{ $game['awayGoals'] }}<br><span style="font-size:12px"></span></div>
						<div style="float: right;"><img src="{{ $game['imgAwayTeam'] }}" width="45px" height="45px"></div>
						<br style="clear: both;">
						<div style="float:left"><span style="font-size:10px;margin-left:5px"><strong>{{ $game['localTeam']->nombre }}</strong></span></div>
						<div style="float:right"><span style="font-size:10px;margin-right:5px"><strong>{{ $game['awayTeam']->nombre }}</strong></span></div>
					</div>
					@elseif($countPhases == 4)
					<div id="partidono" style="margin-top:2px">
					</div>
					<img src="http://lh4.googleusercontent.com/-HsyrWZpfT-U/UplECp5gcCI/AAAAAAAAAks/M4xJMpBtCuA/s136/worldcup.png">
					<br/>
					<div id="partido" style="margin-top:10px;">
						<span class="fecha">{{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}-{{ $game['game']->stadium }}</span><br>
						<div style="float: left;">
							<img src="{{ $game['imgLocalTeam'] }}" width="45px" height="45px">
						</div>
						<div class="cuadrores3">{{ $game['localGoals'] }} - {{ $game['awayGoals'] }}<br><span style="font-size:12px"></span></div>
						<div style="float: right;"><img src="{{ $game['imgAwayTeam'] }}" width="45px" height="45px"></div>
						<br style="clear: both;">
						<div style="float:left"><span style="font-size:10px;margin-left:5px"><strong>{{ $game['localTeam']->nombre }}</strong></span></div>
						<div style="float:right"><span style="font-size:10px;margin-right:5px"><strong>{{ $game['awayTeam']->nombre }}</strong></span></div>
					</div>
					<br>
					<br>
					<span class="grupom">3°Puesto</span>
					@if (!empty($thirdPlace))
					@if(!empty($thirdPlace['games']))
					@foreach($thirdPlace['games'] as $groups)
					@foreach($groups as $games)
					@foreach($games as $game)
					<div id="partido" style="margin-top:15px">
						<span class="fecha">{{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}-{{ $game['game']->stadium }}</span><br>
						<div style="float: left;">
							<img src="{{ $game['imgLocalTeam'] }}" width="45px" height="45px">
						</div>
						<div class="cuadrores3">{{ $game['localGoals'] }} - {{ $game['awayGoals'] }}<br><span style="font-size:12px"></span></div>
						<div style="float: right;"><img src="{{ $game['imgAwayTeam'] }}" width="45px" height="45px"></div>
						<br style="clear: both;">
						<div style="float:left"><span style="font-size:10px;margin-left:5px"><strong>{{ $game['localTeam']->nombre }}</strong></span></div>
						<div style="float:right"><span style="font-size:10px;margin-right:5px"><strong>{{ $game['awayTeam']->nombre }}</strong></span></div>
					</div>
					@endforeach
					@endforeach
					@endforeach
					@endif
					@endif
					@endif
					@endif
					<?php $countGames++ ?>
					@endforeach
					@endforeach
					@endforeach
					@endif
				</div>
				@endif
			@endif
			<?php $countPhases++; ?>
			@endforeach

			@if(!empty($gamesSemiFinal))
				<?php $countGames = 0; ?>
				<div id="columna">
					<span class="grupom">Semifinal</span><br>
					@if(!empty($gamesSemiFinal['games']))
					@foreach($gamesSemiFinal['games'] as $groups)
					@foreach($groups as $games)
					@foreach($games as $game)
					@if(($countGames+1) > $gamesSemiFinal['media'])
					<div id="partidono" style="margin-top:4px">
					</div>
					<div id="partido" style="margin-top:130px">
						<span class="fecha">{{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}-{{ $game['game']->stadium }}</span><br>
						<div style="float: left;">
							<img src="{{ $game['imgLocalTeam'] }}" width="45px" height="45px">
						</div>
						<div class="cuadrores3">{{ $game['localGoals'] }} - {{ $game['awayGoals'] }}<br><span style="font-size:12px"></span></div>
						<div style="float: right;"><img src="{{ $game['imgAwayTeam'] }}" width="45px" height="45px"></div>
						<br style="clear: both;">
						<div style="float:left"><span style="font-size:10px;margin-left:5px"><strong>{{ $game['localTeam']->nombre }}</strong></span></div>
						<div style="float:right"><span style="font-size:10px;margin-right:5px"><strong>{{ $game['awayTeam']->nombre }}</strong></span></div>
					</div>
					@endif
					<?php $countGames++ ?>
					@endforeach
					@endforeach
					@endforeach
					@endif
				</div>
			@endif
			@if(!empty($gamesCuartos))
				<?php $countGames = 0; ?>
				<div id="columna">
					<span class="grupom">Cuartos</span><br>
					@if(!empty($gamesCuartos['games']))
					@foreach($gamesCuartos['games'] as $groups)
					@foreach($groups as $games)
					@foreach($games as $game)
					@if(($countGames+1) > $gamesCuartos['media'])
					<div id="partidono" style="margin-top:4px">
					</div>
					<div id="partido" style="margin-top:2px; margin-bottom: 80px;">
						<span class="fecha">{{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}-{{ $game['game']->stadium }}</span><br>
						<div style="float: left;">
							<img src="{{ $game['imgLocalTeam'] }}" width="45px" height="45px">
						</div>
						<div class="cuadrores3">{{ $game['localGoals'] }} - {{ $game['awayGoals'] }}<br><span style="font-size:12px"></span></div>
						<div style="float: right;"><img src="{{ $game['imgAwayTeam'] }}" width="45px" height="45px"></div>
						<br style="clear: both;">
						<div style="float:left"><span style="font-size:10px;margin-left:5px"><strong>{{ $game['localTeam']->nombre }}</strong></span></div>
						<div style="float:right"><span style="font-size:10px;margin-right:5px"><strong>{{ $game['awayTeam']->nombre }}</strong></span></div>
					</div>
					@endif
					<?php $countGames++ ?>
					@endforeach
					@endforeach
					@endforeach
					@endif
				</div>
			@endif
			@if(!empty($gamesOctavos))
			<div style="margin-left:100px">
				<div id="fixture">
					<?php $countGames = 0; ?>
					<div id="columna">
						<span class="grupom">Octavos</span><br>
						@if(!empty($gamesOctavos['games']))
						@foreach($gamesOctavos['games'] as $groups)
						@foreach($groups as  $games)
						@foreach($games as $game)
						@if(($countGames + 1) > $gamesOctavos['media'])
						<div id="partido">
							<span class="fecha">{{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}-{{ $game['game']->stadium }}</span><br>
							<div style="float: left;">
								<img src="{{ $game['imgLocalTeam'] }}" width="45px" height="45px">
							</div>
							<div class="cuadrores3">{{ $game['localGoals'] }} - {{ $game['awayGoals'] }}<br><span style="font-size:12px"></span></div>
							<div style="float: right;"><img src="{{ $game['imgAwayTeam'] }}" width="45px" height="45px"></div>
							<br style="clear: both;">
							<div style="float:left"><span style="font-size:10px;margin-left:5px"><strong>{{ $game['localTeam']->nombre }}</strong></span></div>
							<div style="float:right"><span style="font-size:10px;margin-right:5px"><strong>{{ $game['awayTeam']->nombre }}</strong></span></div>
						</div>
						@endif
						<?php $countGames++ ?>
						@endforeach
						@endforeach
						@endforeach
						@endif
					</div>
				</div>
			</div>
			@endif
			<br style="clear: both;">
			<br>
			<br>
			<?php 
				$firstPhase = null;
				if($currentCup->hasPhases)
					$firstPhase = $currentCup->phases->first(); 
			?>
			@if(!empty($firstPhase))
			<div id="infoequipo">{{ $firstPhase->name }}</div>
			@foreach($firstPhase->groups as $group)
			<div id="grupom">
				<span class="grupom">{{ $group->name }}</span><br>
				<div id="contenedorm">
					@foreach($group->teams as $team)
					<div id="paism">
						<img src="{{ $team->escudo->url('small') }}" width="40px" height="50px"> <br>
					</div>
					@endforeach
				</div>
				<table id="posiciones" class="tablesorter3" style="width:100%;text-align: center;color:black">
					<thead>
						<tr style="background: black; color: white">
							<th>#</th>
							<th style="width:155px">Equipo</th>
							<th class="pts" style="background: #408080;width: 30px">Pts</th>
							<th class="pj">PJ</th>
							<th class="pg">PG</th>
							<th class="pe">PE</th>
							<th class="pp">PP</th>
							<th class="gf">GF</th>
							<th class="gc">GC</th>
							<th class="dg">DIF</th>
						</tr>
					</thead>
					<tbody>
						@foreach($tablePosTeams[$group->id] as $team)
						<tr style="background: #ace39e">
							<td>{{ $team['pos']}}</td>
							<td align="left">
								<img src="{{ $team['team']->escudo->url('thumb')  }}" width="15px"><strong> {{ $team['team']->subName }}</strong>
							</td>
							<td>{{ $team['points'] }}</td>
							<td>{{ $team['gamesPlayed'] }}</td>
							<td>{{ $team['winGames'] }}</td>
							<td>{{ $team['tieGames'] }}</td>
							<td>{{ $team['lostGames'] }}</td>
							<td>{{ $team['scoredGoals'] }}</td>
							<td>{{ $team['againstGoals'] }}</td>
							<td>{{ $team['goalsDiff'] }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<table width="100%">
					<tbody>
						@if(!empty($gamesForGroups))
						@foreach($gamesForGroups as $index => $groups)
						@foreach($groups as $index2 => $games)
						@foreach($games as $index2 => $game)
						@if($game['group_id'] == $group->id)
						<tr>
							<td colspan="4">
								<div id="titulom"> {{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}-{{ $game['game']->stadium }} </div>
							</td>
						</tr>
						<tr>
							<td style="width: 45%">
								<img src="{{ $game['imgLocalTeam'] }}"> {{ $game['localTeam']->nombre }}
							</td>
							<td class="resulm">
								{{ $game['localGoals'] }}
							</td>
							<td class="resulm">
								{{ $game['awayGoals'] }}
							</td>
							<td style="width: 45%">
								<img src="{{ $game['imgAwayTeam'] }}"> {{ $game['awayTeam']->nombre }}
							</td>
						</tr> 
						@endif
						@endforeach
						@endforeach
						@endforeach
						@endif
					</tbody>
				</table>
			</div>
			@endforeach
			@endif
			<div style="clear: both;"></div>
			<br>
			<br>
			<br style="clear: both;">
			<br>
			<br style="clear: both;">
			<br>
			@if(!empty($scoredGoals))
			<div id="lugar" style="width: 980px;text-align: center;margin: auto">
				<span class="datosequipo" style="display: block; text-align: center"><strong>Goleadores</strong> </span><br>
				<div id="golprim" style="margin: auto;width: 600px;font-size:12px">
					<table style="width: 100%; font-weight: bold;color: black">
						<tbody>
							<tr style="background: black;color: white"><th>Jugador</th><th>Goles</th></tr>
							@foreach($scoredGoals as $goal)
							<tr style="background: #d5d5d5;">
								<td style="text-align: left">
									<img src="{{ $goal['img'] }}" width="15px"> {{ $goal['player']->nombre }}
								</td>
								<td style="text-align: center">{{ $goal['totalsGoals'] }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>  
				</div> 
			</div>
			@endif
			<div style="clear: both;"></div>
		</div>
	@endif
@endif