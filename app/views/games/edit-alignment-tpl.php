<script id="edit-alignment-tpl" type="text/x-handlebars-template">
		<div class="box-title">
			<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">{{title}}</span></h4>
		</div>
		<div class="box-body">
			<form action="#" method="GET" class='form-horizontal', role='form', id='edit-alignment-to-game-form'>
				<div class="form-group">
					<label for="observations" class = "col-sm-2 control-label" >Observación</label>
					<div class="col-sm-6">
						<input type="text" name="observations" class = "form-control" id="observations-alignment-edit" value="{{observations_alignment}}" />
					</div>
				</div>
				<div class="form-group">
					<label for="team_id" class = "col-sm-2 control-label" >Equipo</label>
					<div class="col-md-6">
						<select name="team_id" class="form-control chosen-select" data-placeholder = "Escoger Equipo..." id="team-for-alignment-edit">
						  <option value="{{team_alignment_id}}">{{team_alignment}}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="player_id" class = "col-sm-2 control-label" >Jugador</label>
					<div class="col-md-6">
						<select name="player_id" class="form-control chosen-select" data-placeholder = "Escoger Jugador..." id="player-alignment-id-edit">
						  <option value="{{player_alignment_id}}">{{player_name}}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="position_id" class = "col-sm-2 control-label" >Posición</label>
					<div class="col-md-6">
						<select name="position_id" class="form-control chosen-select" data-placeholder = "Escoger Posición..." id="position-alignment-id-edit">
						  <option value="{{position_alignment_id}}">{{position_name}}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="type_id" class = "col-sm-2 control-label" >Tipo de alineación</label>
					<div class="col-md-6">
						<select name="type_id" class="form-control chosen-select" data-placeholder = "Escoger Tipo..." id="type-alignment-id-edit">
						  <option value="{{type_alignment_id}}">{{type_alignment_name}}</option>
						</select>
					</div>
				</div>
			</form>
		</div>
</script>