<script id="edit-sanction-tpl" type="text/x-handlebars-template">
		<div class="box-title">
			<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">{{title}}</span></h4>
		</div>
		<div class="box-body">
			<form action="#" method="GET" class='form-horizontal', role='form', id='edit-sanction-to-game-form'>
				<div class="form-group">
					<label for="observations" class = "col-sm-2 control-label" >Observación</label>
					<div class="col-sm-6">
						<input type="text" name="observations" class = "form-control" id="observations-sanction-edit" value="{{observations_sanction}}" />
					</div>
				</div>
				<div class="form-group">
					<label for="minute" class = "col-sm-2 control-label" >Minuto</label>
					<div class="col-sm-6">
						<input type="text" name="minute" class = "form-control" id="minute-sanction-edit" value="{{minute_sanction}}" />
					</div>
				</div>
				<div class="form-group">
					<label for="second" class = "col-sm-2 control-label" >Segundo</label>
					<div class="col-sm-6">
						<input type="text" name="second" class = "form-control" id="second-sanction-edit" value="{{second_sanction}}" />
					</div>
				</div>
				<div class="form-group">
					<label for="type_id" class = "col-sm-2 control-label" >Tipo de sanción</label>
					<div class="col-md-6">
						<select name="type_id" class="form-control chosen-select" data-placeholder = "Escoger Tipo..." id="sanction-type-for-game-id-edit">
						  <option value="{{type_sanction_id}}">{{type_sanction}}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="team_id" class = "col-sm-2 control-label" >Equipo</label>
					<div class="col-md-6">
						<select name="team_id" class="form-control chosen-select" data-placeholder = "Escoger Equipo..." id="team-for-sanction-edit">
						  <option value="{{team_sanction_id}}">{{team_sanction}}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="player_id" class = "col-sm-2 control-label" >Jugador</label>
					<div class="col-md-6">
						<select name="player_id" class="form-control chosen-select" data-placeholder = "Escoger Jugador..." id="player-for-sanction-id-edit">
						  <option value="{{player_sanction_id}}">{{player_sanction}}</option>
						</select>
					</div>
				</div>
			</form>
		</div>
</script>