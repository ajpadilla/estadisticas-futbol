var CustomPublicApp = function () {
	
	//console.log($("#firstPhase").attr('data-phase-id'))

	var base_url = window.location.origin;
	console.log(base_url);

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
				var html;
				//console.log(response);
				$.each(response.groupsFixtures, function(groupIndex, teams) 
				{
					$("#positionsForTeams"+groupIndex).tablesorter();
					$.each(teams, function(teamIndex, team)
					{
						html = "<tr style='background: #d5d5d5'>"+
									"<td>"+teamIndex+"</td>"+
									"<td align='left'>"+"<strong>"+team.team.nombre+"</strong>"+"</td>"+
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
			phaseId: $("#firstPhase").attr('data-phase-id')
		}
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
								console.log(game);
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
			var phaseId = $(this).attr('data-phase-id');
			var url = $(this).attr('href');
			var data = {
				phaseId: phaseId
			}
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
								console.log(game);
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


	return {
		init: function () {
			groupsFixturesForCompetition();
			gamesForFirtsPhase();
			gameForPhases();
		}
	}
}();