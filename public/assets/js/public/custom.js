var CustomPublicApp = function () {
	
	
	var teamsFormCompetition = function() 
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
				console.log(response);
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
			teamsFormCompetition();
		}
	}
}();