@if(!empty($americaCups))
    @foreach($americaCups as $americaCup)
    <div id="infoequipo">FASE FINAL</div>
        <?php $gamesCuartos = $competitionRepository->getGamesForTypePhase('cuartos', $americaCup->from, $americaCup->to);  ?>
        <?php $gamesSemiFinal = $competitionRepository->getGamesForTypePhase('semifinal', $americaCup->from, $americaCup->to);  ?>
        <?php $gamesFinal = $competitionRepository->getGamesForTypePhase('final', $americaCup->from, $americaCup->to);  ?>

        <div style="margin-left:100px">
        <div id="fixture">
        @if($gamesCuartos)
        <?php $countGamesCuartos = 0; ?>
        <div id="columna">
            <span class="grupom">Cuartos</span><br>
            <div id="partidono" style="margin-top:2px"></div>
            @foreach($gamesCuartos as $indexGroup => $groups)
                @foreach($groups as $indexGames => $games)
                    @foreach($games as $index => $game)
                        @if(($countGamesCuartos + 1) <= 2)
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
                            <?php $countGamesCuartos++ ?>
                        </div>
                        <div id="partidono" style="margin-top:4px"></div>
                        @endif
                    @endforeach
                @endforeach
            @endforeach
        </div>
        @endif

        @if($gamesSemiFinal)
        <?php $countGamesSemiFinal = 0; ?>
        <div id="columna">
            <span class="grupom">Semifinal</span><br>
            <div id="partidono" style="margin-top:80px"></div>
            @foreach($gamesSemiFinal as $indexGroup => $groups)
            @foreach($groups as $indexGames => $games)
            @foreach($games as $index => $game)
            @if(($countGamesSemiFinal + 1) <= 1)
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
                <?php $countGamesSemiFinal++ ?>
            </div>
            @endif
            @endforeach
            @endforeach
            @endforeach
        </div>
        @endif

        @if($gamesFinal)
        <?php $countGamesFinal = 0; ?>
        <div id="columna">
            <span class="grupom">Final</span><br><br><br>
            <div id="partidono" style="margin-top:-55px"></div>
            @foreach($gamesFinal as $indexGroup => $groups)
            @foreach($groups as $indexGames => $games)
            @foreach($games as $index => $game)
            @if(($countGamesFinal + 1) <=1)
            <div>
                <img src="http://lh3.googleusercontent.com/-uRf0s42LF84/VOeZ_PjBwnI/AAAAAAAADmo/GKXTZNnBc9Y/w80/copaamerica.png" height="100px"><br>
                <div id="partido" style="margin-top:15px"> 
                    <span class="fecha">{{ $game['dateObject']->toFormattedDateString() }}-{{ $game['time'] }}-{{ $game['game']->stadium }}</span><br>
                    <div style="float: left;">
                        <img src="{{ $game['imgLocalTeam'] }}" width="45px" height="45px">
                    </div>
                    <div class="cuadrores3">{{ $game['localGoals'] }} - {{ $game['awayGoals'] }}<br><span style="font-size:12px">(3-2)</span></div>
                    <div style="float: right;"><img src="{{ $game['imgAwayTeam'] }}" width="45px" height="45px"></div>
                    <br style="clear: both;">
                    <div style="float:left"><span style="font-size:10px;margin-left:5px"><strong>{{ $game['localTeam']->nombre }}</strong></span></div>
                    <div style="float:right"><span style="font-size:10px;margin-right:5px"><strong>{{ $game['awayTeam']->nombre }}</strong></span></div>
                    <?php $countGamesFinal++ ?>
                </div>
            </div>
            @endif
            @endforeach
            @endforeach
            @endforeach
        </div>
        @endif

        @if($gamesSemiFinal)
        <?php $countGamesSemiFinal = 0; ?>
        <div id="columna">
            <span class="grupom">Semifinal</span><br>
            <div id="partidono" style="margin-top:80px"></div>
            @foreach($gamesSemiFinal as $indexGroup => $groups)
            @foreach($groups as $indexGames => $games)
            @foreach($games as $index => $game)
            @if(($countGamesSemiFinal + 1) > 1)
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
            @endif
            <?php $countGamesSemiFinal++ ?>
            @endforeach
            @endforeach
            @endforeach
        </div>
        @endif
        
        @if($gamesCuartos)
        <?php $countGamesCuartos = 0; ?>
        <div id="columna">
            <span class="grupom">Cuartos</span><br>
            <div id="partidono" style="margin-top:2px"></div>
            @foreach($gamesCuartos as $indexGroup => $groups)
            @foreach($groups as $indexGames => $games)
            @foreach($games as $index => $game)
            @if(($countGamesCuartos + 1) > 2)
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
            <?php $countGamesCuartos++ ?>
            @endforeach
            @endforeach
            @endforeach
        </div>
        @endif

        </div>
    </div>
    @endforeach
@endif