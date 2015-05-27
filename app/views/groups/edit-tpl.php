<script id="edit-group-tpl" type="text/x-handlebars-template">
		<div class="box-title">
			<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">{{title}}</span></h4>
		</div>
		<div class="box-body">
			<form action="#" method="GET" class='form-horizontal', role='form', id='edit-group-to-phase-form'>
				<div class="form-group">
					<label for="name" class = "col-md-2 control-label" >Observación</label>
					<div class="col-md-6">
						<input type="text" name="name" class = "form-control" id="name-group-edit" value="{{name}}" />
					</div>
				</div>
				<div class="form-group">
					<label for="teams_ids" class = "col-md-2 control-label" >Equipos</label>
					<div class="col-md-6">
						<select multiple name="teams_ids" class="form-control chosen-select" data-placeholder = "Escoger Equipos..." id="teams-for-group-ids-edit">
						  <option value="{{team_id}}">{{team_name}}</option>
						</select>
					</div>
				</div>
			</form>
		</div>
</script>