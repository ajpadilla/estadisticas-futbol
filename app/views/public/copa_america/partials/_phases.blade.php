@if(!empty($americaCups))
    <div id="infoequipo">FASE FINAL</div>
    @if($gamesOctavos)
    <div style="margin-left:100px">
        <div id="fixture">
            <?php $countGames = 0; ?>
            <div id="columna">
                <span class="grupom">Octavos</span><br>
                <div id="partidono" style="margin-top:2px"></div>
                @foreach($gamesOctavos['games'] as $groups)
                    @foreach($groups as  $games)
                        @foreach($games as $game)
                            @if(($countGames + 1) <= $gamesOctavos['media'])
                            <div id="partido">
                                <span class="fecha">{{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}-{{ $game['game']->stadium }}</span><br>
                                <div style="float: left;">
                                    <img src="{{ $game['imgLocalTeam'] }}" width="45px" height="45px">
                                </div>
                                <div class="cuadrores3">{{ $game['localGoals'] }} - {{ $game['awayGoals'] }}<br><span style="font-size:12px">(3-2)</span></div>
                                <div style="float: right;"><img src="{{ $game['imgAwayTeam'] }}" width="45px" height="45px"></div>
                                <br style="clear: both;">
                                <div style="float:left"><span style="font-size:10px;margin-left:5px"><strong>{{ $game['localTeam']->nombre }}</strong></span></div>
                                <div style="float:right"><span style="font-size:10px;margin-right:5px"><strong>{{ $game['awayTeam']->nombre }}</strong></span></div>
                            </div>
                            <div id="partidono" style="margin-top:4px"></div>
                            @endif
                        <?php $countGames++ ?>
                        @endforeach
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    @endif
    @if($gamesCuartos)
    <div style="margin-left:100px">
        <div id="fixture">
            <?php $countGames = 0; ?>
            <div id="columna">
                <span class="grupom">Cuartos</span><br>
                <div id="partidono" style="margin-top:2px"></div>
                @foreach($gamesCuartos['games'] as $groups)
                    @foreach($groups as  $games)
                        @foreach($games as $game)
                            @if(($countGames + 1) <= $gamesCuartos['media'])
                            <div id="partido">
                                <span class="fecha">{{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}-{{ $game['game']->stadium }}</span><br>
                                <div style="float: left;">
                                    <img src="{{ $game['imgLocalTeam'] }}" width="45px" height="45px">
                                </div>
                                <div class="cuadrores3">{{ $game['localGoals'] }} - {{ $game['awayGoals'] }}<br><span style="font-size:12px">(3-2)</span></div>
                                <div style="float: right;"><img src="{{ $game['imgAwayTeam'] }}" width="45px" height="45px"></div>
                                <br style="clear: both;">
                                <div style="float:left"><span style="font-size:10px;margin-left:5px"><strong>{{ $game['localTeam']->nombre }}</strong></span></div>
                                <div style="float:right"><span style="font-size:10px;margin-right:5px"><strong>{{ $game['awayTeam']->nombre }}</strong></span></div>
                            </div>
                            <div id="partidono" style="margin-top:4px"></div>
                            @endif
                        <?php $countGames++ ?>
                        @endforeach
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    @endif
    @if($gamesSemiFinal)
    <div style="margin-left:100px">
        <div id="fixture">
            <?php $countGames = 0; ?>
            <div id="columna">
                <span class="grupom">Semifinal</span><br>
                <div id="partidono" style="margin-top:80px"></div>
                @foreach($gamesSemiFinal['games'] as $groups)
                    @foreach($groups as  $games)
                        @foreach($games as $game)
                            @if(($countGames + 1) <= $gamesSemiFinal['media'])
                            <div id="partido">
                                <span class="fecha">{{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}-{{ $game['game']->stadium }}</span><br>
                                <div style="float: left;">
                                    <img src="{{ $game['imgLocalTeam'] }}" width="45px" height="45px">
                                </div>
                                <div class="cuadrores3">{{ $game['localGoals'] }} - {{ $game['awayGoals'] }}<br><span style="font-size:12px">(3-2)</span></div>
                                <div style="float: right;"><img src="{{ $game['imgAwayTeam'] }}" width="45px" height="45px"></div>
                                <br style="clear: both;">
                                <div style="float:left"><span style="font-size:10px;margin-left:5px"><strong>{{ $game['localTeam']->nombre }}</strong></span></div>
                                <div style="float:right"><span style="font-size:10px;margin-right:5px"><strong>{{ $game['awayTeam']->nombre }}</strong></span></div>
                            </div>
                            <div id="partidono" style="margin-top:4px"></div>
                            @endif
                        <?php $countGames++ ?>
                        @endforeach
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @if($gamesFinal)
    <div style="margin-left:100px">
        <div id="fixture">
            <?php $countGames = 0; ?>
            <div id="columna">
                <span class="grupom">Final</span><br>
                <div id="partidono" style="margin-top:2px"></div>
                <div>
                    <img src="http://lh3.googleusercontent.com/-uRf0s42LF84/VOeZ_PjBwnI/AAAAAAAADmo/GKXTZNnBc9Y/w80/copaamerica.png" height="100px"><br>
                    @foreach($gamesFinal['games'] as $groups)
                        @foreach($groups as  $games)
                            @foreach($games as $game)
                                <div id="partido"> 
                                    <span class="fecha">{{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}-{{ $game['game']->stadium }}</span><br>
                                    <div style="float: left;">
                                        <img src="{{ $game['imgLocalTeam'] }}" width="45px" height="45px">
                                    </div>
                                    <div class="cuadrores3">{{ $game['localGoals'] }} - {{ $game['awayGoals'] }}<br><span style="font-size:12px">(3-2)</span></div>
                                    <div style="float: right;"><img src="{{ $game['imgAwayTeam'] }}" width="45px" height="45px"></div>
                                    <br style="clear: both;">
                                    <div style="float:left"><span style="font-size:10px;margin-left:5px"><strong>{{ $game['localTeam']->nombre }}</strong></span></div>
                                    <div style="float:right"><span style="font-size:10px;margin-right:5px"><strong>{{ $game['awayTeam']->nombre }}</strong></span></div>
                                </div>
                            <?php $countGames++ ?>
                            @endforeach
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($gamesSemiFinal)
    <div style="margin-left:100px">
        <div id="fixture">
            <?php $countGames = 0; ?>
            <div id="columna">
                <span class="grupom">Semifinal</span><br>
                <div id="partidono" style="margin-top:80px"></div>
                @foreach($gamesSemiFinal['games'] as $groups)
                    @foreach($groups as  $games)
                        @foreach($games as $game)
                            @if(($countGames + 1) > $gamesSemiFinal['media'])
                            <div id="partido">
                                <span class="fecha">{{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}-{{ $game['game']->stadium }}</span><br>
                                <div style="float: left;">
                                    <img src="{{ $game['imgLocalTeam'] }}" width="45px" height="45px">
                                </div>
                                <div class="cuadrores3">{{ $game['localGoals'] }} - {{ $game['awayGoals'] }}<br><span style="font-size:12px">(3-2)</span></div>
                                <div style="float: right;"><img src="{{ $game['imgAwayTeam'] }}" width="45px" height="45px"></div>
                                <br style="clear: both;">
                                <div style="float:left"><span style="font-size:10px;margin-left:5px"><strong>{{ $game['localTeam']->nombre }}</strong></span></div>
                                <div style="float:right"><span style="font-size:10px;margin-right:5px"><strong>{{ $game['awayTeam']->nombre }}</strong></span></div>
                            </div>
                            <div id="partidono" style="margin-top:4px"></div>
                            @endif
                        <?php $countGames++ ?>
                        @endforeach
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    @endif
     @if($gamesCuartos)
    <div style="margin-left:100px">
        <div id="fixture">
            <?php $countGames = 0; ?>
            <div id="columna">
                <span class="grupom">Cuartos</span><br>
                <div id="partidono" style="margin-top:2px"></div>
                @foreach($gamesCuartos['games'] as $groups)
                    @foreach($groups as  $games)
                        @foreach($games as $game)
                            @if(($countGames + 1) > $gamesCuartos['media'])
                            <div id="partido">
                                <span class="fecha">{{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}-{{ $game['game']->stadium }}</span><br>
                                <div style="float: left;">
                                    <img src="{{ $game['imgLocalTeam'] }}" width="45px" height="45px">
                                </div>
                                <div class="cuadrores3">{{ $game['localGoals'] }} - {{ $game['awayGoals'] }}<br><span style="font-size:12px">(3-2)</span></div>
                                <div style="float: right;"><img src="{{ $game['imgAwayTeam'] }}" width="45px" height="45px"></div>
                                <br style="clear: both;">
                                <div style="float:left"><span style="font-size:10px;margin-left:5px"><strong>{{ $game['localTeam']->nombre }}</strong></span></div>
                                <div style="float:right"><span style="font-size:10px;margin-right:5px"><strong>{{ $game['awayTeam']->nombre }}</strong></span></div>
                            </div>
                            <div id="partidono" style="margin-top:4px"></div>
                            @endif
                        <?php $countGames++ ?>
                        @endforeach
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    @endif
    @if($gamesOctavos)
    <div style="margin-left:100px">
        <div id="fixture">
            <?php $countGames = 0; ?>
            <div id="columna">
                <span class="grupom">Octavos</span><br>
                <div id="partidono" style="margin-top:2px"></div>
                @foreach($gamesOctavos['games'] as $groups)
                    @foreach($groups as  $games)
                        @foreach($games as $game)
                            @if(($countGames + 1) <= $gamesOctavos['media'])
                            <div id="partido">
                                <span class="fecha">{{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}-{{ $game['game']->stadium }}</span><br>
                                <div style="float: left;">
                                    <img src="{{ $game['imgLocalTeam'] }}" width="45px" height="45px">
                                </div>
                                <div class="cuadrores3">{{ $game['localGoals'] }} - {{ $game['awayGoals'] }}<br><span style="font-size:12px">(3-2)</span></div>
                                <div style="float: right;"><img src="{{ $game['imgAwayTeam'] }}" width="45px" height="45px"></div>
                                <br style="clear: both;">
                                <div style="float:left"><span style="font-size:10px;margin-left:5px"><strong>{{ $game['localTeam']->nombre }}</strong></span></div>
                                <div style="float:right"><span style="font-size:10px;margin-right:5px"><strong>{{ $game['awayTeam']->nombre }}</strong></span></div>
                            </div>
                            <div id="partidono" style="margin-top:4px"></div>
                            @endif
                        <?php $countGames++ ?>
                        @endforeach
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    @endif
@endif