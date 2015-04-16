<div id="country-form-div" class="box border primary">
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
					{{ Form::open(['route' => 'paises.store','class'=>'form-horizontal','role'=>'form',
					'method' => 'POST','files' => true,'id'=> 'country-form']) }}
						
						<div class="form-group" style="display: none;">
							{{ Form::label('pais_id','Id',['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('pais_id',null, ['class' => 'form-control','id' => 'pais_id']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('nombre','Nombre',['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('nombre',null, ['class' => 'form-control','id' => 'nombre']) }}
							</div>
						</div>

						<div class="form-group">
							{{ Form::label('bandera','Bandera',['class'=>'col-sm-2 control-label']) }}
							<div class="col-sm-6">
								{{ Form::text('bandera',null, ['class' => 'form-control','id' => 'bandera']) }}
							</div>
						</div>

					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>

