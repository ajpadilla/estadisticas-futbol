<script id="edit-game-tpl" type="text/x-handlebars-template">
	<div class="box-title">
		<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">{{title}}</span></h4>
	</div>
	<div class="box-body">
		<form action="#" method="GET" class='form-horizontal', role='form', id='edit-game-form'>
			<div class="form-group">
				<label for="date" class = "col-md-2 control-label" >Fecha y hora</label>
				<div class="col-md-6">
					<input type="text" name="date" class = "form-control datepicker-time" id="date-for-game-edit" value="{{date}}" />
				</div>
			</div>
			<div class="form-group">
				<label for="type_id" class = "col-sm-2 control-label" >Tipo de juego</label>
				<div class="col-md-6">
					<select name="type_id" class="form-control chosen-select" data-placeholder = "Escoger tipo..." id="type-id-for-game-edit">
						<option value="{{type_id}}">{{type_name}}</option>
					</select>
				</div>
			</div>
		</form>
	</div>
</script>