<div style="float: left;width:480px">
	<div style="width:480px;margin-left:15px">
		@foreach($competitions as $competition)
			@foreach ($competition->phasesWithGames as $phase) 
				<a id="irfecha" href="{{ route('getGamesForPhase') }}" class="phasesWithGames" data-phase-id="{{ $phase->id }}">{{ $phase->name }}</a>
			@endforeach
		@endforeach
	</div>
	<br>
	<div id="fixtureactual">
		<div style="background: #092b1d; height:50px">
			<div id="flechaatrno"></div>
			<div style="float: left; width:380px; font-size: 14px; color: #c2e213; text-align: center;">
				Torneo 2016<br>
				Fecha 1<br>
				<span class="datosequipo2b" style="font-weight: normal">
					(use las flechas para mirar otras fechas)
				</span>
			</div>
			<div id="flechaad" class="2_1"></div>
		</div>
		<br>
		<table style="width:480px">
			<tbody>
			<tr style="background:#092B1D;text-align: center">
				<td colspan="6"><span class="horariopartido"> Viernes 5 de Febrero</span></td>
			</tr>
			<tr style="background: #e5e5e5">
				<td class="falta" id="ti_1_10">19:00</td>
				<td style="min-width:153px"><img src="http://www.promiedos.com.ar/images/s18/huracan.png" width="18px">
					<span class="datoequipo">Huracan</span>
				</td>
				<td class="resu" id="r1_1_10"></td>
				<td class="resu" id="r2_1_10"></td>
				<td style="min-width:153px">
					<img src="http://www.promiedos.com.ar/images/s18/atlrafaela.png" width="18px">
					<span class="datoequipo">Atl Rafaela</span>
				</td>
				<td>
					<div id="ficha" onclick="previa('10','primera');">Ficha<br><img src="http://www.promiedos.com.ar/images/nota.png">
					</div>
				</td>
			</tr>
			</tbody>
		</table>
		<br>
		<div style="float: left;"><img src="images/canales/tvpublica.png">TV Publica</div>
		<div style="float: left;margin-left: 20px;"><img src="images/canales/canal13.png">Canal 13</div>
		<div style="float: left;margin-left:20px"><img src="images/canales/canal9.png">Canal 9</div>
		<div style="float: left;margin-left:20px"><img src="images/canales/americatv.png">America TV</div>
		<div style="float: left;margin-left:20px"><img src="images/canales/telefe.png">Telefe</div>
		<div style="float: left;margin-left:20px"><img src="images/canales/deportv.png" width="15px">DeporTV</div>
		<br style="clear: both;"><br>
	</div>
</div>