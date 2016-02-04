var CustomPublicApp = function () {
	
	$("#positionsForTeams").tablesorter();

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
				console.log(response);
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


	return {
		init: function () {
			groupsFixturesForCompetition();
		}
	}
}();