@if(!empty($sudamericanaCups))
<div id="infoequipo">FASE FINAL</div>
<div id="fixture">
    @if($gamesOctavos)
    <?php $countGames = 0; ?>
    <div id="columna">
        <span class="grupom">Octavos</span><br>
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
        @endif
        <?php $countGames++ ?>
        @endforeach
        @endforeach
        @endforeach
    </div>
    @endif

    @if($gamesCuartos)
    <?php $countGames = 0; ?>
    <div id="columna">
        <span class="grupom">Cuartos</span><br>
        <div id="partidono">
        </div>
        <div id="partidono" style="margin-top:15px">
        </div>
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
        @endif
        @if($countGames == 2)
        <div id="partidono">
            </div>
            <div id="partidono">
            </div>
            <div id="partidono">
            </div>
            <div id="partidono">
            </div>
        @endif
        <?php $countGames++ ?>
        @endforeach
        @endforeach
        @endforeach
    </div>
    @endif

     @if($gamesSemiFinal)
            <?php $countGames = 0; ?>
            <div id="columna">
                <div id="partidono">
                </div>
                <div id="partidono">
                </div>
                <div id="partidono">
                </div>
                <div id="partidono">
                </div>
                <div id="partidono">
                </div>
                <div id="partidono">
                </div>
                <div id="partidono">
                </div>
                @foreach($gamesSemiFinal['games'] as $groups)
                @foreach($groups as  $games)
                @foreach($games as $game)
                @if(($countGames + 1) <= $gamesSemiFinal['media'])
                <div id="partido" style="margin-top:18px">
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
                <?php $countGames++ ?>
                @endforeach
                @endforeach
                @endforeach
            </div>
        @endif

        @if($gamesFinal)
        <?php $countGames = 0; ?>
        <div id="columna">
            <span class="grupom">Final</span><br>
            <div id="partidono">
            </div>
            <div id="partido" style="height:250px">
                <br><br><br>
                <img src="http://www.promiedos.com.ar/images/copas/copasudamericana.png" border="0"><br>
                <strong>FINAL COPA SUDAMERICANA {{ $currentCup->year }}</strong><br>
            </div>
            <div id="partidono" style="margin-top:8px"></div>
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
        @endif

        @if($gamesSemiFinal)
            <?php $countGames = 0; ?>
            <div id="columna">
                <div id="partidono">
                </div>
                <div id="partidono">
                </div>
                <div id="partidono">
                </div>
                <div id="partidono">
                </div>
                <div id="partidono">
                </div>
                <div id="partidono">
                </div>
                <div id="partidono">
                </div>
                @foreach($gamesSemiFinal['games'] as $groups)
                @foreach($groups as  $games)
                @foreach($games as $game)
                @if(($countGames + 1) > $gamesSemiFinal['media'])
                <div id="partido" style="margin-top:18px">
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
                <?php $countGames++ ?>
                @endforeach
                @endforeach
                @endforeach
            </div>
        @endif

       
    @if($gamesCuartos)
    <?php $countGames = 0; ?>
    <div id="columna">
        <span class="grupom">Cuartos</span><br>
        <div id="partidono">
        </div>
        <div id="partidono" style="margin-top:15px">
        </div>
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
        @endif
        @if($countGames == 2)
        <div id="partidono">
            </div>
            <div id="partidono">
            </div>
            <div id="partidono">
            </div>
            <div id="partidono">
            </div>
        @endif
        <?php $countGames++ ?>
        @endforeach
        @endforeach
        @endforeach
    </div>
    @endif


    @if($gamesOctavos)
    <?php $countGames = 0; ?>
    <div id="columna">
        <span class="grupom">Octavos</span><br>
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
        @endif
        <?php $countGames++ ?>
        @endforeach
        @endforeach
        @endforeach
    </div>
    @endif

</div>
@endif
    