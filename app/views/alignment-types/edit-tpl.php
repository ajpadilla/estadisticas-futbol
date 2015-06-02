<script id="edit-alignmet-type-tpl" type="text/x-handlebars-template">
	<div class="box-title">
		<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">{{title}}</span></h4>
	</div>
	<div class="box-body">
		<form action="#" method="GET" class='form-horizontal', role='form', id='edit-alignmet-type-form'>
			<div class="form-group">
				<label for="name" class = "col-sm-2 control-label" >Nombre</label>
				<div class="col-sm-6">
					<input type="text" name="name" class = "form-control" id="alignmet-type-name-edit" value="{{name}}" />
				</div>
			</div>
		</form>
	</div>
</script>