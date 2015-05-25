<script id="edit-change-tpl" type="text/x-handlebars-template">
		<div class="box-title">
			<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">{{title}}</span></h4>
		</div>
		<div class="box-body">
			<form action="#" method="GET" class='form-horizontal', role='form', id='edit-change-to-game-form'>
				<div class="form-group">
					<label for="observations" class = "col-sm-2 control-label" >Observación</label>
					<div class="col-sm-6">
						<input type="text" name="observations" class = "form-control" id="observations-change-edit" value="{{observations_change}}" />
					</div>
				</div>
				<div class="form-group">
					<label for="minute" class = "col-sm-2 control-label" >Minuto</label>
					<div class="col-sm-6">
						<input type="text" name="minute" class = "form-control" id="minute-change-edit" value="{{minute_change}}" />
					</div>
				</div>
				<div class="form-group">
					<label for="second" class = "col-sm-2 control-label" >Segundo</label>
					<div class="col-sm-6">
						<input type="text" name="second" class = "form-control" id="second-change-edit" value="{{second_change}}" />
					</div>
				</div>
				<div class="form-group">
					<label for="team_id" class = "col-sm-2 control-label" >Equipo</label>
					<div class="col-md-6">
						<select name="team_id" class="form-control chosen-select" data-placeholder = "Escoger Equipo..." id="team-for-change-edit">
						  <option value="{{team_change_id}}">{{team_change}}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="player_out_id" class = "col-sm-2 control-label" >Jugador</label>
					<div class="col-md-6">
						<select name="player_out_id" class="form-control chosen-select" data-placeholder = "Escoger Jugador..." id="player-change-out-id-edit">
						  <option value="{{player_change_out_id}}">{{player_out_name}}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="player_in_id" class = "col-sm-2 control-label" >Jugador</label>
					<div class="col-md-6">
						<select name="player_in_id" class="form-control chosen-select" data-placeholder = "Escoger Jugador..." id="player-change-in-id-edit">
						  <option value="{{player_change_in_id}}">{{player_in_name}}</option>
						</select>
					</div>
				</div>
			</form>
		</div>
</script>