<div id="player-form-view-div" class="box border primary">
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
					<form id="player-form-view" class="form-horizontal" role="form">
						<a href="#"><img src="" alt="" id="imgen_vista">
						</a>
						<div class="form-group">
							<label class="col-sm-3 control-label">Nombre</label>
							<div class="col-sm-9">
								<input id="nombre_vista" name="nombre" type="text" class="form-control" placeholder="Text input">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Fecha de nacimiento</label>
							<div class="col-sm-9">
								<input id="fecha_vista" name="nombre" type="text" class="form-control" placeholder="Text input">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Altura</label>
							<div class="col-sm-9">
								<input id="altura_vista" name="altura" type="text" class="form-control" placeholder="Text input">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Abreviación</label>
							<div class="col-sm-9">
								<input  id="abreviacion_vista" name="abreviacion" type="text" class="form-control" placeholder="Text input">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Posición</label>
							<div class="col-sm-9">
								<input id="posicion_vista" name="posicion" type="text" class="form-control" placeholder="Text input">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">País</label>
							<div class="col-sm-9">
								<input id="pais_vista" name="pais" type="text" class="form-control" placeholder="Text input">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>