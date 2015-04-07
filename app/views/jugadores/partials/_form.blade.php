<div id="new-player-form" class="box border primary">
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
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label class="col-sm-3 control-label">Nombre</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" placeholder="Text input">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Textarea</label>
							<div class="col-sm-9">
								<textarea class="form-control" rows="3"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Inline checkboxes</label>
							<div class="col-sm-9">
								<label class="checkbox-inline">
									<input type="checkbox" id="inlineCheckbox1" value="option1"> 1
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="inlineCheckbox2" value="option2"> 2
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" id="inlineCheckbox3" value="option3"> 3
								</label>
							</div>
						</div>
						<div class="divide-20"></div>
						<div class="form-group">
							<label class="col-sm-3 control-label">País</label>
							<div class="col-sm-9">
								<select class="form-control">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<input type="file" class="file-upload"></a>
						</div>

						<button type="submit" class="btn btn-success">Guardar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>