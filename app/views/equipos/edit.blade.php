{{ Form::model($equipo, ['route' => ['equipos.edit', $equipo->id], 'class' => 'form-horizontal']) }}
	<div class="row">
		<div class="col-md-6">
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-bars"></i>Información General</h4>
				</div>
				<div class="box-body big">
					<div class="row">
						<div class="col-md-12">
								@include('equipos.partials._basic-form')
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-bars"></i>Detalles</h4>
				</div>
				<div class="box-body big">
					<div class="row">
						<div class="col-md-12">
								@include('equipos.partials._details-form')
						</div>
					</div>
				</div>
			</div>	
		</div>		
	</div>
{{ Form::close() }}						
<div class="form-actions clearfix"> 
	<input type="submit" value="Actualizar Cuenta" class="btn btn-primary pull-right"> 
</div>