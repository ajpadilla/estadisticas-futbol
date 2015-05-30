<script id="edit-competition-format-tpl" type="text/x-handlebars-template">
	<div class="box-title">
		<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">{{title}}</span></h4>
	</div>
	<div class="box-body">
		<form action="#" method="GET" class='form-horizontal', role='form', id='edit-competition-format-form'>
			<div class="form-group">
				<label for="name" class = "col-sm-2 control-label" >Nombre</label>
				<div class="col-sm-6">
					<input type="text" name="name" class = "form-control" id="name-competition-format-edit" value="{{name}}" />
				</div>
			</div>
			<div class="form-group">
				<label for="groups" class = "col-sm-2 control-label" >Grupos</label>
				<div class="col-sm-6">
					<input type="text" name="groups" class = "form-control" id="groups-competition-format-edit" value="{{groups}}" />
				</div>
			</div>
			<div class="form-group">
				<label for="clasificated_by_group" class = "col-sm-2 control-label" >Clasificados por grupo</label>
				<div class="col-sm-6">
					<input type="text" name="clasificated_by_group" class = "form-control" id="clasificated-by-group-competition-format-edit" value="{{clasificated_by_group}}" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<div class="checkbox">
						<label> 
							<input type="checkbox" name="local_away_game" value="{{local_away_game}}" id="local-away-game-edit"> Partido de ida local
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<div class="checkbox">
						<label> 
							<input type="checkbox" name="local_away_game_final" value="{{local_away_game_final}}" id="local-away-game-final-edit"> Último partido fuera de casa local
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<div class="checkbox">
						<label> 
							<input type="checkbox" name="away_goal" value="{{away_goal}}" id="away-goal-edit"> Gol fuera de casa
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="teams_by_group" class = "col-sm-2 control-label" >Equipos Por Grupo</label>
				<div class="col-sm-6">
					<input type="text" name="teams_by_group" class = "form-control" id="teams-by-group-competition-format-edit" value="{{teams_by_group}}" />
				</div>
			</div>
			<div class="form-group">
				<label for="promotion" class = "col-sm-2 control-label" >Promoción</label>
				<div class="col-sm-6">
					<input type="text" name="promotion" class = "form-control" id="promotion-competition-format-edit" value="{{promotion}}" />
				</div>
			</div>
			<div class="form-group">
				<label for="descent" class = "col-sm-2 control-label" >Descenso</label>
				<div class="col-sm-6">
					<input type="text" name="descent" class = "form-control" id="descent-competition-format-edit" value="{{descent}}" />
				</div>
			</div>
		</form>
	</div>
</script>