<script id="edit-phase-tpl" type="text/x-handlebars-template">
	<div class="box-title">
		<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">{{title}}</span></h4>
	</div>
	<div class="box-body">
		<form action="#" method="GET" class='form-horizontal', role='form', id='edit-phase-form'>
			<div class="form-group">
				<label for="name" class = "col-md-2 control-label" >Observación</label>
				<div class="col-md-6">
					<input type="text" name="name_edit" class = "form-control" id="name-phase-edit" value="{{name}}" />
				</div>
			</div>
			<div class="form-group">
				<label for="from" class = "col-md-2 control-label" >Desde</label>
				<div class="col-md-6">
					<input type="text" name="from_edit" class = "form-control datepicker" id="from-phase-edit" value="{{from}}" />
				</div>
			</div>
			<div class="form-group">
				<label for="to" class = "col-md-2 control-label" >Hasta</label>
				<div class="col-md-6">
					<input type="text" name="to_edit" class = "form-control datepicker" id="to-phase-edit" value="{{to}}" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					<div class="checkbox">
						<label> 
							<input type="checkbox" name="last_phase_edit" value="{{last_value}}"> Última
						</label>
					</div>
				</div>
			</div>
		</form>
	</div>
</script>