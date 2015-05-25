<script id="edit-goal-tpl" type="text/x-handlebars-template">
		<div class="box-title">
			<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">{{title}}</span></h4>
		</div>
		<div class="box-body">
			<form action="#" method="GET" class='form-horizontal', role='form', id='edit-goals-to-game-form'>
				<div class="form-group">
					<label for="observations" class = "col-sm-2 control-label" >Observación</label>
					<div class="col-sm-6">
						<input type="text" name="observations" class = "form-control" id="observations-game-edit" value="{{observations_game}}" />
					</div>
				</div>
				<div class="form-group">
					<label for="minute" class = "col-sm-2 control-label" >Minuto</label>
					<div class="col-sm-6">
						<input type="text" name="minute" class = "form-control" id="minute-game-edit" value="{{minute_game}}" />
					</div>
				</div>
				<div class="form-group">
					<label for="second" class = "col-sm-2 control-label" >Segundo</label>
					<div class="col-sm-6">
						<input type="text" name="second" class = "form-control" id="second-game-edit" value="{{second_game}}" />
					</div>
				</div>
				<div class="form-group">
					<label for="type_id" class = "col-sm-2 control-label" >Tipo de gol</label>
					<div class="col-md-6">
						<select name="type_id" class="form-control chosen-select" data-placeholder = "Escoger Tipo..." id="goal-types-for-games-id-edit">
						  <option value="{{type_goal_id}}">{{type_goal}}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="team_id" class = "col-sm-2 control-label" >Equipo</label>
					<div class="col-md-6">
						<select name="team_id" class="form-control chosen-select" data-placeholder = "Escoger Equipo..." id="team-for-game-edit">
						  <option value="{{team_goal_id}}">{{team_goal}}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="player_id" class = "col-sm-2 control-label" >Jugador</label>
					<div class="col-md-6">
						<select name="player_id" class="form-control chosen-select" data-placeholder = "Escoger Jugador..." id="player-for-game-id-edit">
						  <option value="{{player_goal_id}}">{{player_goal}}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="assistance_id" class = "col-sm-2 control-label" >Asistencia</label>
					<div class="col-md-6">
						<select name="assistance_id" class="form-control chosen-select" data-placeholder = "Escoger Jugador..." id="assistance-for-game-id-edit">
						  <option value="{{assistance_goal_id}}">{{assistance_goal}}</option>
						</select>
					</div>
				</div>
			</form>
		</div>
</script>