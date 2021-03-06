<div class="col-md-12">
	<!-- BOX -->
	<div  id="add-phase-to-competition-form-div" class="box border primary col-md-12">
		<div class="box-title">
			<h4><i class="fa fa-user"></i><span class="hidden-inline-mobile">Agregar Nueva Fase</span></h4>
		</div>
		<div class="box-body">
			{{ Form::open(['route' => 'competitions.api.add.phase','class'=>'form-horizontal', 'role'=>'form', 'method' => 'POST', 'id' => 'add-phase-to-competition-form']) }}

			<div class="form-group">
				{{ Form::label('name', 'Nombre', ['class' => 'col-md-2 control-label']) }}	
				<div class="col-md-6">{{ Form::text('name', null, ['class' => 'form-control','id' =>'name-new-phase-to-competition' ]) }}</div>
			</div>
	
			<div class="form-group">
				{{ Form::label('type','Tipo',['class'=>'col-sm-2 control-label']) }}
				<div class="col-sm-6">
					{{ Form::select('type',
						[
						'' => '',
						'fase de grupos'=> 'fase de grupos',
						'octavos' => 'octavos',
						'cuartos' => 'cuartos',
						'semifinal' => 'semifinal',
						'final' => 'final',
						'repechaje' => 'repechaje',
						'tercer lugar' => 'tercer lugar'
						]
						,null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoge Tipo...','id'=> 'type_phase']) }}
					</div>
			</div>

				<div class="form-group">
				{{ Form::label('from', 'Desde', ['class' => 'col-md-2 control-label']) }}	
				<div class="col-md-6">{{ Form::text('from', null, ['class' => 'form-control datepicker','id' =>'from-new-phase-to-competition' ]) }}</div>
			</div>			

			<div class="form-group">
				{{ Form::label('to', 'Hasta', ['class' => 'col-md-2 control-label ']) }}	
				<div class="col-md-6">{{ Form::text('to', null, ['class' => 'form-control datepicker','id' =>'to-new-phase-to-competition' ]) }}</div>
			</div>						

			<div class="form-group">
				{{ Form::label('format_id','Formatos',['class'=>'col-md-2 control-label']) }}
				<div class="col-md-6">
					{{ Form::select('format_id', $formats->lists('name', 'id'), null,['class' => 'form-control chosen-select','data-placeholder' => 'Escoger formato...','id'=>'competition-new-format-id']) }}
				</div>
			</div>	

			<div class="form-group">
				<div class="col-md-6">
					<div class="checkbox">
						<label> 
						{{ Form::checkbox('last', '1', false)}}
							<i></i> Última	
						</label>
					</div>
				</div>
			</div>
			{{ Form::close() }}
		</div>
	</div>
	<!-- /BOX -->					
</div>