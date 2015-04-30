<div id="type-of-competition-form-div" class="box border primary">
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
					{{ Form::open(['route' => 'tipos-competencia.store','class'=>'form-horizontal','role'=>'form',
					'method' => 'POST','files' => true,'id'=> 'type-of-competition-form']) }}
						<div class="row">
							<div class="form-group" style="display: none;">
								{{ Form::label('tipo_competencia_id','Id',['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-6">
									{{ Form::text('tipo_competencia_id',null, ['class' => 'form-control','id' => 'tipo_competencia_id']) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('nombre','Nombre',['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-6">
									{{ Form::text('nombre',null, ['class' => 'form-control','id' => 'nombre-tipo-competicion']) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('grupos','Grupos',['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-6">
									{{ Form::text('grupos',0, ['class' => 'form-control','placeholder' => 0,'id' => 'grupos-tipo-competicion']) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('fases_eliminatorias','Fases Eliminatorias',['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-6">
									{{ Form::text('fases_eliminatorias',0, ['class' => 'form-control','placeholder' => 0,'id' => 'fases-eliminatorias-tipo-competicion']) }}
								</div>
							</div>
							<div class="form-group">
								{{--{{ Form::label('ida_vuelta', 'Ida Vuelta',['class'=>'col-sm-2 control-label']) }}--}}
								<div class="col-sm-6">
									<div class="checkbox">
										<label> 
											{{ Form::checkbox('ida_vuelta', '1', 0)}}
											<i></i> Ida Vuelta	
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								{{--{{ Form::label('pre_clasificacion', 'Pre Clasificacion',['class'=>'col-sm-2 control-label']) }}--}}
								<div class="col-sm-6">
									<div class="checkbox">
										<label> 
											{{ Form::checkbox('pre_clasificacion', '1', 0)}}
											<i></i> Pre Clasificación	
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('equipos_por_grupo','Equipos Por Grupo',['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-6">
									{{ Form::text('equipos_por_grupo',0, ['class' => 'form-control','placeholder' => 0,'id' => 'equipos-por-grupo-tipo-competicion']) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('ascenso','Ascenso',['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-6">
									{{ Form::text('ascenso',0, ['class' => 'form-control','placeholder' => 0,'id' => 'ascenso-tipo-competicion']) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('descenso','Descenso',['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-6">
									{{ Form::text('descenso',0, ['class' => 'form-control','placeholder' => 0,'id' => 'descenso-tipo-competicion']) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label('clasificados_por_grupo','Clasificados Por Grupo',['class'=>'col-sm-2 control-label']) }}
								<div class="col-sm-6">
									{{ Form::text('clasificados_por_grupo',0, ['class' => 'form-control','placeholder' => 0,'id' => 'clasificados-por-grupo-tipo-competicion']) }}
								</div>
							</div>
						</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>
