{{ Form::model($player, ['route' => ['players.update', $player->id], 'class' => 'form-horizontal','files' => true]) }}
	<div class="row">
	 @include('layouts.partials._error')
		<div class="col-md-6">
			<div class="box border green">
				<div class="box-title">
					<h4><i class="fa fa-bars"></i>Información General</h4>
				</div>
				<div class="box-body big">
					<div class="row">
						<div class="col-md-12">
								@include('players.partials._basic-form-edit')
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
								@include('players.partials._details-form-edit')
						</div>
					</div>
				</div>
			</div>	
		</div>		
	</div>
	<div class="form-actions clearfix"> 
		<input type="submit" value="Guardar" class="btn btn-primary pull-right"> 
	</div>
{{ Form::close() }}						

