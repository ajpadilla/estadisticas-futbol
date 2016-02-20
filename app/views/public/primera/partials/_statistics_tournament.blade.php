@if (!empty($statisticsTournament))
<div style="background: url('/assets/img/public/caja.png'); float: left;width: 240px;text-align: center;margin-left:15px">
	<span class="datosequipo">Estadisticas del Torneo:</span>
	<br><br>
	<span class="datosequipo2">Partidos jugados:</span><br>
	<span class="datosequipo"><strong>{{ $statisticsTournament['totalGames'] }}</strong></span><br><br>
	<span class="datosequipo2">Goles:</span><br>
	<span class="datosequipo"><strong>{{ $statisticsTournament['totalsGoals'] }}</strong> goles</span><br>
	<span class="datosequipo"><strong>{{ $statisticsTournament['average'] }}</strong> goles de media por partido</span><br>
	<span class="datosequipo"><strong>{{ $statisticsTournament['totalGoalsLocal'] }}</strong> goles locales ({{ $statisticsTournament['percentGoalsLocal'] }}%)</span><br>
	<span class="datosequipo"><strong>{{ $statisticsTournament['totalGoalsAway'] }}</strong> goles visitantes ({{ $statisticsTournament['percentGoalsAway'] }}%)</span><br><br>
	<span class="datosequipo2">Resultados:</span><br>
	<span class="datosequipo"><strong>{{ $statisticsTournament['winGamesLocal'] }}</strong> victorias locales ({{ $statisticsTournament['percentWinsGamesLocal'] }}%)</span><br>
	<span class="datosequipo"><strong>{{ $statisticsTournament['winGamesAway'] }}</strong> victorias visitantes ({{ $statisticsTournament['percentWinsGamesAway'] }}%)</span><br>
	<span class="datosequipo"><strong>{{ $statisticsTournament['tieGames'] }}</strong> empates ({{ $statisticsTournament['percentTieGames'] }}%)</span><br><br>
</div>
@endif