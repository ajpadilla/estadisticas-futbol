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
								[   'primera' => 'primera',
									'desempate descenso primera' => 'desempate descenso primera',
									'liguilla' => 'liguilla',
									'b nacional' => 'b nacional',
									'desempate ascenso b nacional' => 'desempate ascenso b nacional',
									'desempate descenso b nacional' => 'desempate descenso b nacional',
									'reducido b nacional' => 'reducido b nacional',
									'b metro' => 'b metro',
									'desempate ascenso b metro' => 'desempate ascenso b metro',
									'desempate descenso b metro' => 'desempate descenso b metro',
									'reducido b metro' => 'reducido b metro',
									'federal a' => 'federal a',
									'desempate ascenso federal a' => 'desempate ascenso federal a',
									'desempate descenso federal a' => 'desempate descenso federal a',
									'reducido federal a' => 'reducido federal a',
									'primera c' => 'primera c',
									'desempate ascenso primera c' => 'desempate ascenso primera c',
									'desempate descenso primera c' => 'desempate descenso primera c',
									'reducido primera c'  => 'reducido primera c',
									'primera d'  => 'primera d',
									'desempate ascenso primera d'  => 'desempate ascenso primera d',
									'desempate descenso primera d'  =>  'desempate descenso primera d',
									'reducido primera d'  => 'reducido primera d',
									'federal b'  => 'federal b',
									'desempate ascenso federal b' =>  'desempate ascenso federal b',
									'desempate descenso federal b' =>  'desempate descenso federal b',
									'reducido federal b'  => 'reducido federal b',
									'copa mundial' =>  'copa mundial',
									'eliminatorias copa mundial'  => 'eliminatorias copa mundial',
									'copa america'  => 'copa america',
									'copa libertadores' =>  'copa libertadores',
									'champion L'  => 'champion L',
									'copa argentina'  => 'copa argentina',
									'sudamericana'  => 'sudamericana',
									'mundial de clubes' => 'mundial de clubes',
									'repechaje' => 'repechaje'
								]
							,null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoge Tipo...','id'=> 'type_competition_load']) }}
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
					{{--< --div class="form-group">
						{{ Form::label('competition_format_id','Formato de competencía',['class'=>'col-sm-2 control-label']) }}
						<div class="col-sm-6">
							{{ Form::select('competition_format_id',array(),null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoge formatooooo...','id'=> 'competition_format_id']) }}
						</div>
					</div>--}}
					<div class="form-group">
						{{ Form::label('previous_id','Competencia previa',['class'=>'col-sm-2 control-label']) }}
						<div class="col-sm-6">
						{{ Form::select('previous_id',[],null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoge competencia...','id'=>'competition_previous_id']) }}
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

