<script id="player-form-view-div-tpl" type="text/x-handlebars-template">
	<div id="player-form-view-div" class="box border primary">
	<div class="box-title">
		<h4><i class="fa fa-plus-square"></i>{{ title }}</h4>
		<div class="tools">
			<a href="javascript:;" class="reload">
				<i class="fa fa-refresh"></i>
			</a>
			<a href="javascript:;" class="collapse">
				<i class="fa fa-chevron-up"></i>
			</a>
		</div>
	</div>
	<div class="box-body" style="display: block;">
		<div class="row">
			<div class="col-md-12">

				<div class="divide-20"></div>
				<div class="box-body big">
					<form id="player-form-view" class="form-horizontal" role="form">
						<a href="#"><img src="{{ url }}<" alt="{{ alt-text }}">
						</a>
						<div class="form-group">
							<label class="col-sm-3 control-label">{{ name }}<</label>
							<div class="col-sm-9">
								<input name="nombre" type="text" class="form-control" placeholder="Text input">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">{{ height }}</label>
							<div class="col-sm-9">
								<input name="nombre" type="text" class="form-control" placeholder="Text input">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">{{ abbreviation }}</label>
							<div class="col-sm-9">
								<input name="nombre" type="text" class="form-control" placeholder="Text input">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">{{ position }}</label>
							<div class="col-sm-9">
								<input name="nombre" type="text" class="form-control" placeholder="Text input">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">{{ country }}</label>
							<div class="col-sm-9">
								<input name="nombre" type="text" class="form-control" placeholder="Text input">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</script>