<div id="competition-form-div" class="box border primary">
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
					{{ Form::open(['route' => 'competencias.store','class'=>'form-horizontal','role'=>'form',
					'method' => 'POST','files' => true,'id'=> 'competition-form']) }}
					<div class="form-group">
						{{ Form::label('nombre','Nombre',['class'=>'col-sm-2 control-label']) }}
						<div class="col-sm-6">
							{{ Form::text('nombre',null, ['class' => 'form-control','id' => 'nombre-competencia']) }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('type','Tipo',['class'=>'col-sm-2 control-label']) }}
						<div class="col-sm-6">
							{{ Form::select('type',
								[   'primera',
									'desempate descenso primera'
									'liguilla'
									'b nacional',
									'desempate ascenso b nacional'
									'desempate descenso b nacional'
									'reducido b nacional'
									'b metro',
									'desempate ascenso b metro'
									'desempate descenso b metro'
									'reducido b metro'
									'federal a',
									'desempate ascenso federal a'
									'desempate descenso federal a'
									'reducido federal a'
									'primera c',
									'desempate ascenso primera c'
									'desempate descenso primera c'
									'reducido primera c'
									'primera d',
									'desempate ascenso primera d'
									'desempate descenso primera d'
									'reducido primera d'
									'federal b',
									'desempate ascenso federal b'
									'desempate descenso federal b'
									'reducido federal b'
									'copa mundial',
									'eliminatorias copa mundial',
									'copa america',
									'copa libertadores',
									'champion L',
									'copa argentina',
									'sudamericana',
									'mundial de clubes'
								]
							,null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoge Tipo...','id'=> 'type_competition']) }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('desde', 'Desde', ['class' => 'col-md-2 control-label']) }}	
						<div class="col-md-6">{{ Form::text('desde', null, ['class' => 'form-control datepicker', 'id'=>'desde-competencia']) }}</div>
					</div>
					<div class="form-group">
						{{ Form::label('hasta', 'Hasta', ['class' => 'col-md-2 control-label']) }}	
						<div class="col-md-6">{{ Form::text('hasta', null, ['class' => 'form-control datepicker', 'id'=>'hasta-competencia']) }}</div>
					</div>
					<div class="form-group">
						{{ Form::label('competition_format_id','Formato de competencía',['class'=>'col-sm-2 control-label']) }}
						<div class="col-sm-6">
							{{ Form::select('competition_format_id',array(),null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoge formato...','id'=> 'competition_format_id']) }}
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-6">
							<div class="checkbox">
								<label> 
									{{ Form::checkbox('international', '1',false,['id' => 'competition-international'])}}
									<i></i> Internacional	
								</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						{{ Form::label('country_id','País',['class'=>'col-sm-2 control-label']) }}
						<div class="col-sm-6">
							{{ Form::select('country_id',array(),null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoge País...','id'=>'pais-competencias']) }}
						</div>
					</div>
					<div class="form-group">
						{{ Form::file('imagen', ['class' => 'file-upload']) }}
					</div> 
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>

