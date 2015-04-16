<div id="country-form-view-div" class="box border primary">
	<div class="box-title">
		<h4><i class="fa fa-plus-square"></i>@yield('title-modal')</h4>
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
					<form id="country-form-view" class="form-horizontal" role="form">
						<a href="#"><img src="" alt="" id="imgen_vista">
						</a>
						<div class="form-group">
							<label class="col-sm-3 control-label">Nombre</label>
							<div class="col-sm-9">
								<input id="nombre_vista" name="nombre" type="text" class="form-control" placeholder="Text input">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Bandera</label>
							<div class="col-sm-9">
								<input id="bandera_vista" name="bandera" type="text" class="form-control" placeholder="Text input">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>