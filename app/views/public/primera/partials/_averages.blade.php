@foreach ($competitions as $competition)
<div id="tablapromactualprim">
    <span class="datosequipo" style="display: block; text-align: center"><strong>Promedios Campeonato {{ $competition->year }} </strong> </span> 
    <div id="prom1b">
        <table id="tablapromactual" class="tablesorter" style="width: 100%;text-align: center">
            <thead > 
                <tr style="background: black; color: white">
                    <th class="header">#</th>
                    <th style="width:150px" class="header">Equipo</th>
                    @foreach ($dates_reverse as $date)
                        <th   class="temp header"> {{ $date }}</th>
                    @endforeach
                    <th class="pts header">Pts<div class="tooltip fixed" style="left: 420.5px; top: 1329px; display: none;">Puntos obtenidos. <br><span class="ordenar">Click para ordenar con este criterio.</span></div></th>
                    <th class="pj header">PJ<div class="tooltip fixed" style="left: 447.5px; top: 1329px; display: none;">Partidos jugados. <br><span class="ordenar">Click para ordenar con este criterio.</span></div></th>
                    <th class="prom header" style="background: #408080">PROM<div class="tooltip fixed" style="left: 482px; top: 1329px; display: none;">Promedio. <br><span class="ordenar">Click para ordenar con este criterio.</span></div></th>
                </tr>
            </thead> 
            <tbody>
                @if (!empty($averages))
                    @foreach ($averages  as $average)
                        <tr style="background: #d5d5d5">
                            <td>1</td>
                            <td align="left">
                                <img src="{{ $average['team']->escudo->url('thumb') }}" width="15px"><strong>{{ $average['team']->nombre }}</strong>
                            </td>
                            <?php $averagesForSeasons =  $average['averageForCompetition']?>
                            @foreach ($averagesForSeasons as $averageForCompetition)
                                    <td>{{ $averageForCompetition }}</td>
                            @endforeach
                            <td>{{ $average['totalPoints'] }}</td>
                            <td>{{ $average['gamesPlayed'] }}</td>
                            <td>{{ $average['average'] }}</td>
                        </tr>
                    @endforeach
                @endif
                
            </tbody>
        </table>
    </div>
<!--<div class="infotabla">
*Los últimos 4 equipos descienden al Federal A o a la B Metro, segun su afiliación.
</div>-->
</div>
@endforeach
