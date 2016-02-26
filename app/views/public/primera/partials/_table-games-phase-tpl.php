<script id="tableGamesForPhase-tpl" type="text/x-handlebars-template">
	<tbody>
		<tr style="background:#092B1D;text-align: center">
			<td colspan="6"><span class="horariopartido">{{ time }}</span></td>
		</tr>
		<tr style="background: #e5e5e5">
			<td class="falta" id="ti_1_10">{{ hour }}</td>
			<td style="min-width:153px"><img src="{{ imgLocalTeam }}" width="18px">
				<span class="datoequipo">{{ localTema }}</span>
			</td>
			<td class="resu" id="r1_1_10">{{ localGoals }}</td>
			<td class="resu" id="r2_1_10">{{ awayGoals }}</td>
			<td style="min-width:153px">
				<img src="{{ imgAwayTeam }}" width="18px">
				<span class="datoequipo">{{ awayTema }}</span>
			</td>
			<td>
				<div id="ficha" class="game-file">Ficha<br>
					<img src="/assets/img/public/nota.png">
				</div>
			</td>
		</tr>
		<tr style="background: white; font-size:10px">
		<td colspan="3"><span style="color: green"></span>{{ fixturesLocalGoals }}</td>
		<td colspan="3"><span style="color: green">{{ fixturesAwayGoals }}</td>
		</tr>
	</tbody>

</script>