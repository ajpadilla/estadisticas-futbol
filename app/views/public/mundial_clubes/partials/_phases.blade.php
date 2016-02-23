@if(!empty($mundialClubesCups))
<span class="verdegrande">Llaves</span>
<br>
<div id="fixture">
    
    @if(count($gamesRepechage['games'])> 0)
    <?php $countGames = 0; ?>
    <div id="columna">
        <span class="grupom">Repechaje</span><br>
        @foreach($gamesRepechage['games'] as $groups)
        @foreach($groups as  $games)
        @foreach($games as $game)
        @if(($countGames + 1) <= $gamesRepechage['media'])
        <div id="partido" style="margin-top:50px">
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
    </div>
    @endif
     @if($gamesCuartos)
    <?php $countGames = 0; ?>
    <div id="columna">
        <span class="grupom">Cuartos</span><br>
        @foreach($gamesCuartos['games'] as $groups)
        @foreach($groups as  $games)
        @foreach($games as $game)
        @if(($countGames + 1) <= $gamesCuartos['media'])
        <div id="partido" style="margin-top:100px">
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
    </div>
    @endif

     @if($gamesSemiFinal)
    <?php $countGames = 0; ?>
    <div id="columna">
        <span class="grupom">Semifinal</span><br>
        @foreach($gamesSemiFinal['games'] as $groups)
        @foreach($groups as  $games)
        @foreach($games as $game)
        @if(($countGames + 1) <= $gamesSemiFinal['media'])
        <div id="partido" style="margin-top:170px">
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
    </div>
    @endif
    @if($gamesFinal)
    <?php $countGames = 0; ?>
    <div id="columna">
        <span class="grupom">Final</span>
        <br>
        <br>
        <br>
        @foreach($gamesFinal['games'] as $groups)
        @foreach($groups as  $games)
        @foreach($games as $game)
        @if(($countGames + 1) <= $gamesFinal['media'])
        <div>
            <img src="http://upload.wikimedia.org/wikipedia/en/4/4e/FIFA_Club_World_Cup_logo.svg" width="70px" border="0"><br>
            <br>
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
            <br><br>
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
        <span class="grupom">Semifinal </span><br>
        @foreach($gamesSemiFinal['games'] as $groups)
        @foreach($groups as  $games)
        @foreach($games as $game)
        @if(($countGames + 1) > $gamesSemiFinal['media'])
        <div id="partido" style="margin-top:170px">
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
    </div>
    @endif
     @if($gamesCuartos)
    <?php $countGames = 0; ?>
    <div id="columna">
        <span class="grupom">Cuartos</span><br>
        @foreach($gamesCuartos['games'] as $groups)
        @foreach($groups as  $games)
        @foreach($games as $game)
        @if(($countGames + 1) > $gamesCuartos['media'])
        <div id="partido" style="margin-top:100px">
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
    </div>
    @endif
</div>
@endif