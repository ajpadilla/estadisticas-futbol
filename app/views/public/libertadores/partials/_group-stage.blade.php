@if(!empty($libertadoresCups))
    @foreach($libertadoresCups as $libertadoresCup)
        @if($libertadoresCup->hasGames)
            <?php $firstPhase = $libertadoresCup->phases()->whereType('fase de grupos')->first(); ?>
        
        @if (!empty($firstPhaseRepechaje))
           <div id="infoequipo">REPECHAJE</div>
            <div id="fixrepe">
                @foreach ($firstPhaseRepechaje->groups as $indexGroup => $group)
                <div style="width: 400px; float: left; margin-top:10px">
                    <table>
                        <tbody>
                             <tr>
                                <td colspan="4">
                                    <span class="datosequipo" style="display: block; background: url(assets/img/public/caja.png);width: 386px">
                                        <span style="margin-left:10px; color: yellow">G{{$indexGroup+1}}</span>
                                        <span style="margin-left:50px">{{ $group->name }}</span>
                                    </span>
                                </td>
                            </tr>
                            @if(!empty($gamesForRepechaje))
                                @foreach($gamesForRepechaje as $index => $groups)
                                @foreach($groups as $index2 => $games)
                                @foreach($games as $index2 => $game)
                                @if($game['group_id'] == $group->id)
                                <tr style="background:#155219">
                                    <td colspan="4">
                                    <span class="horariopartido">{{ $game['dateObject']->toFormattedDateString() }}  , {{ $game['time'] }}hs</span>
                                        <span class="horariopartido2" style="float: right;">
                                            <!--<span class="statuspartido2">Final</span> </span>-->
                                        </td>
                                    </tr>
                                    <tr id="188" style="background: url(assets/img/public/caja2b.png)"><td width="150">
                                        <span class="datoequipo"> {{ $game['localTeam']->nombre }}</span></td>
                                        <td width="20" style="background: white">
                                            <span class="datoequipo" style="margin-left: 5px">{{$game['localGoals'] }}</span>
                                        </td>
                                        <td width="20" style="background: white">
                                            <span class="datoequipo" style="margin-left: 5px">{{ $game['awayGoals'] }} </span>
                                        </td>
                                        <td width="150"><span class="datoequipo">{{ $game['awayTeam']->nombre }}</span></td>
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
            </div>
            <br>
            <div style="clear: both"></div>
            <div style="clear: both"></div>
            <br>
        @endif


        @if(!empty($firstPhase))
        <div id="infoequipo">{{ $firstPhase->name }}</div>
            <br>
            @foreach($firstPhase->groups as $group)
            <div id="grupos">
                <span class="datosequipo" style="display: block; background: #092B1D; text-align: center; width: 964px; font-size: 14px; font-weight: bold">{{ $group->name }}</span>
                    <div style="float: left; width: 450px">
                        <table id="posiciones" class="tablesorter1" width="440">
                            <thead>
                                <tr style="background: black; color: white">
                                    <th>#</th>
                                    <th>Equipo</th>
                                    <th>Pts</th>
                                    <th>PJ</th>
                                    <th>PG</th>
                                    <th>PE</th>
                                    <th>PP</th>
                                    <th>GF</th>
                                    <th>GC</th>
                                    <th>DIF</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tablePosTeams[$group->id] as $index => $team)
                                <tr style="background: #ace39e">
                                    <td>{{ $team['pos'] }}</td>
                                    <td align="left">
                                        <img src="{{ $team['team']->escudo->url('thumb')  }}" width="15px"><strong> {{ $team['team']->nombre }}</strong>
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
                    </div>
                        <div style="width: 400px; float: left; margin-left:20px">
                            @foreach($tablePosTeams[$group->id] as $index => $team)
                                <img src="{{ $team['team']->escudo->url('thumb')  }}" border="0" title="{{ $team['team']->nombre }}" width="64px" height="64px">
                            @endforeach
                        </div>
                    <div style="clear: both"><br></div>

                    <div id="fixgrupo">
                        <div style="float:left; width: 320px">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="datosequipo" style="display: block; background: url(images/caja.png); text-align: center; width: 316px">Juegos</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @if(!empty($gamesForGroups))
                            @foreach($gamesForGroups as $index => $groups)
                            @foreach($groups as $index2 => $games)
                            @foreach($games as $index2 => $game)
                            @if($game['group_id'] == $group->id)
                                <table>
                                    <tbody>

                                        <tr style="background:#155219">
                                            <td colspan="4">
                                                <span class="horariopartido2">{{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}
                                                </span>
                                                <!--<span style="float: right">
                                                    <span class="statuspartido2">Final</span>
                                                </span>-->
                                            </td>
                                        </tr>
                                        <tr id="188" style="background: url(assets/img/public/caja2b.png)"><td width="150">
                                            <span class="datoequipo"> {{ $game['localTeam']->nombre }}</span></td>
                                            <td width="20" style="background: white">
                                                <span class="datoequipo" style="margin-left: 5px">{{$game['localGoals'] }}</span>
                                            </td>
                                            <td width="20" style="background: white">
                                                <span class="datoequipo" style="margin-left: 5px">{{ $game['awayGoals'] }} </span>
                                            </td>
                                            <td width="150"><span class="datoequipo">{{ $game['awayTeam']->nombre }}</span></td>
                                        </tr>

                                    </tbody>
                                </table>
                            @endif
                            @endforeach
                            @endforeach
                            @endforeach
                            @endif
                        </div>
                </div>
            </div>
            @endforeach
        @endif
         @endif
    @endforeach
@endif