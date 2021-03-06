@extends("public.layouts.main")

@section("content")
	@if(count($cups)> 0)
		@if($currentCup->isClean)
			<div style="clear: both;"></div>
			<br/>
			<div style="clear: both;"></div>
			<br/>
			@include('public.mundial.partials._info-cup')
			<div style="clear: both;"></div>
			<br/>
			@include('public.mundial.partials._google-syndication')
			<div style="clear: both;"></div>
			<br>
			@include('public.mundial.partials._competition-eliminatory')
			<div style="clear: both;"></div>
			<br/>
			<br>
			@include('public.mundial.partials._ranked-teams')
			<div style="clear: both;"></div>
		@else
			<br/>
			@include('public.mundial.partials._google-syndication')
			@include('public.mundial.partials._info-cup')
			<div style="clear: both;"></div>
			<br>
			<br>
			@include('public.mundial.partials._games-for-day')
			<div style="clear: both;"></div>
			<br>
			@include('public.mundial.partials._final-phase')
			@include('public.mundial.partials._table-games-phase-tpl')
			<br/>
		@endif
	@endif
@stop

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function () 
		{

			var dataForCompetition = function() {
				var data = {
						competitionId : $('#currentCompetitionId').attr('data-competition-id')
				};
				$.ajax({
					type: 'GET',
					url: '{{ route('currentCompetition') }}' ,
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
			}

			var gameForPhases = function() 
			{
				$(".phasesWithGames").click(function(event) 
				{
					event.preventDefault();

					jQuery('#tableGamesForPhase').html('');

					var phaseId = $(this).attr('data-phase-id');
					var url = $(this).attr('href');
					var data = {
						phaseId: phaseId,
						competitionId : $(this).attr('data-competition-id')
					};
					console.log(data);
					$.ajax({
						type: 'GET',
						url: url,
						data: data,
						dataType:'json',
						success: function(response) {
							console.log(response);
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
			dataForCompetition();
			gameForPhases();
		});
	</script>
@stop