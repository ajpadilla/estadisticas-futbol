@if(!empty($competitions))
<div style="display:none" id="competition-id">
     @foreach($competitions as $competition)
        <a id="teamsFormCompetition" data-id="{{ $competition->id }}" href="{{ route('getPositionsteamsForCompetitions') }}"></a>
     @endforeach 
</div>
@foreach($competitions as $competition)
@if($competition->hasPhases)
<div id="tablaptsactual">
<span class="datosequipo" style="display: block; text-align: center"><strong>Posiciones {{ $competition->nombre }}</strong> </span>  
<div id="tabla">
@foreach($competition->phases->first()->groups as $index => $group)
@if(count($competition->phases->first()->groups) > 1 )
<div style="display:block;text-align:center;font-size:18px;color:white;background:black">Zona {{ $index + 1 }}</div>
@endif
<table id="positionsForTeams-{{$index + 1}}" class="tablesorter3" style="width:100%;text-align: center">
    <thead>
        <tr style="background: black; color: white">
            <th class="header positionTeam">#</th>
            <th style="width:140px" class="header">Equipo</th>
            <th class="pts header" style="background: #408080">Pts</th>
            <th class="pj header">PJ<div class="tooltip fixed" style="display: none;">Partidos jugados. <br><span class="ordenar">Click para ordenar con este criterio.</span></div></th>
            <th class="pg header">PG<div class="tooltip fixed" style="display: none;">Partidos ganados. <br><span class="ordenar">Click para ordenar con este criterio.</span></div></th>
            <th class="pe header">PE<div class="tooltip fixed" style="display: none;">Partidos empatados. <br><span class="ordenar">Click para ordenar con este criterio.</span></div></th>
            <th class="pp header">PP<div class="tooltip fixed" style="display: none;">Partidos perdidos. <br><span class="ordenar">Click para ordenar con este criterio.</span></div></th>
            <th class="gf header">GF<div class="tooltip fixed" style="display: none;">Goles a favor. <br><span class="ordenar">Click para ordenar con este criterio.</span></div></th>
            <th class="gc header">GC<div class="tooltip fixed" style="display: none;">Goles en contra. <br><span class="ordenar">Click para ordenar con este criterio.</span></div></th>
            <th class="dg header">DIF<div class="tooltip fixed" style="display: none;">Diferencia de Gol. <br><span class="ordenar">Click para ordenar con este criterio.</span></div></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@endforeach 
</div>
    <!--<div class="infotabla">
    <span style="background: #AAF597;color:black">*El campeón y el subcampeón clasifican a la Copa Libertadores 2016.</span><br>
    <span style="background: #7dbc6d;color:black">*Del 3° al 6° jugarán un reducido por otro cupo a la Copa Libertadores 2016.</span><br>
    <span style="background: #fcf912;color:black">*Del 7° al 18° jugarán una liguilla para la clasificación a la Copa Sudamericana 2016.</span><br>
    Nota: Al estar River Plate clasificado a la Copa Libertadores 2016 como actual campeón, el lugar lo ocupará el siguiente equipo de la tabla.<br>
    Nota: Rosario Central esta entrando a la Copa Libertadores 2016 por la Copa Argentina, el lugar lo ocupará el siguiente equipo de la tabla.
    </div>-->
</div>
@endif
@endforeach 
@endif