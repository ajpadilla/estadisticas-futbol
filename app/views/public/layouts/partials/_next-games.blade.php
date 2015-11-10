<div style="width: 440px;float:left;margin-left: 230px"><br>
    
    @if (isset($competitions) AND !empty($competitions))
        @foreach($competitions as $competition)
        <div id="fixturein">
            <div class="tituloin"><a href="primerad">{{ $competition->name }}</a></div>
            <table style="width:440px">
                <tbody>
                    <tr style="background:#092B1D;text-align: center">
                        <td colspan="6"><span class="horariopartido"> {{ $tomorrow }}</span></td>
                    </tr>
                    @forelse($competition->todayGames as $game)
                        <tr style="background: #e5e5e5">
                            <td class="falta" id="ti_6_222">15:00</td>
                            <td style="width: 35%;"><img src="{{ $game->localTeam->shield }}" width="18px"><span
                                        class="datoequipo">{{ $game->localTeam }}</span></td>
                            <td class="resu" id="r1_6_222"></td>
                            <td class="resu" id="r2_6_222"></td>
                            <td style="width: 35%;"><img src="{{ $game->awayTeam->shield }}"
                                                 width="18px"><span class="datoequipo">{{ $game->awayTeam }}</span></td>
                        </tr>
                    @empty
                        <p>No hay juegos para hoy</p>
                    @endforelse
                    <tr style="background: white; font-size:10px;display: none" id="gole_6_222">
                        <td colspan="3" id="g1_6_222"></td>
                        <td colspan="3" id="g2_6_222"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endforeach
    @else
        <p>No hay competencias</p>
    @endif

    <div id="abajo">
        <div id="cuadros"><a href="primerad">Ir a Sección<br>Prim. D</a></div>
        <div id="cuadros3" onclick="popup(6,1);">Ver Tabla<br>Puntos</div>
        <div id="cuadros3" onclick="popup(6,2);">Ver Tabla<br>Promedios</div>
        <div id="cuadros3"><a href="foro.php?seccion=PrimeraD">Ir a Foro<br>Prim. D</a></div>
        <div style="clear: both"></div>
    </div>
</div>