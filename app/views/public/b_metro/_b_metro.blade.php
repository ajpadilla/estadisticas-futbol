@extends("public.layouts.main")
 {{--
@section("page-title")
	INICIO
@stop

@section("page-description")
	Página Inicial
@stop
--}}
@section("content")
	<div style="clear: both;"></div>
	<br/>
	<div style="clear: both;"></div>
	@include('public.b_metro.partials._paginator-games')
	<div style="clear: both;"></div>
	@include('public.b_metro.partials._shields')
	<div style="clear: both;"></div>
	<div style="clear: both;"></div>
	<br>
	@include('public.b_metro.partials._info-league')
	<div style="clear: both;"></div>
	<br>
	<div style="clear: both;"></div>
	<br>
	@include('public.b_metro.partials._associated_skills')
	<div style="clear: both;"></div>
	<br>
	@include('public.b_metro.partials._positions')
	@include('public.b_metro.partials._phases');
	<br>
	<div style="clear: both;"></div>
	<br>
	@include('public.b_metro.partials._averages')
	@include('public.b_metro.partials._scorers')
	@include('public.b_metro.partials._statistics_tournament')
	<br>
	<div style="clear: both;"></div>
	<br>
	<div style="clear: both;"></div>
	<br>
	@include('public.b_metro.partials._table-games-phase-tpl')
	@include('public.b_metro.partials._name-phases-for-competition-tpl')
	@include('public.b_metro.partials._stats-phase-tpl')
	@include('public.b_metro.partials._scorers-tpl')
	@include('public.b_metro.partials._average-head-tpl')
@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready(function () 
	{
		var groupsFixturesForCompetition = function() 
		{
			var competitionId = $('#teamsFormCompetition').attr('data-id');
			var url = $('#teamsFormCompetition').attr('href');

			var data = {
				id: competitionId
			}
			$.ajax({
				type: 'GET',
				url: url,
				data: data,
				dataType:'json',
				success: function(response) {
					if(response.success)
					{
						var html;
						//console.log(response);
						$.each(response.groupsFixtures, function(groupIndex, teams) 
						{
							$("#positionsForTeams"+groupIndex).tablesorter();
							$.each(teams, function(teamIndex, team)
							{
								html = "<tr style='background: #d5d5d5'>"+
								"<td>"+teamIndex+"</td>"+
								"<td align='left'>"+
								"<img width='18px' src="+team.img+">"+
								"<strong>"+team.team.nombre+"</strong>"
								+"</td>"+
								"<td>"+team.points+"</td>"+
								"<td>"+team.gamesPlayed+"</td>"+
								"<td>"+team.winGames+"</td>"+
								"<td>"+team.tieGames+"</td>"+
								"<td>"+team.lostGames+"</td>"+
								"<td>"+team.scoredGoals+"</td>"+
								"<td>"+team.againstGoals+"</td>"+
								"<td>"+team.goalsDiff+"</td>"
								+"</tr>";
								$("#positionsForTeams-"+groupIndex+" tbody").append(html);
								$("#positionsForTeams-"+groupIndex+" tbody").trigger("update");
							})
						});	
					}
			},
			error: function(objeto, quepaso, otroobj){
				console.log(objeto);
				console.log(quepaso);
				console.log(otroobj);
			}
		});
		};

		var gamesForFirtsPhase = function() 
		{
			var url = $('.phasesWithGames').attr('href');
			var data = {
				phaseId: $("#firstPhase").attr('data-phase-id'),
				competitionId : $('#teamsFormCompetition').attr('data-id')
			}
			$.ajax({
				type: 'GET',
				url: url,
				data: data,
				dataType:'json',
				success: function(response) {
					//console.log(response);
					if(response.success) 
					{
						$.each(response.gamesFixtures, function(groupIndex, games) 
						{
							$.each(games, function(gameIndex, game)
							{
								//console.log(game);
								var tableGames = jQuery('#tableGamesForPhase');
								var data = {
									time: game.game.date,
									imgLocalTeam: game.game.imgLocalTeam,
									imgAwayTeam: game.game.imgAwayTeam,
									hour: game.game.time,
									localTema: game.game.localTeam.nombre,
									awayTema: game.game.awayTeam.nombre,
									localGoals: game.game.localGoals,
									awayGoals: game.game.awayGoals,
									fixturesLocalGoals: game.game.fixturesLocalGoals ? game.game.fixturesLocalGoals : "",
									fixturesAwayGoals: game.game.fixturesAwayGoals ? game.game.fixturesAwayGoals : ""
								};
								var template = jQuery('#tableGamesForPhase-tpl').html();
								var html = Mustache.to_html(template, data);
								tableGames.append(html);
							});
						});
						
						var currentPhase = jQuery('#phaseForCompetition');
						var data = {
							competition: response.infoCompetition.competition,
							phase: response.infoCompetition.phase
						};
						var template = jQuery('#phaseForCompetition-tpl').html();
						var html = Mustache.to_html(template, data);
						currentPhase.html(html);

						var statsPhase = jQuery('#statsPhase');
						var data = {
							average: response.statsPhase.average,
							tieGames: response.statsPhase.tieGames,
							totalGames: response.statsPhase.totalGames,
							totalGoalsAway: response.statsPhase.totalGoalsAway,
							totalGoalsLocal: response.statsPhase.totalGoalsLocal,
							totalsGolas: response.statsPhase.totalsGolas,
							winGamesAway: response.statsPhase.winGamesAway,
							winGamesLocal: response.statsPhase.winGamesLocal
						};
						var template = jQuery('#statsPhase-tpl').html();
						var html = Mustache.to_html(template, data);
						statsPhase.html(html);
					}
				},
				error: function(objeto, quepaso, otroobj){
					console.log(objeto);
					console.log(quepaso);
					console.log(otroobj);
				}
			});

		}

		var gameForPhases = function() 
		{
			$(".phasesWithGames").click(function(event) 
			{
				event.preventDefault();

				jQuery('#tableGamesForPhase').html('')
				jQuery('#phaseForCompetition').html('');
				jQuery('#statsPhase').html('');

				var phaseId = $(this).attr('data-phase-id');
				var url = $(this).attr('href');
				var data = {
					phaseId: phaseId,
					competitionId : $('#teamsFormCompetition').attr('data-id')
				};
				$.ajax({
					type: 'GET',
					url: url,
					data: data,
					dataType:'json',
					success: function(response) {
						//console.log(response);
						if (response.success) 
						{
							$.each(response.gamesFixtures, function(groupIndex, games) 
							{
								$.each(games, function(gameIndex, game)
								{
								//console.log(game);
								var tableGames = jQuery('#tableGamesForPhase');
								var data = {
									time: game.game.date,
									imgLocalTeam: game.game.imgLocalTeam,
									imgAwayTeam: game.game.imgAwayTeam,
									hour: game.game.time,
									localTema: game.game.localTeam.nombre,
									awayTema: game.game.awayTeam.nombre,
									localGoals: game.game.localGoals,
									awayGoals: game.game.awayGoals,
									fixturesLocalGoals: game.game.fixturesLocalGoals ? game.game.fixturesLocalGoals : "",
									fixturesAwayGoals: game.game.fixturesAwayGoals ? game.game.fixturesAwayGoals : ""
								};
								var template = jQuery('#tableGamesForPhase-tpl').html();
								var html = Mustache.to_html(template, data);
								tableGames.append(html);
							});
							});

							var currentPhase = jQuery('#phaseForCompetition');
							var data = {
								competition: response.infoCompetition.competition,
								phase: response.infoCompetition.phase
							};
							var template = jQuery('#phaseForCompetition-tpl').html();
							var html = Mustache.to_html(template, data);
							currentPhase.html(html);

							var statsPhase = jQuery('#statsPhase');
							var data = {
								average: response.statsPhase.average,
								tieGames: response.statsPhase.tieGames,
								totalGames: response.statsPhase.totalGames,
								totalGoalsAway: response.statsPhase.totalGoalsAway,
								totalGoalsLocal: response.statsPhase.totalGoalsLocal,
								totalsGolas: response.statsPhase.totalsGolas,
								winGamesAway: response.statsPhase.winGamesAway,
								winGamesLocal: response.statsPhase.winGamesLocal
							};
							var template = jQuery('#statsPhase-tpl').html();
							var html = Mustache.to_html(template, data);
							statsPhase.html(html);
						}
					},
					error: function(objeto, quepaso, otroobj){
						console.log(objeto);
						console.log(quepaso);
						console.log(otroobj);
					}
				});
			});
		};

		var scoredGoals = function() 
		{
			var competitionId = $('#teamsFormCompetition').attr('data-id');
			url = $('#scoredGoalsUrl').attr('href')
			var data = {
				id: competitionId
			};
			$.ajax({
				type: 'GET',
				url: url,
				data: data,
				dataType:'json',
				success: function(response) {
					//console.log(response);
					var scoredGoals = jQuery('#colScorers');
					$.each(response.scoredGoals, function(index , scorer) {
						var data = {
							img: scorer.img,
							player: scorer.player.nombre,
							team: scorer.team.nombre,
							goals: scorer.totalsGoals
						};
						var template = jQuery('#scorers-tpl').html();
						var html = Mustache.to_html(template, data);
						scoredGoals.append(html);
					});

				},
				error: function(objeto, quepaso, otroobj){
					console.log(objeto);
					console.log(quepaso);
					console.log(otroobj);
				}
			});
		};

		groupsFixturesForCompetition();
		gamesForFirtsPhase();
		gameForPhases();
		scoredGoals();
	});
</script>
@stop